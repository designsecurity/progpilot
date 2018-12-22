<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\AbstractLayer;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Analysis\ResolveDefs;

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
    
    public static function checkIfFuncEqualMySpecify($context, $mySpecify, $myFunc, $stackClass = null)
    {
        $checkName = false;
        if ($myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $properties = $myFunc->property->getProperties();
            if (is_array($properties) && isset($properties[count($properties) - 1])) {
                $lastproperty = $properties[count($properties) - 1];
                if ($lastproperty === $mySpecify->getName()) {
                    $checkName = true;
                }
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
                                $objectId = $propClass->getObjectId();
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
    
    public static function checkIfDefEqualDefRule($context, $defs, $rule, $def, $stackClass = null)
    {
        $definition = $rule->getDefinition();
        $checkName = false;
        if ($def->isType(MyDefinition::TYPE_PROPERTY)) {
            $properties = $def->property->getProperties();
            if (is_array($properties) && isset($properties[count($properties) - 1])) {
                $lastproperty = $properties[count($properties) - 1];
                if ($lastproperty === $definition->getName()) {
                    $checkName = true;
                }
            }
        }
                    
        $checkInstance = false;
        if (!is_null($definition) && ($definition->getName() === $def->getName()) || $checkName) {
            $checkName = true;
            $checkInstance = true;
                    
            if (is_null($stackClass) && !is_null($defs)) {
                $stackClass = ResolveDefs::propertyClass($context, $defs, $def);
            }
                                
            if ($definition->isInstance() && !is_null($stackClass)) {
                if ($definition->getLanguage() === "php") {
                    $propertiesRule = explode("->", $definition->getInstanceOfName());
                } elseif ($definition->getLanguage() === "js") {
                    $propertiesRule = explode(".", $definition->getInstanceOfName());
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
                                $objectId = $propClass->getObjectId();
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
            }
        }
        
        return $checkInstance & $checkName;
    }
}
