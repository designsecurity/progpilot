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
use progpilot\Transformations\Php\Exprs\PropertyFetch;
use progpilot\Transformations\Php\Exprs\DimFetch;
use progpilot\Transformations\Php\Exprs\VariableFetch;

class FuncCall
{
    public static function argument($context, $arg, $instFuncCallMain, $funcCallName, $numParam)
    {
        echo "argument start\n";
        $myExprparam = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());

        VariableFetch::variableFetch($context, $arg, null);

        $instArg = new MyInstruction(Opcodes::ARGUMENT);
        $instArg->addProperty(MyInstruction::VARID, $context->getCurrentFunc()->getOpId($arg));
        $context->getCurrentMycode()->addCode($instArg);

        $defName =
            $funcCallName.
            "_param".
            $numParam.
            "_line".
            $context->getCurrentLine().
            "_column".
            $context->getCurrentColumn().
            "_progpilot";
        $myDef = new MyDefinition(
            $context->getCurrentBlock()->getId(),
            $context->getCurrentMyFile(),
            $context->getCurrentLine(),
            $context->getCurrentColumn(),
            $defName
        );

        $instArg->addProperty("argdef$numParam", $myDef);
        $instArg->addProperty("argexpr$numParam", $myExprparam);
        $instArg->addProperty("idparam", $numParam);

        $instFuncCallMain->addProperty("argdef$numParam", $myDef);
        $instFuncCallMain->addProperty("argexpr$numParam", $myExprparam);

        echo "argument end\n";

/*
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

            echo "transform funcall 1\n";
            if (isset($context->getCurrentOp()->expr)) {
                echo "transform funcall 2\n";
                //Common::transformPropertyFetch($context, $context->getCurrentOp()->expr->ops[0]);
            }
            echo "transform funcall 3\n";

            $myTemp = Expr::instruction($arg, $context, $myExprparam);

            echo "transform funcall 4\n";
            if (!is_null($myTemp)) {
                $myDef->setValueFromDef($myTemp);
            }
        }

        $instDef = new MyInstruction(Opcodes::DEFINITION);
        $instDef->addProperty(MyInstruction::DEF, $myDef);
        $context->getCurrentMycode()->addCode($instDef);

        unset($myExprparam);
        unset($myDef);
        */
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
        $propertyName = null;
        $className = "";

        // instance_name = new obj; instance_name->method_name()

        echo "funccall start\n";
        if ($context->getCurrentOp() instanceof Op\Expr\MethodCall) {
            echo "funccall transform2\n";
            $isMethod = true;
            $instanceName = Common::getNameDefinition($context->getCurrentOp()->var);
            
            if (isset($context->getCurrentOp()->var->ops[0])) {
                $propertyName = Common::getNameProperty($context->getCurrentOp()->var->ops[0]);
            }
            echo "funccall transform3 '$instanceName' '$propertyName'\n";
        }

        $funcCallName = "";
        if ($context->getCurrentOp() instanceof Op\Expr\New_) {
            $funcCallName = "__construct";

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
        } elseif ($context->getCurrentOp() instanceof Op\Expr\Exit_
            || $context->getCurrentOp() instanceof Op\Terminal\Exit_) {
            $funcCallName = "exit";
        }

        $instFuncCallMain = new MyInstruction(Opcodes::FUNC_CALL);

        if (isset($context->getCurrentOp()->result)) {
            $instFuncCallMain->addProperty(
                MyInstruction::RESULTID,
                $context->getCurrentFunc()->getOpId($context->getCurrentOp()->result)
            );
        }
        if (isset($context->getCurrentOp()->var)) {
            $instFuncCallMain->addProperty(
                MyInstruction::VARID,
                $context->getCurrentFunc()->getOpId($context->getCurrentOp()->var)
            );
        } elseif (isset($context->getCurrentOp()->class)) {
            $instFuncCallMain->addProperty(
                MyInstruction::VARID,
                $context->getCurrentFunc()->getOpId($context->getCurrentOp()->class)
            );
        }
        echo "funccall transform4 '$funcCallName'\n";
        $instFuncCallMain->addProperty(MyInstruction::FUNCNAME, $funcCallName);

        $myFunctionCall = new MyFunction($funcCallName);
        $myFunctionCall->setCastReturn($cast);
        $myFunctionCall->setLine($context->getCurrentLine());
        $myFunctionCall->setColumn($context->getCurrentColumn());
        $myFunctionCall->setInstanceClassName($className);

        if ($isStatic && isset($context->getCurrentOp()->class->value)) {
            $nameClass = $context->getCurrentOp()->class->value;
            $myFunctionCall->addType(MyFunction::TYPE_FUNC_STATIC);
            $myFunctionCall->setNameInstance($nameClass);
        }

        if ($isMethod) {
            $myFunctionCall->addType(MyFunction::TYPE_FUNC_METHOD);
            $myFunctionCall->setNameInstance($instanceName);
        }

        $listArgs = [];

        if ($context->getCurrentOp() instanceof Op\Expr\Include_
                    || $context->getCurrentOp() instanceof Op\Expr\Print_
                    || $context->getCurrentOp() instanceof Op\Terminal\Echo_
                    || $context->getCurrentOp() instanceof Op\Expr\Eval_
                    || $context->getCurrentOp() instanceof Op\Expr\Exit_
                    || $context->getCurrentOp() instanceof Op\Terminal\Exit_) {
            $listArgs[] = $context->getCurrentOp()->expr;

            if ($context->getCurrentOp() instanceof Op\Expr\Include_) {
                $instFuncCallMain->addProperty(MyInstruction::TYPE_INCLUDE, $context->getCurrentOp()->type);
            }
        } else {
            $listArgs = $context->getCurrentOp()->args;
        }

        echo "funccall start arg\n";
        foreach ($listArgs as $arg) {
            FuncCall::argument($context, $arg, $instFuncCallMain, $funcCallName, $nbparams);
            $nbparams ++;
        }
        echo "funccall end arg\n";

        $myFunctionCall->setNbParams($nbparams);

/*
        if ($isMethod) {
            if (isset($context->getCurrentOp()->var->ops[0])) {
                Common::transformPropertyFetch($context, $context->getCurrentOp()->var->ops[0]);
            }
        }*/

        $instFuncCallMain->addProperty(MyInstruction::MYFUNC_CALL, $myFunctionCall);
        $instFuncCallMain->addProperty(MyInstruction::EXPR, $myExpr);
        $instFuncCallMain->addProperty(MyInstruction::ARR, $funcCallArr);
        $context->getCurrentMycode()->addCode($instFuncCallMain);

        echo "funcall end\n";
        return $mybackdef;
    }
}
