<?php

include("../../Code/MyCode.php");
include("../../Objects/MyOp.php");
include("../../Objects/MyBlock.php");
include("../../Objects/MyDefinition.php");
include("../../Objects/MyExpr.php");
include("../../Code/MyInstruction.php");
include("../../Code/Opcodes.php");

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Code\MyCode;
use progpilot\objects\MyBlock;
use progpilot\objects\MyDefinition;
use progpilot\objects\MyExpr;

$handle = fopen("file.txt", "r");

if($handle)
{
    $mycode = new MyCode;
    $array_myblocks = [];
    $array_myblocks_parents = [];
    
    $array_exprs = [];
    $array_definitions = [];
    
	while(!feof($handle))
	{
		$buffer = rtrim(fgets($handle));
		
		switch($buffer)
		{
            case 'EnterBlock':
            {
                $myblock_string = fgets($handle);
                $myblock_id = (int) fgets($handle);
                $myblock_start_address_block = (int) fgets($handle);
                $myblock_end_address_block = (int) fgets($handle);
                $edges = fgets($handle);
                $nb_edges = (int) fgets($handle);
                
                $myblock = new MyBlock;
                $myblock->set_id($myblock_id);
                $myblock->set_start_address_block(count($mycode->get_codes()));
                
                $array_myblocks[$myblock_id] = $myblock;
                $array_myblocks_parents[$myblock_id] = [];
                
                for($i = 0; $i < $nb_edges; $i ++)
                {
                    $id_parent = (int) fgets($handle);
                    $array_myblocks_parents[$myblock_id][] = $id_parent;
                }
                
                $inst_block = new MyInstruction(Opcodes::ENTER_BLOCK);
                $inst_block->add_property("myblock", $myblock);
                $mycode->add_code($inst_block);
                
                break;
            }
            
            case 'LeaveBlock':
            {
                $myblock_string = fgets($handle);
                $myblock_id = (int) fgets($handle);
                
                if(isset($array_myblocks[$myblock_id]))
                {
                    $myblock = $array_myblocks[$myblock_id];
                    $myblock->set_end_address_block(count($mycode->get_codes()));
				
                    $inst_block = new MyInstruction(Opcodes::LEAVE_BLOCK);
                    $inst_block->add_property("myblock", $myblock);
                    $mycode->add_code($inst_block);
				}
				
                break;
            }
                    
            case 'Definition':
            {
                $code = $mycode->get_codes();
                $last_opcode = $code[count($code) - 1];
                
                $def_string = fgets($handle);
                $def_name = fgets($handle);
                $def_line = (int) fgets($handle);
                $def_column = (int) fgets($handle);
                
                $mydef = new MyDefinition($def_line, $def_column, $def_name, false, false);
                $array_definitions[] = $mydef;
                
                if($last_opcode->get_opcode() == Opcodes::END_ASSIGN)
                {
                    $opcode_expr = $code[count($code) - 2];
                    $myexpr = $opcode_expr->get_property("expr");
                    
                    $myexpr->set_assign(true);
                    $myexpr->set_assign_def($mydef);
                    
                    $defs = $myexpr->get_defs();
                    for($i = 0; $i < count($defs); $i ++)
                    {
                        $myexpr->add_def($array_definitions[$defs[i]]);
                    }
                    
                }
                
                $inst_def = new MyInstruction(Opcodes::DEFINITION);
                $inst_def->add_property("def", $mydef);
                $mycode->add_code($inst_def);
                
                break;
            }
            
            case 'temporary':
            {
                $def_string = fgets($handle);
                $def_name = fgets($handle);
                $def_line = (int) fgets($handle);
                $def_column = (int) fgets($handle);
                
                $mytemp = new MyDefinition($def_line, $def_column, $def_name, false, false);
                $array_definitions[] = $mytemp;
                
                $nb_exprs = (int) fgets($handle);
                for($i = 0; $i < $nb_exprs; $i ++)
                {
                    $id_expr = (int) fgets($handle);
                    $mytemp->add_expr($id_expr);
                }

                $inst_temporary_simple = new MyInstruction(Opcodes::TEMPORARY);
                $inst_temporary_simple->add_property("temporary", $mytemp);
                $mycode->add_code($inst_temporary_simple);
			
                break;
            }
            
            case 'start_assign':
            {
                $mycode->add_code(new MyInstruction(Opcodes::START_ASSIGN));
                
                break;
            }
            
            case 'end_assign':
            {
                $mycode->add_code(new MyInstruction(Opcodes::END_ASSIGN));
                
                break;
            }
            
            case 'start_expression':
            {
                $mycode->add_code(new MyInstruction(Opcodes::START_EXPRESSION));
                
                break;
            }
            
            case 'end_expression':
            {
                $expr_string = fgets($handle);
                $expr_line = (int) fgets($handle);
                $expr_column = (int) fgets($handle);
                $nb_exprs = (int) fgets($handle);
                
                $myexpr = new MyExpr($expr_line, $expr_column);
                $array_exprs[] = $myexpr;
                
                for($i = 0; $i < $nb_exprs; $i ++)
                {
                    $def_id = (int) fgets($handle);
                    $myexpr->add_def($def_id);
                }   
                
                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->add_property("expr", $myexpr);
                $mycode->add_code($inst_end_expr);
                
                break;
            }
        }
    }
    
    foreach($array_myblocks as $myblock)
    {
        $parents = $array_myblocks_parents[$myblock_id];
        
        foreach($parents as $parent)
        {
            $myblock_parent = $array_myblocks[$parent];
            $myblock->addParent($myblock_parent);
        }
    }
    
	fclose($handle);
	
	$mycode->print_stdout();
}

?>
