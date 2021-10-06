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

use progpilot\Objects\MyProperty;
use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyInstance;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyFunction;

use progpilot\Dataflow\Definitions;

use progpilot\Helpers\Analysis as HelpersAnalysis;
use progpilot\Helpers\Dataflow as HelpersDataflow;

class ResolveDefs
{
    public static function funccallReturnValues($context, $myFuncCall, $instruction, $myCode, $index)
    {
        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

        if ($myFuncCall->getName() === "dirname") {

            /*
            $codes = $myCode->getCodes();

            $suffix = "";
            if (isset($codes[$index + 1]) && $codes[$index + 1]->getOpcode() === Opcodes::CONCAT_RIGHT) {
                if (isset($codes[$index + 2]) && $codes[$index + 2]->getOpcode() === Opcodes::TEMPORARY) {
                    $tempInstruction = $codes[$index + 2];
                    $myTemp = $tempInstruction->getProperty(MyInstruction::TEMPORARY);

                    if (isset($myTemp->getLastKnownValues()[0])) {
                        $suffix = $myTemp->getLastKnownValues()[0];
                    }
                }

                $index = $index + 2;
            }
            
            if (isset($codes[$index + 2]) && $codes[$index + 2]->getOpcode() === Opcodes::END_ASSIGN) {
                $instructionDef = $codes[$index + 3];
                $myDefReturn = $instructionDef->getProperty(MyInstruction::DEF);

                if ($instruction->isPropertyExist("argdef0")) {
                    $defarg = $instruction->getProperty("argdef0");
                    foreach ($defarg->getLastKnownValues() as $knownValue) {
                        $myDefReturn->addLastKnownValue(dirname($knownValue).$suffix);
                    }
                }
            }
            */

            echo "funccallReturnValues 1 '$resultid'\n";

            if ($instruction->isPropertyExist("argdef0")) {
                echo "funccallReturnValues 2 '$resultid'\n";
                $defarg = $instruction->getProperty("argdef0");
                $defarg->printStdout();



                $myTempReturn = new MyDefinition(
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $myFuncCall->getLine(),
                    $myFuncCall->getColumn(),
                    "special_return_".$myFuncCall->getName()
                );

                foreach ($defarg->getCurrentState()->getLastKnownValues() as $knownValue) {
                    echo "funccallReturnValues 3 '$resultid' '$knownValue'\n";
                    $myTempReturn->getCurrentState()->addLastKnownValue(dirname($knownValue));
                }

                $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);
                $opInformation["chained_results"][] = $myTempReturn;
                $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
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
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $mydef->getLine(),
                    $mydef->getColumn(),
                    $mydef->getName()
                );
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

    public static function funccallClass($context, $data, $myFuncCall, $code, $index)
    {
        $instruction = $code[$index];

        $varid = $instruction->getProperty(MyInstruction::VARID);
        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

        $i = 0;
        $classStackName = [];

        echo "funccallClass 1_\n";
        
        if ($myFuncCall->getName() === "__construct") {
            echo "funccallClass 1b_ '".$myFuncCall->getInstanceClassName()."'\n";
            $myFakeInstance = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentMyFile(),
                $myFuncCall->getLine(),
                $myFuncCall->getColumn(),
                "return__construct"
            );
            $myFakeInstance->addType(MyDefinition::TYPE_INSTANCE);
            $myFakeInstance->getCurrentState()->addType(MyDefinition::TYPE_INSTANCE);
            $myFakeInstance->setClassName($myFuncCall->getInstanceClassName());

            HelpersDataflow::createObject($context, $myFakeInstance);

            $opInformation["chained_results"][] = $myFakeInstance;
            $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);

            echo "funccallClass 1c_\n";
            $classStackName[$i][] = $myFakeInstance;
        } elseif ($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $tmpProperties = null;

            echo "funccallClass 2_ name '".$myFuncCall->getName()."'";
            echo " nameinstance '".$myFuncCall->getNameInstance()."'\n";
            $myDefTmp = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentMyFile(),
                $myFuncCall->getLine(),
                $myFuncCall->getColumn(),
                $myFuncCall->getNameInstance()
            );

            //$myDefTmp->property->setProperties($tmpProperties);
            $myDefTmp->addType(MyDefinition::TYPE_PROPERTY);
            // we don't want the backdef but the original instance
            
            $classStackName[$i] = [];
            $previousChainedResults = $context->getCurrentFunc()->getOpInformation($varid);

            if (!is_null($previousChainedResults)) {
                echo "funccallClass 3_ '$varid'\n";
                $instances = $previousChainedResults["chained_results"];
            } else {
                echo "funccallClass 4_\n";
                $instances = ResolveDefs::selectInstances(
                    $context,
                    $data,
                    $myDefTmp
                );
            }

            foreach ($instances as $instance) {
                echo "funccallClass 5_\n";
                if ($instance->getCurrentState()->isType(MyDefinition::TYPE_INSTANCE)) {
                    echo "funccallClass 6_\n";
                    $classStackName[$i][] = $instance;
                }
            }
        }

        return $classStackName;
    }

    // def1 and def2 defined in different files
    // return true if def1 is deeper by def2
    public static function isNearestIncludes($def1, $def2)
    {
        $def1IncludedByDef2 = false;
        $def1IncludedToDef2 = false;

        /*
        file1.php
        echo $def1; <= def1 (file1.php from file2.php)

        file2.php
        $def1 <= def2 (file2.php to file2.php)
        include("file1.php")
        */

        $myFilef = $def1->getSourceMyFile();
        while (!is_null($myFilef)) {
            $myFileFrom = $myFilef->getIncludedFromMyfile();
            if (!is_null($myFileFrom) && ($myFileFrom->getName() === $def2->getSourceMyFile()->getName())) {
                $def1IncludedByDef2 = true;
                break;
            }

            $myFilef = $myFileFrom;
        }

        $myFilet = $def1->getSourceMyFile();
        while (!is_null($myFilet)) {
            $myFileTo = $myFilet->getIncludedToMyfile();
            if (!is_null($myFileTo) && ($myFileTo->getName() === $def2->getSourceMyFile()->getName())) {
                $def1IncludedToDef2 = true;
                break;
            }

            $myFilet = $myFileTo;
        }

        /* same thing but for def2 */
        if (!$def1IncludedToDef2 && !$def1IncludedByDef2) {
            $def2IncludedByDef1 = false;
            $def2IncludedToDef1 = false;
            
            $myFilef = $def2->getSourceMyFile();
            while (!is_null($myFilef)) {
                $myFileFrom = $myFilef->getIncludedFromMyfile();
                if (!is_null($myFileFrom) && ($myFileFrom->getName() === $def1->getSourceMyFile()->getName())) {
                    $def2IncludedByDef1 = true;
                    break;
                }

                $myFilef = $myFileFrom;
            }

            $myFilet = $def2->getSourceMyFile();
            while (!is_null($myFilet)) {
                $myFileTo = $myFilet->getIncludedToMyfile();
                if (!is_null($myFileTo) && ($myFileTo->getName() === $def1->getSourceMyFile()->getName())) {
                    $def2IncludedToDef1 = true;
                    break;
                }

                $myFilet = $myFileTo;
            }
        }

        // def1 is included by file from def2
        // but def2 defined before or after the include ?

        /*
        file1.php
        echo $def1; <= def1 (file1.php from file2.php)

        file2.php
        $def1 <= def2 (file2.php to file2.php)
        include("file1.php")
        */
        if ($def1IncludedByDef2) {
            // def2 defined after the include
            if (($def2->getLine() > $myFilef->getLine())
                || ($def2->getLine() === $myFilef->getLine()
                    && $def2->getColumn() >= $myFilef->getColumn())) {
                return false;
            }

            return true;
        }

        if ($def1IncludedToDef2) {
            // def2 defined before the include
            if (($def1->getLine() > $myFilet->getLine())
                || ($def1->getLine() === $myFilet->getLine()
                    && $def1->getColumn() >= $myFilet->getColumn())) {
                return false;
            }

            return true;
        }

        /*
        file1.php
        $def1

        file2.php
        echo $def1 (def2) <= def1 (file1.php from file2.php)
        include("file1.php")
        */
        // def2 is included by file from def1
        // but def1 defined before or after the include ?
        if ($def2IncludedByDef1) {
            // def1 defined after the include
            if (($def1->getLine() > $myFilef->getLine())
                || ($def1->getLine() === $myFilef->getLine()
                    &&  $def1->getColumn() >= $myFilef->getColumn())) {
                return true;
            }

            return false;
        }
        if ($def2IncludedToDef1) {
            // def1 defined before the include
            if (($def2->getLine() > $myFilet->getLine())
                || ($def2->getLine() === $myFilet->getLine()
                    &&  $def2->getColumn() >= $myFilet->getColumn())) {
                return true;
            }

            return false;
        }

        return false;
    }

    // return true if op is deeper in code than def
    public static function isNearest($context, $def1, $def2)
    {
        echo "isNearest 1________________________\n";
        if ($def1->getSourceMyFile()->getName() === $def2->getSourceMyFile()->getName()) {
            echo "isNearest 2________________________\n";
            // def1 is deeper in the code
            if ($def1->getLine() > $def2->getLine()) {
                echo "isNearest 3________________________\n";
                return true;
            }

            // the two defs are on the same line
            if ($def1->getLine() === $def2->getLine()) {
                echo "isNearest 4________________________\n";
                if ($def1->getId() >= $def2->getId()) {
                    echo "isNearest 5________________________\n";
                    return true;
                }
            }
        } else {
            echo "isNearest 6________________________\n";
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
            && $def->getName() === "this") {
            return true;
        }
            
        if (!is_null($def) && !is_null($currentFunc) && !is_null($currentFunc->getMyClass())
                && $def->getName() === $currentFunc->getMyClass()->getName()) {
            return true;
        }

        if (!is_null($property)
            && $property->getVisibility() === "public") {
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
            //$prop = $copyDefAssign->property->popProperty();
            $prop = $defAssign->getName();
            $visibilityFinal = false;

            $instances = ResolveDefs::selectInstances($context, $data, $copyDefAssign);
            foreach ($instances as $instance) {
                if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                    $idObject = $instance->getCurrentState()->getObjectId();
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
        } elseif ($defAssign->isType(MyDefinition::TYPE_STATIC_PROPERTY)) {
            $visibilityFinal = false;
            $myClass = $context->getClasses()->getMyClass($defAssign->getName());
            
            if (!is_null($myClass)) {
                $property = $myClass->getProperty($defAssign->property->getProperties());
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
        echo "selectDefinitions 1\n";

        $defsFound = [];
        if (is_null($data)) {
            return $defsFound;
        }
        echo "selectDefinitions 2\n";

        foreach ($data as $def) {
            echo "selectDefinitions 2b\n";
            if (Definitions::defEquality($def, $searchedDed, $bypassIsNearest)
                        && ResolveDefs::isNearest($context, $searchedDed, $def)) {
                
                if (!is_null($def->getParamToArg())) {
                    $def = $def->getParamToArg();
                }

                echo "selectDefinitions 3 'searched id = ".$searchedDed->getId()."' 'def id = ".$def->getId()."'\n";
                $def->printStdout();
                // CA SERT A QUOI ICI REDONDANT AVEC LE DERNIER ?
                if ($def->getCurrentState()->isType(MyDefinition::TYPE_INSTANCE)
                    && $searchedDed->isType(MyDefinition::TYPE_INSTANCE)) {
                    echo "selectDefinitions 4\n";

                if (!is_null($def->getArgToParam())) {
                    $def = $def->getArgToParam();
                }

                    $defsFound[$def->getBlockId()][] = $def;
                } elseif ($def->getCurrentState()->isType(MyDefinition::TYPE_ARRAY)
                        /*&& $def->getArrayValue() === $searchedDed->getArrayValue()*/) {
                    echo "selectDefinitions 7\n";
                    // we are looking for the nearest not instance of a property

                if (!is_null($def->getArgToParam())) {
                    $def = $def->getArgToParam();
                }

                    $defsFound[$def->getBlockId()][] = $def;
                } elseif (!$searchedDed->isType(MyDefinition::TYPE_INSTANCE)) {
                    echo "selectDefinitions 8\n";

                if (!is_null($def->getArgToParam())) {
                    $def = $def->getArgToParam();
                }
                
                    // we are looking for the nearest not instance of a property
                    $defsFound[$def->getBlockId()][] = $def;
                }
            }
        }

        echo "selectDefinitions 9\n";
        // si on a trouvé des defs dans le même bloc que la ou on cherche elles killent les autres
        if (isset($defsFound[$searchedDed->getBlockId()])
                    && count($defsFound[$searchedDed->getBlockId()]) > 0) {
                        echo "selectDefinitions 10\n";
            $defsFoundGood[$searchedDed->getBlockId()] = $defsFound[$searchedDed->getBlockId()];
        } else {
            echo "selectDefinitions 11\n";
            $defsFoundGood = $defsFound;
        }

        $trueDefsFound = [];

        foreach ($defsFoundGood as $blockDefs) {
            echo "selectDefinitions 12\n";
            $nearestDef = null;
            foreach ($blockDefs as $blockId => $defLast) {
                echo "selectDefinitions 13\n";
                //if (!$bypassIsNearest) {

                    echo "selectDefinitions 14\n";
                    if (ResolveDefs::isNearest($context, $searchedDed, $defLast)) {

                        echo "selectDefinitions 15\n";
                        if (is_null($nearestDef) || ResolveDefs::isNearest($context, $defLast, $nearestDef)) {

                            echo "selectDefinitions 16\n";
                            $nearestDef = $defLast;
                        }
                    }
                    /*
                } else {

                    echo "selectDefinitions 17\n";
                    $trueDefsFound[] = $defLast;
                }
                */
            }

            if (!is_null($nearestDef)/* && !$bypassIsNearest*/) {

                echo "selectDefinitions 18\n";
                $trueDefsFound[] = $nearestDef;
            }
        }

        echo "selectDefinitions 19\n";
        return $trueDefsFound;
    }

    public static function selectArrays($context, $data, $tempDefa, $arrayDim)
    {
        $arrayDefs = [];

        $copyTempDefa = clone $tempDefa;
        $copyTempDefa->addType(MyDefinition::TYPE_ARRAY);

        echo "selectArrays 1\n";
        $arrayDefsTmp = ResolveDefs::selectDefinitions(
            $context,
            $data,
            $copyTempDefa
        );

        echo "selectArrays 2\n";
        foreach ($arrayDefsTmp as $arrayDef) {
            echo "selectArrays 3\n";

            if (!is_null($arrayDef->getParamToArg())) {
                $arrayDef = $arrayDef->getParamToArg();
            }

            if ($arrayDef->getCurrentState()->isType(MyDefinition::TYPE_ARRAY)) {
                echo "selectArrays 4\n";
                $arrayDefs[] = $arrayDef
                    ->getCurrentState()
                        ->getOrCreateDefArrayIndex($tempDefa->getBlockId(), $arrayDef, $arrayDim);
            }
        }

        return $arrayDefs;
    }

    public static function selectInstances($context, $data, $tempDefa, $bypassIsNearest = false)
    {
        $instancesDefs = [];

        // we can have multiple instances with the same property assigned
        // we are looking for and instance, not a property
        $copyTempDefa = clone $tempDefa;
        /*
                if ($copyTempDefa->isType(MyDefinition::TYPE_PROPERTY)) {
                    $copyTempDefa->removeType(MyDefinition::TYPE_PROPERTY);
                    $copyTempDefa->property->setProperties(null);
                }
        */
        /*
        if (!$copyTempDefa->isType(MyDefinition::TYPE_INSTANCE)) {
            $copyTempDefa->addType(MyDefinition::TYPE_INSTANCE);
        }

        if ($copyTempDefa->isType(MyDefinition::TYPE_ARRAY)) {
            $copyTempDefa->removeType(MyDefinition::TYPE_ARRAY);
        }
        */

        $instancesDefs = ResolveDefs::selectDefinitions(
            $context,
            $data,
            $copyTempDefa,
            $bypassIsNearest
        );

        return $instancesDefs;
    }

    public static function selectStaticProperties($context, $tempDef, $propertyName)
    {
        echo "selectStaticProperties 1_\n";
        $currentFunc = $context->getCurrentFunc();
        $className = $tempDef->getName();

        $myClass = $context->getClasses()->getMyClass($className);

        if (!is_null($myClass)) {
            echo "selectStaticProperties 2_ '$propertyName'\n";
            $property = $myClass->getProperty($propertyName);

            if (!is_null($property)) {
                echo "selectStaticProperties 3_ '$propertyName'\n";
            }

            if (!is_null($property)
                                        && (ResolveDefs::getVisibility(
                                            $tempDef,
                                            $property,
                                            $currentFunc
                                        ))) {
                                            echo "selectStaticProperties 4_ '$propertyName'\n";
                return $property;
            }
        }

        return null;
    }

    public static function selectProperties($context, $data, $tempDefa, $propertyName, $bypassVisibility = false)
    {
        $propertiesDefs = [];
        $currentFunc = $context->getCurrentFunc();

        //if ($tempDefa->isType(MyDefinition::TYPE_PROPERTY)) {
        $tempDefaProp = clone $tempDefa;

        echo "selectProperties 1_\n";
        $instances = ResolveDefs::selectInstances($context, $data, $tempDefaProp);

        foreach ($instances as $instance) {
            echo "selectProperties 2_\n";
            if ($instance->getCurrentState()->isType(MyDefinition::TYPE_INSTANCE)) {
                /*
                if ($instance->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")) {
                    $tempDefa->setTaintedByExpr($instance->getTaintedByExpr());
                    $tempDefa->setTainted(true);
                } else {*/
                echo "selectProperties 3_\n";

                $idObject = $instance->getCurrentState()->getObjectId();
                $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);

                if (!is_null($tmpMyClass)) {
                    echo "selectProperties 4_ '$propertyName'\n";
                    $property = $tmpMyClass->getProperty($propertyName);

                    if (!is_null($property)
                                                && (ResolveDefs::getVisibility(
                                                    $tempDefaProp,
                                                    $property,
                                                    $currentFunc
                                                )
                                                    || $bypassVisibility)) {
                        echo "selectProperties 5_\n";
                        $propertiesDefs[] = [$property, $tmpMyClass];
                    } else {
                        // we didn't find any propery but in this case php create automatically the property

                        echo "selectProperties 6_\n";
                        $myProperty = new MyProperty(
                            $context->getCurrentBlock()->getId(),
                            $context->getCurrentMyFile(),
                            $tempDefa->getLine(),
                            $tempDefa->getColumn(),
                            $propertyName
                        );
                        $myProperty->setVisibility("public");
                        $tmpMyClass->addProperty($myProperty);

                        if($instance->getCurrentState()->isType(MyDefinition::ALL_PROPERTIES_TAINTED)) {
                            echo "selectProperties 7_\n";
                            $myProperty->getCurrentState()->setTainted(true);
                            $myProperty->getCurrentState()->addTaintedByDef([$instance, $instance->getCurrentState()]);

                        }


                        $propertiesDefs[] = [$myProperty, $tmpMyClass];
                    }
                }
                //}
            }
        }
        //}

        return $propertiesDefs;
    }

    public static function selectGlobals($globalName, $context, $data, $tempDefa, $isIterator, $isAssign)
    {
        $callStack = $context->getCallStack();

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

                    $resGlobal = ResolveDefs::selectDefinitions(
                        $context,
                        $currentContextCall->func_callee->getDefs()->getOutMinusKill($tempDefa->getBlockId()),
                        $tempDefa,
                        $isIterator
                    );

                    // to not call recursively this function
                    if (!(count($resGlobal) === 1 && $resGlobal[0] === $tempDefa)) {
                        return $resGlobal;
                    }
                }
            }
        }

        return array();
    }
    /*
    public static function selectStaticProperty($context, $data, $tempDefa, $isIterator, $isAssign)
    {
        $callStack = $context->getCallStack();
        if (is_array($callStack)) {
            // we are looking in first for a possible static property defined inside the function
            $resStatic = ResolveDefs::temporarySimple(
                $context,
                $data,
                $tempDefa,
                $isIterator,
                $isAssign,
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
*/

    public static function temporarySimple(
        $context,
        $data,
        $tempDefa,
        $isIterator,
        $isAssign,
        $bypassStatic = false
    ) {
        if ($tempDefa->isType(MyDefinition::TYPE_STATIC_PROPERTY) && !$bypassStatic) {
            return ResolveDefs::selectStaticProperty(
                $context,
                $data,
                $tempDefa,
                $isIterator,
                $isAssign
            );
        } elseif ($tempDefa->isType(MyDefinition::TYPE_ARRAY) && $tempDefa->getName() === "GLOBALS") {
            return ResolveDefs::selectGlobals(
                key($tempDefa->getArrayValue()),
                $context,
                $data,
                $tempDefa,
                $isIterator,
                $isAssign
            );
        } else {
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
                    if (!is_null($defz->getParamToArg())) {
                        $param = $defz;
                        $defz = $defz->getParamToArg();
                        $defz->setBlockId($param->getBlockId());
                    }

                    // a param (paramtoarg use case) cannot be global
                    if ($defz->isType(MyDefinition::TYPE_GLOBAL)) {
                        return ResolveDefs::selectGlobals(
                            $defz->getName(),
                            $context,
                            $data,
                            $tempDefa,
                            $isIterator,
                            $isAssign
                        );
                    } else {
                        $defaa = ArrayAnalysis::temporarySimple(
                            $context,
                            $data->getOutMinusKill($tempDefa->getBlockId()),
                            $tempDefa,
                            $defz,
                            $isIterator
                        );

                        foreach ($defaa as $defa) {
                            // a param (case argtoparam) cannot be a reference (alreay copied)
                            if ($defa->isType(MyDefinition::TYPE_REFERENCE)) {
                                $refDef = new MyDefinition(
                                    $context->getCurrentBlock()->getId(),
                                    $context->getCurrentMyFile(),
                                    $tempDefa->getLine(),
                                    $tempDefa->getColumn(),
                                    $defa->getRefName()
                                );

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
                                    $goodDefs[] = $ref;
                                }
                            } else {
                                $goodDefs[] = $defa;
                            }
                        }
                    }
                }
            } else {
                // only one
                $goodDefs[] = $tempDefa;
            }

            return $goodDefs;
        }
    }
}
