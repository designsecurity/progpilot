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
use progpilot\Helpers\Analysis as HelpersAnalysis;
use progpilot\Helpers\Dataflow as HelpersDataflow;

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
        $index,
        $objectId = -1
    ) {
        //$stackClass = ResolveDefs::funccallClass($context, $data, $myFuncCall, $myCode->getCodes(), $index);

        \progpilot\Analysis\CustomAnalysis::returnObject(
            $context,
            $myFuncCall,
            $myClass,
            $instruction
        );

        TaintAnalysis::funccallValidator(
            $stackClass,
            $context,
            $data,
            $myFunc,
            $myClass,
            $instruction,
            $myCode,
            $index
        );

        TaintAnalysis::funccallSanitizer(
            $myFunc,
            $stackClass,
            $context,
            $data,
            $myClass,
            $instruction,
            $myCode,
            $index,
            $objectId
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

    public static function funccallValidator(
        $stackClass,
        $context,
        $data,
        $myFunc,
        $myClass,
        $instruction,
        $myCode,
        $index
    ) {
        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arrFuncCall = $instruction->getProperty(MyInstruction::ARR);
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $nbParams = 0;
        $defsValid = [];
        $conditionsRespected = true;

        $myValidator = $context->inputs->getValidatorByName($context, $stackClass, $myFuncCall, $myClass);
        if (!is_null($myValidator)) {
            $validwhenreturning = $myValidator->getValidWhenReturning();
        } else {
            $validwhenreturning = true;
        }

        while (true) {
            if (!$instruction->isPropertyExist("argdef$nbParams")
                || !$instruction->isPropertyExist("argexpr$nbParams")) {
                break;
            }

            $defArg = $instruction->getProperty("argdef$nbParams");
            $exprArg = $instruction->getProperty("argexpr$nbParams");

            if (!is_null($myValidator)) {
                $conditions = $myValidator->getParameterconditions($nbParams + 1);
                if ($conditions === "valid" && !$exprArg->getIsConcat()) {
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
                
                $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
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
        $index,
        $objectId = -1
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
        $paramsTaintedDefs = [];

        $nbParams = 0;
        $conditionsRespectedFinal = true;

        $myTempReturn = new MyDefinition(
            $context->getCurrentBlock()->getId(),
            $context->getCurrentMyFile(),
            $myFuncCall->getLine(),
            $myFuncCall->getColumn(),
            "return_".$myFuncCall->getName()
        );

        $mySanitizer = $context->inputs->getSanitizerByName($context, $stackClass, $myFuncCall, $myClass);
        
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
        /*
                if(!is_null($mySanitizer)) {
                    echo "funccallSanitizer 10b\n";
                     foreach($mySanitizer->getParameters() as $paramSanitizer) {
                        echo "funccallSanitizer 10c\n";
                        $index = $paramSanitizer[0];
                        echo "funccallSanitizer 10d '$index' > '$nbParams'\n";
                        if($index > $nbParams) {
                            echo "funccallSanitizer 10e\n";
                            $conditionsRespectedFinal = false;

                        }
                     }

                }*/

        if ($funcName !== "__construct") {
            $resultid = $instruction->getProperty(MyInstruction::RESULTID);
            $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);
            $opInformation["chained_results"][] = $myTempReturn;

            $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
        }

        $funcReturnDefs = (!is_null($myFunc) && !empty($myFunc->getReturnDefs())) ? true : false;

        //$myTempReturn->getCurrentState()->setObjectId($objectId);


        $mySource = $context->inputs->getSourceByName($myFuncCall, $myClass);

        // the default return of func will be tainted if one of arg is tainted
        // AND no defs are returned/defined
        // AND the func is not a sanitizer (with all conditions respected)
        // AND the func is not a source (will return already a def)
        if (!$funcReturnDefs
            && is_null($mySource)/*
            && (is_null($mySanitizer)
                || !$conditionsRespectedFinal)*/) {
            $myTempReturn->getCurrentState()->setTainted($paramsTainted);

            foreach ($paramsTaintedDefs as $paramsTaintedDef) {
                $myTempReturn->getCurrentState()->addTaintedByDef(
                    [$paramsTaintedDef, $paramsTaintedDef->getCurrentState()]
                );
            }
        }

        //if ($conditionsSanitize) {
        if (!is_null($mySanitizer) && $conditionsRespectedFinal) {
            if ($conditionsSanitize) {
                foreach ($exprsTaintedconditionsSanitize as $defTaintedconditionsSanitize) {
                    $callback = "Callbacks::addSanitizedTypes";
                    HelpersAnalysis::forEachTaintedByDefs($defTaintedconditionsSanitize, $preventFinal, $callback);
                }
            } else {
                $myTempReturn->getCurrentState()->setSanitized(true);
                if (is_array($preventFinal)) {
                    foreach ($preventFinal as $preventFinalValue) {
                        $myTempReturn->getCurrentState()->addTypeSanitized($preventFinalValue);
                    }
                }
            }
        }
        //}

        if ($paramsSanitized) {
            $myTempReturn->getCurrentState()->setSanitized(true);
            foreach ($paramsTypeSanitized as $tmp) {
                $myTempReturn->getCurrentState()->addTypeSanitized($tmp);
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

        $mySource = $context->inputs->getSourceByName($myFuncCall, $myClass);
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

                            // no expression needed it's a source
                            //$defFrom->setTainted(true);
                        }
                    }

                    $nbParams ++;
                }
            }

            $resultid = $instruction->getProperty(MyInstruction::RESULTID);
            $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);


            $myDef = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentMyFile(),
                $myFuncCall->getLine(),
                $myFuncCall->getColumn(),
                $myFuncCall->getName()."_return"
            );
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
                HelpersDataflow::createObject($context, $myDef);
            } elseif ($mySource->getIsArrayOfArrays()) {
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY_ARRAY);
                $myDef->getCurrentState()->addType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED);
            } elseif ($mySource->getIsArrayOfObjects()) {
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_INSTANCE);
                $myDef->getCurrentState()->addType(MyDefinition::ALL_PROPERTIES_TAINTED);

                $myDef->setClassName($myFuncCall->getName()."_built-in-class");
                HelpersDataflow::createObject($context, $myDef);
            } elseif ($mySource->getIsArray()) {
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);
                $myDef->getCurrentState()->addType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED);
            } elseif ($mySource->getIsReturnArray() && $arrFuncCall === false) {
                $valueArray = array($mySource->getReturnArrayValue() => false);

                $defAssign->addCopyArray($valueArray, $myDef);
                //$defAssign->addType(MyDefinition::TYPE_COPY_ARRAY);

                $exprReturn->addDef($myDef);
                $myDef->setExpr($exprReturn);
            } elseif ($mySource->getIsReturnArray()) {
                $valueArray = array($mySource->getReturnArrayValue() => false);


                $newArrs = $myDef->getCurrentState()->getOrCreateDefArrayIndex(
                    $myDef->getBlockId(),
                    $myDef,
                    $mySource->getReturnArrayValue()
                );

                $myElement = $newArrs[1][0];
                $myElement->getCurrentState()->setTainted(true);

            /*
            if ($arrFuncCall === $valueArray) {
                $exprReturn->addDef($myDef);
                $myDef->setExpr($exprReturn);

                if ($exprReturn->isAssign()) {
                    if (ResolveDefs::getVisibilityFromInstances($context, $data, $defAssign)) {
                        ValueAnalysis::copyValues($myDef, $defAssign);
                        TaintAnalysis::setTainted($myDef->isTainted(), $defAssign, $exprReturn);
                    }
                }
            }*/
            } elseif (!$mySource->getIsReturnArray()) {
                $myDef->getCurrentState()->setTainted(true);
                /*
                $exprReturn->addDef($myDef);
                if ($exprReturn->isAssign()) {
                    if (ResolveDefs::getVisibilityFromInstances($context, $data, $defAssign)) {
                        ValueAnalysis::copyValues($myDef, $defAssign);
                        TaintAnalysis::setTainted($myDef->isTainted(), $defAssign, $exprReturn);
                    }
                }*/
            }

            $opInformation["chained_results"][] = $myDef;
            $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
        }
        
        return $hasSources;
    }
}
