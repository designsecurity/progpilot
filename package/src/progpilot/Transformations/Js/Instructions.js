"use strict";

var Identifier = require('./Identifier');
var MyBlock = require('./objects/MyBlock');

var blocks = [];

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

function AssignmentExpression(code, mydata)
{
	var myoperator = mydata.operator;
    
    code.instructions.push("start_expression");
	var myright = new Identifier.Identifier;
	myright.CalculateIdentifier(mydata.right);
    myright.setLine(mydata.right.loc.start.line);
    myright.setColumn(mydata.right.loc.start.column);
    
    if(myright.is_identifier())
    {
        code.instructions.push("temporary");
        code.instructions.push("def");
        code.instructions.push(myright);
    }
    code.instructions.push("end_expression");
    
	var myleft = new Identifier.Identifier;
	myleft.CalculateIdentifier(mydata.left);
    myleft.setLine(mydata.left.loc.start.line);
    myleft.setColumn(mydata.left.loc.start.column);

    return myleft;
}

function VariableDeclarator(code, mydata)
{
	/* var identifier = */
	var myvariable = new Identifier.Identifier;
	myvariable.isidentifier = true;
	myvariable.identifiername = mydata.id.name;
    myvariable.setLine(mydata.id.loc.start.line);
    myvariable.setColumn(mydata.id.loc.start.column);
    
	/* = init */
    code.instructions.push("start_expression");
	var myinit = mydata.init;
	if(myinit != null)
	{
		var myidentifier = '';
		switch(myinit.type)
		{
			case 'CallExpression': 
				CallExpression(myinit);
				break;

			default:
				myidentifier = new Identifier.Identifier;
				myidentifier.CalculateIdentifier(myinit);
                
                myidentifier.setLine(myinit.loc.start.line);
                myidentifier.setColumn(myinit.loc.start.column);
                
                if(myidentifier.is_identifier())
                {
                    code.instructions.push("temporary");
                    code.instructions.push("def");
                    code.instructions.push(myidentifier);
                }
        
				break;
		}
	}
    code.instructions.push("end_expression");
	
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

function CallExpression(myinit)
{
	var mycallee = new Identifier.Identifier;
	mycallee.CalculateIdentifier(myinit.callee);

	var myarguments = myinit.arguments;

	for(var i = 0; i < myarguments.length; i ++)
	{
		var myargumenttype = myarguments[i].type;
		var myargumentvalue = myarguments[i].value;
	}
}

module.exports = {
AssignmentExpression: AssignmentExpression,
		      VariableDeclarator: VariableDeclarator,
		      ReturnStatement: ReturnStatement,
		      EnterBlock: EnterBlock,
		      LeaveBlock: LeaveBlock,
		      select_block_from_address: select_block_from_address
};


