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
            }

            $type = MyOp::TYPE_CONST;
            $typeArray = null;
            $typeInstance = null;

            $exprOp = $context->getCurrentOp();
            if (isset($context->getCurrentOp()->args[1])) {
                $exprOp = $context->getCurrentOp()->args[1];
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

        /*
        $isRef = false;
        if ($context->getCurrentOp() instanceof Op\Expr\AssignRef) {
            $isRef = true;
        }

        // it's an expression which will define a definition
        $myExpr = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());
        $myExpr->setAssign(true);

        $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));

        if (isset($context->getCurrentOp()->expr->ops[0])
                    && $context->getCurrentOp()->expr->ops[0] instanceof Op\Iterator\Value) {
            $myExpr->setAssignIterator(true);
        }

        $instStartExpr = new MyInstruction(Opcodes::START_EXPRESSION);
        $instStartExpr->addProperty(MyInstruction::EXPR, $myExpr);
        $context->getCurrentMycode()->addCode($instStartExpr);

        Expr::instruction($exprOp, $context, $myExpr);

        $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
        $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
        $context->getCurrentMycode()->addCode($instEndExpr);

        $myDef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $name);

        if ($isRef) {
            $myDef->addType(MyDefinition::TYPE_REFERENCE);
        }

        if ($type === MyOp::TYPE_CONST) {
            $myDef->addType(MyDefinition::TYPE_CONSTANTE);
        }

        if ($isReturnDef) {
            $context->getCurrentFunc()->addReturnDef($myDef);
            $myblock->addReturnDef($myDef);
        }

        $myExpr->setAssignDef($myDef);

        $newType = Common::getTypeDef($context->getCurrentOp());
        if ($newType === MyOp::TYPE_ARRAY) {
            $myDef->addType(MyDefinition::TYPE_ARRAY);
        }

        // we don't need to create a definition for property as they already exist in the instance
        if ($newType !== MyOp::TYPE_PROPERTY) {
            $instDef = new MyInstruction(Opcodes::DEFINITION);
            $instDef->addProperty(MyInstruction::DEF, $myDef);
            $context->getCurrentMycode()->addCode($instDef);
        }

        if (isset($context->getCurrentOp()->var->ops[0])) {
            Common::transformPropertyFetch($context, $context->getCurrentOp()->var->ops[0]);
        }

        $instEndAssign = new MyInstruction(Opcodes::END_ASSIGN);
        $instEndAssign->addProperty(MyInstruction::EXPR, $myExpr);
        $instEndAssign->addProperty(MyInstruction::DEF, $myDef);
        $context->getCurrentMycode()->addCode($instEndAssign);

        // an object (created by new)
        if ($typeInstance === MyOp::TYPE_INSTANCE) {
            // it's the class name not instance name
            if (isset($context->getCurrentOp()->expr->ops[0]->class->value)) {
                $nameClass = $context->getCurrentOp()->expr->ops[0]->class->value;
                $myDef->addType(MyDefinition::TYPE_INSTANCE);
                $myDef->setClassName($nameClass);
            }
        }

        if ($isRef) {
            $refName = Common::getNameDefinition($context->getCurrentOp()->expr);
            $myDef->setRefName($refName);
        }
        */

        $myExpr = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());

        $instAssign = new MyInstruction(Opcodes::END_ASSIGN);

        // extra = properties, arrays
        // $left(extra) = $right(extra) <= expr right

        // let's start by the right part
        /*
        if (isset($op->expr->original) && $op->expr->original instanceof Operand\Variable
            && isset($op->expr->original->name) && $op->expr->original->name instanceof Operand\Literal) {
            $myTemp = new MyDefinition(
                $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                        $op->expr->original->name->value);
            $myTemp->setSourceMyFile($context->getCurrentMyFile());
            $myTemp->setExpr($myExpr);

            $instAssign->addProperty(MyInstruction::VARIABLE, $myTemp);
        } else*/
        if (isset($expr) && $expr instanceof Operand\Literal) {
            $myTemp = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentMyFile(),
                $context->getCurrentLine(),
                $context->getCurrentColumn(),
                $expr->value
            );
    
            $instAssign->addProperty(MyInstruction::LITERAL, $myTemp);
        }
        
        // $array = [expr, expr, expr]
        if (isset($expr->ops[0]) && $expr->ops[0] instanceof Op\Expr\Array_) {
            ArrayFetch::arrayFetch($context, $expr->ops[0], $var, $expr, $name);
        } else {
            Expr::instructionnew($context, $expr, $myExpr);
        }

        // let's continue by the left part
        $instDefinition = new MyInstruction(Opcodes::DEFINITION);
            
        Expr::instructionassign($context, $var, null);
            
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
            default:
                break;
        }

        echo "ASSIGNDEF\n";
        $myDef->printStdout();
        
        // an object (created by new)
        if ($typeInstance === MyOp::TYPE_INSTANCE) {
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

        $context->getCurrentMycode()->addCode($instAssign);
        

        return $backDef;
    }
}
