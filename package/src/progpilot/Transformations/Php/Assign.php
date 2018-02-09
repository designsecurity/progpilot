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
use progpilot\Transformations\Php\OpTr;

class Assign
{

        public static function instruction($context, $is_returndef = false, $is_define = false)
        {
            if ($is_define)
            {
                $name = "const_".rand();
                if (isset($context->get_current_op()->args[0]->value))
                    $name = $context->get_current_op()->args[0]->value;

                $type = MyOp::TYPE_CONST;
                $type_array = null;
                $type_instance = null;

                $expr_op = $context->get_current_op();
                if (isset($context->get_current_op()->args[1]))
                    $expr_op = $context->get_current_op()->args[1];
            }
            else
            {
                $name = Common::get_name_definition($context->get_current_op());
                $type = Common::get_type_definition($context->get_current_op());
                $type_array = Common::get_type_is_array($context->get_current_op());
                $type_instance = Common::get_type_is_instance($context->get_current_op());

                $expr_op = $context->get_current_op()->expr;
            }

            // name of function return
            if ($is_returndef)
                $name = $context->get_current_func()->get_name()."_return";

            // $array = [expr, expr, expr]
            if ($type_array == MyOp::TYPE_ARRAY_EXPR)
            {
                $arr = false;
                if (isset($context->get_current_op()->var))
                    $arr = BuildArrays::build_array_from_ops($context->get_current_op()->var, false);

                ArrayExpr::instruction($context->get_current_op()->expr, $context, $arr, $name, $is_returndef);
            }
            else
            {
                $isref = false;
                if ($context->get_current_op() instanceof Op\Expr\AssignRef)
                    $isref = true;

                $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::START_ASSIGN));

                // it's an expression which will define a definition
                $myexpr = new MyExpr($context->get_current_line(), $context->get_current_column());
                $myexpr->set_assign(true);

                if (isset($context->get_current_op()->expr->ops[0])
                        && $context->get_current_op()->expr->ops[0] instanceof Op\Iterator\Value)
                    $myexpr->set_assign_iterator(true);

                $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::START_EXPRESSION));

                $backdef = Expr::instruction($expr_op, $context, $myexpr);

                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->add_property(MyInstruction::EXPR, $myexpr);
                $context->get_current_mycode()->add_code($inst_end_expr);

                $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::END_ASSIGN));

                $mydef = new MyDefinition($context->get_current_line(), $context->get_current_column(), $name);

                if ($isref)
                    $mydef->add_type(MyDefinition::TYPE_REFERENCE);

                if ($type == MyOp::TYPE_CONST)
                    $mydef->add_type(MyDefinition::TYPE_CONSTANTE);

                if ($is_returndef)
                    $context->get_current_func()->add_return_def($mydef);

                $myexpr->set_assign_def($mydef);

                $inst_def = new MyInstruction(Opcodes::DEFINITION);
                $inst_def->add_property(MyInstruction::DEF, $mydef);
                $context->get_current_mycode()->add_code($inst_def);

                // $array[09][098] = expr;
                if ($type_array == MyOp::TYPE_ARRAY)
                {
                    $arr = BuildArrays::build_array_from_ops($context->get_current_op()->var, false);
                    $mydef->add_type(MyDefinition::TYPE_ARRAY);
                    $mydef->set_array_value($arr);
                }

                // a variable, property
                if ($type == MyOp::TYPE_PROPERTY)
                {
                    $property_name = Common::get_name_definition($context->get_current_op(), true);
                    $mydef->add_type(MyDefinition::TYPE_PROPERTY);
                    $mydef->property->add_property($property_name);

                    $property_name = Common::get_name_property($context->get_current_op()->var->ops[0]);
                    $mydef->property->set_properties($property_name);
                }

                // an object (created by new)
                if ($type_instance == MyOp::TYPE_INSTANCE)
                {
                    // it's the class name not instance name
                    if (isset($context->get_current_op()->expr->ops[0]->class->value))
                    {
                        $name_class = $context->get_current_op()->expr->ops[0]->class->value;
                        $mydef->add_type(MyDefinition::TYPE_INSTANCE);
                        $mydef->set_class_name($name_class);

                        // ou bien créer backdef ici
                        if (!is_null($backdef))
                            $backdef->set_id($mydef->get_id() + 1);
                    }
                }

                if ($isref)
                {
                    $ref_name = Common::get_name_definition($context->get_current_op()->expr);
                    $ref_type = Common::get_type_definition($context->get_current_op()->expr);
                    $ref_type_array = Common::get_type_is_array($context->get_current_op()->expr);
                    $mydef->set_ref_name($ref_name);

                    if ($ref_type_array == MyOp::TYPE_ARRAY)
                    {
                        $arr = BuildArrays::build_array_from_ops($context->get_current_op()->expr, false);
                        $mydef->add_type(MyDefinition::TYPE_ARRAY_REFERENCE);
                        $mydef->set_ref_arr_value($arr);
                    }
                }

            }
        }
}

?>
