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

use progpilot\Transformations\Php\Assign;
use progpilot\Objects\MyDefinition;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Expr;

class ArrayFetch
{
    public static function arrayFetch($context, $op)
    {
        if (isset($op)
            && $op instanceof Op\Expr\Array_) {
            if (isset($op->values) && !empty($op->values)) {
                $instVariableFetch = new MyInstruction(Opcodes::ARRAY_EXPR);
                $nbArrayExpr = 0;
                foreach ($op->values as $value) {
                    if (isset($op->keys[$nbArrayExpr])) {
                        $instVariableFetch->addProperty(
                            "key".$nbArrayExpr,
                            $context->getCurrentFunc()->getOpId($op->keys[$nbArrayExpr])
                        );
            
                        Expr::implicitfetch($context, $op->keys[$nbArrayExpr], "");
                    }

                    Expr::implicitfetch($context, $value, "");
                    $instVariableFetch->addProperty(
                        "value".$nbArrayExpr,
                        $context->getCurrentFunc()->getOpId($value)
                    );

                    $nbArrayExpr ++;
                }
            

                $instVariableFetch->addProperty(
                    MyInstruction::RESULTID,
                    $context->getCurrentFunc()->getOpId($op->result)
                );

                $instVariableFetch->addProperty(
                    "nbkeys",
                    $nbArrayExpr
                );

                $context->getCurrentMycode()->addCode($instVariableFetch);
            }
        }
    }
}
