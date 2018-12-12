<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Js;

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
    public static function argument($arg, $op, $context, $instFuncCallMain, $funcCallName, $numParam)
    {
        // each argument will be a definition defined by an expression
        $defName =
            $funcCallName.
            "_param".
            $numParam.
            "_line".
            $op->loc->start->line.
            "_column".
            $op->loc->start->column.
            "_progpilot";

        $myDef = new MyDefinition($op->loc->start->line, $op->loc->start->column, $defName);

        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));
        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

        $myExprparam = new MyExpr($op->loc->start->line, $op->loc->start->column);
        $myExprparam->setAssign(true);
        $myExprparam->setAssignDef($myDef);

        $instFuncCallMain->addProperty("argdef$numParam", $myDef);
        $instFuncCallMain->addProperty("argexpr$numParam", $myExprparam);

        /*
        $myTemp = Expr::instruction($arg, $context, $myExprparam);

        if (!is_null($myTemp)) {
            $myDef->setValueFromDef($myTemp);
        }
        */
        $myargumenttype = $arg->type;
        $myargumentvalue = "";
        
        switch ($myargumenttype) {
            case 'Identifier':
                $myargumentvalue = $arg->name;
                break;
            
            case 'Literal':
                $myargumentvalue = $arg->value;
                break;
            
            case 'MemberExpression':
                $myargumentvalue = $arg->object->name;
                break;
        }
            
        $mytemp = new MyDefinition($op->loc->start->line, $op->loc->start->column, $myargumentvalue);
        $mytemp->setExpr($myExprparam);
        
        if ($myargumenttype === 'MemberExpression') {
            $propertyName = Common::getNameProperty($arg);
            $mytemp->addType(MyDefinition::TYPE_PROPERTY);
            $mytemp->property->setProperties($propertyName);
        }
            
        $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
        $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $mytemp);
        $context->getCurrentMycode()->addCode($instTemporarySimple);

        $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
        $instEndExpr->addProperty(MyInstruction::EXPR, $myExprparam);
        $context->getCurrentMycode()->addCode($instEndExpr);

        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

        $instDef = new MyInstruction(Opcodes::DEFINITION);
        $instDef->addProperty(MyInstruction::DEF, $myDef);
        $context->getCurrentMycode()->addCode($instDef);
    }

    /*
    arg2 : expr for the return
    arg3 : arr for the return : function_call()[0] (arr = [0])
     */
    public static function instruction(
        $context,
        $myExpr,
        $op
    ) {
    
        $type = Common::getTypeDefinition($op);
        $mycallee = $op->callee;
    
        if ($mycallee->type === "MemberExpression" || $mycallee->type === "Identifier") {
            if ($mycallee->type === "MemberExpression") {
                $object = $mycallee->object;
                $property = $mycallee->property;
                
                $instance_name = $object->name;
                $method_name = $property->name;
                $isMethod = true;
            } elseif ($mycallee->type === "Identifier" && $type === "NewExpression") {
                $method_name = "__construct";
                $instance_name = $mycallee->name;
                $isMethod = true;
            }
            
            $instFuncCallMain = new MyInstruction(Opcodes::FUNC_CALL);
            $instFuncCallMain->addProperty(MyInstruction::FUNCNAME, $method_name);

            $myFunctionCall = new MyFunction($method_name);
            //$myFunctionCall->setCastReturn($cast);
            $myFunctionCall->setLine($mycallee->loc->start->line);
            $myFunctionCall->setColumn($mycallee->loc->start->column);
            
            if ($isMethod) {
                $myFunctionCall->addType(MyFunction::TYPE_FUNC_METHOD);
                $myFunctionCall->setNameInstance($instance_name);
                
                $mybackdef = new MyDefinition(
                    $mycallee->loc->start->line,
                    $mycallee->loc->start->column,
                    $instance_name
                );
                $mybackdef->addType(MyDefinition::TYPE_INSTANCE);
                $mybackdef->setClassName($instance_name);
                /*
                if ($propertyName !== "" && count($propertyName) > 0) {
                    $mybackdef->addType(MyDefinition::TYPE_PROPERTY);
                    $mybackdef->property->setProperties($propertyName);
                }*/

                $myFunctionCall->setBackDef($mybackdef);
            }
            
            $myarguments = $op->arguments;

            $nbparams = 0;
            for ($i = 0; $i < count($myarguments); $i ++) {
                FuncCall::argument($myarguments[$i], $mycallee, $context, $instFuncCallMain, $method_name, $nbparams);
                $nbparams ++;
            }

            $myFunctionCall->setNbParams($nbparams);
            $instFuncCallMain->addProperty(MyInstruction::MYFUNC_CALL, $myFunctionCall);
            $instFuncCallMain->addProperty(MyInstruction::EXPR, $myExpr);
            $instFuncCallMain->addProperty(MyInstruction::ARR, false);
            $context->getCurrentMycode()->addCode($instFuncCallMain);
            
            return $mybackdef;
        }
    }
}
