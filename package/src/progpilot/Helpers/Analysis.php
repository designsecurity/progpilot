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

    public static function updateBlocksOfArrayElement($context, $arrayElement)
    {
        echo "updateBlocksOfArrayElement\n";
        $arrayElement->printStdout();
        $states = [];

        foreach ($context->getCurrentFunc()->getBlocks() as $myBlock) {
            echo "updateBlocksOfArrayElement blockid = '".$myBlock->getId()."'\n";
            if ($myBlock->getId() === $context->getCurrentBlock()->getId()) {
                echo "updateBlocksOfArrayElement blockid = '".$myBlock->getId()."' good block\n";
                $states = [];
                $blockParents = array_merge($myBlock->getParents(), $myBlock->getVirtualParents());

                foreach ($blockParents as $parentMyBlock) {
                    echo "updateBlocksOfArrayElement parentblockid = '".$parentMyBlock->getId()."' \n";
                    $state = $arrayElement->getState($parentMyBlock->getId());
                    if (!is_null($state)) {
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
        }
    }

    public static function updateBlocksOfArrayElements($context, $array)
    {
        echo "updateBlocksOfArrays\n";
        $array->printStdout();

        $arrayIndexes = $array->getCurrentState()->getArrayIndexes();
        foreach ($arrayIndexes as $arrayIndexArr) {
            $arrayDef = $arrayIndexArr->def;
            echo "updateBlocksOfArrays 1\n";
            if ($arrayDef->getCurrentState()->isType(MyDefinition::TYPE_ARRAY)) {
                echo "updateBlocksOfArrays 2\n";
                $arrayIndexesRec = $arrayDef->getCurrentState()->getArrayIndexes();
                foreach ($arrayIndexesRec as $arrayIndexArrRec) {
                    $arrayDefRec = $arrayIndexArrRec->def;
                    Analysis::updateBlocksOfArrayElement($context, $arrayDefRec);
                }
            }
            else {
                echo "updateBlocksOfArrays 3\n";
                Analysis::updateBlocksOfArrayElement($context, $arrayDef);
            }
        }
    }

    public static function updateBlocksOfProperties($context, $instance)
    {
        echo "updateBlocksOfProperties\n";
        $idObject = $instance->getCurrentState()->getObjectId();
        $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);

        if (!is_null($tmpMyClass)) {
            foreach ($tmpMyClass->getProperties() as $property) {
                echo "updateBlocksOfProperties property\n";
                $property->printStdout();
                $states = [];
                foreach ($context->getCurrentFunc()->getBlocks() as $myBlock) {
                    echo "updateBlocksOfProperties blockid = '".$myBlock->getId()."'\n";
                    $blockParents = array_merge($myBlock->getParents(), $myBlock->getVirtualParents());

                    foreach ($blockParents as $parentMyBlock) {
                        echo "updateBlocksOfProperties parentblockid = '".$parentMyBlock->getId()."' \n";
                        $state = $property->getState($parentMyBlock->getId());
                        if (!is_null($state)) {
                            echo "updateBlocksOfProperties parentblockid = '".$parentMyBlock->getId()."' getstate\n";
                            $states[] = $state;
                        }
                    }

                    $newstate = Analysis::mergeDefStates($states);
                    echo "updateBlocksOfProperties merged new state\n";
                    $newstate->printStdout();

                    $property->setState($newstate, $myBlock->getId());
                    echo "updateBlocksOfProperties merged new property\n";
                    $property->printStdout();
                }
            }
        }
    }

    public static function copyStates($states, $def)
    {
        foreach ($states as $id => $state) {
            $def->setState($state, $id);
        }
    }

    public static function mergeDefsBlockIdStates($defs, $blockId)
    {
        $myState = new MyDefState;
        echo "mergeDefsBlockIdStates\n";

        foreach ($defs as $def) {
            echo "mergeDefsBlockIdStates 0 blockId = '$blockId'\n";
            $def->printStdout();

            if ($def->isType(MyDefinition::TYPE_ARRAY_ELEMENT)
                || $def->isType(MyDefinition::TYPE_PROPERTY)) {
                echo "mergeDefsBlockIdStates 1\n";
                $state = $def->getState($blockId);
            } else {
                echo "mergeDefsBlockIdStates 2\n";
                $state = $def->getCurrentState();
                $state->printStdout();
            }

            if (!is_null($state)) {
                echo "mergeDefsBlockIdStates 3\n";
                if ($state->isTainted()) {
                    echo "mergeDefsBlockIdStates 4\n";
                    $myState->setTainted(true);
                    $myState->addTaintedByDef([$def, $state]);
                }

                if ($state->isSanitized()) {
                    $myState->setSanitized(true);
                    foreach ($state->getTypeSanitized() as $typeSanitized) {
                        $myState->addTypeSanitized($typeSanitized);
                    }
                }

                echo "mergeDefsBlockIdStates 5 '".$state->getObjectId()."'\n";
                if ($state->getObjectId() !== -1) {
                    $myState->addType(MyDefinition::TYPE_INSTANCE);
                    $myState->setObjectId($state->getObjectId());
                }

                if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                    echo "mergeDefsBlockIdStates 6\n";
                    foreach ($state->getArrayIndexes() as $oriArrayIndex) {
                        echo "mergeDefsBlockIdStates 7 index:\n";
                        var_dump($oriArrayIndex->index);
                        $oriArrayIndex->def->printStdout();
                        $tmpDef = clone $oriArrayIndex->def;
                        echo "mergeDefsBlockIdStates 8 index:\n";
                        $tmpDef->printStdout();
                        $myState->addArrayIndex($oriArrayIndex->index, $tmpDef);
                    }
    
                    $myState->addType(MyDefinition::TYPE_ARRAY);
                }

                $myState->setIsEmbeddedByChars($state->getIsEmbeddedByChars(), true);
                $myState->setCast($state->getCast());
                $myState->setLabel($state->getLabel());
            }
        }

        return $myState;
    }

    public static function mergeDefStates($states)
    {
        $myState = new MyDefState;

        echo "mergeDefStates 1\n";

        foreach ($states as $state) {
            echo "mergeDefStates 2\n";
            if ($state->isTainted()) {
                echo "mergeDefStates 3\n";
                $myState->setTainted(true);
                foreach ($state->getTaintedByDefs() as $taintedDef) {
                    $myState->addTaintedByDef($taintedDef);
                }
            }

            if ($state->isSanitized()) {
                $myState->setSanitized(true);
                foreach ($state->getTypeSanitized() as $typeSanitized) {
                    $myState->addTypeSanitized($typeSanitized);
                }
            }

            if ($state->getObjectId() !== -1) {
                echo "mergeDefStates 4\n";
                $myState->addType(MyDefinition::TYPE_INSTANCE);
                $myState->setObjectId($state->getObjectId());
            }

            if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                foreach ($state->getArrayIndexes() as $oriArrayIndex) {
                    $tmpDef = clone $oriArrayIndex->def;
                    $myState->addArrayIndex($oriArrayIndex->index, $tmpDef);
                }

                $myState->addType(MyDefinition::TYPE_ARRAY);
            }

            $myState->setIsEmbeddedByChars($state->getIsEmbeddedByChars(), true);
            $myState->setCast($state->getCast());
            $myState->setLabel($state->getLabel());
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
                                && $defArg->getCurrentState()->getLastKnownValues() === $pastArg->getCurrentState()->getLastKnownValues()
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
    
    public static function checkIfFuncEqualMySpecify($context, $mySpecify, $myFunc, $stackClass = null)
    {
        $checkName = false;
        if ($myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $properties = "eee";
            //$properties = $myFunc->property->getProperties();
            /*
            if (is_array($properties) && isset($properties[count($properties) - 1])) {
                $lastproperty = $properties[count($properties) - 1];
                if ($lastproperty === $mySpecify->getName()) {
                    $checkName = true;
                }
            }
*/
            if ($properties === $mySpecify->getName()) {
                $checkName = true;
            }
        }
                
        $checkInstance = false;
        if (($mySpecify->getName() === $myFunc->getName()) || $checkName) {
            $checkName = true;
            $checkInstance = true;
            
            if ($mySpecify->isInstance() && !is_null($stackClass)) {
                if ($mySpecify->getLanguage() === "php") {
                    $propertiesRule = explode("->", $mySpecify->getInstanceOfName());
                } elseif ($mySpecify->getLanguage() === "js") {
                    $propertiesRule = explode(".", $mySpecify->getInstanceOfName());
                }
                        
                if (is_array($propertiesRule)) {
                    $i = 0;
                    foreach ($propertiesRule as $propertyName) {
                        // if(!isset($stackClass[$i])) && count() == 0 =>
                        //$test = new ClassInconnu;
                        //$test->db->call() (db has no known instance)
                        $foundProperty = true;
                        
                        if (isset($stackClass[$i]) && count($stackClass[$i]) > 0) {
                            $foundProperty = false;
                            foreach ($stackClass[$i] as $propClass) {
                                $objectId = $propClass->getCurrentState()->getObjectId();
                                $myClass = $context->getObjects()->getMyClassFromObject($objectId);
                                        
                                if (!is_null($myClass)
                                    && ($myClass->getName() === $propertyName
                                        || $myClass->getExtendsOf() === $propertyName)) {
                                    $foundProperty = true;
                                    break;
                                }
                            }
                        }
                                
                        if (!$foundProperty) {
                            $checkInstance = false;
                            break;
                        }
                            
                        $i ++;
                    }
                }
            } elseif ($mySpecify->isInstance() && is_null($stackClass)) {
                $checkInstance = false;
            }
        }
        
        return $checkInstance & $checkName;
    }
    
    public static function checkIfDefEqualDefRule($context, $defs, $rule, $def, $myClass = null)
    {
        $definition = $rule->getDefinition();

        echo "checkIfDefEqualDefRule definition name = '".$definition->getName()."' == def name = '".$def->getName()."'\n";

        if (!is_null($myClass)) {
            echo "checkIfDefEqualDefRule myclass name = '".$myClass->getName()."' == extend name = '".$myClass->getExtendsOf()."'\n";
            echo "checkIfDefEqualDefRule defintion getInstanceOfName = '".$definition->getInstanceOfName()."'\n";
        }
        if (! $definition->isInstance()
            && $def->getName() === $definition->getName()) {
            return true;
        }
                    
        if ($definition->isInstance() && !is_null($myClass) &&
            ($myClass->getName() === $definition->getInstanceOfName()
                || $myClass->getExtendsOf() === $definition->getInstanceOfName())) {
            return true;
        }
        
        return false;
    }
}
