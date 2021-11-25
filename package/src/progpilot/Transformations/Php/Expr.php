<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php;

use PHPCfg\Block;
use PHPCfg\Op;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyOp;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;
use progpilot\Transformations\Php\Exprs\PropertyFetch;
use progpilot\Transformations\Php\Exprs\StaticPropertyFetch;
use progpilot\Transformations\Php\Exprs\DimFetch;
use progpilot\Transformations\Php\Exprs\VariableFetch;
use progpilot\Transformations\Php\Exprs\FunccallFetch;
use progpilot\Transformations\Php\Exprs\ConcatFetch;
use progpilot\Transformations\Php\Exprs\ArrayFetch;
use progpilot\Transformations\Php\Exprs\CastFetch;
use progpilot\Transformations\Php\Exprs\ConstFetch;
use progpilot\Transformations\Php\Exprs\LiteralFetch;

class Expr
{
    public static function explicitfetch($context, $op, $expr)
    {
        CastFetch::castFetch($context, $op, $expr);
        ConcatFetch::concatFetch($context, $op, $expr);
        DimFetch::dimFetch($context, $op);
        PropertyFetch::propertyFetch($context, $op);
        StaticPropertyFetch::staticPropertyFetch($context, $op);
        FunccallFetch::funccallFetch($context, $op);
        VariableFetch::variableFetch($context, $op, $expr);
        ArrayFetch::arrayFetch($context, $op);
        ConstFetch::constFetch($context, $op);
    }

    public static function implicitfetch($context, $op, $expr)
    {
        VariableFetch::variableFetch($context, $op, $expr);
        LiteralFetch::literalFetch($context, $op);
    }
}
