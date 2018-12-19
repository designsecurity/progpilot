<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use PHPCfg\Block;
use PHPCfg\Func;
use PHPCfg\Op;
use PHPCfg\Script;
use PHPCfg\Visitor;
use PHPCfg\Operand;

use progpilot\Objects\MyOp;
use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Code\MyInstruction;

class SecurityAnalysis
{
    public static function inArraySource($temp, $name, $line, $column, $file)
    {
        for ($i = 0; $i < count($temp["source_name"]); $i ++) {
            if ($temp["source_name"][$i] === $name
                && $temp["source_line"][$i] === $line
                    && $temp["source_column"][$i] === $column
                        && $temp["source_file"][$i] === $file) {
                return true;
            }
        }

        return false;
    }

    public static function isSafe($indexParameter, $myDef, $mySink, $isFlow = false)
    {
        $possibleConditions = ["QUOTES", "object_tainted", "array_tainted", "variable_tainted", null];
        
        foreach ($possibleConditions as $possibleCondition) {
            if ($mySink->isParameterCondition($indexParameter, $possibleCondition)) {
                if (!SecurityAnalysis::isSafeCondition(
                    $indexParameter,
                    $myDef,
                    $mySink,
                    $possibleCondition,
                    $isFlow
                )
                    ) {
                    return false;
                }
            }
        }
        
        return true;
    }

    public static function isSafeCondition($indexParameter, $myDef, $mySink, $condition, $isFlow)
    {
        if ($myDef->isTainted()
            && $myDef->getCast() === MyDefinition::CAST_NOT_SAFE
                && $myDef->getArrayValue() !== "PROGPILOT_ALL_INDEX_TAINTED"
                    && !$myDef->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")) {
            if ($myDef->isSanitized()) {
                if ($myDef->isTypeSanitized($mySink->getAttack())
                            || $myDef->isTypeSanitized("ALL")) {
                    // 1° the argument of sink must be quoted
                    if ($condition === "QUOTES" && !$myDef->isTypeSanitized("ALL")) {
                        // the def is embedded into quotes but quotes are not sanitized
                        if (!$myDef->isTypeSanitized("QUOTES") && $myDef->getIsEmbeddedByChar("'")) {
                            return false;
                        }

                        // the def is not embedded into quotes
                        if (!$myDef->getIsEmbeddedByChar("'")) {
                            return false;
                        }
                    }

                    if ($mySink->isGlobalCondition("QUOTES_HTML")
                                && !$myDef->isTypeSanitized("ALL")) {
                        if (!$myDef->isTypeSanitized("QUOTES") && $myDef->getIsEmbeddedByChar("<")
                                    && $myDef->getIsEmbeddedByChar("'")) {
                            return false;
                        }

                        if ($myDef->getIsEmbeddedByChar("<") && !$myDef->getIsEmbeddedByChar("'")) {
                            return false;
                        }
                    }

                    return true;
                }
            }

            return false;
        } elseif (($condition === "array_tainted" || $isFlow)
            && $myDef->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED") {
            return false;
        } elseif (($condition === "object_tainted" || $isFlow)
            && $myDef->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")) {
            return false;
        }

        return true;
    }

    public static function funccall($stackClass, $context, $instruction, $myClass = null)
    {
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $nameInstance = null;
        if ($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $nameInstance = $myFuncCall->getNameInstance();
        }
        
        $mySink = $context->inputs->getSinkByName($context, $stackClass, $myFuncCall, $myClass);
        if (!is_null($mySink)) {
            $nbParams = $myFuncCall->getNbParams();
            $conditionRespected = true;
            if ($mySink->hasParameters()) {
                for ($i = 0; $i < $nbParams; $i ++) {
                    if ($mySink->isParameter($i + 1)) {
                        $conditionRespected = false;
        
                        $myDefArg = $instruction->getProperty("argdef$i");
                        $taintedExpr = $myDefArg->getTaintedByExpr();
                            
                        if ($myDefArg->isType(MyDefinition::TYPE_COPY_ARRAY)
                            && $mySink->isParameterCondition($i + 1, "array_tainted")) {
                            foreach ($myDefArg->getCopyArrays() as $copyarray) {
                                if (!SecurityAnalysis::isSafe($i + 1, $copyarray[1], $mySink)) {
                                    $conditionRespected = true;
                                }
                            }
                        } elseif (!$myDefArg->isType(MyDefinition::TYPE_COPY_ARRAY)
                         && (!$mySink->isParameterCondition($i + 1, "array_tainted")
                         || $mySink->isParameterCondition($i + 1, "variable_tainted"))) {
                            if (!is_null($taintedExpr)) {
                                $defsExpr = $taintedExpr->getDefs();
                                foreach ($defsExpr as $defExpr) {
                                    if (!SecurityAnalysis::isSafe($i + 1, $defExpr, $mySink)) {
                                        $conditionRespected = true;
                                    }
                                }
                            }
                        } elseif ($myDefArg->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED"
                            && $mySink->isParameterCondition($i + 1, "array_tainted")) {
                            $conditionRespected = true;
                        } elseif ($myDefArg->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")
                            && $mySink->isParameterCondition($i + 1, "object_tainted")) {
                            $conditionRespected = true;
                        }

                        if (!$conditionRespected) {
                            break;
                        }
                    }
                }
            }

            if ($conditionRespected) {
                for ($i = 0; $i < $nbParams; $i ++) {
                    $myDefArg = $instruction->getProperty("argdef$i");
                    $myDefExpr = $instruction->getProperty("argexpr$i");

                    if (!$mySink->hasParameters() || ($mySink->hasParameters() && $mySink->isParameter($i + 1))) {
                        if ($myDefArg->isType(MyDefinition::TYPE_COPY_ARRAY)
                            && $mySink->isParameterCondition($i + 1, "array_tainted")) {
                            foreach ($myDefArg->getCopyArrays() as $copyarray) {
                                SecurityAnalysis::call(
                                    $i + 1,
                                    $myFuncCall,
                                    $context,
                                    $mySink,
                                    $copyarray[1],
                                    $myDefExpr
                                );
                            }
                        } else {
                            SecurityAnalysis::call(
                                $i + 1,
                                $myFuncCall,
                                $context,
                                $mySink,
                                $myDefArg,
                                $myDefExpr
                            );
                        }
                    }
                }
            }
        }
    }

    public static function taintedFlow($indexParameter, $context, $defExprFlow, $mySink)
    {
        $resultTaintedFlow = [];

        $idFlow = \progpilot\Utils::printDefinition($mySink->getLanguage(), $defExprFlow);

        while ($defExprFlow->getTaintedByExpr() !== null) {
            $taintedFlowExpr = $defExprFlow->getTaintedByExpr();
            $defsExprTainted = $taintedFlowExpr->getDefs();

            foreach ($defsExprTainted as $defExprFlowFrom) {
                if (!SecurityAnalysis::isSafe($indexParameter, $defExprFlowFrom, $mySink, true)) {
                    $tmpname = \progpilot\Utils::printDefinition($mySink->getLanguage(), $defExprFlowFrom);
                    $oneTainted["flow_name"] = $tmpname;
                    $oneTainted["flow_line"] = $defExprFlowFrom->getLine();
                    $oneTainted["flow_column"] = $defExprFlowFrom->getColumn();
                    $oneTainted["flow_file"] = \progpilot\Utils::encodeCharacters(
                        $defExprFlowFrom->getSourceMyFile()->getName()
                    );
                    
                    // just in case
                    if (in_array($oneTainted, $resultTaintedFlow, true)) {
                        break 2;
                    }
                        
                    $resultTaintedFlow[] = $oneTainted;

                    $idFlow .= \progpilot\Utils::printDefinition($mySink->getLanguage(), $defExprFlowFrom);
                    $idFlow .= "-".$defExprFlowFrom->getSourceMyFile()->getName();
                    $defExprFlow = $defExprFlowFrom;
                    break;
                }
            }

            if ($defExprFlow->getTaintedByExpr() === $taintedFlowExpr) {
                break;
            }
        }

        return [$resultTaintedFlow, $idFlow];
    }

    public static function call($indexParameter, $myFuncCall, $context, $mySink, $myDef, $myExpr)
    {
        //$results = &$context->outputs->getResults();
        $hashIdVuln = "";

        $temp["source_name"] = [];
        $temp["source_line"] = [];
        $temp["source_column"] = [];
        $temp["source_file"] = [];

        if ($context->outputs->getTaintedFlow()) {
            $temp["tainted_flow"] = [];
        }

        $nbtainted = 0;
        $taintedExpr = $myDef->getTaintedByExpr();
        if (!is_null($taintedExpr)) {
            $defsExpr = $taintedExpr->getDefs();

            foreach ($defsExpr as $defExpr) {
                if (!SecurityAnalysis::isSafe($indexParameter, $defExpr, $mySink)) {
                    $sourceName = \progpilot\Utils::printDefinition($mySink->getLanguage(), $defExpr);
                    $sourceLine = $defExpr->getLine();
                    $sourceColumn = $defExpr->getColumn();
                    $sourceFile = \progpilot\Utils::encodeCharacters($defExpr->getSourceMyFile()->getName());

                    if (!SecurityAnalysis::inArraySource(
                        $temp,
                        $sourceName,
                        $sourceLine,
                        $sourceColumn,
                        $sourceFile
                    )) {
                        $resultsFlow = SecurityAnalysis::taintedFlow($indexParameter, $context, $defExpr, $mySink);
                        $resultTaintedFlow = $resultsFlow[0];
                        $hashIdVuln .= $resultsFlow[1];

                        $temp["source_name"][] = $sourceName;

                        if ($context->outputs->getTaintedFlow()) {
                            $temp["tainted_flow"][] = $resultTaintedFlow;
                        }

                        $temp["source_line"][] = $sourceLine;
                        $temp["source_column"][] = $sourceColumn;
                        $temp["source_file"][] = $sourceFile;

                        $nbtainted ++;
                    }
                }
            }
        }

        $hashedValue = $hashIdVuln."-".$mySink->getName()."-".$myFuncCall->getSourceMyFile()->getName();
        $hashIdVuln = hash("sha256", $hashedValue);

        if ($nbtainted && is_null($context->inputs->getFalsePositiveById($hashIdVuln))) {
            $temp["sink_name"] = \progpilot\Utils::encodeCharacters($mySink->getName());
            $temp["sink_line"] = $myFuncCall->getLine();
            $temp["sink_column"] = $myFuncCall->getColumn();
            $temp["sink_file"] = \progpilot\Utils::encodeCharacters($myFuncCall->getSourceMyFile()->getName());
            $temp["vuln_name"] = \progpilot\Utils::encodeCharacters($mySink->getAttack());
            $temp["vuln_cwe"] = \progpilot\Utils::encodeCharacters($mySink->getCwe());
            $temp["vuln_id"] = $hashIdVuln;
            $temp["vuln_type"] = "taint-style";

            $context->outputs->addResult($temp);
            //if (!in_array($temp, $results, true))
                // $results[] = $temp;
        }
    }
}
