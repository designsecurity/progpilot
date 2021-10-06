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
        echo "getArrayIndexAsAString 1\n";

        if (is_array($arrValue) && is_array($searchedDim)) {
            $searchedDimKey = array_keys($searchedDim);
            echo "searchedDimKey => '".$searchedDimKey[0]."'\n";

            if (array_key_exists($searchedDimKey[0], $arrValue)) {
                echo "array_key_exists\n";
                return Analysis::getArrayIndexAsAString(
                    $arrValue[$searchedDimKey[0]],
                    $searchedDim[$searchedDimKey[0]]
                );
            }
        }

        echo "getArrayIndexAsAString 2\n";
            
        if (!is_array($searchedDim)) {
            echo "getArrayIndexAsAString 3\n";
            return true;
        }

        return false;
    }

    public static function isSubDimensionOfArray($def, $searchedDim)
    {
        echo "isSubDimensionOfArray 1\n";

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
        echo "isASource 1\n";
        var_dump($arrayValue);


        $source = $context->inputs->getSourceByName(
            $context,
            null,
            $def,
            false,
            false,
            $arrayValue
        );
        
        echo "isASource 2\n";
        if (!is_null($source)) {
            echo "isASource 3\n";
            return true;
        }

        return false;
    }


    public static function updateBlocksOfDef($context, $def)
    {
        echo "updateBlocksOfDef\n";
        $def->printStdout();

        if (!is_null($def->getParamToArg())) {
            $def = $def->getParamToArg();
        }

        echo "updateBlocksOfDef currentid = '".$context->getCurrentBlock()->getId()."' foreach2\n";
        $def->printStdout();

        foreach ($def->getStates() as $state) {
            echo "updateBlocksOfDef currentid = '".$context->getCurrentBlock()->getId()."' foreach2\n";
            $state->printStdout();
            if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                echo "updateBlocksOfDef currentid = '".$context->getCurrentBlock()->getId()."' foreach3\n";
                Analysis::updateBlocksOfArrayElements($context, $state);
            } elseif ($state->isType(MyDefinition::TYPE_INSTANCE)) {
                echo "updateBlocksOfDef currentid = '".$context->getCurrentBlock()->getId()."' foreach4\n";
                Analysis::updateBlocksOfProperties($context, $state);
            }
        }
    }

    public static function blockSwitching($context, $myFunc)
    {
        $tmpDefs = $myFunc->getDefs();
        echo "blockSwitching currentid = '".$context->getCurrentBlock()->getId()."' namefunction '".$myFunc->getName()."' 1\n";
        foreach ($tmpDefs->getDefs() as $defs) {
            foreach ($defs as $def) {
                Analysis::updateBlocksOfDef($context, $def);
            }
        }
    }

    public static function updateBlocksOfArrayElement($context, $arrayElement)
    {
        echo "updateBlocksOfArrayElement\n";
        $states = [];

        $myBlock = $context->getCurrentBlock();
        echo "updateBlocksOfArrayElement blockid = '".$myBlock->getId()."' good block\n";
        $states = [];
        $blockParents = array_merge($myBlock->getParents(), $myBlock->getVirtualParents());

        foreach ($blockParents as $parentMyBlock) {
            echo "updateBlocksOfArrayElement parentblockid = '".$parentMyBlock->getId()."' \n";
            $state = $arrayElement->getState($parentMyBlock->getId());
            if (!is_null($state) && !in_array($state, $states, true)) {
                echo "updateBlocksOfArrayElement parentblockid = '".$parentMyBlock->getId()."' getstate\n";
                $states[] = $state;
            }
        }

        $newstate = Analysis::mergeDefStates($states);
        echo "updateBlocksOfArrayElement merged new state\n";
        $newstate->printStdout();

        $arrayElement->setState($newstate, $myBlock->getId());
        echo "updateBlocksOfArrayElement merged new arrayDef\n";
        $arrayElement->printStdout();
    }

    public static function updateBlocksOfArrayElements($context, $state)
    {
        echo "updateBlocksOfArrays\n";

        $arrayIndexes = $state->getArrayIndexes();
        foreach ($arrayIndexes as $arrayIndexArr) {
            $arrayDef = $arrayIndexArr->def;
            echo "updateBlocksOfArrays 3\n";
            Analysis::updateBlocksOfArrayElement($context, $arrayDef);
            Analysis::updateBlocksOfDef($context, $arrayDef);
        }
    }

    public static function updateBlocksOfProperty($context, $property)
    {
        foreach ($context->getCurrentFunc()->getBlocks() as $myBlock) {
            echo "updateBlocksOfProperties blockid = '".$myBlock->getId()."'\n";
            $blockParents = $myBlock->getVirtualParents();

            $existingState = $property->getState($myBlock->getId());
                        
            // the state has been already computer, we don't need to update that
            // unless there is a new parent that have been added
            if (is_null($existingState) || $myBlock->doNeedUpdateOfState()) {
                echo "updateBlocksOfProperties merged new PARENTS\n";
                $states = [];
                foreach ($blockParents as $parentMyBlock) {
                    echo "updateBlocksOfProperties parentblockid = '".$parentMyBlock->getId()."' \n";
                    $state = $property->getState($parentMyBlock->getId());
                    if (!is_null($state)) {
                        echo "updateBlocksOfProperties parentblockid = '".$parentMyBlock->getId()."' getstate\n";
                        $states[] = $state;
                    }
                }

                echo "updateBlocksOfProperties merged new state before count states = '".count($states)."'\n";
                $newstate = Analysis::mergeDefStates($states);
                echo "updateBlocksOfProperties merged new state\n";

                $property->setState($newstate, $myBlock->getId());
                echo "updateBlocksOfProperties merged new property\n";
            }
        }
    }

    public static function updateBlocksOfProperties($context, $state)
    {
        echo "updateBlocksOfProperties START\n";
        $idObject = $state->getObjectId();
        $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);

        if (!is_null($tmpMyClass)) {
            foreach ($tmpMyClass->getProperties() as $property) {
                echo "updateBlocksOfProperties property\n";
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
        echo "forEachTaintedByDefs -1\n";

        foreach ($def->getStates() as $state) {
            $taintedDefs = $state->getTaintedByDefs();
            foreach ($taintedDefs as $taintedByDef) {
                $taintedDef = $taintedByDef[0];
                $taintedState = $taintedByDef[1];

                echo "forEachTaintedByDefs 0\n";

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



    public static function listOfTreeValues($lastKnownValues)
    {
        $values = [];
        for ($i = 0; $i < count($lastKnownValues[0]); $i ++) {
            $start = $lastKnownValues[0][$i];
            for ($j = 0; $j < count($lastKnownValues[1]); $j ++) {
                $middle = $lastKnownValues[1][$j];
                for ($k = 0; $k < count($lastKnownValues[2]); $k ++) {
                    $end = $lastKnownValues[2][$k];
                    $string = $start.$middle.$end;
                    $values[] = $string;
                }
            }
        }

        return $values;
    }

    public static function listOfTwoValues($lastKnownValues)
    {
        $values = [];
        for ($i = 0; $i < count($lastKnownValues[0]); $i ++) {
            $start = $lastKnownValues[0][$i];
            for ($k = 0; $k < count($lastKnownValues[1]); $k ++) {
                $end = $lastKnownValues[1][$k];
                $string = $start.$end;
                $values[] = $string;
            }
        }

        return $values;
    }

    public static function listOfOneValues($lastKnownValues)
    {
        $values = [];
        for ($i = 0; $i < count($lastKnownValues[0]); $i ++) {
            $string = $lastKnownValues[0][$i];
            $values[] = $string;
        }

        return $values;
    }


    public static function adjustArrayValues(&$lastKnownValues)
    {
        $max = 0;
        for ($i = 0; $i < count($lastKnownValues); $i ++) {
            if (count($lastKnownValues[$i]) > $max) {
                $max = count($lastKnownValues[$i]);
            }
        }

        for ($i = 0; $i < count($lastKnownValues); $i ++) {
            if (count($lastKnownValues[$i]) < $max) {
                $missingElements = $max - count($lastKnownValues[$i]);
                for ($j = 0; $j < $missingElements; $j ++) {
                    array_push($lastKnownValues[$i], "");
                }
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

    public static function computeConcatenatedLastKnownValues($lastKnownValues)
    {
        Analysis::adjustArrayValues($lastKnownValues);

        switch (count($lastKnownValues)) {
            case 1:
                echo "computeConcatenatedLastKnownValues 1\n";
                return Analysis::listOfOneValues($lastKnownValues);
            case 2:
                echo "computeConcatenatedLastKnownValues 2\n";
                return Analysis::listOfTwoValues($lastKnownValues);
            case 3:
                echo "computeConcatenatedLastKnownValues 3\n";
                return Analysis::listOfTreeValues($lastKnownValues);
            default:
                break;
        }
        
        return [];
    }

    public static function mergeDefsBlockIdStates($defs, $concatValues, $block)
    {
        $blockId = $block->getId();

        $myState = new MyDefState;
        echo "mergeDefsBlockIdStates\n";

        $oneStateNotSanitizer = false;
        foreach ($defs as $def) {
            echo "mergeDefsBlockIdStates 0 blockId = '$blockId'\n";
            $def->printStdout();

            if ($def->isType(MyDefinition::TYPE_ARRAY_ELEMENT)
                || $def->isType(MyDefinition::TYPE_PROPERTY)) {
                echo "mergeDefsBlockIdStates 1 blockid = '$blockId'\n";
                $state = $def->getState($blockId);
            //$state = $def->getCurrentState();
            } else {
                echo "mergeDefsBlockIdStates 2\n";
                $state = $def->getCurrentState();
            }

            if (!is_null($state)) {
                echo "mergeDefsBlockIdStates 3\n";
                $state->printStdout();
                if ($state->isTainted() && !AssertionAnalysis::temporarySimple($block, $def)) {
                    echo "mergeDefsBlockIdStates 4\n";
                    $myState->setTainted(true);
                    $myState->addTaintedByDef([$def, $state]);
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

                echo "mergeDefsBlockIdStates 5 '".$state->getObjectId()."'\n";
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
                    echo "mergeDefsBlockIdStates 6\n";
                    foreach ($state->getArrayIndexes() as $oriArrayIndex) {
                        echo "mergeDefsBlockIdStates 7 index:\n";
                        var_dump($oriArrayIndex->index);
                        //$tmpDef = clone $oriArrayIndex->def;
                        echo "mergeDefsBlockIdStates 8 index:\n";
                        $myState->addArrayIndex($oriArrayIndex->index, $oriArrayIndex->def);
                    }
    
                    $myState->addType(MyDefinition::TYPE_ARRAY);
                }

                $myState->setIsEmbeddedByChars($state->getIsEmbeddedByChars(), true);
                $myState->setCast($state->getCast());
                $myState->setLabel($state->getLabel());

                echo "mergeDefsBlockIdStates 9 '".count($concatValues)."'\n";
                $values = count($concatValues) ? $concatValues : $state->getLastKnownValues();
                foreach ($values as $value) {
                    echo "mergeDefsBlockIdStates 10\n";
                    $myState->addLastKnownValue($value);
                }
            }
        }

        return $myState;
    }

    public static function mergeDefStates($states)
    {
        $myState = new MyDefState;

        echo "mergeDefStates 1\n";

        $sanitizedTypes = [];
        foreach ($states as $state) {
            echo "mergeDefStates 2\n";
            if ($state->isTainted()) {
                echo "mergeDefStates 3 is tainted\n";
                $myState->setTainted(true);
                foreach ($state->getTaintedByDefs() as $taintedDef) {
                    $myState->addTaintedByDef($taintedDef);
                }
            }

            if ($state->isSanitized()) {
                echo "mergeDefStates 4 is sanitized\n";
                foreach ($state->getTypeSanitized() as $typeSanitized) {
                    echo "mergeDefStates 5 '$typeSanitized' is sanitized\n";
                    $sanitizedTypes["".$typeSanitized.""][] = true;
                }
            }

            if ($state->getObjectId() !== -1) {
                echo "mergeDefStates 6\n";
                $myState->addType(MyDefinition::TYPE_INSTANCE);
                $myState->setObjectId($state->getObjectId());
            }

            if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                echo "mergeDefStates 6 TYPE ARRAY\n";
                foreach ($state->getArrayIndexes() as $oriArrayIndex) {
                    echo "mergeDefStates 6 TYPE ARRAY FOREACH index:\n";
                    var_dump($oriArrayIndex->index);
                    if (!$myState->isArrayIndexExists($oriArrayIndex->index)) {
                        $tmpDef = clone $oriArrayIndex->def;
                        $myState->addArrayIndex($oriArrayIndex->index, $tmpDef);
                    }
                }

                $myState->addType(MyDefinition::TYPE_ARRAY);
            }

            echo "mergeDefStates 6b\n";
            foreach ($state->getLastKnownValues() as $value) {
                echo "mergeDefStates 6c\n";
                $myState->addLastKnownValue($value);
            }

            $myState->setIsEmbeddedByChars($state->getIsEmbeddedByChars(), true);
            $myState->setCast($state->getCast());
            $myState->setLabel($state->getLabel());
        }

        echo "mergeDefStates 7\n";
        foreach ($sanitizedTypes as $TypeKey => $arrayValue) {
            echo "mergeDefStates 8\n";
            if (count($arrayValue) === count($states)) {
                echo "mergeDefStates 9\n";
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
