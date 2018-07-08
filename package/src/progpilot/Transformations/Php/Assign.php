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
        if ($is_define) {
            $name = "const_".rand();
            if (isset($context->getCurrentOp()->args[0]->value)) {
                $name = $context->getCurrentOp()->args[0]->value;
            }

            $type = MyOp::TYPE_CONST;
            $type_array = null;
            $type_instance = null;

            $expr_op = $context->getCurrentOp();
            if (isset($context->getCurrentOp()->args[1])) {
                $expr_op = $context->getCurrentOp()->args[1];
            }
        } else {
            $name = Common::getNameDefinition($context->getCurrentOp());
            $type = Common::getTypeDefinition($context->getCurrentOp());
            $type_array = Common::getTypeIsArray($context->getCurrentOp());
            $type_instance = Common::getTypeIsInstance($context->getCurrentOp());

            $expr_op = $context->getCurrentOp()->expr;
        }

        // name of function return
        if ($is_returndef) {
            $name = $context->getCurrentFunc()->getName()."_return";
        }

        // $array = [expr, expr, expr]
        if ($type_array === MyOp::TYPE_ARRAY_EXPR) {
            $arr = false;
            if (isset($context->getCurrentOp()->var)) {
                $arr = BuildArrays::buildArrayFromOps($context->getCurrentOp()->var, false);
            }

            ArrayExpr::instruction($context->getCurrentOp()->expr, $context, $arr, $name, $is_returndef);
        } else {
            $isref = false;
            if ($context->getCurrentOp() instanceof Op\Expr\AssignRef) {
                $isref = true;
            }

            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));

            // it's an expression which will define a definition
            $myexpr = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());
            $myexpr->setAssign(true);

            if (isset($context->getCurrentOp()->expr->ops[0])
                        && $context->getCurrentOp()->expr->ops[0] instanceof Op\Iterator\Value) {
                $myexpr->setAssignIterator(true);
            }

            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

            $backdef = Expr::instruction($expr_op, $context, $myexpr);

            $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
            $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
            $context->getCurrentMycode()->addCode($inst_end_expr);

            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

            $mydef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $name);

            if ($isref) {
                $mydef->addType(MyDefinition::TYPE_REFERENCE);
            }

            if ($type === MyOp::TYPE_CONST) {
                $mydef->addType(MyDefinition::TYPE_CONSTANTE);
            }

            if ($is_returndef) {
                $context->getCurrentFunc()->addReturnDef($mydef);
            }

            $myexpr->setAssignDef($mydef);

            $inst_def = new MyInstruction(Opcodes::DEFINITION);
            $inst_def->addProperty(MyInstruction::DEF, $mydef);
            $context->getCurrentMycode()->addCode($inst_def);

            // $array[09][098] = expr;
            if ($type_array === MyOp::TYPE_ARRAY) {
                $arr = BuildArrays::buildArrayFromOps($context->getCurrentOp()->var, false);
                $mydef->addType(MyDefinition::TYPE_ARRAY);
                $mydef->setArrayValue($arr);
            }

            // a variable, property
            if ($type === MyOp::TYPE_PROPERTY) {
                $property_name = Common::getNameDefinition($context->getCurrentOp(), true);
                $mydef->addType(MyDefinition::TYPE_PROPERTY);
                $mydef->property->addProperty($property_name);

                $property_name = Common::getNameProperty($context->getCurrentOp()->var->ops[0]);
                $mydef->property->setProperties($property_name);
            }

            // an object (created by new)
            if ($type_instance === MyOp::TYPE_INSTANCE) {
                // it's the class name not instance name
                if (isset($context->getCurrentOp()->expr->ops[0]->class->value)) {
                    $name_class = $context->getCurrentOp()->expr->ops[0]->class->value;
                    $mydef->addType(MyDefinition::TYPE_INSTANCE);
                    $mydef->setClassName($name_class);

                    // ou bien créer backdef ici
                    if (!is_null($backdef)) {
                        $backdef->setId($mydef->getId() + 1);
                    }
                }
            }

            if ($isref) {
                $ref_name = Common::getNameDefinition($context->getCurrentOp()->expr);
                $ref_type = Common::getTypeDefinition($context->getCurrentOp()->expr);
                $ref_type_array = Common::getTypeIsArray($context->getCurrentOp()->expr);
                $mydef->setRefName($ref_name);

                if ($ref_type_array === MyOp::TYPE_ARRAY) {
                    $arr = BuildArrays::buildArrayFromOps($context->getCurrentOp()->expr, false);
                    $mydef->addType(MyDefinition::TYPE_ARRAY_REFERENCE);
                    $mydef->setRefArrValue($arr);
                }
            }
        }
    }
}
