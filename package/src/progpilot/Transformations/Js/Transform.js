"use strict";

var esprima = require('esprima');
var styx = require('styx');
var Instructions = require('./Instructions');
var Block = require('./Block');
var Code = require('./Code');
var fs = require('fs');

var program = fs.readFileSync("./tests/generic/bloc1.js", 'utf-8');
// http://tobyho.com/2013/12/02/fun-with-esprima/
var ast = esprima.parse(program, {loc: true});
var flowProgram = styx.parse(ast);
var json = styx.exportAsJson(flowProgram);
var data = JSON.parse(json);



if(data.hasOwnProperty('program'))
{
	var prog = data.program;
	if(prog.hasOwnProperty('flowGraph'))
	{
		var edges = prog.flowGraph.edges;

		var code = new Code.Code;

		for(var i = 0; i < edges.length; i ++)
		{
			var myedge = edges[i];
			var myfrom = myedge.from;
			var myto = myedge.to;

			var mydata = myedge.data;

			if(mydata != null)
			{
				var mytype = mydata.type;
				switch(mytype)
				{
					case 'EnterBlock': 
						Instructions.EnterBlock(myedge);
						code.instructions.push("EnterBlock");
						code.instructions.push("myblock");

						break;

					case 'LeaveBlock': 
						Instructions.LeaveBlock(myedge);
						code.instructions.push("LeaveBlock");
						code.instructions.push("myblock");

						break;

						/* identifier = value */
					case 'AssignmentExpression': 
						Instructions.AssignmentExpression(mydata);
						code.instructions.push("Definition");
						code.instructions.push("def");

						break;

						/* var identifier = value */
					case 'VariableDeclarator':
						Instructions.VariableDeclarator(mydata);

						if(mydata.init != null)
						{
							code.instructions.push("Definition");
							code.instructions.push("def");
						}

						break;

					case 'ReturnStatement':
						Instructions.ReturnStatement(mydata);
				}
			}
		}

		for(var i = 0; i < edges.length; i ++)
		{
			var myedge = edges[i];
			var myfrom = myedge.from;
			var myto = myedge.to;


			var blockparent = Instructions.select_block_from_address(myedge.from);
			var blockchild = Instructions.select_block_from_address(myedge.to);

			if(blockparent != null && blockchild != null)
			{
				blockchild.add_parent(blockparent);
			}
		}

		code.print_stdout();
	}
}

