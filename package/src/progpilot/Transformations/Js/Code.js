"use strict";

class Code
{
    constructor()
    {
        this.instructions = [];
    }

    printStdout()
    {
        var i = 0;
        while (i < this.instructions.length) {
            switch (this.instructions[i]) {
                case 'EnterBlock':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_block = this.instructions[i + 2];
                    console.log(tmp_block.id);
                    console.log(tmp_block.start_address_block_from);
                    console.log(tmp_block.end_address_block_to);
                    console.log("edges");
                    console.log(tmp_block.childs.length);
                    for (var j = 0; j < tmp_block.childs.length; j++) {
                        var child = tmp_block.childs[j];
                        console.log(tmp_block.childs[j].id);
                    }
                    
                    i = i + 3;
                    break;
                    
                case 'LeaveBlock':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_block = this.instructions[i + 2];
                    console.log(tmp_block.id);
                    
                    i = i + 3;
                    //i = i + 1;
                    break;
                    
                case 'Definition':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_def = this.instructions[i + 2];
                    console.log(tmp_def.get_var_name());
                    console.log(tmp_def.getLine());
                    console.log(tmp_def.getColumn());
                    
                    i = i + 3;
                    break;
                    
                case 'funccall':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var myfunction = this.instructions[i + 2];
                    console.log(myfunction.getLine());
                    console.log(myfunction.getColumn());
                    console.log(myfunction.getName());
                    console.log(myfunction.get_isInstance());
                    console.log(myfunction.getNameInstance());
                    console.log(myfunction.getNbParams());
                    
                    for (var j = 0; j < myfunction.getNbParams(); j ++) {
                        console.log(myfunction.getParam(j).getId());
                    }
                    
                    console.log(this.instructions[i + 3]);
                    var myexpr = this.instructions[i + 4];
                    console.log(myexpr.getId());
                    
                    i = i + 5;
                    break;
                    
                case 'temporary':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_def = this.instructions[i + 2];
                    console.log(tmp_def.get_var_name());
                    console.log(tmp_def.getLine());
                    console.log(tmp_def.getColumn());
                    
                    var tmp_exprs = tmp_def.getExprs();
                    console.log(tmp_exprs.length);
                    for (var j = 0; j < tmp_exprs.length; j ++) {
                        console.log(tmp_exprs[j].getId());
                    }
                    
                    i = i + 3;
                    break;
                    
                case 'start_assign':
                    console.log(this.instructions[i]);
                    
                    i = i + 1;
                    break;
                    
                case 'end_assign':
                    console.log(this.instructions[i]);
                    
                    i = i + 1;
                    break;
                    
                case 'start_expression':
                    console.log(this.instructions[i]);
                    
                    i = i + 1;
                    break;
                    
                case 'end_expression':
                    console.log(this.instructions[i]);
                    console.log(this.instructions[i + 1]);
                    var tmp_expr = this.instructions[i + 2];
                    console.log(tmp_expr.getLine());
                    console.log(tmp_expr.getColumn());
                    console.log(tmp_expr.get_isAssign());
                    
                    //console.log(tmp_expr);
                    
                    if (tmp_expr.get_isAssign()) {
                        console.log(tmp_expr.getAssignDef().getId());
                    }
                    
                    var tmp_defs = tmp_expr.getDefs();
                    console.log(tmp_defs.length);
                    for (var j = 0; j < tmp_defs.length; j ++) {
                        console.log(tmp_defs[j].getId());
                    }
                    
                    i = i + 3;
                    break;
            }
        }
    }
}

module.exports = {
    Code: Code
};


