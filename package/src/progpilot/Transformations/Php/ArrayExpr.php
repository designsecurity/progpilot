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

            if (isset($op->ops[0]->values))
            {
                $nb_arrayexpr = 0;
                foreach ($op->ops[0]->values as $value)
                {
                    $name = Common::get_name_definition($value);
                    $type = Common::get_type_definition($value);
                    $type_array = Common::get_type_is_array($value);

                    // we create an element for each value of array expr
                    // name_arr = [expr1, expr2] => name_arr[0] = expr1, name_arr[1] = expr2
                    if (isset($op->ops[0]->keys[$nb_arrayexpr]->value))
                    {
                        $index_value = $op->ops[0]->keys[$nb_arrayexpr]->value;
                        $building_arr = array($index_value => $arr);
                    }
                    else
                        $building_arr = array($nb_arrayexpr => $arr);

                    if ($type_array === MyOp::TYPE_ARRAY_EXPR)
                    {
                        $building_arr = ArrayExpr::instruction($value, $context, $building_arr, $def_name, $is_returndef);
                    }
                    else
                    {
                        $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::START_ASSIGN));
                        $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::START_EXPRESSION));

                        $myexpr = new MyExpr($context->get_current_line(), $context->get_current_column());
                        $myexpr->set_assign(true);

                        Expr::instruction($value, $context, $myexpr, null);

                        $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                        $inst_end_expr->add_property(MyInstruction::EXPR, $myexpr);
                        $context->get_current_mycode()->add_code($inst_end_expr);

                        $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::END_ASSIGN));

                        // mydef after expr because expr is executed before (and his id lower than mydef id)
                        $mydef = new MyDefinition($context->get_current_line(), $context->get_current_column(), $def_name);

                        if ($is_returndef)
                            $context->get_current_func()->add_return_def($mydef);

                        $myexpr->set_assign_def($mydef);

                        // we reverse the arr
                        $arrtrans = BuildArrays::build_array_from_arr($building_arr, false);
                        $mydef->add_type(MyDefinition::TYPE_ARRAY);
                        $mydef->set_array_value($arrtrans);

                        $inst_def = new MyInstruction(Opcodes::DEFINITION);
                        $inst_def->add_property(MyInstruction::DEF, $mydef);
                        $context->get_current_mycode()->add_code($inst_def);

                        unset($myexpr);
                        unset($mydef);
                    }

                    $nb_arrayexpr ++;
                }
            }

            return $building_arr;
        }
}

?>
