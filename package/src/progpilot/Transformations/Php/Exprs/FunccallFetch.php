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
use progpilot\Transformations\Php\FuncCall;

class FunccallFetch
{
    public static function funccallFetch($context, $op)
    {
        if (isset($op)
            && ($op instanceof Op\Expr\Include_
                || $op instanceof Op\Expr\Print_
                || $op instanceof Op\Terminal\Echo_
                || $op instanceof Op\Expr\Eval_
                || $op instanceof Op\Expr\Exit_
                || $op instanceof Op\Terminal\Exit_
                || $op instanceof Op\Expr\FuncCall
                || $op instanceof Op\Expr\NsFuncCall
                || $op instanceof Op\Expr\MethodCall
                || $op instanceof Op\Expr\StaticCall
                || $op instanceof Op\Expr\New_)) {
            $oldOp = $context->getCurrentOp();
            $context->setCurrentOp($op);
            FuncCall::instruction($context);
            $context->setCurrentOp($oldOp);
        }
    }
}
