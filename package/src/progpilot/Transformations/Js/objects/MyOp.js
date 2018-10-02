"use strict";

class MyOp
{
    constructor()
    {
        this.line = -1;
        this.column = -1;
        this.id = -1;
    }

    setId(id)
    {
        this.id = id;
    }

    getId()
    {
        return this.id;
    }

    setLine(line)
    {
        this.line = line;
    }

    getLine()
    {
        return this.line;
    }

    setColumn(column)
    {
        this.column = column;
    }

    getColumn()
    {
        return this.column;
    }
}

module.exports = {
    MyOp: MyOp
};


