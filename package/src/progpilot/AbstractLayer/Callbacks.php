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
    public static function modifyMyclassOfObject($context, $id_object, $current_myclass, $new_myclass)
    {
        if (!is_null($current_myclass) && $current_myclass->getName() === $new_myclass->getName()) {
            $context->getObjects()->addMyclassToObject($id_object, $new_myclass);
        }
    }

    public static function modifyMyclassOfObjectFromDef($context, $def, $myclass)
    {
        if ($def->getClassName() === $myclass->getName()) {
            $id_object = $def->getObjectId();
            $context->getObjects()->addMyclassToObject($id_object, $myclass);
        }
    }
}
