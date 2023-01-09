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

use progpilot\Helpers\Analysis as HelpersAnalysis;

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

    public static function funccall($context, $instruction, $myClass = null)
    {
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $mySink = $context->inputs->getSinkByName($myFuncCall, $myClass);
        if (!is_null($mySink)) {
            $nbParams = $myFuncCall->getNbParams();
            for ($i = 0; $i < $nbParams; $i ++) {
                $myDefArg = $instruction->getProperty("argdef$i");

                if (!$mySink->hasParameters() || ($mySink->hasParameters() && $mySink->isParameter($i + 1))) {
                    SecurityAnalysis::callbis(
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

    public static function taintedStateFlow($context, $mySink, $indexParameter, $taintedDef, $taintedState)
    {
        $resultTaintedFlow = [];
        $idFlow = \progpilot\Utils::printDefinition($taintedDef);

        do {
            $fromTaintedByDefs = $taintedState->getTaintedByDefs();

            $taintedDef = null;

            foreach ($fromTaintedByDefs as $fromTaintedByDef) {
                $fromTaintedDef = $fromTaintedByDef[0];
                $fromTaintedState = $fromTaintedByDef[1];

                $possibleConditions = ["QUOTES", "object_tainted", "array_tainted", "variable_tainted", null];
                foreach ($possibleConditions as $condition) {
                    if ($mySink->isParameterCondition($indexParameter, $condition)) {
                        if (!SecurityAnalysis::isSafeStateCondition(
                            $context,
                            $mySink,
                            $fromTaintedState,
                            $condition,
                            true
                        )) {
                            $ret = SecurityAnalysis::getPrintableTaintedDef($mySink, $fromTaintedDef);

                            $oneTainted["flow_name"] = $ret["source_name"];
                            $oneTainted["flow_line"] = $ret["source_line"];
                            $oneTainted["flow_column"] = $ret["source_column"];
                            $oneTainted["flow_file"] =$ret["source_file"];

                            $resultTaintedFlow[] = $oneTainted;

                            $idFlow .= \progpilot\Utils::printDefinition($fromTaintedDef);
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

    public static function isSafeState($context, $mySink, $indexParameter, $myState)
    {
        $possibleConditions = ["QUOTES", "object_tainted", "array_tainted", "variable_tainted", null];
        
        foreach ($possibleConditions as $condition) {
            if ($mySink->isParameterCondition($indexParameter, $condition)) {
                if (!SecurityAnalysis::isSafeStateCondition($context, $mySink, $myState, $condition)) {
                    return false;
                }
            }
        }
        
        return true;
    }
    
    public static function isSafeStateCondition($context, $mySink, $state, $condition, $isFlow = false)
    {
        if (($state->isTainted())
            && $state->getCast() === MyDefinition::CAST_NOT_SAFE
                && $condition !== "object_tainted"
                    && $condition !== "array_tainted") {
            if ($state->isSanitized()) {
                if ($state->isTypeSanitized($mySink->getAttack())
                            || $state->isTypeSanitized("ALL")) {
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

                return true;
            }

            return false;
        } elseif (($condition === "object_tainted" || $isFlow)
            && $state->isType(MyDefinition::TYPE_INSTANCE)
                && $state->isType(MyDefinition::ALL_PROPERTIES_TAINTED)) {
            return false;
        } elseif (($condition === "array_tainted" || $isFlow)
            && $state->isType(MyDefinition::TYPE_ARRAY)
                && $state->isType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED)) {
            return false;
        }
        
        return true;
    }


    public static function isSafeStatesCondition($context, $mySink, $myDef, $condition)
    {
        $statesMyDef = $myDef->getStates();
        foreach ($statesMyDef as $stateMyDef) {
            if (!SecurityAnalysis::isSafeStateCondition($context, $mySink, $stateMyDef, $condition)) {
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

        // arg param of sink = always current state
        if (!SecurityAnalysis::isSafeState($context, $mySink, $indexParameter, $myDef->getCurrentState())) {
            $taintedDefs = $myDef->getCurrentState()->getTaintedByDefs();
            foreach ($taintedDefs as $taintedByDef) {
                $taintedDef = $taintedByDef[0];
                $taintedState = $taintedByDef[1];

                if (!SecurityAnalysis::isSafeState($context, $mySink, $indexParameter, $taintedState)) {
                    $ret = SecurityAnalysis::getPrintableTaintedDef($mySink, $taintedDef);
                    if (!SecurityAnalysis::inArrayStateSource($temp, $ret)) {
                        $resultsFlow = SecurityAnalysis::taintedStateFlow(
                            $context,
                            $mySink,
                            $indexParameter,
                            $taintedDef,
                            $taintedState
                        );
                        $resultTaintedFlow = $resultsFlow[0];
                        $hashIdVuln .= $resultsFlow[1];
                        $hashIdVuln .= $ret["source_name"];

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

            $hashedValue = $hashIdVuln."-".$mySink->getName()."-".$myFuncCall->getSourceMyFile()->fileName;
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
        if (!is_null($myDef->getArgToParam())) {
            $param = $myDef->getArgToParam();
            $return["source_name"] = \progpilot\Utils::printDefinition($param);
            $return["source_line"] = $param->getLine();
            $return["source_column"]= $param->getColumn();
            $return["source_file"] = \progpilot\Utils::encodeCharacters($param->getSourceMyFile()->getName());

            return $return;
        }

        if (!is_null($myDef->original->getDef())) {
            $return["source_name"] = \progpilot\Utils::printDefinition(
                $myDef,
                $myDef->original->getDef()
            );
            $return["source_line"] = $myDef->original->getDef()[0]->getLine();
            $return["source_column"] = $myDef->original->getDef()[0]->getColumn();
            $return["source_file"] = \progpilot\Utils::encodeCharacters(
                $myDef->original->getDef()[0]->getSourceMyFile()->getName()
            );
            return $return;
        }

        $return["source_name"] = \progpilot\Utils::printDefinition($myDef);
        $return["source_line"] = $myDef->getLine();
        $return["source_column"] = $myDef->getColumn();
        $return["source_file"] = \progpilot\Utils::encodeCharacters($myDef->getSourceMyFile()->getName());
        
        return $return;
    }
}
