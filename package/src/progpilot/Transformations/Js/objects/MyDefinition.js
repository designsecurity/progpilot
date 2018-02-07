"use strict";

var MyOp = require('./MyOp');

class MyDefinition extends MyOp.MyOp
{
	constructor()
	{
		super();
		this.var_name = "";
        this.exprs = [];
        this.isobject = false;
		this.isidentifier = false;
		this.isliteral = false;
	}

	is_object()
	{
		return this.isobject;
	}

	is_identifier()
	{
		return this.isidentifier;
	}

	is_literal()
	{
		return this.isliteral;
	}

	get_type()
	{
		if(this.isobject)
		{
			return "MemberExpression";
		}
		else if(this.isidentifier)
		{
			return "Identifier";
		}
		else if(this.isliteral)
		{
			return "Literal";
		}
	}

	CalculateIdentifier(mydata)
	{
		var mytype = mydata.type;

		switch(mytype)
		{
			case 'Identifier': 
				this.isidentifier = true;
				this.var_name = mydata.name;
				break;

			case 'Literal': 
				this.isliteral = true;
				this.var_name = "temporary_"+Math.random();
				break;

			case 'MemberExpression': 
				var myobject = mydata.object;
				this.isobject = true;
				this.objecttype = myobject.type;
				this.var_name = myobject.name;

				var myproperty = mydata.property;
				this.propertytype = myproperty.type;
				this.var_name = myproperty.name;

				break;
		}
	}
	
	set_var_name(var_name)
	{
		this.var_name = var_name;
	}

	get_var_name()
	{
		return this.var_name;
	}
	
	add_expr(myexpr)
    {
        this.exprs.push(myexpr);
    }
    
    get_exprs()
    {
        return this.exprs;
    }
}

module.exports = {
MyDefinition: MyDefinition
};


