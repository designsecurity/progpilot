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

        echo "funccallValidator 1 '$funcName'___\n";
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
            echo "funccallValidator 2___\n";
            if (!$instruction->isPropertyExist("argdef$nbParams")
                || !$instruction->isPropertyExist("argexpr$nbParams")) {
                break;
            }

            $defArg = $instruction->getProperty("argdef$nbParams");
            $exprArg = $instruction->getProperty("argexpr$nbParams");

            if (!is_null($myValidator)) {
                echo "funccallValidator 3___ name '".$myValidator->getName()."'\n";
                $conditions = $myValidator->getParameterconditions($nbParams + 1);
                if ($conditions === "valid" && !$exprArg->getIsConcat()) {
                    $defsValid[] = $defArg;
                } elseif ($conditions === "array_not_tainted") {
                    echo "funccallValidator b___ 1\n";
                    if ($defArg->getCurrentState()->isType(MyDefinition::TYPE_ARRAY)) {
                        echo "funccallValidator b___ 2\n";
                        foreach ($defArg->getCurrentState()->getArrayIndexes() as $arrayIndex) {
                            echo "funccallValidator b___ 3\n";
                            if ($arrayIndex->def->getCurrentState()->isTainted()) {
                                echo "funccallValidator b___ 4\n";
                                $conditionsRespected = false;
                                break;
                            }
                        }
                    }
                } elseif ($conditions === "not_tainted") {
                    echo "funccallValidator a___\n";
                    if ($defArg->isTainted()) {
                        $conditionsRespected = false;
                    }
                } elseif ($conditions === "equals" || $conditions === "notequals") {
                    $conditionsRespectedEquals = false;
                    $values = $myValidator->getParameterValues($nbParams + 1);


                    echo "funccallValidator EQUALS 1\n";

                    if (!is_null($values)) {
                        echo "funccallValidator EQUALS 2\n";
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

                    echo "funccallValidator 5___\n";
                    if (!$conditionsRespectedEquals) {
                        echo "funccallValidator 6___\n";
                        $conditionsRespected = false;
                    }
                }
            } else {
                echo "funccallValidator ccccc___\n";
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

                            foreach ($returnDef->getLastKnownValues() as $lastKnownValue) {
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
                        $theDefsArgs = $exprArg->getDefs();
                        foreach ($theDefsArgs as $theDefsArg) {
                            $defsValid[] = $theDefsArg;
                        }
                    }
                }
            }

            $nbParams ++;
        }
        

        echo "funccallValidator qsdqsdqsdqs___\n";
        if (count($defsValid) > 0) {
            echo "funccallValidator 7___\n";
            if ($conditionsRespected) {
                echo "funccallValidator 8___\n";

                $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);
                foreach ($defsValid as $defValid) {
                    $opInformation["condition_defs"][] = $defValid;
                }
                
                $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);

                /*
                $codes = $myCode->getCodes();

                if (isset($codes[$index + 2])) {
                    $instructionIf = $codes[$index + 2];
                    if ($instructionIf->getOpcode() === Opcodes::COND_START_IF) {
                        $myBlockIf = $instructionIf->getProperty(MyInstruction::MYBLOCK_IF);
                        $myBlockElse = $instructionIf->getProperty(MyInstruction::MYBLOCK_ELSE);

                        if ($instructionIf->isPropertyExist(MyInstruction::NOT_BOOLEAN)) {
                            $block = $validwhenreturning ? $myBlockElse : $myBlockIf;
                            $notboolean = true;
                        } else {
                            $block = $validwhenreturning ? $myBlockIf : $myBlockElse;
                            $notboolean = false;
                        }

                        foreach ($defsValid as $defValid) {
                            $myAssertion = new MyAssertion($defValid, "valid");
                            $block->addAssertion($myAssertion);
                        }

                        foreach ($block->getReturnDefs() as $defReturn) {
                            $defReturn->setReturnedFromValidator(true);
                            $defReturn->setValidWhenReturning($validwhenreturning);
                            $defReturn->setValidNotBoolean($notboolean);
                        }
                    }
                }

                */
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
        echo "funccallSanitizer 1____\n";
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
                if ($defArg->getCurrentState()->isTainted()) {
                    $paramsTainted = true;
                    $paramsTaintedDefs[] = $defArg;
                    $myExprReturn2->addDef($defArg);
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
            }

            if (!is_null($mySanitizer)) {
                $conditions = $mySanitizer->getParameterconditions($nbParams + 1);

                echo "funccallSanitizer 1--1____\n";
                if ($conditions === "equals" || $conditions === "notequals") {
                    $conditionsRespected = false;
                    $values = $mySanitizer->getParameterValues($nbParams + 1);

                    echo "funccallSanitizer 1--2____\n";
                    if (!is_null($values)) {
                        echo "funccallSanitizer 1--3____\n";
                        foreach ($values as $value) {
                            echo "funccallSanitizer 1--4____\n";
                            foreach ($defArg->getCurrentState()->getLastKnownValues() as $lastKnownValue) {
                                echo "funccallSanitizer 1--5____\n";
                                if (($value->value === $lastKnownValue && $conditions === "equals")
                                    || ($value->value !== $lastKnownValue && $conditions === "notequals")) {
                                    $conditionsRespected = true;

                                    echo "funccallSanitizer 1--6____\n";
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
                        $myExprReturn2->addDef($defArg);
                    }
                } elseif ($conditions === "sanitize") {
                    echo "funccallSanitizer 2____\n";
                    $conditionsSanitize = true;
                    $exprsTaintedconditionsSanitize[] = $defArg;
                }
            }

            $nbParams ++;
        }

        $returnSanitizer = false;

        if ($funcName !== "__construct") {
            $resultid = $instruction->getProperty(MyInstruction::RESULTID);
            $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);
            echo "storeopinformation here '$resultid' taintanalysis\n";
            $opInformation["chained_results"][] = $myTempReturn;

            $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
        }

        $returnSanitizer = true;

        $myTempReturn->getCurrentState()->setObjectId($objectId);

        echo "funccallSanitizer 3____\n";
        // the return of func will be tainted if one of arg is tainted
        if ($returnSanitizer) {
            $myTempReturn->getCurrentState()->setTainted($paramsTainted);

            foreach ($paramsTaintedDefs as $paramsTaintedDef) {
                $myTempReturn->getCurrentState()->addTaintedByDef(
                    [$paramsTaintedDef, $paramsTaintedDef->getCurrentState()]
                );
            }
            //TaintAnalysis::setTainted($myTempReturn, $myTempReturn);
        }

        if ($returnSanitizer || $conditionsSanitize) {
            echo "funccallSanitizer 4____\n";
            if (!is_null($mySanitizer) && $conditionsRespectedFinal) {
                echo "funccallSanitizer 5____\n";
                if ($conditionsSanitize) {
                    foreach ($exprsTaintedconditionsSanitize as $defTaintedconditionsSanitize) {
                        echo "funccallSanitizer 6____\n";
                        $callback = "Callbacks::addSanitizedTypes";
                        HelpersAnalysis::forEachTaintedByDefs($defTaintedconditionsSanitize, $preventFinal, $callback);
                    }
                } else {
                    $myTempReturn->getCurrentState()->setSanitized(true);
                    //$myDefReturn->getCurrentState()->setSanitized(true);
                    if (is_array($preventFinal)) {
                        foreach ($preventFinal as $preventFinalValue) {
                            $myTempReturn->getCurrentState()->addTypeSanitized($preventFinalValue);
                            //$myDefReturn->getCurrentState()->addTypeSanitized($preventFinalValue);
                        }
                    }
                }
            }
        }

        if ($returnSanitizer && $paramsSanitized) {
            $myTempReturn->getCurrentState()->setSanitized(true);
            //$myDefReturn->getCurrentState()->setSanitized(true);
            foreach ($paramsTypeSanitized as $tmp) {
                $myTempReturn->getCurrentState()->addTypeSanitized($tmp);
                //$myDefReturn->getCurrentState()->addTypeSanitized($tmp);
            }
        }

        echo "funcallsanitize\n";

        /*
                if ($returnSanitizer) {
                    if (ResolveDefs::getVisibilityFromInstances($context, $data, $myDefReturn)) {
                        $returnState = $myTempReturn->getCurrentState();
                        $myDefReturn->setState($returnState, $myTempReturn->getBlockId());
                    }
                }
        */
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
        
        $mySource = $context->inputs->getSourceByName($context, $stackClass, $myFuncCall, true, $className, false);
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
            echo "storeopinformation here '$resultid' taintanalysis\n";
        
            echo "FUNCCALL SOURCE 1\n";


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

                echo "FUNCCALL SOURCE 2\n";
            //$defAssign->property->setProperties("PROGPILOT_ALL_PROPERTIES_TAINTED");
            } elseif ($mySource->getIsArray()) {
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);
            //$defAssign->setArrayValue("PROGPILOT_ALL_INDEX_TAINTED");

                    // we don't add type of TYPE_ARRAY because is a virtual array
                    // $row = mysqli_fetch_row
                    // echo $row[0]
                    // we don't want row as an array because it's value is constance PROGPILOT_ALL_INDEX_TAINTED
                    // which doesn't mean anything for the user
                    //$defAssign->addType(MyDefinition::TYPE_ARRAY);
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

                echo "getIsReturnArray_\n";
                var_dump($myElement);

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
