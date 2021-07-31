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

    public static function isSafe($indexParameter, $myDef, $myEndDef, $mySink, $isFlow = false)
    {
        $possibleConditions = ["QUOTES", "object_tainted", "array_tainted", "variable_tainted", null];
        
        foreach ($possibleConditions as $possibleCondition) {
            if ($mySink->isParameterCondition($indexParameter, $possibleCondition)) {
                if (!SecurityAnalysis::isSafeCondition(
                    $myDef,
                    $myEndDef,
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

    public static function isSafeCondition($myDef, $myEndDef, $mySink, $condition, $isFlow)
    {
        if ($myDef->getCurrentState()->isTainted()
            && ($myDef->getCurrentState()->getCast() === MyDefinition::CAST_NOT_SAFE
                && $myEndDef->getCurrentState()->getCast() === MyDefinition::CAST_NOT_SAFE)/*
                && $myDef->getArrayValue() !== "PROGPILOT_ALL_INDEX_TAINTED"
                    && !$myDef->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")*/) {
            if ($myDef->getCurrentState()->isSanitized()) {
                if ($myDef->getCurrentState()->isTypeSanitized($mySink->getAttack())
                            || $myDef->getCurrentState()->isTypeSanitized("ALL")) {
                    // 1° the argument of sink must be quoted
                    if ($condition === "QUOTES" && !$myDef->getCurrentState()->isTypeSanitized("ALL")) {
                        // the def is embedded into quotes but quotes are not sanitized
                        if (!$myDef->getCurrentState()->isTypeSanitized("QUOTES") && $myDef->getCurrentState()->getIsEmbeddedByChar("'")) {
                            return false;
                        }

                        // the def is not embedded into quotes
                        if (!$myDef->getCurrentState()->getIsEmbeddedByChar("'")) {
                            return false;
                        }
                    }

                    if ($mySink->isGlobalCondition("QUOTES_HTML")
                                && !$myDef->getCurrentState()->isTypeSanitized("ALL")) {
                        if (!$myDef->isTypeSanitized("QUOTES") && $myDef->getIsEmbeddedByChar("<")
                                    && $myDef->getCurrentState()->getIsEmbeddedByChar("'")) {
                            return false;
                        }

                        if ($myDef->getCurrentState()->getIsEmbeddedByChar("<") && !$myDef->getCurrentState()->getIsEmbeddedByChar("'")) {
                            return false;
                        }
                    }

                    return true;
                }
            }

            return false;
        } elseif (($condition === "array_tainted" || $isFlow)
            /*&& $myDef->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED"*/) {
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

        echo "security funccall 1\n";

        $mySink = $context->inputs->getSinkByName($context, $stackClass, $myFuncCall, $myClass);
        if (!is_null($mySink)) {
            echo "security funccall 2\n";
            $nbParams = $myFuncCall->getNbParams();
            $conditionRespected = true;
            if ($mySink->hasParameters()) {
                echo "security funccall 3\n";
                for ($i = 0; $i < $nbParams; $i ++) {
                    echo "security funccall 4\n";
                    if ($mySink->isParameter($i + 1)) {
                        $conditionRespected = false;
        
                        echo "security funccall 5\n";
                        $myDefArg = $instruction->getProperty("argdef$i");
                        $taintedExpr = $myDefArg->getTaintedByExpr();

                        if ($myDefArg->isType(MyDefinition::TYPE_COPY_ARRAY)
                            && $mySink->isParameterCondition($i + 1, "array_tainted")) {
                            foreach ($myDefArg->getCopyArrays() as $copyarray) {
                                if (!SecurityAnalysis::isSafe($i + 1, $copyarray[1], $myDefArg, $mySink)) {
                                    $conditionRespected = true;
                                }
                            }
                        } elseif (!$myDefArg->isType(MyDefinition::TYPE_COPY_ARRAY)
                         && (!$mySink->isParameterCondition($i + 1, "array_tainted")
                         || $mySink->isParameterCondition($i + 1, "variable_tainted"))) {
                            if (!is_null($taintedExpr)) {
                                $defsExpr = $taintedExpr->getDefs();
                                foreach ($defsExpr as $defExpr) {
                                    if (!SecurityAnalysis::isSafe($i + 1, $defExpr, $myDefArg, $mySink)) {
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
                echo "security funccall 6\n";
                for ($i = 0; $i < $nbParams; $i ++) {
                    echo "security funccall 7\n";
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
                                    $copyarray[1]
                                );
                            }
                        } else {
                            echo "security funccall 8\n";
                            SecurityAnalysis::call(
                                $i + 1,
                                $myFuncCall,
                                $context,
                                $mySink,
                                $myDefArg
                            );
                        }
                    }
                }
            }
        }
    }

    public static function taintedFlow($indexParameter, $defExprFlow, $myEndDef, $mySink)
    {
        $resultTaintedFlow = [];
        $exprTaintedTmp = [];

        $idFlow = \progpilot\Utils::printDefinition($mySink->getLanguage(), $defExprFlow);

        while (!empty($defExprFlow->getCurrentState()->getTaintedByDefs())) {
            $taintedDefs = $defExprFlow->getCurrentState()->getTaintedByDefs();

            foreach ($taintedDefs as $taintedDef) {
                echo "taintedFlow 1\n";
                $taintedDef->printStdout();
                if (!SecurityAnalysis::isSafe($indexParameter, $taintedDef, $myEndDef, $mySink, true)) {
                    if (!is_null($taintedDef->getArgToParam())) {
                        echo "taintedFlow 2\n";
                        $param = $taintedDef->getArgToParam();

                        $sourceName = \progpilot\Utils::printDefinition($mySink->getLanguage(), $param);
                        $sourceLine = $param->getLine();
                        $sourceColumn = $param->getColumn();
                        $sourceFile = \progpilot\Utils::encodeCharacters($param->getSourceMyFile()->getName());
                    } else {

                        echo "taintedFlow 3\n";
                        if (!is_null($taintedDef->original->getDef())) {
                            echo "taintedFlow 4\n";
                            $taintedDef->original->getDef()->printStdout();

                            $sourceName = \progpilot\Utils::printDefinition($mySink->getLanguage(), $taintedDef->original->getDef(), $taintedDef->original);
                            $sourceLine = $taintedDef->original->getDef()->getLine();
                            $sourceColumn = $taintedDef->original->getDef()->getColumn();
                            $sourceFile = \progpilot\Utils::encodeCharacters($taintedDef->original->getDef()->getSourceMyFile()->getName());
                        }
                        else {
                            $sourceName = \progpilot\Utils::printDefinition($mySink->getLanguage(), $taintedDef);
                            $sourceLine = $taintedDef->getLine();
                            $sourceColumn = $taintedDef->getColumn();
                            $sourceFile = \progpilot\Utils::encodeCharacters(
                                $taintedDef->getSourceMyFile()->getName()
                            );
                        }
                    }

                    echo "taintedFlow 5\n";
                    if (!is_null($taintedDef->original->getDef())) {
                        echo "taintedFlow 6\n";
                        $taintedDef->original->getDef()->printStdout();
                    }


                    $oneTainted["flow_name"] = $sourceName;
                    $oneTainted["flow_line"] = $sourceLine;
                    $oneTainted["flow_column"] = $sourceColumn;
                    $oneTainted["flow_file"] = $sourceFile;

                    // just in case
                    if (in_array($oneTainted, $resultTaintedFlow, true)) {
                        break 2;
                    }

                    $resultTaintedFlow[] = $oneTainted;

                    $idFlow .= \progpilot\Utils::printDefinition($mySink->getLanguage(), $taintedDef);
                    $idFlow .= "-".$taintedDef->getSourceMyFile()->getName();
                    $defExprFlow = $taintedDef;
                    break;
                }
            }

            if ($defExprFlow->getCurrentState()->getTaintedByDefs() === $taintedDefs) {
                break;
            }
        }
        

        return [$resultTaintedFlow, $idFlow];
    }

    public static function call($indexParameter, $myFuncCall, $context, $mySink, $myDef)
    {
        $hashIdVuln = "";

        $temp["source_name"] = [];
        $temp["source_line"] = [];
        $temp["source_column"] = [];
        $temp["source_file"] = [];

        if ($context->outputs->getTaintedFlow()) {
            $temp["tainted_flow"] = [];
        }

        $nbtainted = 0;
        $taintedDefs = $myDef->getCurrentState()->getTaintedByDefs();
        echo "security call 1\n";
        $myDef->printStdout();
        if (!empty($taintedDefs)) {
            echo "security call 2\n";
            foreach ($taintedDefs as $taintedDef) {
                echo "security call 3\n";
                if (!SecurityAnalysis::isSafe($indexParameter, $taintedDef, $myDef, $mySink)) {
                    echo "security call 4\n";
                    if (!is_null($taintedDef->getArgToParam())) {
                        $param = $taintedDef->getArgToParam();
                        $sourceName = \progpilot\Utils::printDefinition($mySink->getLanguage(), $param);
                        $sourceLine = $param->getLine();
                        $sourceColumn = $param->getColumn();
                        $sourceFile = \progpilot\Utils::encodeCharacters($param->getSourceMyFile()->getName());
                    } else {
                        echo "security call 5\n";
                        $taintedDef->printStdout();


                        echo "security call 5 a\n";
                        if (!is_null($taintedDef->original->getDef())) {
                            echo "security call 5 b\n";
                            $taintedDef->original->getDef()->printStdout();
                            var_dump($taintedDef->original->getArrayIndexAccessor());


                            $sourceName = \progpilot\Utils::printDefinition($mySink->getLanguage(), $taintedDef->original->getDef(), $taintedDef->original);
                            $sourceLine = $taintedDef->original->getDef()->getLine();
                            $sourceColumn = $taintedDef->original->getDef()->getColumn();
                            $sourceFile = \progpilot\Utils::encodeCharacters($taintedDef->original->getDef()->getSourceMyFile()->getName());
                        }
                        else {
                            $sourceName = \progpilot\Utils::printDefinition($mySink->getLanguage(), $taintedDef);
                            echo "security call 6\n";
                            $sourceLine = $taintedDef->getLine();
                            $sourceColumn = $taintedDef->getColumn();
                            $sourceFile = \progpilot\Utils::encodeCharacters($taintedDef->getSourceMyFile()->getName());
                        }
                    }

                    if (!SecurityAnalysis::inArraySource(
                        $temp,
                        $sourceName,
                        $sourceLine,
                        $sourceColumn,
                        $sourceFile
                    )) {
                        $resultsFlow = SecurityAnalysis::taintedFlow($indexParameter, $taintedDef, $myDef, $mySink);
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
        }
    }
}
