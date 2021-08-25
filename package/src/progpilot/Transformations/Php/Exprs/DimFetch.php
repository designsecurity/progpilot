<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php\Exprs;

use PHPCfg\Op;

use progpilot\Objects\MyDefinition;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;

class DimFetch
{
    public static function dimFetch($context, $op, $expr)
    {
        if (isset($op)
            && $op instanceof Op\Expr\ArrayDimFetch) {
                echo "ArrayDimFetch 2\n";
            $instDefChained = new MyInstruction(Opcodes::ARRAYDIM_FETCH);
            if (isset($op->dim->value)) {
                $instDefChained->addProperty(MyInstruction::ARRAY_DIM, $op->dim->value);
            } else {
                // null when for pushing elements $arr[] = $ele;
                $instDefChained->addProperty(MyInstruction::ARRAY_DIM, 0);
            }
            $instDefChained->addProperty(MyInstruction::EXPR, $expr);

            if (isset($op->result)) {
                echo "ArrayDimFetch 3\n";
                $instDefChained->addProperty(
                    MyInstruction::RESULTID,
                    $context->getCurrentFunc()->getOpId($op->result)
                );
            }

            if (isset($op->var)) {
                echo "ArrayDimFetch 4\n";
                $instDefChained->addProperty(
                    MyInstruction::VARID,
                    $context->getCurrentFunc()->getOpId($op->var)
                );
            }

            // beginning of the chain
            if (isset($op->var->original)) {
                $originalDef = new MyDefinition(
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                    $op->var->original->name->value
                );

                $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
            }

            $context->getCurrentMycode()->addCode($instDefChained);
        }
    }
}
