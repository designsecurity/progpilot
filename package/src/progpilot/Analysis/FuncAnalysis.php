<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyDefinition;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;

class FuncAnalysis
{
    public static function funccallAfter($context, $data, $myFuncCall, $myFunc, $arrFuncCall, $instruction, $opAfter)
    {
        $exprReturn = $instruction->getProperty(MyInstruction::EXPR);

        if (!is_null($myFunc)) {
            $defsReturn = $myFunc->getReturnDefs();
            foreach ($defsReturn as $defReturn) {
                if (($arrFuncCall !== false
                    && $defReturn->isType(MyDefinition::TYPE_ARRAY)
                        && $defReturn->getArrayValue() === $arrFuncCall)
                            || ($arrFuncCall === false && !$defReturn->isType(MyDefinition::TYPE_ARRAY))) {
                    $copyDefReturn = $defReturn;

                    // copydefreturn = return $defReturn;
                    $copyDefReturn->setExpr($exprReturn);
                    $defReturn->setCast($myFuncCall->getCastReturn());
                    // exprreturn = $def = exprreturn(funccall());
                    $exprReturn->addDef($copyDefReturn);
                    
                    $expr = $copyDefReturn->getExpr();
                    if ($expr->isAssign()) {
                        $defAssign = $expr->getAssignDef();
                        //TaintAnalysis::setTainted($copyDefReturn, $defAssign, $expr);

                        if (ResolveDefs::getVisibilityFromInstances($context, $data, $defAssign)) {
                            ValueAnalysis::copyValues($copyDefReturn, $defAssign);
                            TaintAnalysis::setTainted($copyDefReturn->isTainted(), $defAssign, $expr);
                        }

                        ArrayAnalysis::copyArrayFromDef(
                            $defReturn,
                            $arrFuncCall,
                            $defAssign,
                            $defAssign->getArrayValue()
                        );
                    }
                }
            }

            if ($opAfter->getOpcode() === Opcodes::DEFINITION) {
                $copyTab = $opAfter->getProperty(MyInstruction::DEF);

                $originalTabs = $myFunc->getReturnDefs();

                foreach ($originalTabs as $originalTab) {
                    ArrayAnalysis::copyArrayFromDef($originalTab, $arrFuncCall, $copyTab, $copyTab->getArrayValue());
                }
            }
        }
    }

    public static function funccallBefore($context, $data, $myFunc, $myFuncCall, $instruction)
    {
        $nbParams = 0;
        $params = $myFunc->getParams();

        foreach ($params as $param) {
            if ($instruction->isPropertyExist("argdef$nbParams")) {
                $defArg = $instruction->getProperty("argdef$nbParams");
                $exprArg = $instruction->getProperty("argexpr$nbParams");

                $newParam = clone $param;
                $myFuncCall->addParam($newParam);

                $newParam->setLastKnownValues($defArg->getLastKnownValues());
                ArrayAnalysis::copyArrayFromDef($defArg, $defArg->getArrayValue(), $newParam, false);

                $param->setCopyArrays($newParam->getCopyArrays());
                $param->setLastKnownValues($newParam->getLastKnownValues());
                $param->setType($newParam->getType());

                $expr = $param->getExpr();
                    
                if ($defArg->isTainted()) {
                    // useful just for inside the function
                    TaintAnalysis::setTainted($defArg->isTainted(), $param, $exprArg);

                    if (!is_null($expr) && $expr->isAssign()) {
                        $defAssign = $expr->getAssignDef();

                        if (ResolveDefs::getVisibilityFromInstances($context, $data, $defAssign)) {
                            TaintAnalysis::setTainted($defArg->isTainted(), $defAssign, $expr);
                            ValueAnalysis::copyValues($defArg, $defAssign);
                        }
                    }
                }
                
                // useful for copy all tainted array progpilot
                ValueAnalysis::copyValues($defArg, $param);

                $nbParams ++;
                unset($defArg);
            }
        }

        unset($params);
    }
}
