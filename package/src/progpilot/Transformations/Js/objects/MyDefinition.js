"use strict";

var MyOp = require('./MyOp');

class MyDefinition extends MyOp.MyOp
{
	constructor()
	{
		super();
		this.var_name = "";
	}
	
	set_var_name(var_name)
	{
		this.var_name = var_name;
	}

	get_var_name()
	{
		return this.var_name;
	}
}

module.exports = {
MyDefinition: MyDefinition
};


