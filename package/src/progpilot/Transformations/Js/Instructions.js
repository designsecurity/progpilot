"use strict";

var MyDefinition = require('./objects/MyDefinition');
var MyBlock = require('./objects/MyBlock');
var MyFunction = require('./objects/MyFunction');

var blocks = [];
var definitions = [];

function select_block(id)
{
	for(var i = 0; i < blocks.length; i ++)
	{
		if(blocks[i].id == id)
		{
			return blocks[i];
		}
	}

	return null;
}

function select_block_from_address(address)
{
	for(var i = 1; i < blocks.length; i ++)
	{
		if(address >= blocks[i].start_address_block && address <= blocks[i].end_address_block)
		{
			return blocks[i];
		}
	}

	if(blocks.length > 0)
	{
		if(address >= blocks[0].start_address_block && address <= blocks[0].end_address_block)
		{
			return blocks[0];
		}
	}

	return null;
}

function EnterBlock(myedge)
{
	var myblock = new MyBlock.MyBlock;
	myblock.setId(myedge.data.id);
	myblock.setLine(myedge.data.loc.start_line);
	myblock.setColumn(myedge.data.loc.start_column);
	myblock.set_start_address_block(myedge.from);

	blocks.push(myblock);

	return myblock;
}

function LeaveBlock(myedge)
{
	var myblock = select_block(myedge.data.id);
	if(myblock != null)
	{
		myblock.set_end_address_block(myedge.from);
	}
	
	return myblock;
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
    
    if(myright.is_identifier())
    {
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
	var myvariable = new MyDefinition.MyDefinition;
	myvariable.isidentifier = true;
	myvariable.set_var_name(mydata.id.name);
    myvariable.setLine(mydata.id.loc.start.line);
    myvariable.setColumn(mydata.id.loc.start.column);
    myvariable.setId(definitions.length);
    definitions.push(myvariable);
    
	/* = init */
	var myinit = mydata.init;
	if(myinit != null)
	{
		switch(myinit.type)
		{
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
                
                if(mydef.is_identifier())
                {
                    code.instructions.push("temporary");
                    code.instructions.push("def");
                    code.instructions.push(mydef);
                    mydef.add_expr(my_expr);
                }
        
				break;
		}
	}
	
	return myvariable;
}

function ReturnStatement(myinit)
{
	var myarguments = myinit.arguments;

	for(var i = 0; i < myarguments.length; i ++)
	{
		var myargumenttype = myarguments[i].type;
		var myargumentvalue = myarguments[i].value;
	}
}

function CallExpression(myinit, myexpr, exprs)
{
	var mycallee = new MyDefinition.MyDefinition;
	mycallee.CalculateIdentifier(myinit.callee);
    
    if(mycallee.type == "MemberExpression")
    {
        var object = mycallee.object;
        var property = mycallee.property;
        
        var instance_name = object.name;
        var method_name = property.name;
        
        var myfunction = new MyFunction.MyFunction;
        myfunction.setLine(mycallee.loc.start.line);
        myfunction.setColumn(mycallee.loc.start.column);
        myfunction.set_name(method_name);
        myfunction.set_is_instance(true);
        myfunction.set_name_instance(instance_name);

        var myarguments = myinit.arguments;

        for(var i = 0; i < myarguments.length; i ++)
        {
            var def_name = method_name+"_param"+i+"_"+Math.random();
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
            myexprparam.set_assign(true);
            myexprparam.set_assign_def(mydef);
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
            
            myfunction.add_param(mytemp);
            
            
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
	
        myfunction.set_nb_params(myarguments.length);
        
        code.instructions.push("funccall");
        code.instructions.push("myfunc_call");
        code.instructions.push(myfunction);
        code.instructions.push("expr");
        code.instructions.push(myexpr);
    }
}

module.exports = {
    AssignmentExpression: AssignmentExpression,
    VariableDeclarator: VariableDeclarator,
    CallExpression: CallExpression,
    ReturnStatement: ReturnStatement,
    EnterBlock: EnterBlock,
    LeaveBlock: LeaveBlock,
    select_block_from_address: select_block_from_address,
    definitions: definitions
};


