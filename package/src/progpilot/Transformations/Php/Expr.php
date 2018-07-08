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
    public static function setChars($myexpr, $mytemp, $string, $array_chars)
    {
        $nb_chars = [];
        foreach ($array_chars as $char) {
            $nb_chars[$char] = 0;
        }

        for ($i = 0; $i < strlen($string); $i++) {
            foreach ($array_chars as $char) {
                if ($string[$i] === $char) {
                    $nb_chars[$char] ++;
                }
            }
        }

        foreach ($array_chars as $char) {
            $myexpr->setNbChars($char, $myexpr->getNbChars($char) + $nb_chars[$char]);
            $mytemp->setIsEmbeddedByChar($char, $myexpr->getNbChars($char));
        }
    }

    public static function setCharsDefsOfMyExpr(
        &$defs_ofexpr,
        $myexpr,
        $array_chars
    ) {
        $nb_chars = [];

        foreach ($defs_ofexpr as $one_def) {
            if ($one_def->getIsEmbeddedByChar("<") >
                        $one_def->getIsEmbeddedByChar(">")) {
                $one_def->setIsEmbeddedByChar("<", true);
            } else {
                $one_def->setIsEmbeddedByChar("<", false);
            }

            if ((($one_def->getIsEmbeddedByChar("'") % 2) === 1)
                        && $myexpr->getNbChars("'") > $one_def->getIsEmbeddedByChar("'")) {
                $one_def->setIsEmbeddedByChar("'", true);
            } else {
                $one_def->setIsEmbeddedByChar("'", false);
            }
        }
    }

    public static function instruction($op, $context, $myexpr, $cast = MyDefinition::CAST_NOT_SAFE)
    {
        $defs_ofexpr = [];
        $ret = Expr::instructionInternal($defs_ofexpr, $op, $context, $myexpr, $cast);
        Expr::setCharsDefsOfMyExpr($defs_ofexpr, $myexpr, ["'", "<", ">"]);

        return $ret;
    }

    public static function instructionInternal(
        &$defs_ofexpr,
        $op,
        $context,
        $myexpr,
        $cast = MyDefinition::CAST_NOT_SAFE
    ) {
        $mytemp_def = null;
        $arr_funccall = false;
        $name = Common::getNameDefinition($op);
        $type = Common::getTypeDefinition($op);
        $type_array = Common::getTypeIsArray($op);

        // end of expression
        if (!is_null($type) && $type !== MyOp::TYPE_FUNCCALL_ARRAY) {
            if (is_null($name)) {
                $name = mt_rand();
            }

            $arr = BuildArrays::buildArrayFromOps($op, false);

            $column = $context->getCurrentColumn();
            if ($op instanceof Op\Expr\Assign) {
                $column = $op->getAttribute("startFilePos", -1);
            }

            $mytemp = new MyDefinition($context->getCurrentLine(), $column, $name);
            if ($type === MyOp::TYPE_CONST || $type === MyOp::TYPE_LITERAL) {
                $mytemp->addLastKnownValue($name);
            }
            $mytemp->setCast($cast);

            Expr::setChars($myexpr, $mytemp, $name, ["'", "<", ">"]);

            if ($arr != false) {
                $mytemp->addType(MyDefinition::TYPE_ARRAY);
                $mytemp->setArrayValue($arr);
            }

            $mytemp->setExpr($myexpr);
            $defs_ofexpr[] = $mytemp;

            if ($type === MyOp::TYPE_CONST) {
                $mytemp->addType(MyDefinition::TYPE_CONSTANTE);
            }

            if ($type === MyOp::TYPE_PROPERTY) {
                $property_name = "";
                if (isset($op->ops[0])) {
                    $property_name = Common::getNameProperty($op->ops[0]);
                }

                $mytemp->addType(MyDefinition::TYPE_PROPERTY);
                $mytemp->property->setProperties($property_name);
            }

            $inst_temporarySimple = new MyInstruction(Opcodes::TEMPORARY);
            $inst_temporarySimple->addProperty(MyInstruction::TEMPORARY, $mytemp);
            $context->getCurrentMycode()->addCode($inst_temporarySimple);

            return $mytemp;
        } // func()[0][1]
        elseif ($type === MyOp::TYPE_FUNCCALL_ARRAY) {
            $arr_funccall = BuildArrays::buildArrayFromOps($op, false);
            $start_ops = BuildArrays::functionStartOps($op);
            $op = $start_ops;
        }

        if (isset($op->ops)) {
            foreach ($op->ops as $ops) {
                if ($ops instanceof Op\Expr\Cast\Int_
                            || $ops instanceof Op\Expr\Cast\Array_
                            || $ops instanceof Op\Expr\Cast\Bool_
                            || $ops instanceof Op\Expr\Cast\Double_
                            || $ops instanceof Op\Expr\Cast\Object_
                            || $ops instanceof Op\Expr\Cast\Array_) {
                    Expr::instructionInternal($defs_ofexpr, $ops->expr, $context, $myexpr, MyDefinition::CAST_SAFE);
                } elseif ($ops instanceof Op\Expr\Cast\String_) {
                    Expr::instructionInternal($defs_ofexpr, $ops->expr, $context, $myexpr, MyDefinition::CAST_NOT_SAFE);
                } elseif ($ops instanceof Op\Expr\BinaryOp\Concat) {
                    $myexpr->setIsConcat(true);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_LEFT));
                    Expr::instructionInternal($defs_ofexpr, $ops->left, $context, $myexpr);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_RIGHT));
                    Expr::instructionInternal($defs_ofexpr, $ops->right, $context, $myexpr);
                } elseif ($ops instanceof Op\Expr\ConcatList) {
                    $myexpr->setIsConcat(true);

                    $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::CONCAT_LIST));

                    foreach ($ops->list as $opsbis) {
                        Expr::instructionInternal($defs_ofexpr, $opsbis, $context, $myexpr);
                    }
                } elseif ($ops instanceof Op\Expr\Include_) {
                    $old_op = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                    $context->setCurrentOp($old_op);
                } elseif ($ops instanceof Op\Expr\Print_) {
                    $old_op = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                    $context->setCurrentOp($old_op);
                } elseif ($ops instanceof Op\Terminal\Echo_) {
                    $old_op = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                    $context->setCurrentOp($old_op);
                } elseif ($ops instanceof Op\Expr\Eval_) {
                    $old_op = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                    $context->setCurrentOp($old_op);
                } elseif ($ops instanceof Op\Expr\FuncCall || $ops instanceof Op\Expr\NsFuncCall) {
                    $old_op = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $mytemp_def = FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                    $context->setCurrentOp($old_op);
                } elseif ($ops instanceof Op\Expr\MethodCall) {
                    $old_op = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $mytemp_def = FuncCall::instruction($context, $myexpr, $arr_funccall, true);
                    $context->setCurrentOp($old_op);
                } elseif ($ops instanceof Op\Expr\StaticCall) {
                    $old_op = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $mytemp_def = FuncCall::instruction($context, $myexpr, $arr_funccall, false, true);
                    $context->setCurrentOp($old_op);
                } elseif ($ops instanceof Op\Expr\New_) {
                    // funccall for the constructor
                    $old_op = $context->getCurrentOp();
                    $context->setCurrentOp($ops);
                    $mytemp_def = FuncCall::instruction($context, $myexpr, $arr_funccall);
                    $context->setCurrentOp($old_op);
                } else {
                    $mytemp_def = Expr::instructionInternal($defs_ofexpr, $ops, $context, $myexpr);
                }
            }
        }

        return $mytemp_def;
    }
}
