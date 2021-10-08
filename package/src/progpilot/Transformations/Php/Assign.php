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
use PHPCfg\Operand;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyOp;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;
use progpilot\Transformations\Php\OpTr;
use progpilot\Transformations\Php\Common;
use progpilot\Transformations\Php\Exprs\PropertyFetch;
use progpilot\Transformations\Php\Exprs\DimFetch;
use progpilot\Transformations\Php\Exprs\VariableFetch;
use progpilot\Transformations\Php\Exprs\ArrayFetch;

class Assign
{
    public static function instruction(
        $context,
        $op,
        $expr,
        $var,
        $isReturnDef = false,
        $isDefine = false,
        $myblock = null
    ) {
        $backDef = null;

        if ($isDefine) {
            $name = "const_".rand();
            if (isset($context->getCurrentOp()->args[0]->value)) {
                $name = $context->getCurrentOp()->args[0]->value;
                $var = $context->getCurrentOp()->args[0];
            }

            if (isset($context->getCurrentOp()->args[1])) {
                $expr = $context->getCurrentOp()->args[1];
            }
        } else {
            $name = Common::getNameDefinition($context->getCurrentOp());
            $type = Common::getTypeDefinition($context->getCurrentOp());
            $typeArray = Common::getTypeIsArray($context->getCurrentOp());
            $typeInstance = Common::getTypeIsInstance($context->getCurrentOp());
            
            if (empty($name)) {
                $name = "empty_".rand();
            }
        }

        // name of function return
        if ($isReturnDef) {
            $name = $context->getCurrentFunc()->getName()."_return";
        }

        $myExpr = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());

        $instAssign = new MyInstruction(Opcodes::END_ASSIGN);

        // extra = properties, arrays
        // $left(extra) = $right(extra) <= expr right

        // let's start by the right part
        if (isset($expr)) {
            Expr::instructionnew($context, $expr, null);
        }

        // let's continue by the left part
        $instDefinition = new MyInstruction(Opcodes::DEFINITION);
            
        $myDef = new MyDefinition(
            $context->getCurrentBlock()->getId(),
            $context->getCurrentMyFile(),
            $context->getCurrentLine(),
            $context->getCurrentColumn(),
            $name
        );

        switch (Common::getTypeDef($op)) {
            case MyOp::TYPE_ARRAY:
                $myDef->addType(MyDefinition::TYPE_ARRAY);
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);
                break;
            case MyOp::TYPE_PROPERTY:
                $myDef->addType(MyDefinition::TYPE_PROPERTY);
                break;
            case MyOp::TYPE_STATIC_PROPERTY:
                $myDef->addType(MyDefinition::TYPE_STATIC_PROPERTY);
                break;
            case MyOp::TYPE_CONST:
                $myDef->addType(MyDefinition::TYPE_CONSTANTE);
                break;
            case MyOp::TYPE_VARIABLE:
                break;
            default:
                break;
        }
        
        // NOT NECESSARY?
        // an object (created by new)
        if (isset($typeInstance) && $typeInstance === MyOp::TYPE_INSTANCE) {
            // it's the class name not instance name
            if (isset($expr->ops[0]->class->value)) {
                $nameClass = $expr->ops[0]->class->value;
                $myDef->addType(MyDefinition::TYPE_INSTANCE);
                $myDef->setClassName($nameClass);
            }
        }

        $instDefinition->addProperty(MyInstruction::DEF, $myDef);
        $context->getCurrentMycode()->addCode($instDefinition);

        $instAssign->addProperty(MyInstruction::DEF, $myDef);
        $instAssign->addProperty(MyInstruction::EXPR, $myExpr);

        if ($op instanceof Op\Expr\AssignRef) {
            $instAssign->addProperty(MyInstruction::REFERENCE, true);
        }

        if ($isReturnDef) {
            $context->getCurrentFunc()->addReturnDef($myDef);
            $myDef->setReturnDef(true);
        }

        $instAssign->addProperty(
            MyInstruction::EXPRID,
            $context->getCurrentFunc()->getOpId($expr)
        );

        if (!$isReturnDef) {
            $instAssign->addProperty(
                MyInstruction::VARID,
                $context->getCurrentFunc()->getOpId($var)
            );
        }


        if (isset($op->result)) {
            $instAssign->addProperty(
                MyInstruction::RESULTID,
                $context->getCurrentFunc()->getOpId($op->result)
            );
        }

        $context->getCurrentMycode()->addCode($instAssign);

        return $backDef;
    }
}
