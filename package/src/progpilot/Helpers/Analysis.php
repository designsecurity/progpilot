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


    public static function isASource($context, $def, $arrayValue)
    {
        $source = $context->inputs->getSourceByName(
            $context,
            null,
            $def,
            false,
            false,
            $arrayValue
        );
        
        if (!is_null($source)) {
            return true;
        }

        return false;
    }


    public static function updateBlocksOfDef($context, $def)
    {
        if (!is_null($def->getParamToArg())) {
            $def = $def->getParamToArg();
        }

        foreach ($def->getStates() as $state) {
            if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                Analysis::updateBlocksOfArrayElements($context, $state);
            } elseif ($state->isType(MyDefinition::TYPE_INSTANCE)) {
                Analysis::updateBlocksOfProperties($context, $state);
            }
        }
    }

    public static function blockSwitching($context, $myFunc)
    {
        $tmpDefs = $myFunc->getDefs();
        foreach ($tmpDefs->getDefs() as $defs) {
            foreach ($defs as $def) {
                Analysis::updateBlocksOfDef($context, $def);
            }
        }
    }

    public static function updateBlocksOfArrayElement($context, $arrayElement)
    {
        $states = [];

        $myBlock = $context->getCurrentBlock();
        $states = [];
        $blockParents = array_merge($myBlock->getParents(), $myBlock->getVirtualParents());

        foreach ($blockParents as $parentMyBlock) {
            $state = $arrayElement->getState($parentMyBlock->getId());
            if (!is_null($state) && !in_array($state, $states, true)) {
                $states[] = $state;
            }
        }

        $newstate = Analysis::mergeDefStates($states);
        $arrayElement->setState($newstate, $myBlock->getId());
    }

    public static function updateBlocksOfArrayElements($context, $state)
    {
        $arrayIndexes = $state->getArrayIndexes();
        foreach ($arrayIndexes as $arrayIndexArr) {
            $arrayDef = $arrayIndexArr->def;
            Analysis::updateBlocksOfArrayElement($context, $arrayDef);
            Analysis::updateBlocksOfDef($context, $arrayDef);
        }
    }

    public static function updateBlocksOfProperty($context, $property)
    {
        foreach ($context->getCurrentFunc()->getBlocks() as $myBlock) {
            $blockParents = $myBlock->getVirtualParents();

            $existingState = $property->getState($myBlock->getId());
                        
            // the state has been already computer, we don't need to update that
            // unless there is a new parent that have been added
            if (is_null($existingState) || $myBlock->doNeedUpdateOfState()) {
                $states = [];
                foreach ($blockParents as $parentMyBlock) {
                    $state = $property->getState($parentMyBlock->getId());
                    if (!is_null($state)) {
                        $states[] = $state;
                    }
                }

                $newstate = Analysis::mergeDefStates($states);
                $property->setState($newstate, $myBlock->getId());
            }
        }
    }

    public static function updateBlocksOfProperties($context, $state)
    {
        $idObject = $state->getObjectId();
        $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);

        if (!is_null($tmpMyClass)) {
            foreach ($tmpMyClass->getProperties() as $property) {
                Analysis::updateBlocksOfProperty($context, $property);
                Analysis::updateBlocksOfDef($context, $property);
            }
        }

        foreach ($context->getCurrentFunc()->getBlocks() as $myBlock) {
            $myBlock->setNeedUpdateOfState(false);
        }
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

    
    public static function copyStates($states, $def)
    {
        foreach ($states as $id => $state) {
            $def->setState($state, $id);
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

    public static function mergeDefsBlockIdStates($defs, $concatValues, $block)
    {
        $blockId = $block->getId();

        $myState = new MyDefState;

        $oneStateNotSanitizer = false;
        foreach ($defs as $def) {
            if ($def->isType(MyDefinition::TYPE_ARRAY_ELEMENT)
                || $def->isType(MyDefinition::TYPE_PROPERTY)) {
                $state = $def->getState($blockId);
            //$state = $def->getCurrentState();
            } else {
                $state = $def->getCurrentState();
            }
            
            if (!is_null($state)) {
                if ($state->isTainted() && !AssertionAnalysis::temporarySimple($block, $def)) {
                    $myState->setTainted(true);

                    // for the flow we don't want built-in variables
                    if ($def->getName() === "built-in-concatenation") { 
                        $myState->setTaintedByDefs($state->getTaintedByDefs());
                    }
                    else {
                        $myState->addTaintedByDef([$def, $state]);
                    }
                }

                if ($state->isSanitized() && !$oneStateNotSanitizer) {
                    $myState->setSanitized(true);
                    foreach ($state->getTypeSanitized() as $typeSanitized) {
                        $myState->addTypeSanitized($typeSanitized);
                    }
                } else {
                    // if one value is not sanitized it's enough to not sanitize
                    // see custom/sanitizer4.php
                    $myState->setSanitized(false);
                    $myState->setTypeSanitized([]);
                    $oneStateNotSanitizer = true;
                }

                if ($state->getObjectId() !== -1) {
                    $myState->setObjectId($state->getObjectId());
                }

                if ($state->isType(MyDefinition::TYPE_INSTANCE)) {
                    $myState->addType(MyDefinition::TYPE_INSTANCE);
                }

                if ($state->isType(MyDefinition::ALL_PROPERTIES_TAINTED)) {
                    $myState->addType(MyDefinition::ALL_PROPERTIES_TAINTED);
                }

                if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                    foreach ($state->getArrayIndexes() as $oriArrayIndex) {
                        $myState->addArrayIndex($oriArrayIndex->index, $oriArrayIndex->def);
                    }
    
                    $myState->addType(MyDefinition::TYPE_ARRAY);
                }

                $myState->setIsEmbeddedByChars($state->getIsEmbeddedByChars(), true);
                $myState->setCast($state->getCast());
                $myState->setLabel($state->getLabel());

                $values = count($concatValues) ? $concatValues : $state->getLastKnownValues();
                foreach ($values as $value) {
                    $myState->addLastKnownValue($value);
                }
            }
        }

        return $myState;
    }

    public static function mergeDefStates($states)
    {
        $myState = new MyDefState;

        $sanitizedTypes = [];
        foreach ($states as $state) {
            if ($state->isTainted()) {
                $myState->setTainted(true);
                foreach ($state->getTaintedByDefs() as $taintedDef) {
                    $myState->addTaintedByDef($taintedDef);
                }
            }

            if ($state->isSanitized()) {
                foreach ($state->getTypeSanitized() as $typeSanitized) {
                    $sanitizedTypes["".$typeSanitized.""][] = true;
                }
            }

            if ($state->getObjectId() !== -1) {
                $myState->addType(MyDefinition::TYPE_INSTANCE);
                $myState->setObjectId($state->getObjectId());
            }

            if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                foreach ($state->getArrayIndexes() as $oriArrayIndex) {
                    if (!$myState->isArrayIndexExists($oriArrayIndex->index)) {
                        $tmpDef = clone $oriArrayIndex->def;
                        $myState->addArrayIndex($oriArrayIndex->index, $tmpDef);
                    }
                }

                $myState->addType(MyDefinition::TYPE_ARRAY);
            }

            foreach ($state->getLastKnownValues() as $value) {
                $myState->addLastKnownValue($value);
            }

            $myState->setIsEmbeddedByChars($state->getIsEmbeddedByChars(), true);
            $myState->setCast($state->getCast());
            $myState->setLabel($state->getLabel());
        }

        foreach ($sanitizedTypes as $TypeKey => $arrayValue) {
            if (count($arrayValue) === count($states)) {
                $myState->setSanitized(true);
                $myState->addTypeSanitized($TypeKey);
            }
        }

        return $myState;
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

        if (! $definition->isInstance()
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
