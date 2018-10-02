#!/usr/bin/env node

const { parse } = require('espree');
const walkes = require('walkes');
const esgraph = require('../');

process.stdin.resume();
process.stdin.setEncoding('utf8');
let data = '';

process.stdin.on('data', (chunk) => {
  data += chunk;
});

process.stdin.on('end', () => {
  let source = data;
  // filter out hashbangs
  if (source.startsWith('#!')) {
    source = `//${source.substring(2)}`;
  }

  try {
    const fullAst = parse(source, { range: true });
    const functions = findFunctions(fullAst);

    console.log('digraph cfg {');
    console.log('node [shape="box"]');
    const options = { counter: 0, source };
    functions.concat(fullAst).forEach((ast, i) => {
      let cfg;
      let label = '[[main]]';
      if (ast.type.includes('Function')) {
        cfg = esgraph(ast.body);
        const name = (ast.id && ast.id.name) || '';
        const params = ast.params.map(p => p.name);
        label = `function ${name}(${params})`;
      } else {
        cfg = esgraph(ast);
      }

      console.log(`subgraph cluster_${i}{`);
      console.log(`label = "${label}"`);
      console.log(esgraph.dot(cfg, options));
      console.log('}');
    });
    console.log('}');
  } catch (e) {
    console.log(e.message);
  }
});

function findFunctions(ast) {
  const functions = [];
  function handleFunction(node, recurse) {
    functions.push(node);
    recurse(node.body);
  }
  walkes(ast, {
    FunctionDeclaration: handleFunction,
    FunctionExpression: handleFunction,
  });
  return functions;
}
