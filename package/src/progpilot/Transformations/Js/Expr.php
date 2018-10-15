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

    public static function Assignment($op, $context, $myExpr)
    {
        $typeright = Common::getTypeDefinition($op->right);
        $nameright = Common::getNameDefinition($op->right);
    
        $myright = new MyDefinition($op->right->loc->start->line, $op->right->loc->start->column, $nameright);
        $myright->setExpr($myExpr);
            
        if($typeright === "MemberExpression") {
        
            $propertyName = Common::getNameProperty($op->right);
            $myright->addType(MyDefinition::TYPE_PROPERTY);
            $myright->property->setProperties($propertyName);
        }
        
        //if($typeright === "Identifier") {
            $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
            $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $myright);
            $context->getCurrentMycode()->addCode($instTemporarySimple);
        //}
            
        $typeleft = Common::getTypeDefinition($op->left);
        $nameleft = Common::getNameDefinition($op->left);
        
        $myleft = new MyDefinition($op->left->loc->start->line, $op->left->loc->start->column, $nameleft);
        $myleft->setExpr($myExpr);

        return $myleft;
    }
}
