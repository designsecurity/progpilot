"use strict";

var MyOp = require('./MyOp');

class MyExpr extends MyOp.MyOp
{
	constructor()
	{
		super();
		this.is_assign = false;
		this.assign_def = null;
		this.defs = [];
	}

	get_is_assign()
	{
		return this.is_assign;
	}

	get_assign_def()
	{
		return this.assign_def;
	}

	set_assign(is_assign)
	{
		this.is_assign = is_assign;
	}

	set_assign_def(def)
	{
		this.assign_def = def;
	}
	
	add_def(def)
	{
		this.defs.push(def);
	}

	get_defs()
	{
		return this.defs;
	}
}

module.exports = {
MyExpr: MyExpr
};


