"use strict";

var MyOp = require('./MyOp');

class MyBlock extends MyOp.MyOp
{
    constructor()
    {
        super();
        this.childs = [];
    }

    setChilds(childs) {
        this.childs = childs;
    }
}

module.exports = {
    MyBlock: MyBlock
};


