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

class VariableFetch
{
    public static function variableFetch($context, $op, $expr)
    {
        if (isset($op->original) && $op->original instanceof Operand\Variable
            && isset($op->original->name) && $op->original->name instanceof Operand\Literal) {
            $myTemp = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentMyFile(),
                $context->getCurrentLine(),
                $context->getCurrentColumn(),
                $op->original->name->value
            );

            $instVariableFetch = new MyInstruction(Opcodes::VARIABLE_FETCH);

            $property = is_null($expr) ? MyInstruction::VARID : MyInstruction::EXPRID;

            $instVariableFetch->addProperty(
                $property,
                $context->getCurrentFunc()->getOpId($op)
            );
            
            $instVariableFetch->addProperty(MyInstruction::DEF, $myTemp);
            $context->getCurrentMycode()->addCode($instVariableFetch);
        }
    }
}
