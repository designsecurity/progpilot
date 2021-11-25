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

class LiteralFetch
{
    public static function literalFetch($context, $op)
    {
        if (isset($op)
            && $op instanceof Operand\Literal) {
            $myTemp = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentMyFile(),
                $context->getCurrentLine(),
                $context->getCurrentColumn(),
                "literal"
            );
            
            $myTemp->getCurrentState()->addType(MyDefinition::TYPE_LITERAL);
            $myTemp->getCurrentState()->addLastKnownValue($op->value);

            $instDefChained = new MyInstruction(Opcodes::LITERAL_FETCH);
            $instDefChained->addProperty(MyInstruction::DEF, $myTemp);
            $instDefChained->addProperty(MyInstruction::RESULTID, $context->getCurrentFunc()->getOpId($op));
            $context->getCurrentMycode()->addCode($instDefChained);
        }
    }
}
