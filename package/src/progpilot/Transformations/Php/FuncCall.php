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
    public static function argument($context, $arg, $instFuncCallMain, $funcCallName, $numParam)
    {
        // each argument will be a definition defined by an expression
        $defName =
            $funcCallName.
            "_param".
            $numParam.
            "_line".
            $context->getCurrentLine().
            "_column".
            $context->getCurrentColumn().
            "_progpilot";
        $typeArray = Common::getTypeIsArray($arg);

        $myDef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $defName);

        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));
        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

        $myExprparam = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());
        $myExprparam->setAssign(true);
        $myExprparam->setAssignDef($myDef);

        $instFuncCallMain->addProperty("argdef$numParam", $myDef);
        $instFuncCallMain->addProperty("argexpr$numParam", $myExprparam);

        // if we have funccall($arg, array("test"=>false)); for example
        if ($typeArray === MyOp::TYPE_ARRAY_EXPR) {
            ArrayExpr::instruction($arg, $context, false, $defName, false);

            $myTemp = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $defName);
            //$myTemp->addLastKnownValue($defName);
            $myTemp->setExpr($myExprparam);

            $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
            $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $myTemp);
            $context->getCurrentMycode()->addCode($instTemporarySimple);
        } else {
            $myTemp = Expr::instruction($arg, $context, $myExprparam);

            if (!is_null($myTemp)) {
                $myDef->setValueFromDef($myTemp);
            }
        }

        $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
        $instEndExpr->addProperty(MyInstruction::EXPR, $myExprparam);
        $context->getCurrentMycode()->addCode($instEndExpr);

        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

        $instDef = new MyInstruction(Opcodes::DEFINITION);
        $instDef->addProperty(MyInstruction::DEF, $myDef);
        $context->getCurrentMycode()->addCode($instDef);

        unset($myExprparam);
        unset($myDef);
    }

    /*
    arg2 : expr for the return
    arg3 : arr for the return : function_call()[0] (arr = [0])
     */
    public static function instruction(
        $context,
        $myExpr,
        $funcCallArr,
        $isMethod = false,
        $isStatic = false,
        $cast = MyDefinition::CAST_NOT_SAFE
    ) {
        $mybackdef = null;
        $nbparams = 0;
        $propertyName = "";
        $className = "";

        // instance_name = new obj; instance_name->method_name()
        if ($isMethod) {
            $instanceName = Common::getNameDefinition($context->getCurrentOp()->var);
            if (isset($context->getCurrentOp()->var->ops[0])) {
                $propertyName = Common::getNameProperty($context->getCurrentOp()->var->ops[0]);
            }
        }

        $funcCallName = "";
        if ($context->getCurrentOp() instanceof Op\Expr\New_) {
            $funcCallName = "__construct";
            // we have the class name

            if (isset($context->getCurrentOp()->class->value)) {
                $className = $context->getCurrentOp()->class->value;
            }

            $isMethod = true;

            $instanceName = Common::getNameDefinition($context->getCurrentOp()->result->usages[0]);
            if (isset($context->getCurrentOp()->result->usages[0]->var->ops[0])) {
                $propertyName = Common::getNameProperty($context->getCurrentOp()->result->usages[0]->var->ops[0]);
            }
        } elseif (isset($context->getCurrentOp()->nsName->value)) {
            $funcCallName = $context->getCurrentOp()->nsName->value;
        } elseif (isset($context->getCurrentOp()->name->value)) {
            $funcCallName = $context->getCurrentOp()->name->value;
        }

        if ($funcCallName === "define") {
            Assign::instruction($context, false, true);
        }

        if ($context->getCurrentOp() instanceof Op\Expr\Include_) {
            $funcCallName = "include";
        } elseif ($context->getCurrentOp() instanceof Op\Expr\Print_) {
            $funcCallName = "print";
        } elseif ($context->getCurrentOp() instanceof Op\Terminal\Echo_) {
            $funcCallName = "echo";
        } elseif ($context->getCurrentOp() instanceof Op\Expr\Eval_) {
            $funcCallName = "eval";
        } elseif ($context->getCurrentOp() instanceof Op\Expr\Exit_) {
            $funcCallName = "exit";
        }

        $instFuncCallMain = new MyInstruction(Opcodes::FUNC_CALL);
        $instFuncCallMain->addProperty(MyInstruction::FUNCNAME, $funcCallName);

        $myFunctionCall = new MyFunction($funcCallName);
        $myFunctionCall->setCastReturn($cast);
        $myFunctionCall->setLine($context->getCurrentLine());
        $myFunctionCall->setColumn($context->getCurrentColumn());


        if ($isStatic && isset($context->getCurrentOp()->class->value)) {
            $nameClass = $context->getCurrentOp()->class->value;
            $myFunctionCall->addType(MyFunction::TYPE_FUNC_STATIC);
            $myFunctionCall->setNameInstance($nameClass);
        }

        if ($isMethod) {
            $myFunctionCall->addType(MyFunction::TYPE_FUNC_METHOD);
            $myFunctionCall->setNameInstance($instanceName);

            $mybackdef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $instanceName);
            $mybackdef->addType(MyDefinition::TYPE_INSTANCE);
            $mybackdef->setClassName($className);

            if ($propertyName !== "" && count($propertyName) > 0) {
                $mybackdef->addType(MyDefinition::TYPE_PROPERTY);
                $mybackdef->property->setProperties($propertyName);
            }

            $myFunctionCall->setBackDef($mybackdef);
        }

        $listArgs = [];

        if ($context->getCurrentOp() instanceof Op\Expr\Include_
                    || $context->getCurrentOp() instanceof Op\Expr\Print_
                    || $context->getCurrentOp() instanceof Op\Terminal\Echo_
                    || $context->getCurrentOp() instanceof Op\Expr\Eval_
                    || $context->getCurrentOp() instanceof Op\Expr\Exit_) {
            $listArgs[] = $context->getCurrentOp()->expr;

            if ($context->getCurrentOp() instanceof Op\Expr\Include_) {
                $instFuncCallMain->addProperty(MyInstruction::TYPE_INCLUDE, $context->getCurrentOp()->type);
            }
        } else {
            $listArgs = $context->getCurrentOp()->args;
        }

        foreach ($listArgs as $arg) {
            FuncCall::argument($context, $arg, $instFuncCallMain, $funcCallName, $nbparams);
            $nbparams ++;
        }

        $myFunctionCall->setNbParams($nbparams);
        $instFuncCallMain->addProperty(MyInstruction::MYFUNC_CALL, $myFunctionCall);
        $instFuncCallMain->addProperty(MyInstruction::EXPR, $myExpr);
        $instFuncCallMain->addProperty(MyInstruction::ARR, $funcCallArr);
        $context->getCurrentMycode()->addCode($instFuncCallMain);
        
        return $mybackdef;
    }
}
