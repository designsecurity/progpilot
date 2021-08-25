<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php\Exprs;

use PHPCfg\Op;
use PHPCfg\Operand;

use progpilot\Objects\MyDefinition;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;

class StaticPropertyFetch
{
    public static function staticPropertyFetch($context, $op)
    {
        if (isset($op)
            && $op instanceof Op\Expr\StaticPropertyFetch) {
            $instDefChained = new MyInstruction(Opcodes::STATIC_PROPERTY_FETCH);
            $instDefChained->addProperty(MyInstruction::PROPERTY_NAME, $op->name->value);

            // static property
            if (isset($op->class->value)) {
                $originalDef = new MyDefinition(
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                    $op->class->value
                );
                $originalDef->addType(MyDefinition::TYPE_STATIC_PROPERTY);
            
                $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
            }

            if (isset($op->var) && $op->var instanceof Operand\BoundVariable) {
                $originalDef = new MyDefinition(
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                    "this"
                );
                $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
            }

            if (isset($op->result)) {
                $instDefChained->addProperty(
                    MyInstruction::RESULTID,
                    $context->getCurrentFunc()->getOpId($op->result)
                );
            }
            if (isset($op->var)) {
                $instDefChained->addProperty(
                    MyInstruction::VARID,
                    $context->getCurrentFunc()->getOpId($op->var)
                );
            }

            $context->getCurrentMycode()->addCode($instDefChained);
        }
    }
}
