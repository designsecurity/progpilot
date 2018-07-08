# styx

Derives the control flow graph from a JavaScript AST in [ESTree](https://github.com/estree/estree) format.


## Install

```
$ npm install styx
```


## Usage

With the `esprima` and `styx` npm packages installed, Styx can be used as follows:

```js
import Esprima from "esprima";
import * as Styx from "styx";

var code = "var x = 2 + 2;";
var ast = Esprima.parse(code);
var flowProgram = Styx.parse(ast);
var json = Styx.exportAsJson(flowProgram);

console.log(json);
```
