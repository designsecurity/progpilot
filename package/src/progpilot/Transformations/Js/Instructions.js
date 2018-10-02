"use strict";

var MyDefinition = require('./objects/MyDefinition');
var MyBlock = require('./objects/MyBlock');
var MyFunction = require('./objects/MyFunction');
var MyExpr = require('./objects/MyExpr');

function getRandomInt() {
    return Math.floor(Math.random() * Math.floor(Number.MAX_SAFE_INTEGER));
}

if(typeof FlowNodes === 'undefined')
{
    var FlowNodeIds = new Map();
    var blocks = new Map();
    var definitions = [];
}

function EnterBlock(FlowNode)
{
    var idblock = getRandomInt();
    var myblock = new MyBlock.MyBlock;
    myblock.setId(idblock);
    if(typeof FlowNode.astNode !== 'undefined') {
        myblock.setLine(FlowNode.astNode.loc.start_line);
        myblock.setColumn(FlowNode.astNode.loc.start_column);
    }
    myblock.setChilds(FlowNode.next);

    blocks.set(FlowNode, myblock);
    FlowNodeIds.set(FlowNode, idblock);

    return myblock;
}

function LeaveBlock(FlowNode)
{
    return blocks.get(FlowNode);
}

function AssignmentExpression(code, mydata, my_expr)
{
    var myoperator = mydata.operator;
    
    var myright = new MyDefinition.MyDefinition;
    myright.CalculateIdentifier(mydata.right);
    myright.setLine(mydata.right.loc.start.line);
    myright.setColumn(mydata.right.loc.start.column);
    myright.setId(definitions.length);
    definitions.push(myright);
    
    if (myright.is_identifier()) {
        code.instructions.push("temporary");
        code.instructions.push("def");
        code.instructions.push(myright);
        myright.add_expr(my_expr);
    }
    
    var myleft = new MyDefinition.MyDefinition;
    myleft.CalculateIdentifier(mydata.left);
    myleft.setLine(mydata.left.loc.start.line);
    myleft.setColumn(mydata.left.loc.start.column);
    myleft.setId(definitions.length);
    definitions.push(myleft);

    return myleft;
}

function VariableDeclarator(code, mydata, my_expr)
{
    /* var identifier = */
    /* = init */
    var myinit = mydata.init;
    if (myinit != null) {
        var myvariable = new MyDefinition.MyDefinition;
        myvariable.isidentifier = true;
        myvariable.set_var_name(mydata.id.name);
        myvariable.setLine(mydata.id.loc.start.line);
        myvariable.setColumn(mydata.id.loc.start.column);
        myvariable.setId(definitions.length);
        definitions.push(myvariable);
    
        switch (myinit.type) {
            case 'CallExpression':
                CallExpression(myinit);
                break;

            default:
                var mydef = new MyDefinition.MyDefinition;
                mydef.CalculateIdentifier(myinit);
                
                mydef.setLine(myinit.loc.start.line);
                mydef.setColumn(myinit.loc.start.column);
                mydef.setId(definitions.length);
                definitions.push(mydef);
                
                code.instructions.push("temporary");
                code.instructions.push("def");
                code.instructions.push(mydef);
                mydef.add_expr(my_expr);
        
                break;
        }
    }
    
    return myvariable;
}

function ReturnStatement(myinit)
{
    var myarguments = myinit.arguments;

    for (var i = 0; i < myarguments.length; i ++) {
        var myargumenttype = myarguments[i].type;
        var myargumentvalue = myarguments[i].value;
    }
}

function CallExpression(code, myinit, exprs)
{
    var mycallee = myinit.callee;
    
    if (mycallee.type == "MemberExpression") {
        var object = mycallee.object;
        var property = mycallee.property;
        
        var instance_name = object.name;
        var method_name = property.name;
        
        var myfunction = new MyFunction.MyFunction;
        myfunction.setLine(mycallee.loc.start.line);
        myfunction.setColumn(mycallee.loc.start.column);
        myfunction.setName(method_name);
        myfunction.setIsInstance(true);
        myfunction.setNameInstance(instance_name);

        var myarguments = myinit.arguments;

        for (var i = 0; i < myarguments.length; i ++) {
            var def_name = method_name+"_param"+i+"_"+getRandomInt();
            var mydef = new MyDefinition.MyDefinition;
            mydef.set_var_name(def_name);
            mydef.setLine(mycallee.loc.start.line);
            mydef.setColumn(mycallee.loc.start.column);
            mydef.setId(definitions.length);
            definitions.push(mydef);
        
            var myexprparam = new MyExpr.MyExpr;
            myexprparam.setLine(mycallee.loc.start.line);
            myexprparam.setColumn(mycallee.loc.start.column);
            myexprparam.setId(exprs.length);
            myexprparam.setAssign(true);
            myexprparam.setAssignDef(mydef);
            exprs.push(myexprparam);
                                
            code.instructions.push("start_expression");
            code.instructions.push("start_assign");
                                
            var myargumenttype = myarguments[i].type;
            var myargumentvalue = myarguments[i].value;
            
            var mytemp = new MyDefinition.MyDefinition;
            mytemp.setLine(mycallee.loc.start.line);
            mytemp.setColumn(mycallee.loc.start.column);
            mytemp.set_var_name(myargumentvalue);
            mytemp.add_expr(myexprparam);
            mytemp.setId(definitions.length);
            definitions.push(mytemp);
            
            myfunction.addParam(mydef);
            myfunction.addParamExpr(myexprparam);
            
            code.instructions.push("temporary");
            code.instructions.push("def");
            code.instructions.push(mytemp);
                                    
            code.instructions.push("end_expression");
            code.instructions.push("expr");
            code.instructions.push(myexprparam);
            code.instructions.push("end_assign");
                                    
            code.instructions.push("Definition");
            code.instructions.push("def");
            code.instructions.push(mydef);
        }
    
        myfunction.setNbParams(myarguments.length);
        
        code.instructions.push("funccall");
        code.instructions.push("myfunc_call");
        code.instructions.push(myfunction);
    }
}

module.exports = {
    AssignmentExpression: AssignmentExpression,
    VariableDeclarator: VariableDeclarator,
    CallExpression: CallExpression,
    ReturnStatement: ReturnStatement,
    EnterBlock: EnterBlock,
    LeaveBlock: LeaveBlock,
    definitions: definitions,
    FlowNodeIds: FlowNodeIds,
    blocks: blocks
};


