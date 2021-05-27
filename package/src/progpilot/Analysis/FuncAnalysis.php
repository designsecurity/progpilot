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

        $i = 0;

        if (!is_null($myFunc)) {
            $defsReturn = $myFunc->getReturnDefs();
            foreach ($defsReturn as $defReturn) {
                if (($arrFuncCall !== false
                    && $defReturn->isType(MyDefinition::TYPE_ARRAY)
                        && $defReturn->getArrayValue() === $arrFuncCall)
                            || ($arrFuncCall === false && !$defReturn->isType(MyDefinition::TYPE_ARRAY))) {
                    $copyDefReturn = $defReturn;
                    $copyDefReturn->setExpr($exprReturn);
                    $defReturn->setCast($myFuncCall->getCastReturn());
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

                    if ($opAfter->isPropertyExist(MyInstruction::CHAINED_DEF)) {
                        $def = $opAfter->getProperty(MyInstruction::CHAINED_DEF);
                        $def->setObjectId($defReturn->getObjectId());
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

                $param->setParamToArg($defArg);
                $defArg->setArgToParam($param);
                
                $nbParams ++;
            }
        }
    }
}
