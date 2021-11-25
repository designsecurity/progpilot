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
use progpilot\Objects\MyClass;
use progpilot\Analysis\ResolveDefs;
use progpilot\Analysis\TaintAnalysis;
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

        if (($nbExecutions >= 1 && $nbExecutions < 5 && $lastExecutionTime >= $threshold1)
            || ($nbExecutions >= 4 && $nbExecutions < 10 && $lastExecutionTime >= $threshold2)
                || $nbExecutions >= 10) {
            return false;
        }

        return true;
    }

    public static function getBytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        if (!is_numeric($last)) {
            $val = (int) substr($val, 0, -1);
            switch ($last) {
            // The 'G' modifier is available since PHP 5.1.0
                case 'g':
                    $val *= 1024;
                    // no break
                case 'm':
                    $val *= 1024;
                    // no break
                case 'k':
                    $val *= 1024;
            }
        }
    
        return $val;
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

    public static function checkCallStackReachMaxTime($context)
    {
        $callStack = $context->getCallStack();
        $endTime = microtime(true);

        if (is_array($callStack)) {
            foreach ($callStack as $call) {
                $myFunc = $call[0];
                $startTime = $myFunc->getStartExecutionTime();
                $diff = $endTime - $startTime;

                if ($diff > $context->getMaxFileAnalysisDuration()) {
                    return true;
                }
            }
        }
        
        return false;
    }

    public static function checkDeeplyIfDefIsTainted($def)
    {
        $arrayTotal[] = $def;
        $defsToAnalyze[] = $def;
        while (!empty($defsToAnalyze)) {
            $def = array_pop($defsToAnalyze);
            foreach ($def->getStates() as $state) {
                if ($state->isTainted()) {
                    return true;
                }

                foreach ($state->getArrayIndexes() as $arrayElement) {
                    if ($arrayElement->def !== $def
                        && !in_array($arrayElement->def, $defsToAnalyze, true)
                            && !in_array($arrayElement->def, $arrayTotal, true)
                                && count($arrayTotal) < 50) {
                        $defsToAnalyze[] = $arrayElement->def;
                        $arrayTotal[] = $arrayElement->def;
                    }
                }
            }
        }

        return false;
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

            $statesPastArgs = $myFunc->getStatePastArguments();
            for ($i = 0; $i < count($params); $i++) {
                if ($instruction->isPropertyExist("argdef$i")) {
                    $defArg = $instruction->getProperty("argdef$i");

                    if (Analysis::checkDeeplyIfDefIsTainted($defArg)) {
                        return true;
                    }

                    if (empty($defArg->getCurrentState()->getLastKnownValues())) {
                        return false;
                    }

                    if (isset($statesPastArgs[$i]) && is_array($statesPastArgs[$i])) {
                        foreach ($statesPastArgs[$i] as $statePastArg) {
                            if ($defArg->getCurrentState()->getLastKnownValues()
                                === $statePastArg->getLastKnownValues()) {
                                return false;
                            }
                        }
                    } else {
                        return true;
                    }
                }
            }
        }

        return false;
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

    public static function createObject($context, $myDef)
    {
        if ($myDef->isType(MyDefinition::TYPE_INSTANCE)
            || $myDef->getCurrentState()->isType(MyDefinition::TYPE_INSTANCE)) {
            $idObject = $context->getObjects()->addObject();

            if ($myDef->getCurrentState()->getObjectId() === -1) {
                $myDef->getCurrentState()->setObjectId($idObject);
                $myDef->getCurrentState()->addType(MyDefinition::TYPE_INSTANCE);

                if (!empty($myDef->getClassName())) {
                    $myClass = $context->getClasses()->getMyClass($myDef->getClassName());
                    if (is_null($myClass)) {
                        $myClass = new MyClass(
                            $myDef->getLine(),
                            $myDef->getColumn(),
                            $myDef->getClassName()
                        );
                    } else {
                        $myClass = clone $myClass;
                    }

                    $context->getObjects()->addMyclassToObject($idObject, $myClass);
                }
            }
        }
    }
}
