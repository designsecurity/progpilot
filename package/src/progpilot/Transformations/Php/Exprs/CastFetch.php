<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php\Exprs;

use PHPCfg\Op;

use progpilot\Transformations\Php\Expr;
use progpilot\Objects\MyDefinition;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;

class CastFetch
{
    public static function castFetch($context, $op, $expr)
    {
        if (isset($op)) {
            if ($op instanceof Op\Expr\Cast\Int_
                || $op instanceof Op\Expr\Cast\Array_
                || $op instanceof Op\Expr\Cast\Bool_
                || $op instanceof Op\Expr\Cast\Double_
                || $op instanceof Op\Expr\Cast\Object_) {
                Expr::implicitfetch($context, $op->expr, $expr);
                $instDefChained = new MyInstruction(Opcodes::CAST);
                $instDefChained->addProperty("type_cast", MyDefinition::CAST_SAFE);
                $instDefChained->addProperty(MyInstruction::EXPRID, $context->getCurrentFunc()->getOpId($op->expr));
                $instDefChained->addProperty(MyInstruction::RESULTID, $context->getCurrentFunc()->getOpId($op->result));
                $context->getCurrentMycode()->addCode($instDefChained);
            } elseif ($op instanceof Op\Expr\Cast\String_) {
                Expr::implicitfetch($context, $op->expr, $expr);
                $instDefChained = new MyInstruction(Opcodes::CAST);
                $instDefChained->addProperty("type_cast", MyDefinition::CAST_NOT_SAFE);
                $instDefChained->addProperty(MyInstruction::EXPRID, $context->getCurrentFunc()->getOpId($op->expr));
                $instDefChained->addProperty(MyInstruction::RESULTID, $context->getCurrentFunc()->getOpId($op->result));
                $context->getCurrentMycode()->addCode($instDefChained);
            }
        }
    }
}
