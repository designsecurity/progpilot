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

class Assign
{
    public static function instruction($context, $opExpr, $opDef)
    {
        $name = Common::getNameDefinition($opDef);
        $context->getCurrentMycode()->addCode(
            new MyInstruction(Opcodes::START_ASSIGN)
        );
        $context->getCurrentMycode()->addCode(
            new MyInstruction(Opcodes::START_EXPRESSION)
        );
              
        $myExpr = new MyExpr(
            $opExpr->loc->start->line,
            $opExpr->loc->start->column
        );
        
        $backDef = Expr::instruction($opExpr, $context, $myExpr);
                                    
        $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
        $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
        $context->getCurrentMycode()->addCode($instEndExpr);

        $context->getCurrentMycode()->addCode(
            new MyInstruction(Opcodes::END_ASSIGN)
        );
                                    
        $myDef = new MyDefinition(
            $opDef->loc->start->line,
            $opDef->loc->start->column,
            $name
        );
        
        if ($opDef->type === "MemberExpression") {
            $myDef->addType(MyDefinition::TYPE_PROPERTY);
            $propertyName = Common::getNameProperty($opDef);
            $myDef->property->setProperties($propertyName);
        }
        
        if (isset($opExpr->type) && $opExpr->type === "NewExpression") {
            // it's the class name not instance name
            if (isset($opExpr->callee->name)) {
                $nameClass = $opExpr->callee->name;
                $myDef->addType(MyDefinition::TYPE_INSTANCE);
                $myDef->setClassName($nameClass);

                // ou bien créer backdef ici
                if (!is_null($backDef)) {
                    $backDef->setId($myDef->getId() + 1);
                    $backDef->setName($name);
                }
            }
        }
        
        $myDef->setExpr($myExpr);
        $myExpr->setAssign(true);
        $myExpr->setAssignDef($myDef);

        $instDef = new MyInstruction(Opcodes::DEFINITION);
        $instDef->addProperty(MyInstruction::DEF, $myDef);
        $context->getCurrentMycode()->addCode($instDef);
    }
}
