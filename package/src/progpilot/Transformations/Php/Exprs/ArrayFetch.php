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
    public static function arrayFetch($context, $op, $expr, $name)
    {
        if (isset($op)
            && $op instanceof Op\Expr\Array_) {
            $instVariableFetch = new MyInstruction(Opcodes::ARRAY_EXPR);

            if (isset($op->values) && !empty($op->values)) {
                $nbArrayExpr = 0;
                $tempArrayName = "tmp_array_".rand();

                foreach ($op->values as $value) {
                    if (isset($op->keys[$nbArrayExpr])) {
                        $instVariableFetch->addProperty(
                            "key".$nbArrayExpr,
                            $context->getCurrentFunc()->getOpId($op->keys[$nbArrayExpr])
                        );
            
                        Expr::instructionnew($context, $op->keys[$nbArrayExpr], "");
                    }

                    Expr::instructionnew($context, $value, "");
                    $instVariableFetch->addProperty(
                        "value".$nbArrayExpr,
                        $context->getCurrentFunc()->getOpId($value)
                    );

                    /*
                    if (isset($op->keys[$nbArrayExpr])
                        && $op->keys[$nbArrayExpr] instanceof Operand\Literal) {
                        $key = $op->keys[$nbArrayExpr]->value;
                    } elseif (isset($op->keys[$nbArrayExpr]->ops[0])
                        && $op->keys[$nbArrayExpr]->ops[0] instanceof Op\Expr\ConstFetch
                            && isset($op->keys[$nbArrayExpr]->ops[0]->name)
                             && $op->keys[$nbArrayExpr]->ops[0]->name instanceof Operand\Literal) {
                        $key = $op->keys[$nbArrayExpr]->ops[0]->name->value;
                    } else {
                        $key = $nbArrayExpr;
                    }
                    */
                    /*
                                        // element / value part
                                        if (isset($value->ops[0])
                                            && $value->ops[0] instanceof Op\Expr\Array_) {
                                            echo "arrayFetch rec '$key' '$tempArrayName'\n";
                                            ArrayFetch::arrayFetch($context, $value->ops[0], $value->ops[0], $name."_rec");
                                            $newvalue = $value->ops[0];
                                        } else {
                                            echo "arrayFetch Expr '$key' '$tempArrayName'\n";
                                            if (isset($value->original)) {
                                                echo "HERE11\n";
                                                Expr::instructionnew($context, $value, "right");
                                            }
                                            $newvalue = $value;
                                            if (isset($value->result)) {
                                                $newvalue = $value->result;
                                            }
                                        }

                                        echo "arrayFetch 0 '$key' '$tempArrayName'\n";
                                        $instAssign = new MyInstruction(Opcodes::END_ASSIGN);

                                        // simulation of the left part
                                        $instDefChained = new MyInstruction(Opcodes::ARRAYDIM_FETCH);
                                        $instDefChained->addProperty(MyInstruction::ARRAY_DIM, $key);
                                        /*
                                        /* the result of the array_dim fetch tmp[0] = something
                                           should be the varid later of assign instruction (***) */

                    /*
                    $instDefChained->addProperty(
                     MyInstruction::RESULTID,
                     $context->getCurrentFunc()->getOpId($op->keys[$nbArrayExpr])
                    );


                    //echo "arrayFetch '$key' RESULTID = '".$context->getCurrentFunc()->getOpId($var)."'\n";

                    $originalDef = new MyDefinition(
                     $context->getCurrentBlock()->getId(),
                     $context->getCurrentMyFile(),
                     $context->getCurrentLine(),
                     $context->getCurrentColumn(),
                     $tempArrayName
                    );

                    $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
                    $context->getCurrentMycode()->addCode($instDefChained);

                    // simulation of the assign / left part
                    $myDef = new MyDefinition(
                     $context->getCurrentBlock()->getId(),
                     $context->getCurrentMyFile(),
                     $context->getCurrentLine(),
                     $context->getCurrentColumn(),
                     $tempArrayName
                    );

                    $myDef->addType(MyDefinition::TYPE_ARRAY);
                    $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);

                    $instDefinition = new MyInstruction(Opcodes::DEFINITION);
                    $instDefinition->addProperty(MyInstruction::DEF, $myDef);
                    $context->getCurrentMycode()->addCode($instDefinition);

                    $instAssign->addProperty(MyInstruction::DEF, $myDef);

                    echo "arrayFetch '$key' EXPRID = '".$context->getCurrentFunc()->getOpId($newvalue)."'\n";
                    $instAssign->addProperty(
                     MyInstruction::EXPRID,
                     $context->getCurrentFunc()->getOpId($newvalue)
                    );
        */
                    //echo "arrayFetch '$key' VARID = '".$context->getCurrentFunc()->getOpId($var)."'\n";
                    /* here (***) */
                    /*
                    $instAssign->addProperty(
                        MyInstruction::VARID,
                        $context->getCurrentFunc()->getOpId($op->keys[$nbArrayExpr])
                    );

                    $context->getCurrentMycode()->addCode($instAssign);
*/
                    $nbArrayExpr ++;
                }

                /*
                                echo "arrayFetch 11 '$key' '$tempArrayName'\n";
                                $myTemp = new MyDefinition(
                                    $context->getCurrentBlock()->getId(),
                                    $context->getCurrentMyFile(),
                                    $context->getCurrentLine(),
                                    $context->getCurrentColumn(),
                                    $tempArrayName
                                );

                                $myTemp->addType(MyDefinition::TYPE_ARRAY);
                                $myTemp->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);

                                $instVariableFetch = new MyInstruction(Opcodes::VARIABLE_FETCH);
                                $instVariableFetch->addProperty(MyInstruction::EXPR, "right");

                                $instVariableFetch->addProperty(
                                    MyInstruction::EXPRID,
                                    $context->getCurrentFunc()->getOpId($op)
                                );

                                $instVariableFetch->addProperty(
                                    MyInstruction::VARID,
                                    $context->getCurrentFunc()->getOpId($op->result)
                                );

                                $instVariableFetch->addProperty(MyInstruction::DEF, $myTemp);
                                $context->getCurrentMycode()->addCode($instVariableFetch);
                                */
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
