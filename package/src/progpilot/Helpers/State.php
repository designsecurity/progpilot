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

class State
{
    public static function updateBlocksOfDef($context, $def)
    {
        if (!is_null($def->getParamToArg())) {
            $def = $def->getParamToArg();
        }

        foreach ($def->getStates() as $state) {
            if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                State::updateBlocksOfArrayElements($context, $state);
            } elseif ($state->isType(MyDefinition::TYPE_INSTANCE)) {
                State::updateBlocksOfProperties($context, $state);
            }
        }
    }

    public static function blockSwitching($context, $myFunc)
    {
        $tmpDefs = $myFunc->getDefs();
        foreach ($tmpDefs->getDefs() as $defs) {
            foreach ($defs as $def) {
                State::updateBlocksOfDef($context, $def);
            }
        }
        
        foreach ($context->getCurrentFunc()->getBlocks() as $myBlock) {
            $myBlock->setNeedUpdateOfState(false);
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

        if(count($states) === 1) {
            $newstate = $states[0];
        }
        else {
            $newstate = State::mergeDefStates($states);        
            $arrayElement->addState($newstate);
        }

        $arrayElement->assignStateToBlockId($newstate->getId(), $myBlock->getId());
    }

    public static function updateBlocksOfArrayElements($context, $state)
    {
        $arrayIndexes = $state->getArrayIndexes();
        foreach ($arrayIndexes as $arrayIndexArr) {
            $arrayDef = $arrayIndexArr->def;
            State::updateBlocksOfArrayElement($context, $arrayDef);
            State::updateBlocksOfDef($context, $arrayDef);
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

                if(count($states) === 1) {
                    $newstate = $states[0];
                }
                else {
                    $newstate = State::mergeDefStates($states);     
                    $property->addState($newstate);
                }

                $property->assignStateToBlockId($newstate->getId(), $myBlock->getId());

                //$property->setState($newstate, $myBlock->getId());
            }
        }
    }

    public static function updateBlocksOfProperties($context, $state)
    {
        $idObject = $state->getObjectId();
        $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);

        if (!is_null($tmpMyClass)) {
            foreach ($tmpMyClass->getProperties() as $property) {
                State::updateBlocksOfProperty($context, $property);
                State::updateBlocksOfDef($context, $property);
            }
        }
    }

    public static function mergeDefsBlockIdStates($defs, $concatValues, $block)
    {
        $blockId = $block->getId();

        $myState = new MyDefState;

        $oneStateNotSanitizer = false;

        echo "mergeDefsBlockIdStates 1\n";
        foreach ($defs as $def) {
            if ($def->isType(MyDefinition::TYPE_ARRAY_ELEMENT)
                || $def->isType(MyDefinition::TYPE_PROPERTY)) {
                    echo "mergeDefsBlockIdStates 2 '$blockId'\n";
                $state = $def->getState($blockId);
            //$state = $def->getCurrentState();
            } else {
                echo "mergeDefsBlockIdStates 3\n";
                $state = $def->getCurrentState();
            }

            echo "mergeDefsBlockIdStates 4\n";

            if (!is_null($state)) {
                echo "mergeDefsBlockIdStates 5\n";
                $state->printStdout();
                if ($state->isTainted() && !AssertionAnalysis::temporarySimple($block, $def)) {
                    $myState->setTainted(true);

                    // for the flow we don't want built-in variables
                    if ($def->getName() === "built-in-concatenation"
                       /*|| $def->getName() === "built-in-index-array"*/) {
                        $myState->setTaintedByDefs($state->getTaintedByDefs());
                    } else {
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
                }

                if ($state->getObjectId() !== -1) {
                    $myState->setObjectId($state->getObjectId());
                }

                if ($state->isType(MyDefinition::TYPE_INSTANCE)) {
                    $myState->addType(MyDefinition::TYPE_INSTANCE);
                }

                if ($state->isType(MyDefinition::ALL_PROPERTIES_TAINTED)) {
                    $myState->addType(MyDefinition::ALL_PROPERTIES_TAINTED);
                    $myState->addTaintedByDef([$def, $state]);
                }

                if ($state->isType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED)) {
                    $myState->addType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED);
                    $myState->addTaintedByDef([$def, $state]);
                }

                if ($state->isType(MyDefinition::TYPE_ARRAY)) {
                    foreach ($state->getArrayIndexes() as $oriArrayIndex) {
                        $myState->addArrayIndex($oriArrayIndex->index, $oriArrayIndex->def);
                    }
    
                    $myState->addType(MyDefinition::TYPE_ARRAY);
                }

                if ($state->isType(MyDefinition::TYPE_ARRAY_ARRAY)) {
                    $myState->addType(MyDefinition::TYPE_ARRAY_ARRAY);
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

            if ($state->isType(MyDefinition::TYPE_ARRAY_ARRAY)) {
                $myState->addType(MyDefinition::TYPE_ARRAY_ARRAY);
            }

            if ($state->isType(MyDefinition::ALL_PROPERTIES_TAINTED)) {
                $myState->addType(MyDefinition::ALL_PROPERTIES_TAINTED);
                foreach ($state->getTaintedByDefs() as $taintedDef) {
                    $myState->addTaintedByDef($taintedDef);
                }
            }

            if ($state->isType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED)) {
                $myState->addType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED);
                foreach ($state->getTaintedByDefs() as $taintedDef) {
                    $myState->addTaintedByDef($taintedDef);
                }
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
}
