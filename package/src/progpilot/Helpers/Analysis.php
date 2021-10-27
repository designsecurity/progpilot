<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Helpers;

use progpilot\Code\MyCode;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;
use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyDefState;
use progpilot\Analysis\ResolveDefs;
use progpilot\Analysis\TaintAnalysis;
use progpilot\Analysis\ValueAnalysis;
use progpilot\Analysis\AssertionAnalysis;

class Analysis
{
    public static function forAllobjects($context, $func, $myClass)
    {
        foreach ($context->getObjects()->getObjects() as $id => $objectClass) {
            $params = array($context, $id, $objectClass, $myClass);
            call_user_func_array(__NAMESPACE__ ."\\$func", $params);
        }
    }

    public static function forDefsInFunctions($context, $func, $myClass)
    {
        foreach ($context->getFunctions()->getFunctions() as $functionsBlocks) {
            foreach ($functionsBlocks as $functionBlock) {
                foreach ($functionBlock->getDefs()->getDefs() as $defsBlocks) {
                    foreach ($defsBlocks as $defBlock) {
                        $params = array($context, $defBlock, $myClass);
                        call_user_func_array(__NAMESPACE__ ."\\$func", $params);
                    }
                }
            }
        }
    }

    public static function forAllDefsOfFunctionExceptReturnDefs($func, $myFunc)
    {
        $returnDefs = $myFunc->getReturnDefs();
        foreach ($myFunc->getDefs()->getDefs() as $defnames) {
            if (is_array($defnames)) {
                foreach ($defnames as $def) {
                    if (!in_array($def, $returnDefs, true)) {
                        $params = array($def, $myFunc->getDefs());
                        call_user_func_array(__NAMESPACE__ ."\\$func", $params);
                    }
                }
            }
        }
    }

    public static function forAllReturnDefsOfFunction($func, $myFunc)
    {
        $initialReturnDefs = $myFunc->getInitialReturnDefs();
        $returnDefs = $myFunc->getReturnDefs();
        $i = 0;
        foreach ($returnDefs as $returnDef) {
            if (isset($initialReturnDefs[$i])) {
                $params = array($returnDef, $initialReturnDefs[$i]);
                call_user_func_array(__NAMESPACE__ ."\\$func", $params);
            }

            $i ++;
        }
    }

    public static function forAllDefsOfFunction($func, $myFunc)
    {
        foreach ($myFunc->getDefs()->getDefs() as $defnames) {
            if (is_array($defnames)) {
                foreach ($defnames as $def) {
                    $params = array($def, $myFunc->getDefs());
                    call_user_func_array(__NAMESPACE__ ."\\$func", $params);
                }
            }
        }
    }

    public static function forAllArgumentsOfFunction($func, $myfunc, $instruction)
    {
        $params = $myfunc->getParams();

        for ($i = 0; $i < count($params); $i++) {
            if ($instruction->isPropertyExist("argdef$i")) { // myfunccall
                $defArg = $instruction->getProperty("argdef$i");
                $params = array($myfunc, $i, $defArg);
                call_user_func_array(__NAMESPACE__ ."\\$func", $params);
            }
        }
    }

    public static function checkIfTimeExecutionIsAcceptable($context, $myFunc)
    {
        $threshold1 = $context->getMaxFileAnalysisDuration() / 4; // 7.5 seconds by default
        $threshold2 = $context->getMaxFileAnalysisDuration() / 15; // 2 seconds by defaults
        $lastExecutionTime = $myFunc->getLastExecutionTime();
        $nbExecutions = $myFunc->getNbExecutions();

        if (($nbExecutions === 1 && $lastExecutionTime >= $threshold1)
            || ($nbExecutions > 4 && $lastExecutionTime >= $threshold2)) {
            return false;
        }

        return true;
    }

    public static function getAssignedDefOfPreviousInstruction($code, $index)
    {
        $previousInstruction = $code[$index - 2];
        if ($previousInstruction->getOpcode() === Opcodes::END_EXPRESSION) {
            $expr = $previousInstruction->getProperty(MyInstruction::EXPR);
            if ($expr->isAssign()) {
                return $expr->getAssignDef();
            }
        }

        return null;
    }

    public static function isInstructionOfType($code, $index, $type)
    {
        if (isset($code[$index])) {
            $instruction = $code[$index];
            if ($instruction->getOpcode() === $type) {
                return true;
            }
        }

        return false;
    }

    public static function getInstruction($code, $index)
    {
        if (isset($code[$index])) {
            return $code[$index];
        }

        return null;
    }

    public static function extractArrayFromArr($originalarr, $indarr)
    {
        if ($originalarr === $indarr) {
            return false;
        }

        $arr = $originalarr;

        if (is_array($indarr)) {
            foreach ($indarr as $ind => $value) {
                if (isset($originalarr[$ind])) {
                    if ($originalarr[$ind] === $indarr[$ind]) {
                        return $originalarr[$ind];
                    }

                    $arr = BuildArrays::extractArrayFromArr($originalarr[$ind], $indarr[$ind]);
                } else {
                    $arr = false;
                }
            }
        }

        return $arr;
    }

    public static function getArrayIndexAsAString($arrValue, $searchedDim)
    {
        if (is_array($arrValue) && is_array($searchedDim)) {
            $searchedDimKey = array_keys($searchedDim);

            if (array_key_exists($searchedDimKey[0], $arrValue)) {
                return Analysis::getArrayIndexAsAString(
                    $arrValue[$searchedDimKey[0]],
                    $searchedDim[$searchedDimKey[0]]
                );
            }
        }
            
        if (!is_array($searchedDim)) {
            return true;
        }

        return false;
    }

    public static function isSubDimensionOfArray($def, $searchedDim)
    {
        if ($def->isType(MyDefinition::TYPE_ARRAY)) {
            if (is_array($searchedDim)) {
                foreach ($def->getArrayIndexes() as $arrayIndex) {
                    return Analysis::getArrayIndexAsAString($arrayIndex->index, $searchedDim);
                }

                return false;
            }
            
            return true;
        }

        return false;
    }


    public static function isASource($context, $def, $myClass, $arrayDim)
    {
        $source = $context->inputs->getSourceByName($def, $myClass, $arrayDim);
        
        if (!is_null($source)) {
            return true;
        }

        return false;
    }

    public static function forEachTaintedByDefs($def, $block, $callback)
    {
        foreach ($def->getStates() as $state) {
            $taintedDefs = $state->getTaintedByDefs();
            foreach ($taintedDefs as $taintedByDef) {
                $taintedDef = $taintedByDef[0];
                $taintedState = $taintedByDef[1];

                $params = array($taintedDef, $block);
                call_user_func_array(__NAMESPACE__ ."\\$callback", $params);
            }
        }
    }

    public static function updateNbChars(&$nbChars, $string, $arrayChars)
    {
        if (is_string($string)) {
            foreach ($arrayChars as $char) {
                if (!isset($nbChars[$char])) {
                    $nbChars[$char] = 0;
                }
            }

            for ($i = 0; $i < strlen($string); $i++) {
                foreach ($arrayChars as $char) {
                    if ($string[$i] === $char) {
                        $nbChars[$char] ++;
                    }
                }
            }
        }
    }

    public static function getNbChars($string, $arrayChars)
    {
        $nbChars = [];

        if (is_string($string)) {
            foreach ($arrayChars as $char) {
                $nbChars[$char] = 0;
            }
            
            for ($i = 0; $i < strlen($string); $i++) {
                foreach ($arrayChars as $char) {
                    if ($string[$i] === $char) {
                        $nbChars[$char] ++;
                    }
                }
            }
        }

        return $nbChars;
    }

    public static function checkIfOneFunctionArgumentIsNew($myFunc, $instruction)
    {
        if (!is_null($myFunc)) {
            $params = $myFunc->getParams();

            if (empty($params)) {
                // if it's not a method and empty params,
                // then we can't have additional tainted return
                return false;
            }

            for ($i = 0; $i < count($params); $i++) {
                if ($instruction->isPropertyExist("argdef$i")) {
                    $defArg = $instruction->getProperty("argdef$i");

                    $pastArgs = $myFunc->getPastArguments();
                    if (isset($pastArgs[$i]) && is_array($pastArgs[$i])) {
                        foreach ($pastArgs[$i] as $pastArg) {
                            if (!$defArg->getCurrentState()->isTainted()
                                && $defArg->getCurrentState()->getLastKnownValues()
                                === $pastArg->getCurrentState()->getLastKnownValues()
                                    && $defArg->getType() === $pastArg->getType()) {
                                return false;
                            }
                        }
                    } else {
                        return true;
                    }
                }
            }
        }

        return true;
    }
    
    public static function checkIfFuncEqualMySpecify($context, $mySpecify, $myFunc, $myClass = null)
    {
        if (!$mySpecify->isInstance()
            && $mySpecify->getName() === $myFunc->getName()) {
            return true;
        }
                    
        if ($mySpecify->isInstance() && !is_null($myClass) &&
            ($myClass->getName() === $mySpecify->getInstanceOfName()
                || $myClass->getExtendsOf() === $mySpecify->getInstanceOfName())) {
            return true;
        }
        
        return false;
    }
    
    public static function checkIfDefEqualDefRule($context, $defs, $rule, $def, $myClass = null)
    {
        $definition = $rule->getDefinition();

        if (!$definition->isInstance()
            && $def->getName() === $definition->getName()) {
            return true;
        }

        if ($definition->isInstance() && !is_null($myClass) && $def->getName() === $definition->getName() &&
            ($myClass->getName() === $definition->getInstanceOfName()
                || $myClass->getExtendsOf() === $definition->getInstanceOfName())) {
            return true;
        }
        
        return false;
    }
}
