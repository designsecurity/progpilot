"use strict";

var MyOp = require('./MyOp');

class MyBlock extends MyOp.MyOp
{
	constructor()
	{
		super();
		this.start_address_block_from = -1;
		this.start_address_block_to = -1;
		this.end_address_block_from = -1;
		this.end_address_block_to = -1;
		this.childs = [];
	}

	add_child(child)
	{
		// not himself
		if(this.id != child.id)
		{
			var inarray = false;

			for(var i = 0; i < this.childs.length; i++)
			{
				if(child.id == this.childs[i].id)
				{
					inarray = true;
					break;
				}
			}

			if(!inarray)
			{
				this.childs.push(child);
			}
		}
	}

	set_start_address_block_from(address)
	{
		this.start_address_block_from = address;
	}

	set_start_address_block_to(address)
	{
		this.start_address_block_to = address;
	}

	set_end_address_block_from(address)
	{
		this.end_address_block_from = address;
	}

	set_end_address_block_to(address)
	{
		this.end_address_block_to = address;
	}
	
	

	get_start_address_block_from(address)
	{
		return this.start_address_block_from;
	}

	get_start_address_block_to(address)
	{
		return this.start_address_block_to;
	}

	get_end_address_block_from(address)
	{
		return this.end_address_block_from;
	}

	get_end_address_block_to(address)
	{
		return this.end_address_block_to;
	}
}

module.exports = {
MyBlock: MyBlock
};


