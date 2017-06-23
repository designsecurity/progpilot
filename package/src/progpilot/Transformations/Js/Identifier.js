"use strict";

var MyOp = require('./objects/MyOp');

class Identifier extends MyOp.MyOp
{
	constructor()
	{
		super();
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
				this.identifiername = mydata.name;
				break;

			case 'Literal': 
				this.isliteral = true;
				this.literalvalue = mydata.value;
				break;

			case 'MemberExpression': 
				var myobject = mydata.object;
				this.isobject = true;
				this.objecttype = myobject.type;
				this.objectname = myobject.name;

				var myproperty = mydata.property;
				this.propertytype = myproperty.type;
				this.propertyname = myproperty.name;

				break;
		}
	}
}

module.exports = {
Identifier: Identifier
};


