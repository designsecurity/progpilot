<?php


/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot;

use PHPCfg\Block;
use PHPCfg\Op;
use PHPCfg\Visitor;
use PHPCfg\Script;
use PHPCfg\Func;

class CallVisitor implements Visitor
{
    private $context;

    public function setContext($context)
    {
        $this->context = $context;
    }

    public function enterScript(Script $script)
    {
    }

    public function leaveScript(Script $script)
    {
    }

    public function leaveFunc(Func $func)
    {
    }

    public function enterFunc(Func $func)
    {
    }

    public function enterBlock(Block $block, Block $prior = null)
    {
    }

    public function skipBlock(Block $block, Block $prior = null)
    {
    }

    public function leaveOp(Op $op, Block $block)
    {
    }

    public function leaveBlock(Block $block, Block $prior = null)
    {
    }

    public function enterOp(Op $op, Block $block)
    {
        if (isset($op->class->value)) {
            if (strpos($op->class->value, "\\") !== false) {
                preg_match('/(.*)\\\(.*)/', $op->class->value, $matches);
                if (isset($matches[1])) {
                    // and $matches[2] is the name of the class
                    $this->context->addCallToNamespace($matches[1]);
                }
            }
        }
    }
}
