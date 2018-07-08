"use strict";

var MyOp = require('./MyOp');

class MyBlock extends MyOp.MyOp
{
    constructor()
    {
        super();
        this.start_address_block_from = -1;
        this.start_address_block_to = -1;
        this.end_address_block_from = -1;
        this.end_address_block_to = -1;
        this.childs = [];
    }

    addChild(child)
    {
        // not himself
        if (this.id != child.id) {
            var inarray = false;

            for (var i = 0; i < this.childs.length; i++) {
                if (child.id == this.childs[i].id) {
                    inarray = true;
                    break;
                }
            }

            if (!inarray) {
                this.childs.push(child);
            }
        }
    }

    setStartAddressBlock_from(address)
    {
        this.start_address_block_from = address;
    }

    setStartAddressBlock_to(address)
    {
        this.start_address_block_to = address;
    }

    setEndAddressBlock_from(address)
    {
        this.end_address_block_from = address;
    }

    setEndAddressBlock_to(address)
    {
        this.end_address_block_to = address;
    }
    
    

    getStartAddressBlock_from(address)
    {
        return this.start_address_block_from;
    }

    getStartAddressBlock_to(address)
    {
        return this.start_address_block_to;
    }

    getEndAddressBlock_from(address)
    {
        return this.end_address_block_from;
    }

    getEndAddressBlock_to(address)
    {
        return this.end_address_block_to;
    }
}

module.exports = {
    MyBlock: MyBlock
};


