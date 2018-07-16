<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\AbstractLayer;

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
}
