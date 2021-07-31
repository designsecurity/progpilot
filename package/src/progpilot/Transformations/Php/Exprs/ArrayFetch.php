<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php\Exprs;

use PHPCfg\Op;

use progpilot\Transformations\Php\Assign;
use progpilot\Objects\MyDefinition;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;

class ArrayFetch
{
    public static function arrayFetch($context, $op, $opvar, $opexpr, $expr)
    {
        if (isset($op)
            && $op instanceof Op\Expr\Array_) {

            var_dump($op);
            var_dump($opexpr);
            var_dump($opvar);
            if (isset($op->values)) {
                $nbArrayExpr = 0;
                foreach ($op->values as $value) {
                    echo "arrayFetch 0\n";

                }
            }

/*
            $instDefChained = new MyInstruction(Opcodes::ARRAYDIM_FETCH);
            $instDefChained->addProperty(MyInstruction::ARRAY_DIM, $op->dim->value);
            $instDefChained->addProperty(MyInstruction::EXPR, $expr);

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
                    $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                    $op->var->original->name->value
                );

                $originalDef->setExpr($expr);
                $originalDef->setSourceMyfile($context->getCurrentMyfile());
                $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
            }

            $context->getCurrentMycode()->addCode($instDefChained);
            */
        }
    }
}
