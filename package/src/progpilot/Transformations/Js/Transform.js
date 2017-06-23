"use strict";

var esprima = require('esprima');
var styx = require('styx');
var fs = require('fs');

var Code = require('./Code');
var Instructions = require('./Instructions');
var MyBlock = require('./objects/MyBlock');

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
        var code = new Code.Code;
		var edges = prog.flowGraph.edges;

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
						code.instructions.push("start_assign");
						var identifier = Instructions.AssignmentExpression(code, mydata);
						code.instructions.push("end_assign");
                        
						code.instructions.push("Definition");
						code.instructions.push("def");
						code.instructions.push(identifier);

						break;

						/* var identifier = value */
					case 'VariableDeclarator':
                        
                        code.instructions.push("start_assign");
						var identifier = Instructions.VariableDeclarator(code, mydata);
                        code.instructions.push("end_assign");
                        
						code.instructions.push("Definition");
						code.instructions.push("def");
						code.instructions.push(identifier);

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

