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
        Expr::implicitfetch($context, $arg, null);

        $instVariable = $context->getCurrentMycode()->getLastCode();
        if ($instVariable->getOpcode() === Opcodes::VARIABLE_FETCH) {
            $defArg = $instVariable->getProperty(MyInstruction::DEF);
            $instFuncCallMain->addProperty("argoriginaldef$numParam", $defArg);
        }

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


        $instArg = new MyInstruction(Opcodes::ARGUMENT);
        $instArg->addProperty(MyInstruction::VARID, $context->getCurrentFunc()->getOpId($arg));
        $context->getCurrentMycode()->addCode($instArg);

        $instArg->addProperty("argdef$numParam", $myDef);
        $instArg->addProperty("idparam", $numParam);

        $instFuncCallMain->addProperty("argdef$numParam", $myDef);
    }

    /*
    arg2 : expr for the return
    arg3 : arr for the return : function_call()[0] (arr = [0])
     */
    public static function instruction($context)
    {
        $isMethod = false;
        $nbparams = 0;
        $className = "";

        // instance_name = new obj; instance_name->method_name()

        if ($context->getCurrentOp() instanceof Op\Expr\MethodCall) {
            $isMethod = true;
            $instanceName = Common::getNameDefinition($context->getCurrentOp()->var);
        }

        $funcCallName = "";
        if ($context->getCurrentOp() instanceof Op\Expr\New_) {
            $funcCallName = "__construct";

            if (isset($context->getCurrentOp()->class->value)) {
                $className = $context->getCurrentOp()->class->value;
            }

            if (isset($context->getCurrentOp()->result->usages[0])) {
                $isMethod = true;
                $instanceName = Common::getNameDefinition($context->getCurrentOp()->result->usages[0]);
            }
        } elseif (isset($context->getCurrentOp()->nsName->value)) {
            $funcCallName = $context->getCurrentOp()->nsName->value;
        } elseif (isset($context->getCurrentOp()->name->value)) {
            $funcCallName = $context->getCurrentOp()->name->value;
        }

        if ($funcCallName === "define") {
            Assign::instruction($context, $context->getCurrentOp(), null, null, false, true);
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
        $instFuncCallMain->addProperty(MyInstruction::FUNCNAME, $funcCallName);

        $myFunctionCall = new MyFunction($funcCallName);
        $myFunctionCall->setLine($context->getCurrentLine());
        $myFunctionCall->setColumn($context->getCurrentColumn());
        $myFunctionCall->setInstanceClassName($className);

        if ($context->getCurrentOp() instanceof Op\Expr\StaticCall &&
            isset($context->getCurrentOp()->class->value)) {
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
            if (isset($context->getCurrentOp()->expr)) {
                $listArgs[] = $context->getCurrentOp()->expr;
            }

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
        $context->getCurrentMycode()->addCode($instFuncCallMain);
    }
}
