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
    public static function inArrayStateSource($temp, $ret)
    {
        for ($i = 0; $i < count($temp["source_name"]); $i ++) {
            if ($temp["source_name"][$i] === $ret["source_name"]
                && $temp["source_line"][$i] === $ret["source_line"]
                    && $temp["source_column"][$i] === $ret["source_column"]
                        && $temp["source_file"][$i] === $ret["source_file"]) {
                return true;
            }
        }

        return false;
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
                        //$conditionRespected = false;
                        $conditionRespected = true;
        
                        echo "security funccall 5\n";
                        $myDefArg = $instruction->getProperty("argdef$i");
/*
                        if ($myDefArg->isType(MyDefinition::TYPE_COPY_ARRAY)
                            && $mySink->isParameterCondition($i + 1, "array_tainted")) {
                            foreach ($myDefArg->getCopyArrays() as $copyarray) {
                                if (!SecurityAnalysis::isSafe($i + 1, $copyarray[1], $myDefArg, $mySink, $myFuncCall)) {
                                    $conditionRespected = true;
                                }
                            }
                        } elseif (!$myDefArg->isType(MyDefinition::TYPE_COPY_ARRAY)
                         && (!$mySink->isParameterCondition($i + 1, "array_tainted")
                         || $mySink->isParameterCondition($i + 1, "variable_tainted"))) {
                            $defsBy = $myDefArg->getCurrentState()->getTaintedByDefs();
                            foreach ($defsBy as $defBy) {
                                $def = $defBy[0];
                                $state = $defBy[1];
                                if (!SecurityAnalysis::isSafeState($mySink, $i + 1, $state)) {
                                    $conditionRespected = true;
                                }
                            }
                        } elseif ($myDefArg->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED"
                            && $mySink->isParameterCondition($i + 1, "array_tainted")) {
                            $conditionRespected = true;
                        } elseif ($myDefArg->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")
                            && $mySink->isParameterCondition($i + 1, "object_tainted")) {
                            $conditionRespected = true;
                        }*/

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
                        /*
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
                        } else {*/
                            echo "security funccall 8\n";
                            SecurityAnalysis::callbis(
                                $i + 1,
                                $myFuncCall,
                                $context,
                                $mySink,
                                $myDefArg
                            );
                        //}
                    }
                }
            }
        }
    }

    public static function taintedStateFlow($mySink, $indexParameter, $taintedDef, $taintedState)
    {
        $resultTaintedFlow = [];
        $idFlow = \progpilot\Utils::printDefinition($mySink->getLanguage(), $taintedDef);

        do {
            $fromTaintedByDefs = $taintedState->getTaintedByDefs();

            $taintedDef = null;

            foreach ($fromTaintedByDefs as $fromTaintedByDef) {
                $fromTaintedDef = $fromTaintedByDef[0];
                $fromTaintedState = $fromTaintedByDef[1];
                echo "taintedFlow 1\n";
                $fromTaintedDef->printStdout();
                $possibleConditions = ["QUOTES", "object_tainted", "array_tainted", "variable_tainted", null];
                foreach ($possibleConditions as $condition) {
                    if ($mySink->isParameterCondition($indexParameter, $condition)) {
                        if (!SecurityAnalysis::isSafeStateCondition($mySink, $fromTaintedState, $condition)) {
                            $ret = SecurityAnalysis::getPrintableTaintedDef($mySink, $fromTaintedDef);

                            $oneTainted["flow_name"] = $ret["source_name"];
                            $oneTainted["flow_line"] = $ret["source_line"];
                            $oneTainted["flow_column"] = $ret["source_column"];
                            $oneTainted["flow_file"] =$ret["source_file"];

                            $resultTaintedFlow[] = $oneTainted;

                            $idFlow .= \progpilot\Utils::printDefinition($mySink->getLanguage(), $fromTaintedDef);
                            $idFlow .= "-".$fromTaintedDef->getSourceMyFile()->getName();
                            $taintedDef = $fromTaintedDef;
                            $taintedState = $fromTaintedState;
                            break 2;
                        }
                    }
                }
            }
        } while (!is_null($taintedDef));

        return [$resultTaintedFlow, $idFlow];
    }

    public static function isSafeState($mySink, $indexParameter, $myState, $isFlow = false)
    {
        $possibleConditions = ["QUOTES", "object_tainted", "array_tainted", "variable_tainted", null];
        
        echo "isSafeState 1\n";
        foreach ($possibleConditions as $condition) {
            if ($mySink->isParameterCondition($indexParameter, $condition)) {
                echo "isSafeState 2 '$condition'\n";
                if (!SecurityAnalysis::isSafeStateCondition($mySink, $myState, $condition)) {
                    return false;
                }
            }
        }
        
        return true;
    }
    
    public static function isSafeStateCondition($mySink, $state, $condition)
    {
        echo "isSafeStateCondition 1\n";
        if ($state->isTainted() && $state->getCast() === MyDefinition::CAST_NOT_SAFE) {
            echo "isSafeStateCondition 2\n";
            if ($state->isSanitized()) {
                echo "isSafeStateCondition 3 '".$mySink->getAttack()."'\n";
                if ($state->isTypeSanitized($mySink->getAttack())
                            || $state->isTypeSanitized("ALL")) {
                    echo "isSafeStateCondition 4\n";
                    // 1° the argument of sink must be quoted
                    if ($condition === "QUOTES" && !$state->isTypeSanitized("ALL")) {
                        // the def is embedded into quotes but quotes are not sanitized
                        if (!$state->isTypeSanitized("QUOTES")
                            && $state->getIsEmbeddedByChar("'")) {
                            return false;
                        }

                        // the def is not embedded into quotes
                        if (!$state->getIsEmbeddedByChar("'")) {
                            return false;
                        }
                    }

                    if ($mySink->isGlobalCondition("QUOTES_HTML")
                                && !$state->isTypeSanitized("ALL")) {
                        if (!$state->isTypeSanitized("QUOTES") && $state->getIsEmbeddedByChar("<")
                                    && $state->getIsEmbeddedByChar("'")) {
                            return false;
                        }

                        if ($state->getIsEmbeddedByChar("<")
                            && !$state->getIsEmbeddedByChar("'")) {
                            return false;
                        }
                    }
                } else {
                    return false; // not safe because type not sanitized
                }

                echo "isSafeStateCondition 5\n";
                return true;
            }
            echo "isSafeStateCondition 6\n";

            return false;
        }

        return true;
    }


    public static function isSafeStatesCondition($mySink, $myDef, $condition, $isFlow)
    {
        echo "isSafeStatesCondition\n";
        $statesMyDef = $myDef->getStates();
        foreach ($statesMyDef as $stateMyDef) {
            if (!SecurityAnalysis::isSafeStateCondition($mySink, $stateMyDef, $condition)) {
                return false;
            }
        }
        
        return true;
    }

    public static function callbis($indexParameter, $myFuncCall, $context, $mySink, $myDef)
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

        echo "callbis 1\n";
        $myDef->printStdout();

        // arg param of sink = always current state

        if (!SecurityAnalysis::isSafeState($mySink, $indexParameter, $myDef->getCurrentState())) {
            $taintedDefs = $myDef->getCurrentState()->getTaintedByDefs();
            foreach ($taintedDefs as $taintedByDef) {
                $taintedDef = $taintedByDef[0];
                $taintedState = $taintedByDef[1];

                echo "callbis 2\n";
                $taintedDef->printStdout();

                if (!SecurityAnalysis::isSafeState($mySink, $indexParameter, $taintedState)) {
                    $ret = SecurityAnalysis::getPrintableTaintedDef($mySink, $taintedDef);

                    if (!SecurityAnalysis::inArrayStateSource($temp, $ret)) {
                        $resultsFlow = SecurityAnalysis::taintedStateFlow(
                            $mySink,
                            $indexParameter,
                            $taintedDef,
                            $taintedState
                        );
                        $resultTaintedFlow = $resultsFlow[0];
                        $hashIdVuln .= $resultsFlow[1];

                        $temp["source_name"][] = $ret["source_name"];

                        if ($context->outputs->getTaintedFlow()) {
                            $temp["tainted_flow"][] = $resultTaintedFlow;
                        }

                        $temp["source_line"][] = $ret["source_line"];
                        $temp["source_column"][] = $ret["source_column"];
                        $temp["source_file"][] = $ret["source_file"];

                        $nbtainted ++;
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


    public static function getPrintableTaintedDef($mySink, $myDef)
    {
        echo "getPrintableTaintedDef\n";
        $myDef->printStdout();

        if (!is_null($myDef->getArgToParam())) {
            $param = $myDef->getArgToParam();
            $return["source_name"] = \progpilot\Utils::printDefinition($mySink->getLanguage(), $param);
            $return["source_line"] = $param->getLine();
            $return["source_column"]= $param->getColumn();
            $return["source_file"] = \progpilot\Utils::encodeCharacters($param->getSourceMyFile()->getName());

            return $return;
        }
        
        if (!is_null($myDef->original->getDef())) {
            $return["source_name"] = \progpilot\Utils::printDefinition(
                $mySink->getLanguage(),
                $myDef->original->getDef(),
                $myDef->original
            );
            $return["source_line"] = $myDef->original->getDef()->getLine();
            $return["source_column"] = $myDef->original->getDef()->getColumn();
            $return["source_file"] = \progpilot\Utils::encodeCharacters(
                $myDef->original->getDef()->getSourceMyFile()->getName()
            );
            return $return;
        }

        $return["source_name"] = \progpilot\Utils::printDefinition($mySink->getLanguage(), $myDef);
        $return["source_line"] = $myDef->getLine();
        $return["source_column"] = $myDef->getColumn();
        $return["source_file"] = \progpilot\Utils::encodeCharacters($myDef->getSourceMyFile()->getName());
        
        return $return;
    }
}
