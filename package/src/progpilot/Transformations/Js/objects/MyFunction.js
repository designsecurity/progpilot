"use strict";

var MyOp = require('./MyOp');

class MyFunction extends MyOp.MyOp
{
	constructor()
	{
		super();
		this.is_instance = false;
		this.is_method = false;
		this.name_instance = null;
		this.name = null;
        this.params = [];
        this.nb_params = 0;
	}
	
	set_name(name)
	{
		this.name = name;
	}

	get_name()
	{
		return this.name;
	}

	is_instance()
	{
		return this.is_instance;
	}

	set_is_instance(is_instance)
	{
        this.is_instance = is_instance;
	}

	set_name_instance(name_instance)
	{
		this.name_instance = name_instance;
	}

	get_name_instance()
	{
		return this.name_instance;
	}
	
	is_method()
	{
		return this.is_method;
	}

	set_is_method(is_method)
	{
        this.is_method = is_method;
	}
	
	add_param(param)
	{
		this.params.push(param);
	}

	get_params()
	{
		return this.params;
	}

	set_nb_params(nb_params)
	{
		this.nb_params = nb_params;
	}

	get_nb_params()
	{
		return this.nb_params;
	}

	get_param(i)
	{
		if(typeof this.params[i] === 'undefined')
			return this.params[i];

		return null;
	}
}

module.exports = {
MyFunction: MyFunction
};


