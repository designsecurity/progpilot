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
use progpilot\Objects\MyOp;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Js\Transform;

class Expr
{
    public static function instruction($op, $context)
    {
        return Expr::instructionInternal($op, $context);
    }

    public static function instructionInternal($op, $context)
    {
        $myTempDef = null;
        
        $typeright = Common::getTypeDefinition($op);
        $nameright = Common::getNameDefinition($op);
        
        if ($typeright === "Identifier" || $typeright === "Literal" || $typeright === "MemberExpression") {
            $myright = new MyDefinition($op->loc->start->line, $op->loc->start->column, $nameright);
            
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
            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_LEFT));

            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_RIGHT));
        }

        return $myTempDef;
    }
}
