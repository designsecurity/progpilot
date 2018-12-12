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
use progpilot\Transformations\Js\Transform;

class Expr
{

    public static function instruction($op, $context, $myExpr)
    {
        return Expr::instructionInternal($op, $context, $myExpr);
    }

    public static function instructionInternal($op, $context, $myExpr)
    {
        $myTempDef = null;
        
        $typeright = Common::getTypeDefinition($op);
        $nameright = Common::getNameDefinition($op);
        
        if ($typeright === "Identifier" || $typeright === "Literal" || $typeright === "MemberExpression") {
            $myright = new MyDefinition($op->loc->start->line, $op->loc->start->column, $nameright);
            $myright->setExpr($myExpr);
            
            if ($typeright === "MemberExpression") {
                $propertyName = Common::getNameProperty($op);
                $myright->addType(MyDefinition::TYPE_PROPERTY);
                $myright->property->setProperties($propertyName);
            }
            
            if ($typeright === "Literal") {
                $myright->addLastKnownValue($nameright);
            }
        
            $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
            $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $myright);
            $context->getCurrentMycode()->addCode($instTemporarySimple);
            
            return $myright;
        }
    
        if ($typeright === "BinaryExpression") {
            $myExpr->setIsConcat(true);
        
            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_LEFT));
            Expr::instructionInternal($op->left, $context, $myExpr);

            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_RIGHT));
            Expr::instructionInternal($op->right, $context, $myExpr);
        } elseif ($typeright === "CallExpression") {
            $myTempDef = FuncCall::instruction($context, $myExpr, $op);
        } elseif ($typeright === "NewExpression") {
            $myTempDef = FuncCall::instruction($context, $myExpr, $op);
        }

        return $myTempDef;
    }
}
