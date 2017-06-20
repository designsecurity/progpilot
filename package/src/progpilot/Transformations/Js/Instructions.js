"use strict";

var Identifier = require('./Identifier');
var Block = require('./Block');

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
	var block = new Block.Block;
	block.setId(myedge.data.id);
	block.setLine(myedge.data.loc.start_line);
	block.setColumn(myedge.data.loc.start_column);
	block.set_start_address_block(myedge.from);

	blocks.push(block);

	return block;
}

function LeaveBlock(myedge)
{
	var block = select_block(myedge.data.id);
	if(block != null)
	{
		console.log("J'ai retrouvé mon block");
		block.set_end_address_block(myedge.from);
	}
	else
	{
		console.log("ERROR");
	}
}

function AssignmentExpression(mydata)
{
	var myoperator = mydata.operator;

	var myleft = new Identifier.Identifier;
	myleft.CalculateIdentifier(mydata.left);

	console.log("AssignmentExpression left type= "+myleft.gettype());

	var myright = new Identifier.Identifier;
	myright.CalculateIdentifier(mydata.right);

	console.log("AssignmentExpression right type= "+myright.gettype());
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

function VariableDeclarator(mydata)
{
	/* var identifier = */
	var myvariable = new Identifier.Identifier;
	myvariable.isidentifier = true;
	myvariable.identifiername = mydata.id.name;

	/* = init */
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
				break;
		}
	}

	console.log("VariableDeclarator variable name= "+myvariable.identifiername);
}

module.exports = {
AssignmentExpression: AssignmentExpression,
		      VariableDeclarator: VariableDeclarator,
		      ReturnStatement: ReturnStatement,
		      EnterBlock: EnterBlock,
		      LeaveBlock: LeaveBlock,
		      select_block_from_address: select_block_from_address
};


