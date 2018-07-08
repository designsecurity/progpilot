"use strict";

var MyOp = require('./MyOp');

class MyExpr extends MyOp.MyOp
{
    constructor()
    {
        super();
        this.isAssign = false;
        this.assign_def = null;
        this.defs = [];
    }

    get_isAssign()
    {
        return this.isAssign;
    }

    getAssignDef()
    {
        return this.assign_def;
    }

    setAssign(isAssign)
    {
        this.isAssign = isAssign;
    }

    setAssignDef(def)
    {
        this.assign_def = def;
    }
    
    addDef(def)
    {
        this.defs.push(def);
    }

    getDefs()
    {
        return this.defs;
    }
}

module.exports = {
    MyExpr: MyExpr
};


