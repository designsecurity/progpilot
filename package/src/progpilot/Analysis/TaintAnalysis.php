<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyCode;
use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyInstance;
use progpilot\Objects\MyAssertion;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyFunction;

use progpilot\Dataflow\Definitions;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;
use progpilot\Inputs\MySource;

class TaintAnalysis
{
    public static function funccallSpecifyAnalysis(
        $myFunc,
        $stackClass,
        $context,
        $data,
        $myClass,
        $myFuncCall,
        $arrFuncCall,
        $instruction,
        $myCode,
        $index
    ) {
        $stackClass = ResolveDefs::funccallClass($context, $data, $myFuncCall);

        \progpilot\Analysis\CustomAnalysis::returnObject(
            $context,
            $myFuncCall,
            $stackClass,
            $instruction->getProperty(MyInstruction::EXPR)
        );

        TaintAnalysis::funccallValidator($stackClass, $context, $data, $myClass, $instruction, $myCode, $index);
        TaintAnalysis::funccallSanitizer(
            $myFunc,
            $stackClass,
            $context,
            $data,
            $myClass,
            $instruction,
            $myCode,
            $index
        );
        
        $hasSources = TaintAnalysis::funccallSource($stackClass, $context, $data, $myClass, $instruction);

        // for example for document.write
        if (is_null($myClass) && $myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $myClass = new MyClass(
                $myFuncCall->getLine(),
                $myFuncCall->getColumn(),
                $myFuncCall->getNameInstance()
            );
        }
        
        SecurityAnalysis::funccall($stackClass, $context, $instruction, $myClass);
        
        return $hasSources;
    }

    public static function funccallValidator($stackClass, $context, $data, $myClass, $instruction, $myCode, $index)
    {
        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arrFuncCall = $instruction->getProperty(MyInstruction::ARR);
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $nbParams = 0;
        $defsValid = [];
        $conditionsRespected = true;

        $myValidator = $context->inputs->getValidatorByName($context, $stackClass, $myFuncCall, $myClass);
        if (!is_null($myValidator)) {
            while (true) {
                if (!$instruction->isPropertyExist("argdef$nbParams")) {
                    break;
                }

                $defArg = $instruction->getProperty("argdef$nbParams");
                $exprArg = $instruction->getProperty("argexpr$nbParams");

                $conditions = $myValidator->getParameterconditions($nbParams + 1);
                if ($conditions === "valid" && !$exprArg->getIsConcat()) {
                    $theDefsArgs = $exprArg->getDefs();

                    foreach ($theDefsArgs as $theDefsArg) {
                        $defsValid[] = $theDefsArg;
                    }
                } elseif ($conditions === "array_not_tainted") {
                    if ($defArg->isType(MyDefinition::TYPE_ARRAY) && $defArg->isTainted()) {
                        $conditionsRespected = false;
                    } elseif ($defArg->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                        $copyArrays = $defArg->getCopyArrays();
                        foreach ($copyArrays as $copyArray) {
                            $arrvalue = $copyArray[0];
                            $defarr = $copyArray[1];

                            if ($defarr->isTainted()) {
                                $conditionsRespected = false;
                            }
                        }
                    }
                } elseif ($conditions === "not_tainted") {
                    if ($defArg->isTainted()) {
                        $conditionsRespected = false;
                    }
                } elseif ($conditions === "equals") {
                    $conditionsRespectedEquals = false;
                    $values = $myValidator->getParameterValues($nbParams + 1);

                    if (!is_null($values)) {
                        $theDefsArgs = $exprArg->getDefs();
                        if (count($theDefsArgs) > 0) {
                            foreach ($values as $value) {
                                foreach ($theDefsArgs[0]->getLastKnownValues() as $lastKnownValue) {
                                    if ($value->value === $lastKnownValue) {
                                        $conditionsRespectedEquals = true;
                                    }
                                }
                            }
                        }
                    }

                    if (!$conditionsRespectedEquals) {
                        $conditionsRespected = false;
                    }
                }

                $nbParams ++;
            }
        }

        if (count($defsValid) > 0) {
            if ($conditionsRespected) {
                $codes = $myCode->getCodes();

                if (isset($codes[$index + 2])) {
                    $instructionIf = $codes[$index + 2];
                    if ($instructionIf->getOpcode() === Opcodes::COND_START_IF) {
                        $myBlockIf = $instructionIf->getProperty(MyInstruction::MYBLOCK_IF);
                        $myBlockElse = $instructionIf->getProperty(MyInstruction::MYBLOCK_ELSE);

                        foreach ($defsValid as $defValid) {
                            $type = "valid";
                            $myAssertion = new MyAssertion($defValid, $type);

                            if ($instructionIf->isPropertyExist(MyInstruction::NOT_BOOLEAN)) {
                                $myBlockElse->addAssertion($myAssertion);
                            } else {
                                $myBlockIf->addAssertion($myAssertion);
                            }
                        }
                    }
                }
            }
        }
    }

    public static function funccallSanitizer(
        $myFunc,
        $stackClass,
        $context,
        $data,
        $myClass,
        $instruction,
        $myCode,
        $index
    ) {
        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arrFuncCall = $instruction->getProperty(MyInstruction::ARR);
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $conditionsSanitize = false;
        $conditionsTaint = false;
        $paramsTaintedconditionsTaint = false;

        $paramsTainted = false;
        $paramsSanitized = false;
        $paramsTypeSanitized = [];

        $nbParams = 0;
        $conditionsRespectedFinal = true;

        $myTempReturn = new MyDefinition(
            $myFuncCall->getLine(),
            $myFuncCall->getColumn(),
            "return_".$myFuncCall->getName()
        );
        $myTempReturn->setSourceMyFile($context->getCurrentMyfile());

        $myExprReturn1 = new MyExpr($myFuncCall->getLine(), $myFuncCall->getColumn());
        $myExprReturn1->setAssign(true);
        $myExprReturn1->setAssignDef($myTempReturn);
        $myExprReturn1->addDef($myTempReturn);

        $myExprReturn2 = new MyExpr($myFuncCall->getLine(), $myFuncCall->getColumn());
        $myExprReturn2->setAssign(true);
        $myExprReturn2->setAssignDef($myTempReturn);

        $mySanitizer = $context->inputs->getSanitizerByName($context, $stackClass, $myFuncCall, $myClass);
        
        if (!is_null($mySanitizer)) {
            $preventFinal = $mySanitizer->getPrevent();
        }

        while (true) {
            if (!$instruction->isPropertyExist("argdef$nbParams")) {
                break;
            }

            $defArg = $instruction->getProperty("argdef$nbParams");
            $exprArg = $instruction->getProperty("argexpr$nbParams");

            if (is_null($myFunc) || !is_null($mySanitizer)) {
                if ($defArg->isTainted()) {
                    $paramsTainted = true;
                    $myExprReturn2->addDef($defArg);
                }

                if ($defArg->isSanitized()) {
                    $paramsSanitized = true;
                    $tmps = $defArg->getTypeSanitized();

                    foreach ($tmps as $tmp) {
                        if (!in_array($tmp, $paramsTypeSanitized, true)) {
                            $paramsTypeSanitized[] = $tmp;
                        }
                    }
                }
            }

            if (!is_null($mySanitizer)) {
                $conditions = $mySanitizer->getParameterconditions($nbParams + 1);

                if ($conditions === "equals") {
                    $conditionsRespected = false;
                    $values = $mySanitizer->getParameterValues($nbParams + 1);

                    if (!is_null($values)) {
                        $theDefsArgs = $exprArg->getDefs();
                        if (count($theDefsArgs) > 0) {
                            foreach ($values as $value) {
                                foreach ($theDefsArgs[0]->getLastKnownValues() as $lastKnownValue) {
                                    if ($value->value === $lastKnownValue) {
                                        $conditionsRespected = true;

                                        if (isset($value->prevent)) {
                                            $preventFinal = array_merge($preventFinal, $value->prevent);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    if (!$conditionsRespected) {
                        $conditionsRespectedFinal = false;
                    }
                } elseif ($conditions === "taint") {
                    $conditionsTaint = true;
                    if ($defArg->isTainted()) {
                        $paramsTaintedconditionsTaint = true;
                        $myExprReturn2->addDef($defArg);
                    }
                } elseif ($conditions === "sanitize") {
                    $conditionsSanitize = true;
                    $exprsTaintedconditionsSanitize[] = $exprArg;
                }
            }

            $nbParams ++;
        }

        $returnSanitizer = false;

        $codes = $myCode->getCodes();
        if (isset($codes[$index + 2]) && $codes[$index + 2]->getOpcode() === Opcodes::END_ASSIGN) {
            $instructionDef = $codes[$index + 3];
            $myDefReturn = $instructionDef->getProperty(MyInstruction::DEF);
            $returnSanitizer = true;
        }
        
        // the return of func will be tainted if one of arg is tainted
        if ($returnSanitizer) {
            TaintAnalysis::setTainted($paramsTainted, $myTempReturn, $myExprReturn2);
        }

        if ($returnSanitizer || $conditionsSanitize) {
            if (!is_null($mySanitizer) && $conditionsRespectedFinal) {
                if ($conditionsSanitize) {
                    foreach ($exprsTaintedconditionsSanitize as $exprsanitize) {
                        foreach ($exprsanitize->getDefs() as $oneDef) {
                            $oneDef->setSanitized(true);
                            if (is_array($preventFinal)) {
                                foreach ($preventFinal as $preventFinalValue) {
                                    $oneDef->addTypeSanitized($preventFinalValue);
                                }
                            }
                        }
                    }
                } else {
                    $myTempReturn->setSanitized(true);
                    $myDefReturn->setSanitized(true);
                    if (is_array($preventFinal)) {
                        foreach ($preventFinal as $preventFinalValue) {
                            $myTempReturn->addTypeSanitized($preventFinalValue);
                            $myDefReturn->addTypeSanitized($preventFinalValue);
                        }
                    }
                }
            }
        }

        if ($returnSanitizer && $paramsSanitized) {
            $myTempReturn->setSanitized(true);
            $myDefReturn->setSanitized(true);
            foreach ($paramsTypeSanitized as $tmp) {
                $myTempReturn->addTypeSanitized($tmp);
                $myDefReturn->addTypeSanitized($tmp);
            }
        }

        if ($returnSanitizer) {
            if (ResolveDefs::getVisibilityFromInstances($context, $data, $myDefReturn)) {
                ValueAnalysis::copyValues($myTempReturn, $myDefReturn);
                TaintAnalysis::setTainted($myTempReturn->isTainted(), $myDefReturn, $myExprReturn1);
            }
        }
    }

    public static function funccallSource($stackClass, $context, $data, $myClass, $instruction)
    {
        $hasSources = false;
        
        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arrFuncCall = $instruction->getProperty(MyInstruction::ARR);
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);
        
        $className = false;
        if ($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD) && !is_null($myClass)) {
            $className = $myClass->getName();
        }
        
        $mySource = $context->inputs->getSourceByName($stackClass, $myFuncCall, true, $className, false);
        if (!is_null($mySource)) {
            $hasSources = true;
            if ($mySource->hasParameters()) {
                $nbParams = 0;
                while (true) {
                    if (!$instruction->isPropertyExist("argdef$nbParams")) {
                        break;
                    }

                    $defArg = $instruction->getProperty("argdef$nbParams");

                    if ($mySource->isParameter($nbParams + 1)) {
                        $defFrom = $defArg->getValueFromDef();
                        
                        if (!is_null($defFrom)) {
                            $arrayIndex = $mySource->getconditionsParameter($nbParams + 1, MySource::CONDITION_ARRAY);
                            if (!is_null($arrayIndex)) {
                                $trueArrayIndex = array($arrayIndex => false);
                                $defFrom->addType(MyDefinition::TYPE_ARRAY);
                                $defFrom->setArrayValue($trueArrayIndex);
                            }

                            // no expression needed it's a source
                            $defFrom->setTainted(true);
                        }
                    }

                    $nbParams ++;
                }
            }

            $exprReturn = $instruction->getProperty(MyInstruction::EXPR);

            if ($exprReturn->isAssign()) {
                $defAssign = $exprReturn->getAssignDef();
                
                // sanitizers are deleted
                $defAssign->setSanitized(false);
                $defAssign->setTypeSanitized([]);
                $defAssign->setCast(MyDefinition::CAST_NOT_SAFE);

                $myDef = new MyDefinition(
                    $myFuncCall->getLine(),
                    $myFuncCall->getColumn(),
                    $myFuncCall->getName()."_return"
                );
                $myDef->setSourceMyFile($defAssign->getSourceMyFile());
                $myDef->setTainted(true);
                // no need to taintedbyexpr because it's source like _GET

                if ($mySource->getIsObject()) {
                    $defAssign->addType(MyDefinition::TYPE_INSTANCE);
                    $defAssign->property->addProperty("PROGPILOT_ALL_PROPERTIES_TAINTED");
                    
                    $defAssign->setTaintedByExpr($exprReturn);
                    $defAssign->setExpr($exprReturn);
                    
                    $exprReturn->addDef($defAssign);
                } elseif ($mySource->getIsArray()) {
                    $defAssign->setArrayValue("PROGPILOT_ALL_INDEX_TAINTED");
                    // we don't add type of TYPE_ARRAY because is a virtual array
                    // $row = mysqli_fetch_row
                    // echo $row[0]
                    // we don't want row as an array because it's value is constance PROGPILOT_ALL_INDEX_TAINTED
                    // which doesn't mean anything for the user
                    //$defAssign->addType(MyDefinition::TYPE_ARRAY);
                    
                    $defAssign->setTaintedByExpr($exprReturn);
                    $defAssign->setExpr($exprReturn);

                    $exprReturn->addDef($defAssign);
                } elseif ($mySource->getIsReturnArray() && $arrFuncCall === false) {
                    $valueArray = array($mySource->getReturnArrayValue() => false);

                    $defAssign->addCopyArray($valueArray, $myDef);
                    $defAssign->addType(MyDefinition::TYPE_COPY_ARRAY);

                    $exprReturn->addDef($myDef);
                    $myDef->setExpr($exprReturn);
                } elseif ($mySource->getIsReturnArray()) {
                    $valueArray = array($mySource->getReturnArrayValue() => false);

                    if ($arrFuncCall === $valueArray) {
                        $exprReturn->addDef($myDef);
                        $myDef->setExpr($exprReturn);

                        if ($exprReturn->isAssign()) {
                            if (ResolveDefs::getVisibilityFromInstances($context, $data, $defAssign)) {
                                ValueAnalysis::copyValues($myDef, $defAssign);
                                TaintAnalysis::setTainted($myDef->isTainted(), $defAssign, $exprReturn);
                            }
                        }
                    }
                } elseif (!$mySource->getIsReturnArray()) {
                    $exprReturn->addDef($myDef);
                    if ($exprReturn->isAssign()) {
                        if (ResolveDefs::getVisibilityFromInstances($context, $data, $defAssign)) {
                            ValueAnalysis::copyValues($myDef, $defAssign);
                            TaintAnalysis::setTainted($myDef->isTainted(), $defAssign, $exprReturn);
                        }
                    }
                }
            }
        }
        
        return $hasSources;
    }

    public static function setTainted($tainted, $defAssign, $expr)
    {
        if ($tainted) {
            $defAssign->setTainted(true);
            $defAssign->setTaintedByExpr($expr);
        }
    }
}
