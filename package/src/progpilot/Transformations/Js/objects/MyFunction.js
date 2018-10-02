"use strict";

var MyOp = require('./MyOp');

class MyFunction extends MyOp.MyOp
{
    constructor()
    {
        super();
        this.isInstance = false;
        this.is_method = false;
        this.name_instance = null;
        this.name = null;
        this.params = [];
        this.paramsexprs = [];
        this.nb_params = 0;
    }
    
    setName(name)
    {
        this.name = name;
    }

    getName()
    {
        return this.name;
    }

    get_isInstance()
    {
        return this.isInstance;
    }

    setIsInstance(isInstance)
    {
        this.isInstance = isInstance;
    }

    setNameInstance(name_instance)
    {
        this.name_instance = name_instance;
    }

    getNameInstance()
    {
        return this.name_instance;
    }
    
    get_is_method()
    {
        return this.is_method;
    }

    set_is_method(is_method)
    {
        this.is_method = is_method;
    }
    
    addParamExpr(expr)
    {
        this.paramsexprs.push(expr);
    }
    
    addParam(param)
    {
        this.params.push(param);
    }

    getParams()
    {
        return this.params;
    }

    getParamsExprs()
    {
        return this.paramsexprs;
    }

    setNbParams(nb_params)
    {
        this.nb_params = nb_params;
    }

    getNbParams()
    {
        return this.nb_params;
    }

    getParam(i)
    {
        if (typeof this.params[i] !== 'undefined') {
            return this.params[i];
        }

        return null;
    }

    getParamExpr(i)
    {
        if (typeof this.paramsexprs[i] !== 'undefined') {
            return this.paramsexprs[i];
        }

        return null;
    }
}

module.exports = {
    MyFunction: MyFunction
};


