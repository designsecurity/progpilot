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

class Expr
{
    public static function setChars($myExpr, $myTemp, $string, $arrayChars)
    {
        $nbChars = [];
        foreach ($arrayChars as $char) {
            $nbChars[$char] = 0;
        }

        for ($i = 0; $i < strlen($string); $i++) {
            foreach ($arrayChars as $char) {
                if ($string[$i] === $char) {
                    $nbChars[$char] ++;
                }
            }
        }

        foreach ($arrayChars as $char) {
            $myExpr->setNbChars($char, $myExpr->getNbChars($char) + $nbChars[$char]);
            $myTemp->setIsEmbeddedByChar($char, $myExpr->getNbChars($char));
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
        
        if ($op instanceof Op\Phi) {
            $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
            $instTemporarySimple->addProperty(MyInstruction::PHI, count($op->vars));
            
            $nbvars = 0;
            foreach ($op->vars as $var) {
                $myTemp = Expr::instructionInternal($defsOfExpr, $var, $context, $myExpr, $cast, true);
                
                if (!is_null($myTemp)) {
                    $instTemporarySimple->addProperty("temp_".$nbvars, $myTemp);
                    $nbvars ++;
                }
            }
            
            $instTemporarySimple->addProperty(MyInstruction::PHI, $nbvars);
            $context->getCurrentMycode()->addCode($instTemporarySimple);
            // end of expression
        } elseif (!is_null($type) && $type !== MyOp::TYPE_FUNCCALL_ARRAY) {
            if (is_null($name)) {
                $name = mt_rand();
            }
    
            $arr = BuildArrays::buildArrayFromOps($op, false);

            $column = $context->getCurrentColumn();
            if ($op instanceof Op\Expr\Assign) {
                $column = $op->getAttribute("startFilePos", -1);
            }

            $myTemp = new MyDefinition($context->getCurrentLine(), $column, $name);
            if ($type === MyOp::TYPE_CONST || $type === MyOp::TYPE_LITERAL) {
                $myTemp->addLastKnownValue($name);
            }
            $myTemp->setCast($cast);

            Expr::setChars($myExpr, $myTemp, $name, ["'", "<", ">"]);

            if ($arr != false) {
                $myTemp->addType(MyDefinition::TYPE_ARRAY);
                $myTemp->setArrayValue($arr);
            }

            $myTemp->setExpr($myExpr);
            $defsOfExpr[] = $myTemp;

            if ($type === MyOp::TYPE_CONST) {
                $myTemp->addType(MyDefinition::TYPE_CONSTANTE);
            }

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

            if (!$phi) {
                $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
                $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $myTemp);
                $context->getCurrentMycode()->addCode($instTemporarySimple);
            }
            
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
                    Expr::instructionInternal(
                        $defsOfExpr,
                        $ops->expr,
                        $context,
                        $myExpr,
                        MyDefinition::CAST_SAFE,
                        $phi
                    );
                } elseif ($ops instanceof Op\Expr\Cast\String_) {
                    Expr::instructionInternal(
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
                    Expr::instructionInternal($defsOfExpr, $ops->left, $context, $myExpr, $cast, $phi);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_RIGHT));
                    Expr::instructionInternal($defsOfExpr, $ops->right, $context, $myExpr, $cast, $phi);
                } elseif ($ops instanceof Op\Expr\ConcatList) {
                    $myExpr->setIsConcat(true);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_LIST));

                    foreach ($ops->list as $opsbis) {
                        Expr::instructionInternal($defsOfExpr, $opsbis, $context, $myExpr, $cast, $phi);
                    }
                } elseif ($ops instanceof Op\Expr\Include_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\Print_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Terminal\Echo_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\Eval_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
                    $context->setCurrentOp($oldOp);
                } elseif ($ops instanceof Op\Expr\Exit_) {
                    $oldOp = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myExpr, $arrFuncCall, false, false, $cast);
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
