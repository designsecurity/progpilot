"use strict";

var esprima = require('esprima');
var styx = require('styx');
var fs = require('fs');

var Code = require('./Code');
var Instructions = require('./Instructions');
var MyBlock = require('./objects/MyBlock');
var MyExpr = require('./objects/MyExpr');
var MyDefinition = require('./objects/MyDefinition');

var argvs = process.argv;
if (argvs.length > 2) {
    var file = argvs[2];
    fs.stat(file, function (err, stat) {
        
        if (err == null) {
            var program = fs.readFileSync(file, 'utf-8');
            //var program = fs.readFileSync("./tests/generic/bloc1.js", 'utf-8');

            // http://tobyho.com/2013/12/02/fun-with-esprima/
            var ast = esprima.parse(program, {loc: true});
            var flowProgram = styx.parse(ast);
            var json = styx.exportAsJson(flowProgram);
            var data = JSON.parse(json);
        
            //console.log(json);

            var exprs = [];

            if (data.hasOwnProperty('program')) {
                var prog = data.program;
                if (prog.hasOwnProperty('flowGraph')) {
                    var code = new Code.Code;
                    var edges = prog.flowGraph.edges;
                
                    for (var i = 0; i < edges.length; i ++) {
                        var myedge = edges[i];
                        var myfrom = myedge.from;
                        var myto = myedge.to;

                        var mydata = myedge.data;

                        if (mydata != null) {
                            var mytype = mydata.type;
                            switch (mytype) {
                                case 'EnterBlock':
                                    var tmp_myblock = Instructions.EnterBlock(myedge);
                                    code.instructions.push("EnterBlock");
                                    code.instructions.push("myblock");
                                    code.instructions.push(tmp_myblock);

                                    break;

                                case 'LeaveBlock':
                                    var tmp_myblock = Instructions.LeaveBlock(myedge);
                                    code.instructions.push("LeaveBlock");
                                    code.instructions.push("myblock");
                                    code.instructions.push(tmp_myblock);

                                    break;

                                /* identifier = value */
                                case 'AssignmentExpression':
                                    var my_expr = new MyExpr.MyExpr;
                                    my_expr.setLine(mydata.right.loc.start.line);
                                    my_expr.setColumn(mydata.right.loc.start.column);
                                    my_expr.setId(exprs.length);
                                    exprs.push(my_expr);
                                    
                                    code.instructions.push("start_assign");
                                    code.instructions.push("start_expression");
                                    var my_def = Instructions.AssignmentExpression(code, mydata, my_expr);
                                    my_expr.setAssign(true);
                                    my_expr.setAssignDef(my_def);
                                    
                                    code.instructions.push("end_expression");
                                    code.instructions.push("expr");
                                    code.instructions.push(my_expr);
                                    code.instructions.push("end_assign");
                                    
                                    code.instructions.push("Definition");
                                    code.instructions.push("def");
                                    code.instructions.push(my_def);
                                    
                                    break;

                                    /* var identifier = value */
                                case 'VariableDeclarator':
                                
                                    var myinit = mydata.init;
                                    if (myinit != null) {
                                        var my_expr = new MyExpr.MyExpr;
                                        my_expr.setLine(mydata.id.loc.start.line);
                                        my_expr.setColumn(mydata.id.loc.start.column);
                                        my_expr.setId(exprs.length);
                                        exprs.push(my_expr);
                                        
                                        code.instructions.push("start_assign");
                                        code.instructions.push("start_expression");
                                        var my_def = Instructions.VariableDeclarator(code, mydata, my_expr);
                                        my_expr.setAssign(true);
                                        my_expr.setAssignDef(my_def);
                                        
                                        code.instructions.push("end_expression");
                                        code.instructions.push("expr");
                                        code.instructions.push(my_expr);
                                        code.instructions.push("end_assign");
                                        
                                        code.instructions.push("Definition");
                                        code.instructions.push("def");
                                        code.instructions.push(my_def);
                                    }

                                    break;

                                case 'CallExpression':
                                    code.instructions.push("start_expression");
                                
                                    Instructions.CallExpression(code, mydata, exprs);
                                
                                    var my_expr = new MyExpr.MyExpr;
                                    my_expr.setLine(mydata.loc.start.line);
                                    my_expr.setColumn(mydata.loc.start.column);
                                    my_expr.setId(exprs.length);
                                    exprs.push(my_expr);
                                
                                    code.instructions.push("expr");
                                    code.instructions.push(my_expr);
                                    
                                    code.instructions.push("end_expression");
                                    code.instructions.push("expr");
                                    code.instructions.push(my_expr);
                                
                                    break;

                                case 'ReturnStatement':
                                    Instructions.ReturnStatement(mydata);
                                
                                    break;
                            }
                        }
                    }

                    for (var i = 0; i < edges.length; i ++) {
                        var myedge = edges[i];
                        var myfrom = myedge.from;
                        var myto = myedge.to;


                        var blockparent = Instructions.select_block_from_address(myfrom);
                        var blockchild = Instructions.select_block_to_address(myto);
                    
                        /*
                        console.log("edges from ="+myfrom+" to ="+myto);
                        console.log("blockparent");
                        console.log(blockparent);
                        console.log("blockchild");
                        console.log(blockchild);
                        */

                        if (blockparent != null && blockchild != null) {
                            blockparent.addChild(blockchild);
                        }
                    }

                    code.printStdout();
                }
            }
        }});
}
