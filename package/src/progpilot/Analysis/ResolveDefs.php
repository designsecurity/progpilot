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

class ResolveDefs
{
    public static function funccallReturnValues($myFuncCall, $instruction, $virtualReturnDef)
    {
        if ($myFuncCall->getName() === "dirname") {
            if ($instruction->isPropertyExist("argdef0")) {
                $defarg = $instruction->getProperty("argdef0");

                foreach ($defarg->getCurrentState()->getLastKnownValues() as $knownValue) {
                    $virtualReturnDef->getCurrentState()->addLastKnownValue(dirname($knownValue));
                }
            }
        }
    }

    public static function funccallClass($context, $data, $myFuncCall, $instruction)
    {
        $varid = $instruction->getProperty(MyInstruction::VARID);
        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

        $i = 0;
        $classStackName = [];
        
        if ($myFuncCall->getName() === "__construct") {
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

            HelpersAnalysis::createObject($context, $myFakeInstance);

            $opInformation["chained_results"][] = $myFakeInstance;
            $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);

            $classStackName[$i][] = $myFakeInstance->getCurrentState();
        } elseif ($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $myDefTmp = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentFunc()->getSourceMyFile(),
                $myFuncCall->getLine(),
                $myFuncCall->getColumn(),
                $myFuncCall->getNameInstance()
            );

            $myDefTmp->addType(MyDefinition::TYPE_PROPERTY);
            // we don't want the backdef but the original instance
            
            $classStackName[$i] = [];
            $previousChainedResults = $context->getCurrentFunc()->getOpInformation($varid);

            if (!is_null($previousChainedResults)
                && isset($previousChainedResults["chained_results"])) {
                $instances = $previousChainedResults["chained_results"];
            } else {
                $instances = ResolveDefs::selectDefinitions(
                    $context,
                    $data,
                    $myDefTmp
                );
            }

            foreach ($instances as $instance) {
                if ($instance->isType(MyDefinition::TYPE_PROPERTY)) {
                    $state = $instance->getState($context->getCurrentBlock()->getId());
                    if (!is_null($state) && $state->isType(MyDefinition::TYPE_INSTANCE)) {
                        $classStackName[$i][] = $state;
                    }
                } else {
                    if ($instance->getCurrentState()->isType(MyDefinition::TYPE_INSTANCE)) {
                        $classStackName[$i][] = $instance->getCurrentState();
                    }
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

            $instances = ResolveDefs::selectDefinitions($context, $data, $copyDefAssign);
            foreach ($instances as $instance) {
                if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                    $idObject = $instance->getCurrentState()->getObjectId();
                    $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);
                    
                    if (!is_null($tmpMyClass)) {
                        $property = $tmpMyClass->getProperty($context, $instance, $prop);

                        if (!is_null($property)
                            && (ResolveDefs::getVisibility($copyDefAssign, $property, $currentFunc))) {
                            $visibilityFinal = true;
                            break;
                        }/* elseif (is_null($property)) {
                            $visibilityFinal = true; // property doesn't exist
                        }*/
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

    public static function selectDefinitions($context, $data, $searchedDed)
    {
        $defsFound = [];
        if (is_null($data)) {
            return $defsFound;
        }

        foreach ($data as $def) {
            if (Definitions::defEquality($def, $searchedDed)
                && ResolveDefs::isNearest($context, $searchedDed, $def)) {
                // we are looking for the nearest not instance of a property
                $defsFound[$def->getBlockId()][] = $def;
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
                if (ResolveDefs::isNearest($context, $searchedDed, $defLast)) {
                    if (is_null($nearestDef) || ResolveDefs::isNearest($context, $defLast, $nearestDef)) {
                        $nearestDef = $defLast;
                    }
                }
            }

            if (!is_null($nearestDef)) {
                $trueDefsFound[] = $nearestDef;
            }
        }


        $trueDefsFoundParams = [];
        foreach ($trueDefsFound as $trueDef) {
            if (!is_null($trueDef->getParamToArg())) {
                $trueDef = $trueDef->getParamToArg();
            }
            $trueDefsFoundParams[] = $trueDef;
        }

        return $trueDefsFoundParams;
    }

    public static function selectArrays($context, $data, $tempDefa, $arrayDim)
    {
        $arrayDefs = [];

        $copyTempDefa = clone $tempDefa;
        $copyTempDefa->addType(MyDefinition::TYPE_ARRAY);

        $arrayDefsTmp = ResolveDefs::selectDefinitions(
            $context,
            $data,
            $copyTempDefa
        );

        foreach ($arrayDefsTmp as $arrayDef) {/*
            if (!is_null($arrayDef->getParamToArg())) {
                $arrayDef = $arrayDef->getParamToArg();
            }
*/
            $arrayDefs[] = $arrayDef
                ->getCurrentState()
                    ->getOrCreateDefArrayIndex($tempDefa->getBlockId(), $arrayDef, $arrayDim);
        }

        return $arrayDefs;
    }

    public static function selectStaticProperties($context, $tempDef, $propertyName)
    {
        $currentFunc = $context->getCurrentFunc();
        $className = $tempDef->getName();

        $myClass = $context->getClasses()->getMyClass($className);

        if (!is_null($myClass)) {
            $property = $myClass->getProperty($context, $tempDef->getBlockId(), $tempDef, $propertyName);

            if (!is_null($property)
                && (ResolveDefs::getVisibility($tempDef, $property, $currentFunc))) {
                return $property;
            }
        }

        return null;
    }

    public static function selectProperties($context, $data, $tempDefa, $propertyName)
    {
        $propertiesDefs = [];
        $currentFunc = $context->getCurrentFunc();

        $tempDefaProp = clone $tempDefa;

        $instances = ResolveDefs::selectDefinitions($context, $data, $tempDefaProp);

        foreach ($instances as $instance) {
            if ($instance->isType(MyDefinition::TYPE_ITERATOR)
                && !empty($instance->getIteratorValues())
                    && $instance->getIteratorValues()[0]->getCurrentState()->isType(MyDefinition::TYPE_INSTANCE)) {
                // source of type array of properties
                $instance = $instance->getIteratorValues()[0];
            }
            
            if ($instance->isType(MyDefinition::TYPE_PROPERTY)
                || $instance->isType(MyDefinition::TYPE_ARRAY_ELEMENT)) {
                $state = $instance->getState($tempDefaProp->getBlockId());
                $stateId = $tempDefaProp->getBlockId();
            } else {
                $state = $instance->getCurrentState();
                $stateId = $instance->getBlockId();
            }

            if (!is_null($state) && $state->isType(MyDefinition::TYPE_INSTANCE)) {
                $idObject = $state->getObjectId();
                $tmpMyClass = $context->getObjects()->getMyClassFromObject($idObject);

                if (!is_null($tmpMyClass)) {
                    $property = $tmpMyClass->getProperty($context, $stateId, $instance, $propertyName);
                    if (!is_null($property)) {
                        if (ResolveDefs::getVisibility($tempDefaProp, $property, $currentFunc)) {
                            $propertiesDefs[] = [$property, $tmpMyClass];
                        }
                    }
                }
            }
        }

        return $propertiesDefs;
    }

    public static function selectGlobals($context, $defa)
    {
        $callStack = $context->getCallStack();

        if (is_array($callStack)) {
            for ($callNumber = count($callStack) - 1; $callNumber !== 0; $callNumber --) {
                $currentContextCall = $callStack[$callNumber][3];
                // ca peut arriver si on est dans le main() est qu'on appelle une globale
                if (!is_null($currentContextCall->func_called) && !is_null($currentContextCall->func_callee)) {
                    // we can't looking for an element of a global array in PHP
                    foreach ($currentContextCall->func_callee->getLastBlockIds() as $lastBlockId) {
                        $tempDefa = clone $defa;
                        $tempDefa->setLine($currentContextCall->func_called->getLine());
                        $tempDefa->setColumn($currentContextCall->func_called->getColumn());
                        $tempDefa->setBlockId($lastBlockId);

                        $resGlobal = ResolveDefs::selectDefinitions(
                            $context,
                            $currentContextCall->func_callee->getDefs()->getOutMinusKill($tempDefa->getBlockId()),
                            $tempDefa
                        );

                        // to not call recursively this function
                        if (!(count($resGlobal) === 1 && $resGlobal[0] === $tempDefa)) {
                            return $resGlobal;
                        }
                    }
                }
            }
        }

        return array();
    }
}
