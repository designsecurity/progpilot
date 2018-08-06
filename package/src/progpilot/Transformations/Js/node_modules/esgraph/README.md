# esgraph

creates a control flow graph from an esprima abstract syntax tree

[![Build Status](https://travis-ci.org/Swatinem/esgraph.svg?branch=master)](https://travis-ci.org/Swatinem/esgraph)
[![Coverage Status](https://coveralls.io/repos/Swatinem/esgraph/badge.svg?branch=master)](https://coveralls.io/r/Swatinem/esgraph)
[![Dependency Status](https://gemnasium.com/Swatinem/esgraph.svg)](https://gemnasium.com/Swatinem/esgraph)

## Installation

```bash
$ npm install esgraph
```

## Usage

### esgraph

The `esgraph` binary reads from stdin and outputs dot-format usable by graphviz.
To create a png file showing the CFG of a js file:

```bash
$ cat $file | esgraph | dot -Tpng > output.png
```

![example graph](esgraph.png?raw=true)

### library

```js
const esgraph = require("esgraph");

const cfg = esgraph(esprima.parse(source, { range: true }));
// cfg[0] is the start node
// cfg[1] is the end node
// cfg[2] is an array of all nodes for easier iteration

// each node has:
node.astNode; // this is the original esprima AST node, either a statement or an expression
node.prev; // an array of predecessor nodes
node.next; // an array of all successor nodes

// the successor nodes are also awailable by type:
node.normal; // the next statement reached via normal flow
node.true; // the next statement reached when `node.astNode` evaluates to true
node.false; // the next statement reached when `node.astNode` evaluates to false
node.exception; // the next statement reached when `node.astNode` throws

const dot = esgraph.dot(cfg, { counter: startCount, source: source });
// returns the cfg printed in graphviz dot format.
node.label; // can be used to use a custom label for that node
// otherwise `esgraph.dot` will print the nodes source when the ast is created
// with {range: true} and {source: source} option is set
```

## License

LGPLv3
