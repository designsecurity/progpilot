"use strict";

class Code
{
	constructor()
	{
		this.instructions = [];
	}

	print_stdout()
	{
        var i = 0;
        while(i < this.instructions.length)
		{
            switch(this.instructions[i])
            {
                case 'EnterBlock':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_block = this.instructions[i + 2];
                    console.log(tmp_block.id);
                    console.log(tmp_block.start_address_block);
                    console.log(tmp_block.end_address_block);
                    console.log("edges");
                    console.log(tmp_block.parents.length);
                    for(var j = 0; j < tmp_block.parents.length; j++)
                    {
                        var parent = tmp_block.parents[j];
                        console.log(tmp_block.parents[j].id);
                    }
                    
                    i = i + 3;
                    break;
                    
                case 'LeaveBlock':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_block = this.instructions[i + 2];
                    console.log(tmp_block.id);
                    
                    i = i + 3;
                    break;
                    
                case 'Definition':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_def = this.instructions[i + 2];
                    console.log(tmp_def.identifiername);
                    console.log(tmp_def.getLine());
                    console.log(tmp_def.getColumn());
                    
                    i = i + 3;
                    break;
                    
                case 'temporary':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_def = this.instructions[i + 2];
                    console.log(tmp_def.identifiername);
                    console.log(tmp_def.getLine());
                    console.log(tmp_def.getColumn());
                    
                    i = i + 3;
                    break;
                    
                case 'start_assign':
                    console.log(this.instructions[i]);
                    
                    i = i + 1;
                    break;
                    
                case 'end_assign':
                    console.log(this.instructions[i]);
                    
                    i = i + 1;
                    break;
                    
                case 'start_expression':
                    console.log(this.instructions[i]);
                    
                    i = i + 1;
                    break;
                    
                case 'end_expression':
                    console.log(this.instructions[i]);
                    
                    i = i + 1;
                    break;
            }
		}
	}
}

module.exports = {
Code: Code
};


