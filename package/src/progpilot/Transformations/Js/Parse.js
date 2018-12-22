"use strict";

var esprima = require('esprima');
var esgraph = require('esgraph');

try {
    var ast = esprima.parse(PHP.code, {loc: true, range: true});
    var cfg = esgraph(ast);

    var i = 0;
    cfg[2].forEach(function(flowNode) {
        flowNode.id = i;
        i ++;
    });

    cfg;
}
catch(e) {
}
