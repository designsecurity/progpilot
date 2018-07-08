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

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function setEnd($end)
    {
        $this->end = $end;
    }

    public function setCodes($codes)
    {
        $this->code = $codes;
    }

    public function getCodes()
    {
        return $this->code;
    }

    public function addCode($code)
    {
        $this->code[] = $code;
    }

    public function getLastCode()
    {
        $last_index = count($this->code);
        return $this->code[$last_index - 1];
    }

    public static function readCode($context, $file, $defs, $myjavascript_file)
    {
        $first_block = true;
        $handle = fopen($file, "r");

        $myfunction = new MyFunction("{main}");
        $myfunction->setStart_address_func(0);
        $context->getFunctions()->addFunction($myfunction->getName(), $myfunction);

        $inst_func = new MyInstruction(Opcodes::ENTER_FUNCTION);
        $inst_func->addProperty(MyInstruction::MYFUNC, $myfunction);
        $context->getMyCode()->addCode($inst_func);

        if ($handle) {
            $array_myblocks = [];
            $array_myblocks_childs = [];

            $array_exprs = [];
            $array_definitions = [];

            while (!feof($handle)) {
                $buffer = rtrim(fgets($handle));

                switch ($buffer) {
                    case 'EnterBlock':
                        $myblock_string = fgets($handle);
                        $myblock_id = (int) fgets($handle);
                        $myblock_start_address_block = (int) fgets($handle);
                        $myblock_end_address_block = (int) fgets($handle);
                        $edges = fgets($handle);
                        $nb_edges = (int) fgets($handle);

                        $myblock = new MyBlock;
                        $myblock->setId($myblock_id);
                        $myblock->setStartAddressBlock(count($context->getMyCode()->getCodes()));

                        $array_myblocks[$myblock_id] = $myblock;
                        $array_myblocks_childs[$myblock_id] = [];

                        for ($i = 0; $i < $nb_edges; $i ++) {
                            $id_child = (int) fgets($handle);
                            $array_myblocks_childs[$myblock_id][] = $id_child;
                        }

                        $inst_block = new MyInstruction(Opcodes::ENTER_BLOCK);
                        $inst_block->addProperty(MyInstruction::MYBLOCK, $myblock);
                        $context->getMyCode()->addCode($inst_block);

                        if ($first_block) {
                            $first_block = false;

                            foreach ($defs as $mydef) {
                                $inst_def = new MyInstruction(Opcodes::DEFINITION);
                                $inst_def->addProperty(MyInstruction::DEF, $mydef);
                                $context->getMyCode()->addCode($inst_def);
                            }
                        }

                        break;

                    case 'LeaveBlock':
                        $myblock_string = fgets($handle);
                        $myblock_id = (int) fgets($handle);

                        if (isset($array_myblocks[$myblock_id])) {
                            $myblock = $array_myblocks[$myblock_id];
                            $myblock->setEndAddressBlock(count($context->getMyCode()->getCodes()));

                            $inst_block = new MyInstruction(Opcodes::LEAVE_BLOCK);
                            $inst_block->addProperty(MyInstruction::MYBLOCK, $myblock);
                            $context->getMyCode()->addCode($inst_block);
                        }

                        break;

                    case 'Definition':
                        $code = $context->getMyCode()->getCodes();
                        $last_opcode = $code[count($code) - 1];

                        $def_string = fgets($handle);
                        $def_name = rtrim(fgets($handle));
                        $def_line = (int) fgets($handle);
                        $def_column = (int) fgets($handle);

                        $mydef = new MyDefinition($def_line, $def_column, $def_name);
                        $mydef->setSourceMyFile($myjavascript_file);
                        $array_definitions[] = $mydef;

                        $inst_def = new MyInstruction(Opcodes::DEFINITION);
                        $inst_def->addProperty(MyInstruction::DEF, $mydef);
                        $context->getMyCode()->addCode($inst_def);

                        break;

                    case 'funccall':
                        $func_string = fgets($handle);
                        $func_line = (int) fgets($handle);
                        $func_column = (int) fgets($handle);
                        $func_name = rtrim(fgets($handle));
                        $func_isInstance = rtrim(fgets($handle));
                        $func_name_instance = rtrim(fgets($handle));
                        $func_nb_params = (int) fgets($handle);

                        $inst_funcall_main = new MyInstruction(Opcodes::FUNC_CALL);
                        $inst_funcall_main->addProperty(MyInstruction::FUNCNAME, $func_name);

                        $myfunction_call = new MyFunction($func_name);
                        $myfunction_call->setLine($func_line);
                        $myfunction_call->setColumn($func_column);
                        $myfunction_call->setNbParams($func_nb_params);
                        $myfunction_call->setSourceMyFile($myjavascript_file);

                        if ($func_isInstance === "true") {
                            $myfunction_call->addType(MyOp::TYPE_INSTANCE);
                            $myfunction_call->setNameInstance($func_name_instance);

                            $mybackdef = new MyDefinition($func_line, $func_column, $func_name_instance);
                            $mybackdef->addType(MyDefinition::TYPE_INSTANCE);
                            $mybackdef->setSourceMyFile($myjavascript_file);
                            $myfunction_call->setBackDef($mybackdef);
                        }

                        for ($j = 0; $j < $func_nb_params; $j ++) {
                            $func_def_id_param = (int) fgets($handle);
                            $func_def_param = $array_definitions[$func_def_id_param];
                            $inst_funcall_main->addProperty("argdef$j", $func_def_param);
                        }

                        $func_expr_string = fgets($handle);
                        $func_expr_id = (int) fgets($handle);

                        // !!!!????
                        //$myexpr = $array_exprs[$func_expr_id];
                        $myexpr = null;

                        $inst_funcall_main->addProperty(MyInstruction::MYFUNC_CALL, $myfunction_call);
                        $inst_funcall_main->addProperty(MyInstruction::EXPR, $myexpr);
                        $inst_funcall_main->addProperty(MyInstruction::ARR, null);
                        $context->getMyCode()->addCode($inst_funcall_main);

                        break;

                    case 'temporary':
                        $def_string = fgets($handle);
                        $def_name = rtrim(fgets($handle));
                        $def_line = (int) fgets($handle);
                        $def_column = (int) fgets($handle);

                        $mytemp = new MyDefinition($def_line, $def_column, $def_name);
                        $mytemp->setSourceMyFile($myjavascript_file);
                        $array_definitions[] = $mytemp;

                        $nb_exprs = (int) fgets($handle);
                        for ($i = 0; $i < $nb_exprs; $i ++) {
                            $id_expr = (int) fgets($handle);
                            $mytemp->add_expr($id_expr);
                        }

                        $inst_temporarySimple = new MyInstruction(Opcodes::TEMPORARY);
                        $inst_temporarySimple->addProperty(MyInstruction::TEMPORARY, $mytemp);
                        $context->getMyCode()->addCode($inst_temporarySimple);

                        break;

                    case 'start_assign':
                        $context->getMyCode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));

                        break;

                    case 'end_assign':
                        $context->getMyCode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

                        break;

                    case 'start_expression':
                        $context->getMyCode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                        break;

                    case 'end_expression':
                        $expr_string = fgets($handle);
                        $expr_line = (int) fgets($handle);
                        $expr_column = (int) fgets($handle);

                        $myexpr = new MyExpr($expr_line, $expr_column);

                        $expr_isAssign = rtrim(fgets($handle));

                        if ($expr_isAssign === "true") {
                            $expr_def_assign_id = (int) fgets($handle);
                            $myexpr->setAssign(true);
                            $myexpr->setAssignDef($expr_def_assign_id);
                        }

                        $nb_exprs = (int) fgets($handle);

                        $array_exprs[] = $myexpr;

                        for ($i = 0; $i < $nb_exprs; $i ++) {
                            $def_id = (int) fgets($handle);
                            $myexpr->addDef($def_id);
                        }

                        $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                        $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                        $context->getMyCode()->addCode($inst_end_expr);

                        break;
                }
            }

            foreach ($array_myblocks as $parent) {
                $parent->addParent($parent);
                $childs = $array_myblocks_childs[$parent->getId()];

                foreach ($childs as $child) {
                    $myblock_child = $array_myblocks[$child];
                    $myblock_child->addParent($parent);
                }
            }

            foreach ($array_exprs as $myexpr) {
                $defs = $myexpr->getDefs();
                $myexpr->setDefs(array());

                if ($myexpr->isAssign()) {
                    $def_id = $myexpr->getAssignDef();
                    $mydef = $array_definitions[$def_id];
                    $myexpr->setAssignDef($mydef);
                }

                foreach ($defs as $def_id) {
                    $mydef = $array_definitions[$def_id];
                    $myexpr->addDef($mydef);
                }
            }

            foreach ($array_definitions as $mydef) {
                $exprs = $mydef->getExprs();
                $mydef->setExprs(array());

                foreach ($exprs as $expr_id) {
                    $myexpr = $array_exprs[$expr_id];
                    $mydef->add_expr($myexpr);
                }
            }

            fclose($handle);


            $myfunction->setEnd_address_func(count($context->getMyCode()->getCodes()));

            $inst_func = new MyInstruction(Opcodes::LEAVE_FUNCTION);
            $inst_func->addProperty(MyInstruction::MYFUNC, $myfunction);
            $context->getMyCode()->addCode($inst_func);

            $context->getMyCode()->setStart(0);
            $context->getMyCode()->setEnd(count($context->getMyCode()->getCodes()));
        }
    }

    public function printStdout()
    {
        $index = 0;

        do {
            if (isset($this->code[$index])) {
                $instruction = $this->code[$index];
                echo "[$index] ";
                switch ($instruction->getOpcode()) {
                    case Opcodes::ENTER_FUNCTION:
                        echo Opcodes::ENTER_FUNCTION."\n";

                        $myfunc = $instruction->getProperty(MyInstruction::MYFUNC);
                        echo "name = ".htmlentities($myfunc->getName(), ENT_QUOTES, 'UTF-8')."\n";
                        break;

                    case Opcodes::CLASSE:
                        echo Opcodes::CLASSE."\n";

                        $myclass = $instruction->getProperty(MyInstruction::MYCLASS);
                        echo "name = ".htmlentities($myclass->getName(), ENT_QUOTES, 'UTF-8')."\n";
                        break;

                    case Opcodes::ENTER_BLOCK:
                        echo Opcodes::ENTER_BLOCK."\n";

                        $myblock = $instruction->getProperty(MyInstruction::MYBLOCK);
                        echo "id = ".$myblock->getId()."\n";

                        break;

                    case Opcodes::LEAVE_BLOCK:
                        echo Opcodes::LEAVE_BLOCK."\n";

                        $myblock = $instruction->getProperty(MyInstruction::MYBLOCK);
                        echo "id = ".$myblock->getId()."\n";

                        break;

                    case Opcodes::LEAVE_FUNCTION:
                        echo Opcodes::LEAVE_FUNCTION."\n";

                        break;
                    

                    case Opcodes::FUNC_CALL:
                        echo Opcodes::FUNC_CALL."\n";

                        $funcname = htmlentities(
                            $instruction->getProperty(MyInstruction::FUNCNAME),
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        echo "name = $funcname\n";
                        break;

                    case Opcodes::START_EXPRESSION:
                        echo Opcodes::START_EXPRESSION."\n";
                        break;

                    case Opcodes::END_EXPRESSION:
                        echo Opcodes::END_EXPRESSION."\n";
                        $myexpr = $instruction->getProperty(MyInstruction::EXPR);
                        echo "expression et tainted = ".$myexpr->isTainted()."\n";
                        break;

                    case Opcodes::CONCAT_LIST:
                        echo Opcodes::CONCAT_LIST."\n";
                        break;

                    case Opcodes::CONCAT_LEFT:
                        echo Opcodes::CONCAT_LEFT."\n";
                        break;

                    case Opcodes::CONCAT_RIGHT:
                        echo Opcodes::CONCAT_RIGHT."\n";
                        break;

                    case Opcodes::RETURN_FUNCTION:
                        echo Opcodes::RETURN_FUNCTION."\n";
                        break;

                    case Opcodes::START_ASSIGN:
                        echo Opcodes::START_ASSIGN."\n";
                        break;

                    case Opcodes::END_ASSIGN:
                        echo Opcodes::END_ASSIGN."\n";
                        break;

                    case Opcodes::COND_BOOLEAN_NOT:
                        echo Opcodes::COND_BOOLEAN_NOT."\n";
                        break;

                    case Opcodes::COND_START_IF:
                        echo Opcodes::COND_START_IF."\n";
                        break;

                    case Opcodes::TEMPORARY:
                        echo Opcodes::TEMPORARY."\n";
                        $def = $instruction->getProperty(MyInstruction::TEMPORARY);
                        $def->printStdout();

                        break;

                    case Opcodes::DEFINITION:
                        echo Opcodes::DEFINITION."\n";
                        $def = $instruction->getProperty(MyInstruction::DEF);
                        $def->printStdout();

                        break;
                }

                $index = $index + 1;
            }
        } while (isset($this->code[$index]));
    }
}
