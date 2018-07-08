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
    public static function instruction($op, $context, $arr, $def_name, $is_returndef)
    {
        $building_arr = false;

        if (isset($op->ops[0]->values)) {
            $nb_arrayexpr = 0;
            foreach ($op->ops[0]->values as $value) {
                $name = Common::getNameDefinition($value);
                $type = Common::getTypeDefinition($value);
                $type_array = Common::getTypeIsArray($value);

                // we create an element for each value of array expr
                // name_arr = [expr1, expr2] => name_arr[0] = expr1, name_arr[1] = expr2
                if (isset($op->ops[0]->keys[$nb_arrayexpr]->value)) {
                    $index_value = $op->ops[0]->keys[$nb_arrayexpr]->value;
                    $building_arr = array($index_value => $arr);
                } else {
                    $building_arr = array($nb_arrayexpr => $arr);
                }

                if ($type_array === MyOp::TYPE_ARRAY_EXPR) {
                    $building_arr = ArrayExpr::instruction($value, $context, $building_arr, $def_name, $is_returndef);
                } else {
                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));
                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                    $myexpr = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());
                    $myexpr->setAssign(true);

                    Expr::instruction($value, $context, $myexpr, null);

                    $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                    $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                    $context->getCurrentMycode()->addCode($inst_end_expr);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

                    // mydef after expr because expr is executed before (and his id lower than mydef id)
                    $mydef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $def_name);

                    if ($is_returndef) {
                        $context->getCurrentFunc()->addReturnDef($mydef);
                    }

                    $myexpr->setAssignDef($mydef);

                    // we reverse the arr
                    $arrtrans = BuildArrays::buildArrayFromArr($building_arr, false);
                    $mydef->addType(MyDefinition::TYPE_ARRAY);
                    $mydef->setArrayValue($arrtrans);

                    $inst_def = new MyInstruction(Opcodes::DEFINITION);
                    $inst_def->addProperty(MyInstruction::DEF, $mydef);
                    $context->getCurrentMycode()->addCode($inst_def);

                    unset($myexpr);
                    unset($mydef);
                }

                $nb_arrayexpr ++;
            }
        }

        return $building_arr;
    }
}
