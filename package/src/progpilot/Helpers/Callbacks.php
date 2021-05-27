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

class Callbacks
{
    public static function modifyMyclassOfObject($context, $idObject, $currentMyclass, $newMyclass)
    {
        if (!is_null($currentMyclass) && $currentMyclass->getName() === $newMyclass->getName()) {
            $context->getObjects()->addMyclassToObject($idObject, $newMyclass);
        }
    }

    public static function modifyMyclassOfObjectFromDef($context, $def, $myClass)
    {
        if ($def->getClassName() === $myClass->getName()) {
            $idObject = $def->getObjectId();
            $context->getObjects()->addMyclassToObject($idObject, $myClass);
        }
    }

    public static function addDefAsAPastArgument($myfunc, $nbparam, $arg)
    {
        $myfunc->addPastArgument($nbparam, $arg);
    }

    public static function addAttributesOfInitialReturnDefs($returnDef, $initialReturnDef)
    {
        $returnDef->setTainted($initialReturnDef->isTainted());
    }

    public static function cleanTaintedDef($def, $funcDefs)
    {
        // it's more than a cleanwe need a clone of each def/myfunc after the dataflow? or after transform?
        // and put back the origin value because the def could have been modified (tainted as well but also arrays)
        
        $originalDef = $funcDefs->getOriginalDef($def->getId());


        if (!is_null($originalDef)) {
            $def->setType($originalDef->getType());
            $def->setArrayValue($originalDef->getArrayValue());
            $def->setSourceMyFile($originalDef->getSourceMyFile());
            $def->setName($originalDef->getName());
            $def->setIsInstance($originalDef->getIsInstance());
            $def->setIsProperty($originalDef->getIsProperty());
            $def->setValidWhenReturning($originalDef->getValidWhenReturning());
            $def->setValidNotBoolean($originalDef->getValidNotBoolean());
            $def->setReturnedFromValidator($originalDef->getReturnedFromValidator());
            $def->setEmbeddedByChar($originalDef->getIsEmbeddedByChars());
            $def->setLabel($originalDef->getLabel());
            $def->setCast($originalDef->getCast());
            $def->setValueFromDef($originalDef->getValueFromDef());
            $def->setLastKnownValues($originalDef->getLastKnownValues());
            $def->setClassName($originalDef->getClassName());
            $def->setRefName($originalDef->getRefName());
            $def->setTainted($originalDef->isTainted());
            $def->setTaintedByExpr($originalDef->getTaintedByExpr());
            $def->setRefArrValue($originalDef->getRefArrValue());
            $def->setCopyArrays($originalDef->getCopyArrays());
            $def->setExpr($originalDef->getExpr());
            $def->setSanitized($originalDef->isSanitized());
            $def->setTypeSanitized($originalDef->getTypeSanitized());
        }
    }
}
