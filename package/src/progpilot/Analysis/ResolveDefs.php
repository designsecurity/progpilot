<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use PHPCfg\Block;
use PHPCfg\Func;
use PHPCfg\Op;
use PHPCfg\Script;
use PHPCfg\Visitor;
use PHPCfg\Operand;

use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;

use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyInstance;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyFunction;

use progpilot\Dataflow\Definitions;

class ResolveDefs
{
    public static function funccallReturnValues($context, $myFuncCall, $instruction, $myCode, $index)
    {
        if ($myFuncCall->getName() === "dirname") {
            $codes = $myCode->getCodes();
            if (isset($codes[$index + 2]) && $codes[$index + 2]->getOpcode() === Opcodes::END_ASSIGN) {
                $instructionDef = $codes[$index + 3];
                $myDefReturn = $instructionDef->getProperty(MyInstruction::DEF);

                if ($instruction->isPropertyExist("argdef0")) {
                    $defarg = $instruction->getProperty("argdef0");
                    foreach ($defarg->getLastKnownValues() as $knownValue) {
                        $myDefReturn->addLastKnownValue(dirname($knownValue));
                    }
                }
            }
        }
    }

    public static function propertyClass($context, $data, $mydef)
    {
        $i = 0;
        $classStackName = [];
        $currentFunc = $context->getCurrentFunc();
        
        if ($mydef->isType(MyDefinition::TYPE_PROPERTY)) {
            $properties = $mydef->property->getProperties();
            $tmpProperties = [];

            while (true) {
                $myDefTmp = new MyDefinition(
                    $mydef->getLine(),
                    $mydef->getColumn(),
                    $mydef->getName()
                );
                $myDefTmp->setBlockId($mydef->getBlockId());
                $myDefTmp->setSourceMyFile($mydef->getSourceMyFile());
                $myDefTmp->property->setProperties($tmpProperties);
                $myDefTmp->addType(MyDefinition::TYPE_PROPERTY);
                $myDefTmp->setId($mydef->getId());
                
                $classStackName[$i] = [];
                if ($i === 0) {
                    $instances = ResolveDefs::selectInstances(
                        $context,
                        $data->getOutMinusKill($mydef->getBlockId()),
                        $myDefTmp
                    );
                } else {
                    $instances = ResolveDefs::selectProperties(
                        $context,
                        $data->getOutMinusKill($mydef->getBlockId()),
                        $myDefTmp
                    );
                }
                
                // if we have document.url but document hasn't been defined
                // we use the original name of the instance (document)
                if (count($instances) === 0) {
                    $myClassNew = \progpilot\Analysis\CustomAnalysis::defineObject(
                        $context,
                        $mydef,
                        $classStackName
                    );
                    
                    if (!is_null($myClassNew)) {
                        $mydef->addType(MyDefinition::TYPE_INSTANCE);
                        $idObject = $context->getObjects()->addObject();
                        $mydef->setObjectId($idObject);
                        $context->getObjects()->addMyclassToObject($idObject, $myClassNew);
                    }
                    
                    $classStackName[$i][] = $mydef;
                } else {
                    foreach ($instances as $instance) {
                        if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                            $objectId = $instance->getObjectId();
                            $myClass = $context->getObjects()->getMyClassFromObject($objectId);
                            
                            if (!is_null($myClass) && isset($properties[$i])) {
                                $property = $myClass->getProperty($properties[$i]);

                                // if property doesn't exist by default it's a public property
                                if (is_null($property) || (!is_null($property)
                                    && (ResolveDefs::getVisibility($myDefTmp, $property, $currentFunc)))) {
                                    $myClassNew = \progpilot\Analysis\CustomAnalysis::defineObject(
                                        $context,
                                        $myClass,
                                        $classStackName
                                    );
                    
                                    if (!is_null($myClassNew)) {
                                        $idObject = $context->getObjects()->addObject();
                                        $instance->setObjectId($idObject);
                                        $context->getObjects()->addMyclassToObject($idObject, $myClassNew);
                                    }
                                    
                                    $classStackName[$i][] = $instance;
                                }
                            } else {
                                $classStackName[$i][] = $instance;
                            }
                        }
                    }
                }

                if (!isset($properties[$i])) {
                    break;
                }

                $tmpProperties[] = $properties[$i];

                $i ++;

                if (!isset($properties[$i])) {
                    break;
                }
            }
        }

        return $classStackName;
    }

    public static function funccallClass($context, $data, $myFuncCall)
    {
        $i = 0;
        $classStackName = [];

        if ($myFuncCall->getName() === "__construct") {
            $classStackName[$i][] = $myFuncCall->getBackDef();
        } elseif ($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $properties = $myFuncCall->getBackDef()->property->getProperties();

            $tmpProperties = [];

            while (true) {
                $propValue = [];

                $myDefTmp = new MyDefinition(
                    $myFuncCall->getLine(),
                    $myFuncCall->getColumn(),
                    $myFuncCall->getNameInstance()
                );
                $myDefTmp->setBlockId($myFuncCall->getBlockId());
                $myDefTmp->setSourceMyFile($myFuncCall->getSourceMyFile());
                $myDefTmp->property->setProperties($tmpProperties);
                $myDefTmp->addType(MyDefinition::TYPE_PROPERTY);
                $myDefTmp->setId($myFuncCall->getBackDef()->getId() - 1);
                // we don't want the backdef but the original instance

                $classStackName[$i] = [];
                if ($i === 0) {
                    $instances = ResolveDefs::selectInstances(
                        $context,
                        $data,
                        $myDefTmp
                    );
                } else {
                    $instances = ResolveDefs::selectProperties($context, $data, $myDefTmp);
                }

                foreach ($instances as $instance) {
                    if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                        $classStackName[$i][] = $instance;
                    }
                }

                if (!isset($properties[$i])) {
                    break;
                }

                $tmpProperties[] = $properties[$i];

                $i ++;
            }
        }

        return $classStackName;
    }

    public static function instanceBuildBack($context, $data, $myFunc, $myClass, $myFuncCall, $visibility)
    {
        if (!is_null($myFunc) && $myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
            if ($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
                $myBackDef = $myFuncCall->getBackDef();
                //$myClass = $myFunc->getMyClass();
                $method = $myClass->getMethod($myFuncCall->getName());
                $newMyBackMyClass = $context->getObjects()->getMyClassFromObject($myBackDef->getObjectId());
                
                if (is_null($newMyBackMyClass)) {
                    $newMyBackMyClass = new MyClass(
                        $myClass->getLine(),
                        $myClass->getColumn(),
                        $myClass->getName()
                    );
                    
                    $newMyBackMyClass->setExtendsOf($myClass->getExtendsOf());

                    $context->getObjects()->addMyclassToObject($myBackDef->getObjectId(), $newMyBackMyClass);
                }
                
                $copyMyClass = clone $myClass;
                
                foreach ($copyMyClass->getProperties() as $property) {
                    $myDef = new MyDefinition($myFunc->getLastLine() + 1, $myFunc->getLastColumn(), "this");

                    $myDef->addType(MyDefinition::TYPE_PROPERTY);
                    $myDef->property->setProperties($property->property->getProperties());
                    $myDef->setBlockId($myFunc->getLastBlockId());
                    $myDef->setSourceMyFile($myBackDef->getSourceMyFile());

                    $newProperty = $newMyBackMyClass->getProperty($property->property->getProperties()[0]);
                    if (is_null($newProperty)) {
                        $newMyBackMyClass->addProperty($property);
                        $newProperty = $property;
                    }

                    $propertiesInside = ResolveDefs::selectProperties(
                        $context,
                        $myFunc->getDefs()->getOutMinusKill($myDef->getBlockId()),
                        $myDef
                    );

                    foreach ($propertiesInside as $propertyInside) {
                        ValueAnalysis::copyValues($propertyInside, $newProperty);
                    
                        TaintAnalysis::setTainted(
                            $propertyInside->isTainted(),
                            $newProperty,
                            $propertyInside->getTaintedByExpr()
                        );

                        if ($propertyInside->isSanitized()) {
                            $newProperty->setSanitized(true);
                            foreach ($propertyInside->getTypeSanitized() as $typeSanitized) {
                                $newProperty->addTypeSanitized($typeSanitized);
                            }
                        }

                        if ($propertyInside->isType(MyDefinition::TYPE_INSTANCE)
                            && !$newProperty->isType(MyDefinition::TYPE_INSTANCE)) {
                            $newProperty->addType(MyDefinition::TYPE_INSTANCE);
                            $newProperty->setObjectId($propertyInside->getObjectId());
                            $newProperty->setClassName($propertyInside->getClassName());

                            $myClass = $context->getObjects()->getMyClassFromObject($propertyInside->getObjectId());
                        }
                    }

                    $newProperty->setName($myBackDef->getName());

                    ArrayAnalysis::copyArray(
                        $context,
                        $myFunc->getDefs()->getOutMinusKill($myDef->getBlockId()),
                        $myDef,
                        $myDef->getArrayValue(),
                        $newProperty,
                        $newProperty->getArrayValue()
                    );
                }

                foreach ($copyMyClass->getMethods() as $method) {
                    $newMethod = clone $method;
                    $newMyBackMyClass->addMethod($newMethod);
                }
            }
        } elseif (is_null($myFunc)
            && $myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)
                && !is_null($myClass)
                    && $visibility) {
            // query return object custom rule
            //$query = $this->db->query("YOUR QUERY");
        
            // backdef instance should be update with the correct object
            // $row = $query->result();
            $myBackDef = $myFuncCall->getBackDef();
            $myClassTmp = $context->getClasses()->getMyClass($myClass->getName());
                
            if (is_null($myClassTmp)) {
                $myClassTmp = new MyClass(
                    $myClass->getLine(),
                    $myClass->getColumn(),
                    $myClass->getName()
                );
            }

            $context->getObjects()->addMyclassToObject($myBackDef->getObjectId(), $myClassTmp);
        }
    }

    public static function instanceBuildThis($context, $data, $objectId, $myClass, $myFunc, $myFuncCall)
    {
        if (!is_null($myFunc) && $myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
            //$copyMyClass = clone $myClass;
            //<= It was good ? clone for backdef and thisdef or only one of these two ?
            $copyMyClass = $myClass;
            
            foreach ($copyMyClass->getProperties() as $property) {
                $myDef = new MyDefinition(
                    $myFuncCall->getLine(),
                    $myFuncCall->getColumn(),
                    $myFuncCall->getNameInstance()
                );
                $myDef->addType(MyDefinition::TYPE_PROPERTY);
                $myDef->property->setProperties($property->property->getProperties());
                $myDef->setBlockId($myFuncCall->getBlockId());
                $myDef->setSourceMyFile($myFuncCall->getSourceMyFile());
                $myDef->setId($myFuncCall->getId());

                $defsFound = ResolveDefs::selectProperties($context, $data, $myDef, true);
                foreach ($defsFound as $defFound) {
                    if ($defFound->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                        $property->setCopyArrays($defFound->getCopyArrays());
                        $property->addType(MyDefinition::TYPE_COPY_ARRAY);
                    }

                    ValueAnalysis::copyValues($defFound, $property);
                    TaintAnalysis::setTainted($defFound->isTainted(), $property, $defFound->getTaintedByExpr());

                    if ($defFound->isSanitized()) {
                        $property->setSanitized(true);
                        foreach ($defFound->getTypeSanitized() as $typeSanitized) {
                            $property->addTypeSanitized($typeSanitized);
                        }
                    }
                }

                $property->setName("this");
            }

            $context->getObjects()->addMyclassToObject($objectId, $copyMyClass);
        }
    }

    // def1 and def2 defined in different files
    // return true if def1 is deeper by def2
    public static function isNearestIncludes($def1, $def2)
    {
        $def1IncludedByDef2 = false;

        $myFile = $def1->getSourceMyFile();
        while (!is_null($myFile)) {
            $myFileFrom = $myFile->getIncludedFromMyfile();
            if (!is_null($myFileFrom) && ($myFileFrom->getName() === $def2->getSourceMyFile()->getName())) {
                $def1IncludedByDef2 = true;
                break;
            }

            $myFile = $myFileFrom;
        }

        if (!$def1IncludedByDef2) {
            $def2IncludedByDef1 = false;
            $myFile = $def2->getSourceMyFile();
            while (!is_null($myFile)) {
                $myFileFrom = $myFile->getIncludedFromMyfile();
                if (!is_null($myFileFrom) && ($myFileFrom->getName() === $def1->getSourceMyFile()->getName())) {
                    $def2IncludedByDef1 = true;
                    break;
                }

                $myFile = $myFileFrom;
            }
        }

        // the two defs are defined in different included file
        if (!$def1IncludedByDef2 && !$def2IncludedByDef1) {
            $myFileDef1 = $def1->getSourceMyFile();
            while (!is_null($myFileDef1)) {
                $myFileDef2 = $def2->getSourceMyFile();
                while (!is_null($myFileDef2)) {
                    // we found the file from where the include chain start
                    if ($myFileDef1->getName() === $myFileDef2->getName()) {
                        // if the file of def1 is included later so def1 is deeper
                        if (($myFileDef1->getLine() > $myFileDef2->getLine())
                            || ($myFileDef1->getLine() === $myFileDef2->getLine()
                                && $myFileDef1->getColumn() >= $myFileDef2->getColumn())) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    $myFileDef2 = $myFileDef2->getIncludedFromMyfile();
                }

                $myFileDef1 = $myFileDef1->getIncludedFromMyfile();
            }
        }

        // def1 is included by file from def2
        // but def2 defined before or after the include ?
        if ($def1IncludedByDef2) {
            // def2 defined after the include so def2 is deeper
            if (($def2->getLine() > $myFile->getLine())
                || ($def2->getLine() === $myFile->getLine()
                    && $def2->getColumn() >= $myFile->getColumn())) {
                return false;
            }

            return true;
        }

        // def2 is included by file from def1
        // but def1 defined before or after the include ?
        if ($def2IncludedByDef1) {
            // def1 defined after the include so def1 is deeper

            if (($def1->getLine() > $myFile->getLine())
                || ($def1->getLine() === $myFile->getLine()
                    &&  $def1->getColumn() >= $myFile->getColumn())) {
                return true;
            }

            return false;
        }

        return false;
    }

    // return true if op is deeper in code than def
    public static function isNearest($context, $def1, $def2)
    {
        if ($def1->getSourceMyFile()->getName() === $def2->getSourceMyFile()->getName()) {
            // def1 is deeper in the code
            if ($def1->getLine() > $def2->getLine()) {
                return true;
            }

            // the two defs are on the same line
            if ($def1->getLine() === $def2->getLine()) {
                if ($def1->getId() >= $def2->getId()) {
                    return true;
                }
            }
        } else {
            return ResolveDefs::isNearestIncludes($def1, $def2);
        }

        return false;
    }

    public static function getVisibilityMethod($defName, $method)
    {
        if ($defName === "this") {
            return true;
        }

        if (!is_null($method)
            && $method->isType(MyFunction::TYPE_FUNC_METHOD)
                && $method->getVisibility() === "public") {
            return true;
        }
        
        if (is_null($method)) {
            return true;
        }

        return false;
    }

    public static function getVisibility($def, $property, $currentFunc)
    {
        if (!is_null($def)
            && $def->isType(MyDefinition::TYPE_PROPERTY)
                && $def->getName() === "this") {
            return true;
        }
            
        if (!is_null($def) && !is_null($currentFunc) && !is_null($currentFunc->getMyClass())
            && $def->isType(MyDefinition::TYPE_STATIC_PROPERTY)
                && $def->getName() === $currentFunc->getMyClass()->getName()) {
            return true;
        }

        if (!is_null($property)
            && ($property->isType(MyDefinition::TYPE_PROPERTY)
                || $property->isType(MyDefinition::TYPE_STATIC_PROPERTY))
                && $property->property->getVisibility() === "public") {
            return true;
        }

        return false;
    }

    public static function getVisibilityFromInstances($context, $data, $defAssign)
    {
        $visibilityFinal = true;
        $currentFunc = $context->getCurrentFunc();

        if ($defAssign->isType(MyDefinition::TYPE_PROPERTY)) {
            $copyDefAssign = clone $defAssign;
            $prop = $copyDefAssign->property->popProperty();
            $visibilityFinal = false;

            $instances = ResolveDefs::selectInstances($context, $data, $copyDefAssign);

            foreach ($instances as $instance) {
                if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                    $idObject = $instance->getObjectId();
                    $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);
                    
                    if (!is_null($tmpMyClass)) {
                        $property = $tmpMyClass->getProperty($prop);

                        if (!is_null($property)
                            && (ResolveDefs::getVisibility($copyDefAssign, $property, $currentFunc))) {
                            $visibilityFinal = true;
                            break;
                        } elseif (is_null($property)) {
                            $visibilityFinal = true; // property doesn't exist
                        }
                    } else {
                        $visibilityFinal = true; // class not defined
                    }
                }
            }
/*
            if (count($instances) === 0) {
                $visibilityFinal = true;
            }
            */
        } elseif ($defAssign->isType(MyDefinition::TYPE_STATIC_PROPERTY)) {
            $visibilityFinal = false;
            $myClass = $context->getClasses()->getMyClass($defAssign->getName());
            
            if (!is_null($myClass)) {
                $property = $myClass->getProperty($defAssign->property->getProperties()[0]);
                if (!is_null($property)
                    && (ResolveDefs::getVisibility($defAssign, $property, $currentFunc))) {
                    $visibilityFinal = true;
                }
            }
        }

        return $visibilityFinal;
    }

    public static function selectDefinitions($context, $data, $searchedDed, $bypassIsNearest = false)
    {
        $defsFound = [];
        if (is_null($data)) {
            return $defsFound;
        }

        foreach ($data as $def) {
            if (Definitions::defEquality($def, $searchedDed, $bypassIsNearest)
                        && ResolveDefs::isNearest($context, $searchedDed, $def)) {
                // CA SERT A QUOI ICI REDONDANT AVEC LE DERNIER ?
                if ($def->isType(MyDefinition::TYPE_INSTANCE)
                    && $searchedDed->isType(MyDefinition::TYPE_INSTANCE)) {
                    $defsFound[$def->getBlockId()][] = $def;
                } elseif (($def->isType(MyDefinition::TYPE_PROPERTY) ===
                $searchedDed->isType(MyDefinition::TYPE_PROPERTY))
                    || ($def->isType(MyDefinition::TYPE_INSTANCE) ===
                    $searchedDed->isType(MyDefinition::TYPE_INSTANCE))) {
                    if ($def->isType(MyDefinition::TYPE_PROPERTY)
                        && $searchedDed->isType(MyDefinition::TYPE_PROPERTY)) {
                        $defsFound[$def->getBlockId()][] = $def;
                    } elseif (!$def->isType(MyDefinition::TYPE_PROPERTY)
                        && !$searchedDed->isType(MyDefinition::TYPE_PROPERTY)) {
                        $defsFound[$def->getBlockId()][] = $def;
                    }
                } elseif (!$def->isType(MyDefinition::TYPE_INSTANCE)
                    && $searchedDed->isType(MyDefinition::TYPE_PROPERTY)) {
                    // we are looking for the nearest not instance of a property
                    $defsFound[$def->getBlockId()][] = $def;
                }
            }
        }

        // si on a trouvé des defs dans le même bloc que la ou on cherche elles killent les autres
        if (isset($defsFound[$searchedDed->getBlockId()])
                    && count($defsFound[$searchedDed->getBlockId()]) > 0) {
            $defsFoundGood[$searchedDed->getBlockId()] = $defsFound[$searchedDed->getBlockId()];
        } else {
            $defsFoundGood = $defsFound;
        }

        $trueDefsFound = [];

        foreach ($defsFoundGood as $blockDefs) {
            $nearestDef = null;
            foreach ($blockDefs as $blockId => $defLast) {
                if (!$bypassIsNearest) {
                    if (ResolveDefs::isNearest($context, $searchedDed, $defLast)) {
                        if (is_null($nearestDef) || ResolveDefs::isNearest($context, $defLast, $nearestDef)) {
                            $nearestDef = $defLast;
                        }
                    }
                } else {
                    $trueDefsFound[] = $defLast;
                }
            }

            if (!is_null($nearestDef) && !$bypassIsNearest) {
                $trueDefsFound[] = $nearestDef;
            }
        }

        return $trueDefsFound;
    }

    public static function selectInstances($context, $data, $tempDefa, $bypassIsNearest = false)
    {
        $instancesDefs = [];

        // we can have multiple instances with the same property assigned
        // we are looking for and instance, not a property
        $copyTempDefa = clone $tempDefa;

        if (!$copyTempDefa->isType(MyDefinition::TYPE_INSTANCE)) {
            $copyTempDefa->addType(MyDefinition::TYPE_INSTANCE);
        }

        if ($copyTempDefa->isType(MyDefinition::TYPE_ARRAY)) {
            $copyTempDefa->removeType(MyDefinition::TYPE_ARRAY);
        }

        $copyTempDefa->setArrayValue(false);
        
        $instancesDefs = ResolveDefs::selectDefinitions(
            $context,
            $data,
            $copyTempDefa,
            $bypassIsNearest
        );

        return $instancesDefs;
    }

    public static function selectProperties($context, $data, $tempDefa, $bypassVisibility = false)
    {
        $propertiesDefs = [];
        $currentFunc = $context->getCurrentFunc();

        if ($tempDefa->isType(MyDefinition::TYPE_PROPERTY)) {
            $propLine = $tempDefa->getLine();
            $propColumn = $tempDefa->getColumn();

            $tempDefaProp = clone $tempDefa;
            $firstProperties = [];
            $isFirstProperty = true;
            $propertyExist = false;

            if (is_array($tempDefa->property->getProperties())) {
                $myProperties = $tempDefa->property->getProperties();
                for ($indexProperty = count($myProperties) - 1; $indexProperty !== -1; $indexProperty --) {
                    $tempDefaProp->setLine($propLine);
                    $tempDefaProp->setColumn($propColumn);

                    $defs = ResolveDefs::selectDefinitions(
                        $context,
                        $data,
                        $tempDefaProp,
                        $bypassVisibility
                    );

                    $tempDefaProp->property->popProperty();
                    $prop = $myProperties[$indexProperty];

                    if (count($defs) > 0) {
                        foreach ($defs as $defa) {
                            if ($defa->isType(MyDefinition::TYPE_PROPERTY)) {
                                // if we found a property, we are looking for the nearest instance or not instance
                                // and we are looking for an instance that contains this visible property
                                $instances = ResolveDefs::selectInstances($context, $data, $tempDefaProp);

                                foreach ($instances as $instance) {
                                    $idObject = $instance->getObjectId();
                                    $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);

                                    if (!is_null($tmpMyClass)) {
                                        $property = $tmpMyClass->getProperty($prop);

                                        if (!is_null($property)
                                            && (ResolveDefs::getVisibility($defa, $property, $currentFunc)
                                                || $bypassVisibility)) {
                                            $propertyExist = true;

                                            if ($isFirstProperty || $bypassVisibility) {
                                                $isFirstProperty = false;

                                                // if the instance is nearest (deeper) than the property,
                                                // it has the priority
                                                if (ResolveDefs::isNearest($context, $instance, $defa)) {
                                                    $firstProperties[] = $property;
                                                } else {
                                                    // else property exist in the nearest instance
                                                    //but property has the priority
                                                    $firstProperties[] = $defa;
                                                }
                                            }
                                        }
                                    }
                                }

                                if (count($instances) === 0 && !$isFirstProperty) {
                                    $propertyExist = true;
                                    $firstProperties[] = $defa;
                                }
                            }
                        }
                    } else {
                        // we didn't find a property, we are looking for the nearest instance
                        // or not instance
                        
                        $instances = ResolveDefs::selectInstances($context, $data, $tempDefaProp);

                        foreach ($instances as $instance) {
                            if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                                if ($instance->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")) {
                                    //$propertiesDefs[] = $tempDefa;
                                    $tempDefa->setTaintedByExpr($instance->getTaintedByExpr());
                                    $tempDefa->setTainted(true);
                                } else {
                                    for ($i = $indexProperty; $i < count($myProperties); $i++) {
                                        $idObject = $instance->getObjectId();
                                        $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);

                                        if (!is_null($tmpMyClass)) {
                                            $prop = $myProperties[$i];
                                            $property = $tmpMyClass->getProperty($prop);
                                            
                                            if (!is_null($property)
                                                && (ResolveDefs::getVisibility(
                                                    $tempDefaProp,
                                                    $property,
                                                    $currentFunc
                                                )
                                                    || $bypassVisibility)) {
                                                $limit = count($myProperties) - 1;

                                                if ($property->isType(MyDefinition::TYPE_INSTANCE)
                                                    && $i < (count($myProperties) - 1)) {
                                                    $instance = $property;
                                                } elseif ($i === (count($myProperties) - 1)) {
                                                    $propertiesDefs[] = $property;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($propertyExist) {
                foreach ($firstProperties as $first_property) {
                    $propertiesDefs[] = $first_property;
                }
            }
        }

        return $propertiesDefs;
    }

    public static function selectGlobals($globalName, $context, $data, $tempDefa, $isIterator, $isAssign, $callStack)
    {
        if (is_array($callStack)) {
            for ($callNumber = count($callStack) - 1; $callNumber !== 0; $callNumber --) {
                $currentContextCall = $callStack[$callNumber][4];

                // ca peut arriver si on est dans le main() est qu'on appelle une globale
                if (!is_null($currentContextCall->func_called) && !is_null($currentContextCall->func_callee)) {
                    // we can't looking for an element of a global array in PHP
                    $tempDefa->removeType(MyDefinition::TYPE_ARRAY);
                    $tempDefa->setArrayValue(false);

                    $tempDefa->setName($globalName);
                    $tempDefa->setLine($currentContextCall->func_called->getLine());
                    $tempDefa->setColumn($currentContextCall->func_called->getColumn());
                    $tempDefa->setBlockId($currentContextCall->func_callee->getLastBlockId());

                    $resGlobal = ResolveDefs::temporarySimple(
                        $context,
                        $currentContextCall->func_callee->getDefs(),
                        $tempDefa,
                        $isIterator,
                        $isAssign,
                        $currentContextCall
                    );
                    if (!(count($resGlobal) === 1 && $resGlobal[0] === $tempDefa)) {
                        return $resGlobal;
                    }
                }
            }
        }

        return array();
    }
    
    public static function selectStaticProperty($context, $data, $tempDefa, $isIterator, $isAssign, $callStack)
    {
        if (is_array($callStack)) {
            // we are looking in first for a possible static property defined inside the function
            $resStatic = ResolveDefs::temporarySimple(
                $context,
                $data,
                $tempDefa,
                $isIterator,
                $isAssign,
                $callStack,
                true
            );
            
            if (!(count($resStatic) === 1 && $resStatic[0] === $tempDefa)) {
                return $resStatic;
            }
            
            // if no result we are looking inside the callee functions
            for ($callNumber = count($callStack) - 1; $callNumber >= 0; $callNumber --) {
                $currentContextCall = $callStack[$callNumber][4];

                // ca peut arriver si on est dans le main() est qu'on appelle une static
                if (!is_null($currentContextCall->func_called) && !is_null($currentContextCall->func_callee)) {
                    $tempDefa->setLine($currentContextCall->func_called->getLine());
                    $tempDefa->setColumn($currentContextCall->func_called->getColumn());
                    $tempDefa->setBlockId($currentContextCall->func_callee->getLastBlockId());
                    
                    $resGlobal = ResolveDefs::temporarySimple(
                        $context,
                        $currentContextCall->func_callee->getDefs(),
                        $tempDefa,
                        $isIterator,
                        $isAssign,
                        $callStack,
                        true
                    );
                    if (!(count($resGlobal) === 1 && $resGlobal[0] === $tempDefa)) {
                        return $resGlobal;
                    }
                }
            }
        }

        return array();
    }


    public static function temporarySimple(
        $context,
        $data,
        $tempDefa,
        $isIterator,
        $isAssign,
        $callStack,
        $bypassStatic = false
    ) {
        if ($tempDefa->isType(MyDefinition::TYPE_STATIC_PROPERTY) && !$bypassStatic) {
            return ResolveDefs::selectStaticProperty(
                $context,
                $data,
                $tempDefa,
                $isIterator,
                $isAssign,
                $callStack
            );
        } elseif ($tempDefa->isType(MyDefinition::TYPE_ARRAY) && $tempDefa->getName() === "GLOBALS") {
            return ResolveDefs::selectGlobals(
                key($tempDefa->getArrayValue()),
                $context,
                $data,
                $tempDefa,
                $isIterator,
                $isAssign,
                $callStack
            );
        } else {
            $myExpr = $tempDefa->getExpr();

            if ($tempDefa->isType(MyDefinition::TYPE_PROPERTY)) {
                $defs = ResolveDefs::selectProperties(
                    $context,
                    $data->getOutMinusKill($tempDefa->getBlockId()),
                    $tempDefa
                );
            } else {
                $defs = ResolveDefs::selectDefinitions(
                    $context,
                    $data->getOutMinusKill($tempDefa->getBlockId()),
                    $tempDefa,
                    $isIterator
                );
            }

            $goodDefs = [];
            if (count($defs) > 0) {
                foreach ($defs as $defz) {
                    if ($defz->isType(MyDefinition::TYPE_GLOBAL)) {
                        return ResolveDefs::selectGlobals(
                            $defz->getName(),
                            $context,
                            $data,
                            $tempDefa,
                            $isIterator,
                            $isAssign,
                            $callStack
                        );
                    } else {
                        $defaa = ArrayAnalysis::temporarySimple(
                            $context,
                            $data->getOutMinusKill($tempDefa->getBlockId()),
                            $tempDefa,
                            $defz,
                            $isIterator,
                            $isAssign
                        );

                        foreach ($defaa as $defa) {
                            if ($defa->isType(MyDefinition::TYPE_REFERENCE)) {
                                $refDef = new MyDefinition(
                                    $tempDefa->getLine(),
                                    $tempDefa->getColumn(),
                                    $defa->getRefName()
                                );
                                $refDef->setBlockId($tempDefa->getBlockId());
                                $refDef->setSourceMyFile($tempDefa->getSourceMyFile());

                                if ($defa->isType(MyDefinition::TYPE_ARRAY_REFERENCE)) {
                                    $refDef->addType(MyDefinition::TYPE_ARRAY);
                                    $refDef->setArrayValue($defa->getRefArrValue());
                                }

                                $trueRefs = ResolveDefs::selectDefinitions(
                                    $context,
                                    $data->getOutMinusKill($refDef->getBlockId()),
                                    $refDef
                                );

                                foreach ($trueRefs as $ref) {
                                    $myExpr->addDef($ref);
                                    $goodDefs[] = $ref;
                                }

                                unset($trueRefs);
                            } else {
                                $myExpr->addDef($defa);
                                $goodDefs[] = $defa;
                            }
                        }
                    }
                }
            } else {
                $myExpr->addDef($tempDefa);
                $goodDefs[] = $tempDefa;
            }

            return $goodDefs;
        }
    }
}
