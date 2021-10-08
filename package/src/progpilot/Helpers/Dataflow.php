<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Helpers;

use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyClass;

class Dataflow
{
    public static function createObject($context, $myDef)
    {
        if ($myDef->isType(MyDefinition::TYPE_INSTANCE)
            || $myDef->getCurrentState()->isType(MyDefinition::TYPE_INSTANCE)) {
            $idObject = $context->getObjects()->addObject();
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