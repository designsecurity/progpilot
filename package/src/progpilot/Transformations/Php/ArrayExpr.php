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

class ArrayExpr
{
    public static function instruction($op, $context, $arr, $defName, $isReturnDef)
    {
        $buildingArr = false;

        if (isset($op->ops[0]->values)) {
            $nbArrayExpr = 0;
            foreach ($op->ops[0]->values as $value) {
                $name = Common::getNameDefinition($value);
                $type = Common::getTypeDefinition($value);
                $typeArray = Common::getTypeIsArray($value);

                // we create an element for each value of array expr
                // name_arr = [expr1, expr2] => name_arr[0] = expr1, name_arr[1] = expr2
                if (isset($op->ops[0]->keys[$nbArrayExpr]->value)) {
                    $indexValue = $op->ops[0]->keys[$nbArrayExpr]->value;
                    $buildingArr = array($indexValue => $arr);
                } elseif (isset($op->ops[0]->keys[$nbArrayExpr]->ops[0]->name->value)) {
                    // const arr(CONST => "value")
                    $indexValue = $op->ops[0]->keys[$nbArrayExpr]->ops[0]->name->value;
                    $buildingArr = array($indexValue => $arr);
                } else {
                    $buildingArr = array($nbArrayExpr => $arr);
                }

                if ($typeArray === MyOp::TYPE_ARRAY_EXPR) {
                    $buildingArr = ArrayExpr::instruction($value, $context, $buildingArr, $defName, $isReturnDef);
                } else {
                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));
                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                    $myExpr = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());
                    $myExpr->setAssign(true);

                    Expr::instruction($value, $context, $myExpr, null);

                    $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                    $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                    $context->getCurrentMycode()->addCode($instEndExpr);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

                    // mydef after expr because expr is executed before (and his id lower than mydef id)
                    $myDef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $defName);

                    if ($isReturnDef) {
                        $context->getCurrentFunc()->addReturnDef($myDef);
                    }

                    $myExpr->setAssignDef($myDef);

                    // we reverse the arr
                    $arrtrans = BuildArrays::buildArrayFromArr($buildingArr, false);
                    
                    $myDef->addType(MyDefinition::TYPE_ARRAY);
                    $myDef->setArrayValue($arrtrans);

                    $instDef = new MyInstruction(Opcodes::DEFINITION);
                    $instDef->addProperty(MyInstruction::DEF, $myDef);
                    $context->getCurrentMycode()->addCode($instDef);

                    unset($myExpr);
                    unset($myDef);
                }

                $nbArrayExpr ++;
            }
        }

        return $buildingArr;
    }
}
