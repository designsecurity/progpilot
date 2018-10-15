const walker = require('walkes');

// FIXME: switch/case with default before other cases?
// FIXME: catch creates a new scope, so should somehow be handled differently

// TODO: try/finally: finally follows try, but does not return to normal flow?

// TODO: labeled break/continue
// TODO: WithStatement

// TODO: avoid adding and deleting properties on ast nodes

const continueTargets = ['ForStatement', 'ForInStatement', 'DoWhileStatement', 'WhileStatement'];
const breakTargets = continueTargets.concat(['SwitchStatement']);
const throwTypes = [
  'AssignmentExpression', // assigning to undef or non-writable prop
  'BinaryExpression', // instanceof and in on non-objects
  'CallExpression', // obviously
  'MemberExpression', // getters may throw
  'NewExpression', // obviously
  'UnaryExpression', // delete non-deletable prop
];

class FlowNode {
  constructor(astNode, parent, type) {
    this.astNode = astNode;
    this.parent = parent;
    this.type = type;
    this.prev = [];
  }

  connect(next, type) {
    this[type || 'normal'] = next;
    return this;
  }
}

/**
 * Returns [entry, exit] `FlowNode`s for the passed in AST
 */
function ControlFlowGraph(astNode) {
  const parentStack = [];
  const exitNode = new FlowNode(undefined, undefined, 'exit');
  const catchStack = [exitNode];

  createNodes(astNode);
  linkSiblings(astNode);

  walker(astNode, {
    CatchClause(node, recurse) {
      node.cfg.connect(getEntry(node.body));
      recurse(node.body);
    },
    DoWhileStatement(node, recurse) {
      mayThrow(node.test);
      node.test.cfg.connect(getEntry(node.body), 'true').connect(getSuccessor(node), 'false');
      recurse(node.body);
    },
    ExpressionStatement: connectNext,
    FunctionDeclaration() {},
    ForStatement(node, recurse) {
      if (node.test) {
        mayThrow(node.test);
        node.test.cfg.connect(getEntry(node.body), 'true').connect(getSuccessor(node), 'false');
        if (node.update) node.update.cfg.connect(node.test.cfg);
      } else if (node.update) node.update.cfg.connect(getEntry(node.body));

      if (node.update) mayThrow(node.update);

      if (node.init) {
        mayThrow(node.init);
        node.init.cfg.connect((node.test && node.test.cfg) || getEntry(node.body));
      }

      recurse(node.body);
    },
    ForInStatement(node, recurse) {
      mayThrow(node);
      node.cfg.connect(getEntry(node.body), 'true').connect(getSuccessor(node), 'false');
      recurse(node.body);
    },
    IfStatement(node, recurse) {
      recurse(node.consequent);
      mayThrow(node.test);
      node.test.cfg.connect(getEntry(node.consequent), 'true');
      if (node.alternate) {
        recurse(node.alternate);
        node.test.cfg.connect(getEntry(node.alternate), 'false');
      } else node.test.cfg.connect(getSuccessor(node), 'false');
    },
    ReturnStatement(node) {
      mayThrow(node);
      node.cfg.connect(exitNode);
    },
    SwitchCase(node, recurse) {
      if (node.test) {
        // if this is a real case, connect `true` to the body
        // or the body of the next case
        let check = node;

        while (!check.consequent.length && check.cfg.nextSibling) {
          check = check.cfg.nextSibling.astNode;
        }

        node.cfg.connect(
          (check.consequent.length && getEntry(check.consequent[0])) ||
            getSuccessor(node.cfg.parent),
          'true',
        );

        // and connect false to the next `case`
        node.cfg.connect(getSuccessor(node), 'false');
      } else {
        // this is the `default` case, connect it to the body, or the
        // successor of the parent
        const next =
          (node.consequent.length && getEntry(node.consequent[0])) || getSuccessor(node.cfg.parent);
        node.cfg.connect(next);
      }
      node.consequent.forEach(recurse);
    },
    SwitchStatement(node, recurse) {
      node.cfg.connect(node.cases[0].cfg);
      node.cases.forEach(recurse);
    },
    ThrowStatement(node) {
      node.cfg.connect(getExceptionTarget(node), 'exception');
    },
    TryStatement(node, recurse) {
      const handler = (node.handler && node.handler.cfg) || getEntry(node.finalizer);
      catchStack.push(handler);
      recurse(node.block);
      catchStack.pop();

      if (node.handler) recurse(node.handler);
      // node.finalizer.cfg.connect(getSuccessor(node));
      if (node.finalizer) recurse(node.finalizer);
    },
    VariableDeclaration: connectNext,
    WhileStatement(node, recurse) {
      mayThrow(node.test);
      node.test.cfg.connect(getEntry(node.body), 'true').connect(getSuccessor(node), 'false');
      recurse(node.body);
    },
  });

  const entryNode = new FlowNode(astNode, undefined, 'entry');
  entryNode.normal = getEntry(astNode);
  walker(astNode, {
    default(node, recurse) {
      if (!node.cfg) return;
      // ExpressionStatements should refer to their expression directly
      if (node.type === 'ExpressionStatement') node.cfg.astNode = node.expression;

      delete node.cfg;
      walker.checkProps(node, recurse);
    },
  });

  const allNodes = [];
  const reverseStack = [entryNode];
  let cfgNode;
  while (reverseStack.length) {
    cfgNode = reverseStack.pop();
    allNodes.push(cfgNode);
    cfgNode.next = [];
    for (const type of ['exception', 'false', 'true', 'normal']) {
      const next = cfgNode[type];

      if (!next) continue;
      if (!cfgNode.next.includes(next)) cfgNode.next.push(next);
      if (!next.prev.includes(cfgNode)) next.prev.push(cfgNode);
      if (!reverseStack.includes(next) && !next.next) reverseStack.push(next);
    }
  }

  function getExceptionTarget() {
    return catchStack[catchStack.length - 1];
  }

  function mayThrow(node) {
    if (expressionThrows(node)) {
      node.cfg.connect(getExceptionTarget(node), 'exception');
    }
  }
  function expressionThrows(astNode) {
    if (typeof astNode !== 'object' || astNode.type === 'FunctionExpression') return false;

    if (astNode.type && throwTypes.includes(astNode.type)) return true;
    return Object.values(astNode).some((prop) => {
      if (prop instanceof Array) return prop.some(expressionThrows);
      else if (typeof prop === 'object' && prop) return expressionThrows(prop);

      return false;
    });
  }

  function getJumpTarget(astNode, types) {
    let { parent } = astNode.cfg;

    while (!types.includes(parent.type) && parent.cfg.parent) ({ parent } = parent.cfg);

    return types.includes(parent.type) ? parent : null;
  }

  function connectNext(node) {
    mayThrow(node);
    node.cfg.connect(getSuccessor(node));
  }

  /**
   * Returns the entry node of a statement
   */
  function getEntry(astNode) {
    let target;
    switch (astNode.type) {
      case 'BreakStatement':
        target = getJumpTarget(astNode, breakTargets);
        return target ? getSuccessor(target) : exitNode;

      case 'ContinueStatement':
        target = getJumpTarget(astNode, continueTargets);

        switch (target.type) {
          case 'ForStatement':
            // continue goes to the update, test or body
            return (
              (target.update && target.update.cfg) ||
              (target.test && target.test.cfg) ||
              getEntry(target.body)
            );
          case 'ForInStatement':
            return target.cfg;
          case 'DoWhileStatement':
          /* falls through */
          case 'WhileStatement':
            return target.test.cfg;
          default:
        }

      // unreached
      /* falls through */
      case 'BlockStatement':
      /* falls through */
      case 'Program':
        return (astNode.body.length && getEntry(astNode.body[0])) || getSuccessor(astNode);

      case 'DoWhileStatement':
        return getEntry(astNode.body);

      case 'EmptyStatement':
        return getSuccessor(astNode);

      case 'ForStatement':
        return (
          (astNode.init && astNode.init.cfg) ||
          (astNode.test && astNode.test.cfg) ||
          getEntry(astNode.body)
        );

      case 'FunctionDeclaration':
        return getSuccessor(astNode);

      case 'IfStatement':
        return astNode.test.cfg;
      case 'SwitchStatement':
        return getEntry(astNode.cases[0]);

      case 'TryStatement':
        return getEntry(astNode.block);

      case 'WhileStatement':
        return astNode.test.cfg;

      default:
        return astNode.cfg;
    }
  }
  /**
   * Returns the successor node of a statement
   */
  function getSuccessor(astNode) {
    // part of a block -> it already has a nextSibling
    if (astNode.cfg.nextSibling) return astNode.cfg.nextSibling;
    const { parent } = astNode.cfg;
    // it has no parent -> exitNode
    if (!parent) return exitNode;

    switch (parent.type) {
      case 'DoWhileStatement':
        return parent.test.cfg;

      case 'ForStatement':
        return (
          (parent.update && parent.update.cfg) ||
          (parent.test && parent.test.cfg) ||
          getEntry(parent.body)
        );

      case 'ForInStatement':
        return parent.cfg;

      case 'TryStatement':
        return (
          (parent.finalizer && astNode !== parent.finalizer && getEntry(parent.finalizer)) ||
          getSuccessor(parent)
        );

      case 'SwitchCase': {
        // the sucessor of a statement at the end of a case block is
        // the entry of the next cases consequent
        if (!parent.cfg.nextSibling) return getSuccessor(parent);

        let check = parent.cfg.nextSibling.astNode;

        while (!check.consequent.length && check.cfg.nextSibling) {
          check = check.cfg.nextSibling.astNode;
        }

        // or the next statement after the switch, if there are no more cases
        return (
          (check.consequent.length && getEntry(check.consequent[0])) || getSuccessor(parent.parent)
        );
      }

      case 'WhileStatement':
        return parent.test.cfg;

      default:
        return getSuccessor(parent);
    }
  }

  /**
   * Creates a FlowNode for every AST node
   */
  function createNodes(astNode) {
    walker(astNode, {
      default(node, recurse) {
        const parent = parentStack.length ? parentStack[parentStack.length - 1] : undefined;
        createNode(node, parent);
        // do not recurse for FunctionDeclaration or any sub-expression
        if (node.type === 'FunctionDeclaration' || node.type.includes('Expression')) return;

        parentStack.push(node);
        walker.checkProps(node, recurse);
        parentStack.pop();
      },
    });
  }
  function createNode(astNode, parent) {
    if (!astNode.cfg) {
      Object.defineProperty(astNode, 'cfg', {
        value: new FlowNode(astNode, parent),
        configurable: true,
      });
    }
  }

  /**
   * Links in the next sibling for nodes inside a block
   */
  function linkSiblings(astNode) {
    function backToFront(list, recurse) {
      // link all the children to the next sibling from back to front,
      // so the nodes already have .nextSibling
      // set when their getEntry is called
      for (const [i, child] of Array.from(list.entries()).reverse()) {
        if (i < list.length - 1) child.cfg.nextSibling = getEntry(list[i + 1]);
        recurse(child);
      }
    }
    function BlockOrProgram(node, recurse) {
      backToFront(node.body, recurse);
    }
    walker(astNode, {
      BlockStatement: BlockOrProgram,
      Program: BlockOrProgram,
      FunctionDeclaration() {},
      FunctionExpression() {},
      SwitchCase(node, recurse) {
        backToFront(node.consequent, recurse);
      },
      SwitchStatement(node, recurse) {
        backToFront(node.cases, recurse);
      },
    });
  }
  return [entryNode, exitNode, allNodes];
}

module.exports = ControlFlowGraph;
module.exports.dot = require('./dot');
