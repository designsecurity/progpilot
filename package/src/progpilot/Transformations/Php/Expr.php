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
use progpilot\Objects\MyExpr;
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

class Expr
{
    public static function setChars($myExpr, $myTemp, $string, $arrayChars)
    {
        if (is_string($string)) {
            $nbChars = [];
            foreach ($arrayChars as $char) {
                $nbChars[$char] = 0;
            }
            
            for ($i = 0; $i < strlen($string); $i++) {
                foreach ($arrayChars as $char) {
                    if ($string[$i] === $char) {
                        $nbChars[(string) $char] ++;
                    }
                }
            }

            foreach ($arrayChars as $char) {
                $myExpr->setNbChars($char, $myExpr->getNbChars($char) + $nbChars[$char]);
                $myTemp->setIsEmbeddedByChar($char, $myExpr->getNbChars($char));
            }
        }
    }

    public static function setCharsDefsOfMyExpr(
        &$defsOfExpr,
        $myExpr,
        $arrayChars
    ) {
        $nbChars = [];

        foreach ($defsOfExpr as $oneDef) {
            if ($oneDef->getIsEmbeddedByChar("<") >
                        $oneDef->getIsEmbeddedByChar(">")) {
                $oneDef->setIsEmbeddedByChar("<", true);
            } else {
                $oneDef->setIsEmbeddedByChar("<", false);
            }

            if ((($oneDef->getIsEmbeddedByChar("'") % 2) === 1)
                        && $myExpr->getNbChars("'") > $oneDef->getIsEmbeddedByChar("'")) {
                $oneDef->setIsEmbeddedByChar("'", true);
            } else {
                $oneDef->setIsEmbeddedByChar("'", false);
            }
        }
    }

    public static function instructionnew2($context, $op, $expr)
    {/*
        echo "instructionnew2 1\n";
        if (isset($op->var->ops[0]) && $op !== $op->var->ops[0]) {
            echo "instructionnew2 2\n";
            Expr::instructionnew2($context, $op->var->ops[0], $expr);
        }

        if (isset($op->ops[0]) && $op !== $op->ops[0]) {
            echo "instructionnew2 3\n";
            Expr::instructionnew2($context, $op->ops[0], $expr);
        }

        echo "instructionnew2 4\n";
        */
        ConcatFetch::concatFetch($context, $op, $expr);
        DimFetch::dimFetch($context, $op, $expr);
        PropertyFetch::propertyFetch($context, $op);
        StaticPropertyFetch::staticPropertyFetch($context, $op);
        FunccallFetch::funccallFetch($context, $op, $expr);
        VariableFetch::variableFetch($context, $op, $expr);
    }

    public static function instructionnew($context, $op, $expr)
    {
        echo "instructionnew 1\n";
        if (isset($op->ops[0]) && is_null($op->original)) {
            echo "instructionnew 2\n";
            Expr::instructionnew2($context, $op->ops[0], $expr);
        } else {
            echo "instructionnew 3\n";
            VariableFetch::variableFetch($context, $op, $expr);
        }
    }

    public static function instructionassign($context, $op, $expr)
    {
        if (isset($op->ops[0]) && is_null($op->original)) {
            Expr::instructionnew2($context, $op->ops[0], $expr);
        }/*
        else {
            VariableFetch::variableFetch($context, $op, $expr);
        }*/
    }

    public static function instruction($op, $context, $myExpr, $cast = MyDefinition::CAST_NOT_SAFE)
    {
        $defsOfExpr = [];
        $ret = Expr::instructionInternal($defsOfExpr, $op, $context, $myExpr, $cast);
        Expr::setCharsDefsOfMyExpr($defsOfExpr, $myExpr, ["'", "<", ">"]);

        return $ret;
    }

    public static function instructionInternal(
        &$defsOfExpr,
        $op,
        $context,
        $myExpr,
        $cast = MyDefinition::CAST_NOT_SAFE,
        $phi = false
    ) {
        $myTempDef = null;
        $arrFuncCall = false;
        $name = Common::getNameDefinition($op);
        $type = Common::getTypeDefinition($op);
        $typeArray = Common::getTypeIsArray($op);
        
        if (!is_null($type) && $type !== MyOp::TYPE_FUNCCALL_ARRAY) {
            if (is_null($name)) {
                $name = mt_rand();
            }
    
            $arr = BuildArrays::buildArrayFromOps($op, false);

            $column = $context->getCurrentColumn();
            if ($op instanceof Op\Expr\Assign) {
                $column = $op->getAttribute("startFilePos", -1);
            }

            if ($name === "GLOBALS") {
                $context->getCurrentFunc()->setHasGlobalVariables(true);
            }
            
            $myTemp = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentMyFile(),
                $context->getCurrentLine(),
                $column,
                $name
            );

            if ($type === MyOp::TYPE_CONST || $type === MyOp::TYPE_LITERAL) {
                $myTemp->addLastKnownValue($name);
            }
            $myTemp->setCast($cast);

            Expr::setChars($myExpr, $myTemp, $name, ["'", "<", ">"]);
            /*
                        if ($arr != false) {
                            $myTemp->addType(MyDefinition::TYPE_ARRAY);
                            $myTemp->setArrayValue($arr);
                        }
            */
            $myTemp->setExpr($myExpr);
            $defsOfExpr[] = $myTemp;

            if ($type === MyOp::TYPE_CONST) {
                $myTemp->addType(MyDefinition::TYPE_CONSTANTE);
            }
            
            /*
                        if ($type === MyOp::TYPE_PROPERTY) {
                            $propertyName = "";
                            if (isset($op->ops[0])) {
                                $propertyName = Common::getNameProperty($op->ops[0]);
                            }

                            $myTemp->addType(MyDefinition::TYPE_PROPERTY);
                            $myTemp->property->setProperties($propertyName);
                        }

                        if ($type === MyOp::TYPE_STATIC_PROPERTY) {
                            $propertyName = "";
                            if (isset($op->ops[0])) {
                                $propertyName = Common::getNameProperty($op->ops[0]);
                            }

                            $myTemp->addType(MyDefinition::TYPE_STATIC_PROPERTY);
                            $myTemp->property->setProperties($propertyName);
                        }
            */

            //if ($type === MyOp::TYPE_PROPERTY || $arr !== false) {
            echo "expr transformPropertyFetch 1\n";
            //Common::transformPropertyFetch($context, $op->ops[0]);
            Common::transformPropertyFetch($context, $op);
            echo "expr transformPropertyFetch 2\n";
            /*
            }
            else if (!$phi) {
            $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
            $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $myTemp);
            $context->getCurrentMycode()->addCode($instTemporarySimple);
            }*/
            
            return $myTemp;
        } elseif ($type === MyOp::TYPE_FUNCCALL_ARRAY) {
            // func()[0][1]
            $arrFuncCall = BuildArrays::buildArrayFromOps($op, false);
            $startOps = BuildArrays::functionStartOps($op);
            $op = $startOps;
        }

        if (isset($op->ops)) {
            foreach ($op->ops as $ops) {
                if ($ops instanceof Op\Expr\Cast\Int_
                            || $ops instanceof Op\Expr\Cast\Array_
                            || $ops instanceof Op\Expr\Cast\Bool_
                            || $ops instanceof Op\Expr\Cast\Double_
                            || $ops instanceof Op\Expr\Cast\Object_) {
                    $myTempDef = Expr::instructionInternal(
                        $defsOfExpr,
                        $ops->expr,
                        $context,
                        $myExpr,
                        MyDefinition::CAST_SAFE,
                        $phi
                    );
                } elseif ($ops instanceof Op\Expr\Cast\String_) {
                    $myTempDef = Expr::instructionInternal(
                        $defsOfExpr,
                        $ops->expr,
                        $context,
                        $myExpr,
                        MyDefinition::CAST_NOT_SAFE,
                        $phi
                    );
                } elseif ($ops instanceof Op\Expr\BinaryOp\Concat) {
                    $myExpr->setIsConcat(true);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_LEFT));
                    $myTempDef = Expr::instructionInternal($defsOfExpr, $ops->left, $context, $myExpr, $cast, $phi);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_RIGHT));
                    $myTempDef = Expr::instructionInternal($defsOfExpr, $ops->right, $context, $myExpr, $cast, $phi);
                } elseif ($ops instanceof Op\Expr\ConcatList) {
                    $myExpr->setIsConcat(true);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_LIST));

                    foreach ($ops->list as $opsbis) {
                        $myTempDef = Expr::instructionInternal($defsOfExpr, $opsbis, $context, $myExpr, $cast, $phi);
                    }
                } elseif ($ops instanceof Op\Expr\Include_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\Print_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Terminal\Echo_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\Eval_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\Exit_ || $ops instanceof Op\Terminal\Exit_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\FuncCall || $ops instanceof Op\Expr\NsFuncCall) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\MethodCall) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, true, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\StaticCall) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, false, true, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\New_) {
                    // funccall for the constructor
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $myTempDef = FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } else {
                    $myTempDef = Expr::instructionInternal($defsOfExpr, $ops, $context, $myExpr, $cast, $phi);
                }
            }
        }

        return $myTempDef;
    }
}
