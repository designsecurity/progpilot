<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php;

use PHPCfg\Block;
use PHPCfg\Op;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyOp;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;
use progpilot\Transformations\Php\Expr;

class FuncCall
{
    public static function argument($context, $arg, $inst_funcall_main, $funccall_name, $num_param)
    {
        // each argument will be a definition defined by an expression
        $def_name =
            $funccall_name.
            "_param".
            $num_param.
            "_line".
            $context->getCurrentLine().
            "_column".
            $context->getCurrentColumn().
            "_progpilot";
        $type_array = Common::getTypeIsArray($arg);

        $mydef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $def_name);

        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));
        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

        $myexprparam = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());
        $myexprparam->setAssign(true);
        $myexprparam->setAssignDef($mydef);

        $inst_funcall_main->addProperty("argdef$num_param", $mydef);
        $inst_funcall_main->addProperty("argexpr$num_param", $myexprparam);

        // if we have funccall($arg, array("test"=>false)); for example
        if ($type_array === MyOp::TYPE_ARRAY_EXPR) {
            ArrayExpr::instruction($arg, $context, false, $def_name, false);

            $mytemp = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $def_name);
            //$mytemp->addLastKnownValue($def_name);
            $mytemp->setExpr($myexprparam);

            $inst_temporarySimple = new MyInstruction(Opcodes::TEMPORARY);
            $inst_temporarySimple->addProperty(MyInstruction::TEMPORARY, $mytemp);
            $context->getCurrentMycode()->addCode($inst_temporarySimple);
        } else {
            $mytemp = Expr::instruction($arg, $context, $myexprparam);

            if (!is_null($mytemp)) {
                $mydef->setValueFromDef($mytemp);
            }
        }

        $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
        $inst_end_expr->addProperty(MyInstruction::EXPR, $myexprparam);
        $context->getCurrentMycode()->addCode($inst_end_expr);

        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

        $inst_def = new MyInstruction(Opcodes::DEFINITION);
        $inst_def->addProperty(MyInstruction::DEF, $mydef);
        $context->getCurrentMycode()->addCode($inst_def);

        unset($myexprparam);
        unset($mydef);
    }

    /*
    arg2 : expr for the return
    arg3 : arr for the return : function_call()[0] (arr = [0])
     */
    public static function instruction($context, $myexpr, $funccall_arr, $is_method = false, $is_static = false)
    {
        $mybackdef = null;
        $nbparams = 0;
        $property_name = "";
        $class_name = "";

        // instance_name = new obj; instance_name->method_name()
        if ($is_method) {
            $instance_name = Common::getNameDefinition($context->getCurrentOp()->var);
            if (isset($context->getCurrentOp()->var->ops[0])) {
                $property_name = Common::getNameProperty($context->getCurrentOp()->var->ops[0]);
            }
        }

        $funccall_name = "";
        if ($context->getCurrentOp() instanceof Op\Expr\New_) {
            $funccall_name = "__construct";
            // we have the class name

            if (isset($context->getCurrentOp()->class->value)) {
                $class_name = $context->getCurrentOp()->class->value;
            }

            $is_method = true;

            $instance_name = Common::getNameDefinition($context->getCurrentOp()->result->usages[0]);
            if (isset($context->getCurrentOp()->result->usages[0]->var->ops[0])) {
                $property_name = Common::getNameProperty($context->getCurrentOp()->result->usages[0]->var->ops[0]);
            }
        } elseif (isset($context->getCurrentOp()->nsName->value)) {
            $funccall_name = $context->getCurrentOp()->nsName->value;
        } elseif (isset($context->getCurrentOp()->name->value)) {
            $funccall_name = $context->getCurrentOp()->name->value;
        }

        if ($funccall_name === "define") {
            Assign::instruction($context, false, true);
        }

        if ($context->getCurrentOp() instanceof Op\Expr\Include_) {
            $funccall_name = "include";
        } elseif ($context->getCurrentOp() instanceof Op\Expr\Print_) {
            $funccall_name = "print";
        } elseif ($context->getCurrentOp() instanceof Op\Terminal\Echo_) {
            $funccall_name = "echo";
        } elseif ($context->getCurrentOp() instanceof Op\Expr\Eval_) {
            $funccall_name = "eval";
        }

        $inst_funcall_main = new MyInstruction(Opcodes::FUNC_CALL);
        $inst_funcall_main->addProperty(MyInstruction::FUNCNAME, $funccall_name);

        $myfunction_call = new MyFunction($funccall_name);
        $myfunction_call->setLine($context->getCurrentLine());
        $myfunction_call->setColumn($context->getCurrentColumn());


        if ($is_static && isset($context->getCurrentOp()->class->value)) {
            $name_class = $context->getCurrentOp()->class->value;
            $myfunction_call->addType(MyFunction::TYPE_FUNC_STATIC);
            $myfunction_call->setNameInstance($name_class);
        }

        if ($is_method) {
            // when we define a method in a class (TYPE_METHOD) but when we use a method (TYPE_INSTANCE)
            $myfunction_call->addType(MyFunction::TYPE_FUNC_METHOD);
            $myfunction_call->setNameInstance($instance_name);

            $mybackdef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $instance_name);
            $mybackdef->addType(MyDefinition::TYPE_INSTANCE);
            $mybackdef->setClassName($class_name);

            if ($property_name !== "" && count($property_name) > 0) {
                $mybackdef->addType(MyDefinition::TYPE_PROPERTY);
                $mybackdef->property->setProperties($property_name);
            }

            $myfunction_call->setBackDef($mybackdef);
        }

        $list_args = [];

        if ($context->getCurrentOp() instanceof Op\Expr\Include_
                    || $context->getCurrentOp() instanceof Op\Expr\Print_
                    || $context->getCurrentOp() instanceof Op\Terminal\Echo_
                    || $context->getCurrentOp() instanceof Op\Expr\Eval_) {
            $list_args[] = $context->getCurrentOp()->expr;

            if ($context->getCurrentOp() instanceof Op\Expr\Include_) {
                $inst_funcall_main->addProperty(MyInstruction::TYPE_INCLUDE, $context->getCurrentOp()->type);
            }
        } else {
            $list_args = $context->getCurrentOp()->args;
        }

        foreach ($list_args as $arg) {
            FuncCall::argument($context, $arg, $inst_funcall_main, $funccall_name, $nbparams);
            $nbparams ++;
        }

        $myfunction_call->setNbParams($nbparams);
        $inst_funcall_main->addProperty(MyInstruction::MYFUNC_CALL, $myfunction_call);
        $inst_funcall_main->addProperty(MyInstruction::EXPR, $myexpr);
        $inst_funcall_main->addProperty(MyInstruction::ARR, $funccall_arr);
        $context->getCurrentMycode()->addCode($inst_funcall_main);

        return $mybackdef;
    }
}
