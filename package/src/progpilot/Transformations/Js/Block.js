"use strict";

var Op = require('./Op');

class Block extends Op.Op
{
	constructor()
	{
		super();
		this.start_address_block = -1;
		this.end_address_block = -1;
		this.parents = [];
	}

	add_parent(parent)
	{
		// not himself
		if(this.id != parent.id)
		{
			var inarray = false;

			for(var i = 0; i < this.parents.length; i++)
			{
				if(parent.id == this.parents[i].id)
				{
					inarray = true;
					break;
				}
			}

			if(!inarray)
			{
				console.log("add_parent véritable");
				this.parents.push(parent);
			}
		}
	}

	set_start_address_block(address)
	{
		this.start_address_block = address;
	}

	set_end_address_block(address)
	{
		this.end_address_block = address;
	}

	get_start_address_block()
	{
		return this.start_address_block;
	}

	get_end_address_block()
	{
		return this.end_address_block;
	}
}

module.exports = {
Block: Block
};


