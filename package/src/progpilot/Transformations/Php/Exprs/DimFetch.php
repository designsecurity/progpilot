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
    public static function dimFetch($context, $op)
    {
        if (isset($op)
            && $op instanceof Op\Expr\ArrayDimFetch) {
            $instDefChained = new MyInstruction(Opcodes::ARRAYDIM_FETCH);
            if (isset($op->dim->value)) {
                $instDefChained->addProperty(MyInstruction::ARRAY_DIM, $op->dim->value);
            } else {
                // null when for pushing elements $arr[] = $ele;
                $instDefChained->addProperty(MyInstruction::ARRAY_DIM, 0);
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

                if ($originalDef->getName() === "GLOBALS") {
                    $context->getCurrentFunc()->setHasGlobalVariables(true);
                }
            }

            $context->getCurrentMycode()->addCode($instDefChained);
        }
    }
}
