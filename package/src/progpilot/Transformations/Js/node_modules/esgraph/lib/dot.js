module.exports = dot;

function dot(cfg, options) {
  options = options || {};
  const { counter = 0, source } = options;
  const output = [];
  const nodes = cfg[2];

  // print all the nodes:
  for (const [i, node] of nodes.entries()) {
    let { label = node.type } = node;
    if (!label && source && node.astNode.range) {
      const ast = node.astNode;
      let { range } = ast;
      let add = '';

      // special case some statements to get them properly printed
      if (ast.type === 'SwitchCase') {
        if (ast.test) {
          range = [range[0], ast.test.range[1]];
          add = ':';
        } else {
          range = [range[0], range[0]];
          add = 'default:';
        }
      } else if (ast.type === 'ForInStatement') {
        range = [range[0], ast.right.range[1]];
        add = ')';
      } else if (ast.type === 'CatchClause') {
        range = [range[0], ast.param.range[1]];
        add = ')';
      }

      label =
        source
          .slice(range[0], range[1])
          .replace(/\n/g, '\\n')
          .replace(/\t/g, '    ')
          .replace(/"/g, '\\"') + add;
    }

    if (!label && node.astNode) {
      label = node.astNode.type;
    }

    output.push(`n${counter + i} [label="${label}"`);

    if (['entry', 'exit'].includes(node.type)) output.push(', style="rounded"');

    output.push(']\n');
  }

  // print all the edges:
  for (const [i, node] of nodes.entries()) {
    for (const type of ['normal', 'true', 'false', 'exception']) {
      const next = node[type];

      if (!next) continue;

      output.push(`n${counter + i} -> n${counter + nodes.indexOf(next)} [`);

      if (type === 'exception') output.push('color="red", label="exception"');
      else if (['true', 'false'].includes(type)) output.push(`label="${type}"`);

      output.push(']\n');
    }
  }

  if (options.counter !== undefined) options.counter += nodes.length;

  return output.join('');
}
