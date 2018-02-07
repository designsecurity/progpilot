<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Code;

use progpilot\Objects\MyOp;
use progpilot\objects\MyBlock;
use progpilot\objects\MyDefinition;
use progpilot\objects\MyExpr;
use progpilot\objects\MyFunction;

class MyCode
{

    private $code;
    private $start;
    private $end;

    public function __construct()
    {

        $this->code = [];
    }

    public function get_start()
    {
        return $this->start;
    }

    public function get_end()
    {
        return $this->end;
    }

    public function set_start($start)
    {
        $this->start = $start;
    }

    public function set_end($end)
    {
        $this->end = $end;
    }

    public function set_codes($codes)
    {
        $this->code = $codes;
    }

    public function get_codes()
    {
        return $this->code;
    }

    public function add_code($code)
    {
        $this->code[] = $code;
    }

    public function get_last_code()
    {
        $last_index = count($this->code);
        return $this->code[$last_index - 1];
    }

    public static function read_code($context, $file, $defs, $myjavascript_file)
    {
        $first_block = true;
        $handle = fopen($file, "r");

        $myfunction = new MyFunction("{main}");
        $myfunction->set_start_address_func(0);
        $context->get_functions()->add_function($myfunction->get_name(), $myfunction);

        $inst_func = new MyInstruction(Opcodes::ENTER_FUNCTION);
        $inst_func->add_property(MyInstruction::MYFUNC, $myfunction);
        $context->get_mycode()->add_code($inst_func);

        if ($handle)
        {
            $array_myblocks = [];
            $array_myblocks_childs = [];

            $array_exprs = [];
            $array_definitions = [];

            while (!feof($handle))
            {
                $buffer = rtrim(fgets($handle));

                switch ($buffer)
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
                    $myblock->set_start_address_block(count($context->get_mycode()->get_codes()));

                    $array_myblocks[$myblock_id] = $myblock;
                    $array_myblocks_childs[$myblock_id] = [];

                    for ($i = 0; $i < $nb_edges; $i ++)
                    {
                        $id_child = (int) fgets($handle);
                        $array_myblocks_childs[$myblock_id][] = $id_child;
                    }

                    $inst_block = new MyInstruction(Opcodes::ENTER_BLOCK);
                    $inst_block->add_property(MyInstruction::MYBLOCK, $myblock);
                    $context->get_mycode()->add_code($inst_block);

                    if ($first_block)
                    {
                        $first_block = false;

                        foreach ($defs as $mydef)
                        {
                            $inst_def = new MyInstruction(Opcodes::DEFINITION);
                            $inst_def->add_property(MyInstruction::DEF, $mydef);
                            $context->get_mycode()->add_code($inst_def);
                        }
                    }

                    break;
                }

                case 'LeaveBlock':
                {
                    $myblock_string = fgets($handle);
                    $myblock_id = (int) fgets($handle);

                    if (isset($array_myblocks[$myblock_id]))
                    {
                        $myblock = $array_myblocks[$myblock_id];
                        $myblock->set_end_address_block(count($context->get_mycode()->get_codes()));

                        $inst_block = new MyInstruction(Opcodes::LEAVE_BLOCK);
                        $inst_block->add_property(MyInstruction::MYBLOCK, $myblock);
                        $context->get_mycode()->add_code($inst_block);
                    }

                    break;
                }

                case 'Definition':
                {
                    $code = $context->get_mycode()->get_codes();
                    $last_opcode = $code[count($code) - 1];

                    $def_string = fgets($handle);
                    $def_name = rtrim(fgets($handle));
                    $def_line = (int) fgets($handle);
                    $def_column = (int) fgets($handle);

                    $mydef = new MyDefinition($def_line, $def_column, $def_name);
                    $mydef->set_source_myfile($myjavascript_file);
                    $array_definitions[] = $mydef;

                    $inst_def = new MyInstruction(Opcodes::DEFINITION);
                    $inst_def->add_property(MyInstruction::DEF, $mydef);
                    $context->get_mycode()->add_code($inst_def);

                    break;
                }

                case 'funccall':
                {
                    $func_string = fgets($handle);
                    $func_line = (int) fgets($handle);
                    $func_column = (int) fgets($handle);
                    $func_name = rtrim(fgets($handle));
                    $func_is_instance = rtrim(fgets($handle));
                    $func_name_instance = rtrim(fgets($handle));
                    $func_nb_params = (int) fgets($handle);

                    $inst_funcall_main = new MyInstruction(Opcodes::FUNC_CALL);
                    $inst_funcall_main->add_property(MyInstruction::FUNCNAME, $func_name);

                    $myfunction_call = new MyFunction($func_name);
                    $myfunction_call->setLine($func_line);
                    $myfunction_call->setColumn($func_column);
                    $myfunction_call->set_nb_params($func_nb_params);
                    $myfunction_call->set_source_myfile($myjavascript_file);

                    if ($func_is_instance == "true")
                    {
                        $myfunction_call->add_type(MyOp::TYPE_INSTANCE);
                        $myfunction_call->set_name_instance($func_name_instance);

                        $mybackdef = new MyDefinition($func_line, $func_column, $func_name_instance);
                        $mybackdef->add_type(MyDefinition::TYPE_INSTANCE);
                        $mybackdef->set_source_myfile($myjavascript_file);
                        $myfunction_call->set_back_def($mybackdef);
                    }

                    for ($j = 0; $j < $func_nb_params; $j ++)
                    {
                        $func_def_id_param = (int) fgets($handle);
                        $func_def_param = $array_definitions[$func_def_id_param];
                        $inst_funcall_main->add_property("argdef$j", $func_def_param);
                    }

                    $func_expr_string = fgets($handle);
                    $func_expr_id = (int) fgets($handle);

                    // !!!!????
                    //$myexpr = $array_exprs[$func_expr_id];
                    $myexpr = null;

                    $inst_funcall_main->add_property(MyInstruction::MYFUNC_CALL, $myfunction_call);
                    $inst_funcall_main->add_property(MyInstruction::EXPR, $myexpr);
                    $inst_funcall_main->add_property(MyInstruction::ARR, null);
                    $context->get_mycode()->add_code($inst_funcall_main);

                    break;
                }

                case 'temporary':
                {
                    $def_string = fgets($handle);
                    $def_name = rtrim(fgets($handle));
                    $def_line = (int) fgets($handle);
                    $def_column = (int) fgets($handle);

                    $mytemp = new MyDefinition($def_line, $def_column, $def_name);
                    $mytemp->set_source_myfile($myjavascript_file);
                    $array_definitions[] = $mytemp;

                    $nb_exprs = (int) fgets($handle);
                    for ($i = 0; $i < $nb_exprs; $i ++)
                    {
                        $id_expr = (int) fgets($handle);
                        $mytemp->add_expr($id_expr);
                    }

                    $inst_temporary_simple = new MyInstruction(Opcodes::TEMPORARY);
                    $inst_temporary_simple->add_property(MyInstruction::TEMPORARY, $mytemp);
                    $context->get_mycode()->add_code($inst_temporary_simple);

                    break;
                }

                case 'start_assign':
                {
                    $context->get_mycode()->add_code(new MyInstruction(Opcodes::START_ASSIGN));

                    break;
                }

                case 'end_assign':
                {
                    $context->get_mycode()->add_code(new MyInstruction(Opcodes::END_ASSIGN));

                    break;
                }

                case 'start_expression':
                {
                    $context->get_mycode()->add_code(new MyInstruction(Opcodes::START_EXPRESSION));

                    break;
                }

                case 'end_expression':
                {
                    $expr_string = fgets($handle);
                    $expr_line = (int) fgets($handle);
                    $expr_column = (int) fgets($handle);

                    $myexpr = new MyExpr($expr_line, $expr_column);

                    $expr_is_assign = rtrim(fgets($handle));

                    if ($expr_is_assign == "true")
                    {
                        $expr_def_assign_id = (int) fgets($handle);
                        $myexpr->set_assign(true);
                        $myexpr->set_assign_def($expr_def_assign_id);
                    }

                    $nb_exprs = (int) fgets($handle);

                    $array_exprs[] = $myexpr;

                    for ($i = 0; $i < $nb_exprs; $i ++)
                    {
                        $def_id = (int) fgets($handle);
                        $myexpr->add_def($def_id);
                    }

                    $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                    $inst_end_expr->add_property(MyInstruction::EXPR, $myexpr);
                    $context->get_mycode()->add_code($inst_end_expr);

                    break;
                }
                }
            }

            foreach ($array_myblocks as $parent)
            {
                $parent->addParent($parent);
                $childs = $array_myblocks_childs[$parent->get_id()];

                foreach ($childs as $child)
                {
                    $myblock_child = $array_myblocks[$child];
                    $myblock_child->addParent($parent);
                }
            }

            foreach ($array_exprs as $myexpr)
            {
                $defs = $myexpr->get_defs();
                $myexpr->set_defs(array());

                if ($myexpr->is_assign())
                {
                    $def_id = $myexpr->get_assign_def();
                    $mydef = $array_definitions[$def_id];
                    $myexpr->set_assign_def($mydef);
                }

                foreach ($defs as $def_id)
                {
                    $mydef = $array_definitions[$def_id];
                    $myexpr->add_def($mydef);
                }
            }

            foreach ($array_definitions as $mydef)
            {
                $exprs = $mydef->get_exprs();
                $mydef->set_exprs(array());

                foreach ($exprs as $expr_id)
                {
                    $myexpr = $array_exprs[$expr_id];
                    $mydef->add_expr($myexpr);
                }
            }

            fclose($handle);


            $myfunction->set_end_address_func(count($context->get_mycode()->get_codes()));

            $inst_func = new MyInstruction(Opcodes::LEAVE_FUNCTION);
            $inst_func->add_property(MyInstruction::MYFUNC, $myfunction);
            $context->get_mycode()->add_code($inst_func);

            $context->get_mycode()->set_start(0);
            $context->get_mycode()->set_end(count($context->get_mycode()->get_codes()));

        }
    }

    public function print_stdout()
    {
        $index = 0;

        do
        {
            if (isset($this->code[$index]))
            {
                $instruction = $this->code[$index];
                echo "[$index] ";
                switch ($instruction->get_opcode())
                {
                case Opcodes::ENTER_FUNCTION:
                {
                    echo Opcodes::ENTER_FUNCTION."\n";

                    $myfunc = $instruction->get_property(MyInstruction::MYFUNC);
                    echo "name = ".htmlentities($myfunc->get_name(), ENT_QUOTES, 'UTF-8')."\n";
                    break;
                }

                case Opcodes::CLASSE:
                {
                    echo Opcodes::CLASSE."\n";

                    $myclass = $instruction->get_property(MyInstruction::MYCLASS);
                    echo "name = ".htmlentities($myclass->get_name(), ENT_QUOTES, 'UTF-8')."\n";
                    break;
                }

                case Opcodes::ENTER_BLOCK:
                {
                    echo Opcodes::ENTER_BLOCK."\n";

                    $myblock = $instruction->get_property(MyInstruction::MYBLOCK);
                    echo "id = ".$myblock->get_id()."\n";

                    break;
                }

                case Opcodes::LEAVE_BLOCK:
                {
                    echo Opcodes::LEAVE_BLOCK."\n";

                    $myblock = $instruction->get_property(MyInstruction::MYBLOCK);
                    echo "id = ".$myblock->get_id()."\n";

                    break;
                }

                case Opcodes::LEAVE_FUNCTION:
                {
                    echo Opcodes::LEAVE_FUNCTION."\n";

                    break;
                }

                case Opcodes::FUNC_CALL:
                {
                    echo Opcodes::FUNC_CALL."\n";

                    $funcname = htmlentities($instruction->get_property(MyInstruction::FUNCNAME), ENT_QUOTES, 'UTF-8');
                    echo "name = $funcname\n";
                    break;
                }

                case Opcodes::START_EXPRESSION:
                {
                    echo Opcodes::START_EXPRESSION."\n";
                    break;
                }

                case Opcodes::END_EXPRESSION:
                {
                    echo Opcodes::END_EXPRESSION."\n";
                    $myexpr = $instruction->get_property(MyInstruction::EXPR);
                    echo "expression et tainted = ".$myexpr->is_tainted()."\n";
                    break;
                }

                case Opcodes::CONCAT_LIST:
                {
                    echo Opcodes::CONCAT_LIST."\n";
                    break;
                }

                case Opcodes::CONCAT_LEFT:
                {
                    echo Opcodes::CONCAT_LEFT."\n";
                    break;
                }

                case Opcodes::CONCAT_RIGHT:
                {
                    echo Opcodes::CONCAT_RIGHT."\n";
                    break;
                }

                case Opcodes::RETURN_FUNCTION:
                {
                    echo Opcodes::RETURN_FUNCTION."\n";
                    break;
                }

                case Opcodes::START_ASSIGN:
                {
                    echo Opcodes::START_ASSIGN."\n";
                    break;
                }

                case Opcodes::END_ASSIGN:
                {
                    echo Opcodes::END_ASSIGN."\n";
                    break;
                }

                case Opcodes::COND_BOOLEAN_NOT:
                {
                    echo Opcodes::COND_BOOLEAN_NOT."\n";
                    break;
                }

                case Opcodes::COND_START_IF:
                {
                    echo Opcodes::COND_START_IF."\n";
                    break;
                }

                case Opcodes::TEMPORARY:
                {
                    echo Opcodes::TEMPORARY."\n";
                    $def = $instruction->get_property(MyInstruction::TEMPORARY);
                    $def->print_stdout();

                    break;
                }

                case Opcodes::DEFINITION:
                {
                    echo Opcodes::DEFINITION."\n";
                    $def = $instruction->get_property(MyInstruction::DEF);
                    $def->print_stdout();

                    break;
                }
                }

                $index = $index + 1;
            }

        }
        while (isset($this->code[$index]));
    }
}

?>
