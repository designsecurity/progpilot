"use strict";

class Code
{
	constructor()
	{
		this.instructions = [];
	}

	print_stdout()
	{
		for(var i = 0; i < this.instructions.length; i++)
		{
			console.log(this.instructions[i]);
		}
	}
}

module.exports = {
Code: Code
};


