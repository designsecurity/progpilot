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

class ConcatFetch
{
    public static function concatFetch($context, $op, $expr)
    {
        if (isset($op)) {
            if ($op instanceof Op\Expr\BinaryOp\Concat) {
                $instDefChained = new MyInstruction(Opcodes::CONCAT_LEFT);
                Expr::implicitfetch($context, $op->left, $expr);
                $instDefChained->addProperty(MyInstruction::LEFTID, $context->getCurrentFunc()->getOpId($op->left));
                Expr::implicitfetch($context, $op->right, $expr);
                $opIds = [];
                $opIds[] = $context->getCurrentFunc()->getOpId($op->right);
                $instDefChained->addProperty(MyInstruction::RIGHTID, $opIds);
                $instDefChained->addProperty(MyInstruction::RESULTID, $context->getCurrentFunc()->getOpId($op->result));

                $context->getCurrentMycode()->addCode($instDefChained);
            } elseif ($op instanceof Op\Expr\ConcatList) {
                $instDefChained = new MyInstruction(Opcodes::CONCAT_LEFT);

                $opIds = [];
                foreach ($op->list as $opsbis) {
                    $opIds[] = $context->getCurrentFunc()->getOpId($opsbis);
                    Expr::implicitfetch($context, $opsbis, $expr);
                }
                $instDefChained->addProperty(MyInstruction::RIGHTID, $opIds);
                $instDefChained->addProperty(MyInstruction::RESULTID, $context->getCurrentFunc()->getOpId($op->result));
                $context->getCurrentMycode()->addCode($instDefChained);
            }
        }
    }
}
