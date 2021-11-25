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
use progpilot\Objects\MyFunction;

use progpilot\Dataflow\Definitions;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;
use progpilot\Inputs\MySource;
use progpilot\Helpers\Analysis as HelpersAnalysis;

class TaintAnalysis
{
    public static function funccallValidator(
        $context,
        $myFunc,
        $myClass,
        $instruction
    ) {
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $nbParams = 0;
        $defsValid = [];
        $conditionsRespected = true;

        $myValidator = $context->inputs->getValidatorByName($myFuncCall, $myClass);
        if (!is_null($myValidator)) {
            $validwhenreturning = $myValidator->getValidWhenReturning();
        } else {
            $validwhenreturning = true;
        }

        while (true) {
            if (!$instruction->isPropertyExist("argdef$nbParams")) {
                break;
            }

            $defArg = $instruction->getProperty("argdef$nbParams");

            if (!is_null($myValidator)) {
                $conditions = $myValidator->getParameterconditions($nbParams + 1);
                if ($conditions === "valid") {
                    $defsValid[] = $defArg;
                } elseif ($conditions === "array_not_tainted") {
                    if ($defArg->getCurrentState()->isType(MyDefinition::TYPE_ARRAY)) {
                        foreach ($defArg->getCurrentState()->getArrayIndexes() as $arrayIndex) {
                            if ($arrayIndex->def->getCurrentState()->isTainted()) {
                                $conditionsRespected = false;
                                break;
                            }
                        }
                    }
                } elseif ($conditions === "not_tainted") {
                    if ($defArg->isTainted()) {
                        $conditionsRespected = false;
                    }
                } elseif ($conditions === "equals" || $conditions === "notequals") {
                    $conditionsRespectedEquals = false;
                    $values = $myValidator->getParameterValues($nbParams + 1);

                    if (!is_null($values)) {
                        foreach ($values as $value) {
                            foreach ($defArg->getCurrentState()->getLastKnownValues() as $lastKnownValue) {
                                if ($value->value === $lastKnownValue && $conditions === "equals") {
                                    $conditionsRespectedEquals = true;
                                } elseif ($value->value !== $lastKnownValue && $conditions === "notequals") {
                                    $conditionsRespectedEquals = true;
                                }
                            }
                        }
                    }

                    if (!$conditionsRespectedEquals) {
                        $conditionsRespected = false;
                    }
                }
            } else {
                if (!is_null($myFunc)) {
                    $ambiguous = true;

                    foreach ($myFunc->getReturnDefs() as $returnDef) {
                        $ambiguous = false;
                        // we have a return def from a known validator
                        if ($returnDef->getReturnedFromValidator()) {
                            $returnTrue = false;
                            $returnFalse = false;

                            // we overwrite the value for below
                            $validwhenreturning = $returnDef->getValidWhenReturning();
                            $validNotBoolean = $returnDef->getValidNotBoolean();

                            foreach ($returnDef->getCurrentState()->getLastKnownValues() as $lastKnownValue) {
                                if ($lastKnownValue === "true"
                                    || $lastKnownValue === "TRUE"
                                        || (is_numeric($lastKnownValue) && $lastKnownValue > 0)) {
                                    $returnTrue = true;
                                } elseif ($lastKnownValue === "false"
                                    || $lastKnownValue === "FALSE"
                                        || (is_numeric($lastKnownValue) && $lastKnownValue <= 0)) {
                                    $returnFalse = true;
                                } else {
                                    $ambiguous = true;
                                    break 2;
                                }
                            }

                            // ambiguous
                            if ($returnTrue && $returnFalse) {
                                $ambiguous = true;
                                break;
                            }
                        }
                    }

                    // all the returns are true OR all the returns are false
                    if (!$ambiguous) {
                        $defsValid[] = $defArg;
                    }
                }
            }

            $nbParams ++;
        }

        if (!empty($defsValid)) {
            if ($conditionsRespected) {
                $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);
                foreach ($defsValid as $defValid) {
                    $opInformation["condition_defs"][] = $defValid;
                }

                $opInformation["valid_when_returning"] = $validwhenreturning;
                return $opInformation;
            }
        }

        return null;
    }

    public static function funccallSanitizer(
        $myFunc,
        $context,
        $myClass,
        $instruction,
        $virtualReturnDef
    ) {
        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $conditionsSanitize = false;

        $paramsTainted = false;
        $paramsSanitized = false;
        $paramsTypeSanitized = [];
        $paramsTaintedDefs = [];

        $nbParams = 0;
        $conditionsRespectedFinal = true;

        $mySanitizer = $context->inputs->getSanitizerByName($myFuncCall, $myClass);
        
        if (!is_null($mySanitizer)) {
            $preventFinal = $mySanitizer->getPrevent();
        }

        while (true) {
            if (!$instruction->isPropertyExist("argdef$nbParams")) {
                break;
            }
            
            $defArg = $instruction->getProperty("argdef$nbParams");

            if ($defArg->getCurrentState()->isTainted()) {
                $paramsTainted = true;
                $paramsTaintedDefs[] = $defArg;
            }

            if ($defArg->getCurrentState()->isSanitized()) {
                $paramsSanitized = true;
                $tmps = $defArg->getCurrentState()->getTypeSanitized();

                foreach ($tmps as $tmp) {
                    if (!in_array($tmp, $paramsTypeSanitized, true)) {
                        $paramsTypeSanitized[] = $tmp;
                    }
                }
            }

            if (!is_null($mySanitizer)) {
                $conditions = $mySanitizer->getParameterconditions($nbParams + 1);

                if ($conditions === "equals" || $conditions === "notequals") {
                    $conditionsRespected = false;
                    $values = $mySanitizer->getParameterValues($nbParams + 1);

                    if (!is_null($values)) {
                        foreach ($values as $value) {
                            foreach ($defArg->getCurrentState()->getLastKnownValues() as $lastKnownValue) {
                                if (($value->value === $lastKnownValue && $conditions === "equals")
                                    || ($value->value !== $lastKnownValue && $conditions === "notequals")) {
                                    $conditionsRespected = true;
                                    if (isset($value->prevent)) {
                                        $preventFinal = array_merge($preventFinal, $value->prevent);
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
                    if ($defArg->getCurrentState()->isTainted()) {
                        $paramsTaintedconditionsTaint = true;
                    }
                } elseif ($conditions === "sanitize") {
                    $conditionsSanitize = true;
                    $exprsTaintedconditionsSanitize[] = $defArg;
                }
            }

            $nbParams ++;
        }

        $funcReturnDefs = (!is_null($myFunc) && !empty($myFunc->getReturnDefs())) ? true : false;

        $mySource = $context->inputs->getSourceByName($myFuncCall, $myClass);

        // the default return of func will be tainted if one of arg is tainted
        // AND no defs are returned/defined
        // AND the func is not a sanitizer (with all conditions respected)
        // AND the func is not a source (will return already a def)
        if (!$funcReturnDefs
            && is_null($mySource)) {
            $virtualReturnDef->getCurrentState()->setTainted($paramsTainted);

            foreach ($paramsTaintedDefs as $paramsTaintedDef) {
                $virtualReturnDef->getCurrentState()->addTaintedByDef(
                    [$paramsTaintedDef, $paramsTaintedDef->getCurrentState()]
                );
            }
        }

        if (!is_null($mySanitizer) && $conditionsRespectedFinal) {
            if ($conditionsSanitize) {
                foreach ($exprsTaintedconditionsSanitize as $defTaintedconditionsSanitize) {
                    $callback = "Callbacks::addSanitizedTypes";
                    HelpersAnalysis::forEachTaintedByDefs($defTaintedconditionsSanitize, $preventFinal, $callback);
                }
            } else {
                $virtualReturnDef->getCurrentState()->setSanitized(true);
                if (is_array($preventFinal)) {
                    foreach ($preventFinal as $preventFinalValue) {
                        $virtualReturnDef->getCurrentState()->addTypeSanitized($preventFinalValue);
                    }
                }
            }
        }

        if ($paramsSanitized) {
            $virtualReturnDef->getCurrentState()->setSanitized(true);
            foreach ($paramsTypeSanitized as $tmp) {
                $virtualReturnDef->getCurrentState()->addTypeSanitized($tmp);
            }
        }
    }

    public static function funccallSource($context, $myClass, $instruction, $virtualReturnDef)
    {
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $mySource = $context->inputs->getSourceByName($myFuncCall, $myClass);
        if (!is_null($mySource)) {
            if ($mySource->hasParameters()) {
                $nbParams = 0;
                while (true) {
                    if (!$instruction->isPropertyExist("argdef$nbParams")) {
                        break;
                    }

                    if ($mySource->isParameter($nbParams + 1)) {
                        $defFrom = $instruction->getProperty("argoriginaldef$nbParams");
                        
                        if (!is_null($defFrom)) {
                            $arrayIndex = $mySource->getconditionsParameter($nbParams + 1, MySource::CONDITION_ARRAY);
                            if (!is_null($arrayIndex)) {
                                $newArrs = $defFrom->getCurrentState()->getOrCreateDefArrayIndex(
                                    $defFrom->getBlockId(),
                                    $defFrom,
                                    $arrayIndex
                                );

                                $myElement = $newArrs[1][0];
                                $myElement->getCurrentState()->setTainted(true);
                            }
                        }
                    }

                    $nbParams ++;
                }
            }

            $myDef = $virtualReturnDef;
            
            // sanitizers are deleted
            $myDef->getCurrentState()->setSanitized(false);
            $myDef->getCurrentState()->setTypeSanitized([]);
            $myDef->getCurrentState()->setCast(MyDefinition::CAST_NOT_SAFE);
            //$myDef->getCurrentState()->setTainted(true);
            // no need to taintedbyexpr because it's source like _GET

            if ($mySource->getIsObject()) {
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_INSTANCE);
                $myDef->getCurrentState()->addType(MyDefinition::ALL_PROPERTIES_TAINTED);

                $myDef->setClassName($myFuncCall->getName()."_built-in-class");
                HelpersAnalysis::createObject($context, $myDef);
            } elseif ($mySource->getIsArrayOfArrays()) {
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY_ARRAY);
                $myDef->getCurrentState()->addType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED);
            } elseif ($mySource->getIsArrayOfObjects()) {
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_INSTANCE);
                $myDef->getCurrentState()->addType(MyDefinition::ALL_PROPERTIES_TAINTED);

                $myDef->setClassName($myFuncCall->getName()."_built-in-class");
                HelpersAnalysis::createObject($context, $myDef);
            } elseif ($mySource->getIsArray()) {
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);
                $myDef->getCurrentState()->addType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED);
            } elseif ($mySource->getIsReturnArray()) {
                $newArrs = $myDef->getCurrentState()->getOrCreateDefArrayIndex(
                    $myDef->getBlockId(),
                    $myDef,
                    $mySource->getReturnArrayValue()
                );

                $myElement = $newArrs[1][0];
                $myElement->getCurrentState()->setTainted(true);
            } elseif (!$mySource->getIsReturnArray()) {
                $myDef->getCurrentState()->setTainted(true);
            }
        }
    }
}
