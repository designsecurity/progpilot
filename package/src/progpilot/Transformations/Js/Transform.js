"use strict";

var esprima = require('esprima');
var fs = require('fs');
var esgraph = require("esgraph");

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
            try {
                var ast = esprima.parse(program, {loc: true, range: true});
                var cfg = esgraph(ast);
                var code = new Code.Code;
                var exprs = [];
                
                cfg[2].forEach(function(FlowNode) {
                    
                    var tmp_myblock1 = Instructions.EnterBlock(FlowNode);
                    code.instructions.push("EnterBlock");
                    code.instructions.push("myblock");
                    code.instructions.push(tmp_myblock1);
                        
                    if(FlowNode.type !== 'exit') {
                        
                        var mytype = FlowNode.astNode.type;
                        switch (mytype) {
                            // identifier = value 
                            case 'AssignmentExpression':
                                var my_expr = new MyExpr.MyExpr;
                                my_expr.setLine(FlowNode.astNode.right.loc.start.line);
                                my_expr.setColumn(FlowNode.astNode.right.loc.start.column);
                                my_expr.setId(exprs.length);
                                exprs.push(my_expr);
                                            
                                code.instructions.push("start_assign");
                                code.instructions.push("start_expression");
                                var my_def = Instructions.AssignmentExpression(code, FlowNode.astNode, my_expr);
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
                                
                            // var identifier = value 
                            case 'VariableDeclaration':
                                
                                FlowNode.astNode.declarations.forEach(function(VariableDeclarator) {
                                    
                                    var myinit = VariableDeclarator.init;
                                    if (myinit != null) {
                                        var my_expr = new MyExpr.MyExpr;
                                        my_expr.setLine(VariableDeclarator.id.loc.start.line);
                                        my_expr.setColumn(VariableDeclarator.id.loc.start.column);
                                        my_expr.setId(exprs.length);
                                        exprs.push(my_expr);
                                                    
                                        code.instructions.push("start_assign");
                                        code.instructions.push("start_expression");
                                        var my_def = Instructions.VariableDeclarator(code, VariableDeclarator, my_expr);
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
                                });
                                
                                break;

                            case 'CallExpression':
                                code.instructions.push("start_expression");
                                        
                                Instructions.CallExpression(code, FlowNode.astNode, exprs);
                                        
                                var my_expr = new MyExpr.MyExpr;
                                my_expr.setLine(FlowNode.astNode.loc.start.line);
                                my_expr.setColumn(FlowNode.astNode.loc.start.column);
                                my_expr.setId(exprs.length);
                                exprs.push(my_expr);
                                        
                                code.instructions.push("expr");
                                code.instructions.push(my_expr);
                                            
                                code.instructions.push("end_expression");
                                code.instructions.push("expr");
                                code.instructions.push(my_expr);
                                        
                                break;

                            case 'ReturnStatement':
                                Instructions.ReturnStatement(FlowNode.astNode);
                                        
                                break;
                        }
                    }
                        
                    var tmp_myblock2 = Instructions.LeaveBlock(FlowNode);
                    code.instructions.push("LeaveBlock");
                    code.instructions.push("myblock");
                    code.instructions.push(tmp_myblock2);
                });
                
                code.printStdout();
            
            } catch(e) {
                false
            }
        }
    });
}
