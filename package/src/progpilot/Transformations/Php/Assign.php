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
use progpilot\Transformations\Php\OpTr;

class Assign
{
    public static function instruction($context, $isReturnDef = false, $isDefine = false, $myblock = null)
    {
        $backDef = null;

        if ($isDefine) {
            $name = "const_".rand();
            if (isset($context->getCurrentOp()->args[0]->value)) {
                $name = $context->getCurrentOp()->args[0]->value;
            }

            $type = MyOp::TYPE_CONST;
            $typeArray = null;
            $typeInstance = null;

            $exprOp = $context->getCurrentOp();
            if (isset($context->getCurrentOp()->args[1])) {
                $exprOp = $context->getCurrentOp()->args[1];
            }
        } else {
            $name = Common::getNameDefinition($context->getCurrentOp());
            $type = Common::getTypeDefinition($context->getCurrentOp());
            $typeArray = Common::getTypeIsArray($context->getCurrentOp());
            $typeInstance = Common::getTypeIsInstance($context->getCurrentOp());
            
            if (empty($name)) {
                $name = "empty_".rand();
            }

            $exprOp = $context->getCurrentOp()->expr;
        }

        // name of function return
        if ($isReturnDef) {
            $name = $context->getCurrentFunc()->getName()."_return";
        }

        // $array = [expr, expr, expr]
        if ($typeArray === MyOp::TYPE_ARRAY_EXPR) {
            $arr = false;
            if (isset($context->getCurrentOp()->var)) {
                $arr = BuildArrays::buildArrayFromOps($context->getCurrentOp()->var, false);
            }

            ArrayExpr::instruction($context->getCurrentOp()->expr, $context, $arr, $name, $isReturnDef);
        } else {
            $isRef = false;
            if ($context->getCurrentOp() instanceof Op\Expr\AssignRef) {
                $isRef = true;
            }
            
            $fromPhi = false;
            // currently we disable analysis of phi
            /*
            if (isset($context->getCurrentOp()->expr->ops[0])
                && $context->getCurrentOp()->expr->ops[0] instanceof Op\Phi) {

                $tmpDefsFromPhi = [];
                $fromPhi = true;

                // normally there is only two cars for a phi => phi(var1,var2)
                $phi = $context->getCurrentOp()->expr->ops[0];
                foreach ($phi->vars as $phivar) {
                    if (isset($phivar->ops[0]) && $phivar->ops[0] instanceof Op\Expr\Assign) {
                        $oldOp = $context->getCurrentOp();
                        $context->setCurrentOp($phivar->ops[0]);
                        $tmpDefsFromPhi[] = Assign::instruction($context);
                        $context->setCurrentOp($oldOp);
                    }
                }
            }
            */

            // it's an expression which will define a definition
            $myExpr = new MyExpr($context->getCurrentLine(), $context->getCurrentColumn());
            $myExpr->setAssign(true);

            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));

            if (isset($context->getCurrentOp()->expr->ops[0])
                        && $context->getCurrentOp()->expr->ops[0] instanceof Op\Iterator\Value) {
                $myExpr->setAssignIterator(true);
            }

            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));
                
            if ($fromPhi) {
                $myTemp = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), "phi_".rand());
                $myTemp->setExpr($myExpr);
                $context->getSymbols()->addRawDef($myTemp);
                $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
                $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $myTemp->getId());
                $instTemporarySimple->addProperty(MyInstruction::PHI, count($tmpDefsFromPhi));

                $nbvars = 0;
                foreach ($tmpDefsFromPhi as $defFromPhi) {
                    $defFromPhi->setExpr($myExpr);
                    $instTemporarySimple->addProperty("temp_".$nbvars, $defFromPhi);
                    $nbvars ++;
                }

                $context->getCurrentMycode()->addCode($instTemporarySimple);
            } else {
                $backDef = Expr::instruction($exprOp, $context, $myExpr);
            }

            $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
            $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
            $context->getCurrentMycode()->addCode($instEndExpr);
            $context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

            $myDef = new MyDefinition($context->getCurrentLine(), $context->getCurrentColumn(), $name);

            if ($isRef) {
                $myDef->addType(MyDefinition::TYPE_REFERENCE);
            }

            if ($type === MyOp::TYPE_CONST) {
                $myDef->addType(MyDefinition::TYPE_CONSTANTE);
            }

            $context->getSymbols()->addRawDef($myDef);

            if ($isReturnDef) {
                $context->getCurrentFunc()->addReturnDef($myDef->getId());
                $myblock->addReturnDef($myDef->getId());
            }

            $myExpr->setAssignDef($myDef->getId());

            $instDef = new MyInstruction(Opcodes::DEFINITION);
            $instDef->addProperty(MyInstruction::DEF, $myDef->getId());
            $context->getCurrentMycode()->addCode($instDef);

            // $array[09][098] = expr;
            if ($typeArray === MyOp::TYPE_ARRAY) {
                $arr = BuildArrays::buildArrayFromOps($context->getCurrentOp()->var, false);
                $myDef->addType(MyDefinition::TYPE_ARRAY);
                $myDef->setArrayValue($arr);
            }

            // a variable, property
            if ($type === MyOp::TYPE_PROPERTY) {
                $myDef->addType(MyDefinition::TYPE_PROPERTY);
                $propertyName = Common::getNameProperty($context->getCurrentOp()->var->ops[0]);
                $myDef->property->setProperties($propertyName);
            }

            // a variable, property
            if ($type === MyOp::TYPE_STATIC_PROPERTY) {
                $myDef->addType(MyDefinition::TYPE_STATIC_PROPERTY);
                $propertyName = Common::getNameProperty($context->getCurrentOp()->var->ops[0]);
                $myDef->property->setProperties($propertyName);
            }

            // an object (created by new)
            if ($typeInstance === MyOp::TYPE_INSTANCE) {
                // it's the class name not instance name
                if (isset($context->getCurrentOp()->expr->ops[0]->class->value)) {
                    $nameClass = $context->getCurrentOp()->expr->ops[0]->class->value;
                    $myDef->addType(MyDefinition::TYPE_INSTANCE);
                    $myDef->setClassName($nameClass);

                    // ou bien créer backdef ici
                    if (!is_null($backDef)) {
                        $backDef->setId($myDef->getId() + 1);
                        $context->getSymbols()->addRawDef($backDef);
                    }
                }
            }

            if ($isRef) {
                $refName = Common::getNameDefinition($context->getCurrentOp()->expr);
                $refType = Common::getTypeDefinition($context->getCurrentOp()->expr);
                $refTypeArray = Common::getTypeIsArray($context->getCurrentOp()->expr);
                $myDef->setRefName($refName);

                if ($refTypeArray === MyOp::TYPE_ARRAY) {
                    $arr = BuildArrays::buildArrayFromOps($context->getCurrentOp()->expr, false);
                    $myDef->addType(MyDefinition::TYPE_ARRAY_REFERENCE);
                    $myDef->setRefArrValue($arr);
                }
            }
        }

        return $backDef;
    }
}
