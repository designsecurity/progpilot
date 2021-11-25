<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Helpers;

use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyProperty;
use progpilot\Objects\MyAssertion;

use function DeepCopy\deep_copy;

class Callbacks
{
    public static function modifyMyclassOfObject($context, $idObject, $currentMyclass, $newMyclass)
    {
        if (!is_null($currentMyclass) && $currentMyclass->getName() === $newMyclass->getName()) {
            $context->getObjects()->addMyclassToObject($idObject, $newMyclass);
        }
    }

    public static function addStateDefAsAPastArgument($myfunc, $nbparam, $arg)
    {
        $myfunc->addStatePastArgument($nbparam, $arg->getCurrentState());
    }

    public static function addAttributesOfInitialReturnDefs($returnDef, $initialReturnDef)
    {
        $returnDef->setStates($initialReturnDef->getStates());
        $returnDef->setStatesToBlocksIds($initialReturnDef->getStatesToBlocksIds());
    }

    public static function addSanitizedTypes($defValid, $sanitizedTypes)
    {
        $defValid->getCurrentState()->setSanitized(true);
        if (is_array($sanitizedTypes)) {
            foreach ($sanitizedTypes as $sanitizedType) {
                $defValid->getCurrentState()->addTypeSanitized($sanitizedType);
            }
        }
    }

    public static function addValidAssertion($defValid, $block)
    {
        $myAssertion = new MyAssertion($defValid, "valid");
        $block->addAssertion($myAssertion);
    }

    public static function cleanTaintedDef($def, $funcDefs)
    {
        $originalDef = $funcDefs->getOriginalDef($def->getId());

        if (!is_null($originalDef)) {
            $originalDefCopy = clone $originalDef;
            $def->setType($originalDefCopy->getType());
            $def->setSourceMyFile($originalDefCopy->getSourceMyFile());
            $def->setName($originalDefCopy->getName());
            $def->setValidWhenReturning($originalDefCopy->getValidWhenReturning());
            $def->setValidNotBoolean($originalDefCopy->getValidNotBoolean());
            $def->setReturnedFromValidator($originalDefCopy->getReturnedFromValidator());
            $def->setClassName($originalDefCopy->getClassName());
            $def->setRefs($originalDefCopy->getRefs());
            $def->setStates($originalDefCopy->getStates());
            $def->setStatesToBlocksIds($originalDefCopy->getStatesToBlocksIds());
        }
    }
}
