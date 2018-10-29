<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Representations\DepthFirstSearch;
use progpilot\Representations\DFSVisitor;
use progpilot\Representations\NodeCG;
use progpilot\Inputs\MyCustomRule;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyClass;
use progpilot\Code\MyInstruction;
use progpilot\Utils;

class CustomAnalysis
{
    public static function defineObject($context, $myFuncorDef, $stackClass)
    {
        $customRules = $context->inputs->getCustomRules();
        foreach ($customRules as $customRule) {
            if ($customRule->getType() === MyCustomRule::TYPE_VARIABLE
                && $customRule->getAction() === "DEFINE_OBJECT"
                    && !is_null($customRule->getExtra())) {
                $myClassNew = new MyClass(
                    $myFuncorDef->getLine(),
                    $myFuncorDef->getColumn(),
                    $customRule->getExtra()
                );
                
                $definition = $customRule->getDefinition();
                $checkName = false;
                if ($myFuncorDef->isType(MyDefinition::TYPE_PROPERTY)) {
                    $properties = $myFuncorDef->property->getProperties();
                    if (is_array($properties) && isset($properties[count($properties) - 1])) {
                        $lastproperty = $properties[count($properties) - 1];
                        if ($lastproperty === $definition->getName()) {
                            $checkName = true;
                        }
                    }
                }
                    
                if (!is_null($definition) && ($definition->getName() === $myFuncorDef->getName()) || $checkName) {
                    if ($definition->isInstance() && !is_null($stackClass)) {
                        if ($definition->getLanguage() === "php") {
                            $propertiesRule = explode("->", $definition->getInstanceOfName());
                        } elseif ($definition->getLanguage() === "js") {
                            $propertiesRule = explode(".", $definition->getInstanceOfName());
                        }

                        if (is_array($propertiesRule)) {
                            $i = 0;
                            foreach ($propertiesRule as $propertyName) {
                                $foundProperty = false;
                                
                                if (isset($stackClass[$i])) {
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
                                    break;
                                }
                            
                                $i ++;
                            }
                            
                            if ($foundProperty) {
                                return $myClassNew;
                            }
                        }
                    } elseif (!$definition->isInstance()) {
                        return $myClassNew;
                    }
                }
            }
        }
        
        return null;
    }
    
    public static function returnObjectCreateObject($context, $myExpr, $customRule, $myFuncorDef)
    {
        $defAssign = $myExpr->getAssignDef();
                
        $objectId = $context->getObjects()->addObject();
                
        $defAssign->addType(MyDefinition::TYPE_INSTANCE);
        $defAssign->setObjectId($objectId);
                        
        $myClass = $context->getClasses()->getMyClass($customRule->getExtra());
                                
        if (is_null($myClass)) {
            $myClass = new MyClass(
                $defAssign->getLine(),
                $defAssign->getColumn(),
                $customRule->getExtra()
            );
        }

        $context->getObjects()->addMyclassToObject($objectId, $myClass);
        
        $myBackDef = $myFuncorDef->getBackDef();
        if (!is_null($myBackDef)) {
            $objectId = $myBackDef->getObjectId();
            $context->getObjects()->addMyclassToObject($objectId, $myClass);
        }
    }
    
    public static function returnObject($context, $myFuncorDef, $stackClass, $myExpr)
    {
        if (!is_null($myExpr) && $myExpr->isAssign()) {
            $customRules = $context->inputs->getCustomRules();
            foreach ($customRules as $customRule) {
                if ($customRule->getType() === MyCustomRule::TYPE_FUNCTION
                    && $customRule->getAction() === "DEFINE_OBJECT"
                        && !is_null($customRule->getExtra())) {
                    $definition = $customRule->getDefinition();
                    
                    if (!is_null($definition) && $definition->getName() === $myFuncorDef->getName()) {
                        if ($definition->isInstance() && !is_null($stackClass)) {
                            if ($definition->getLanguage() === "php") {
                                $propertiesRule = explode("->", $definition->getInstanceOfName());
                            } elseif ($definition->getLanguage() === "js") {
                                $propertiesRule = explode(".", $definition->getInstanceOfName());
                            }

                            if (is_array($propertiesRule)) {
                                $myRuleInstanceName = $propertiesRule[0];
                                $myRuleNumberOfProperties = count($propertiesRule);
                                $stackNumberOfProperties = count($stackClass);

                                if ($stackNumberOfProperties >= $myRuleNumberOfProperties) {
                                    $knownProperties =
                                        $stackClass[$stackNumberOfProperties - $myRuleNumberOfProperties];

                                    foreach ($knownProperties as $propClass) {
                                        $objectId = $propClass->getObjectId();
                                        $myClass = $context->getObjects()->getMyClassFromObject($objectId);
                                        
                                        if (!is_null($myClass)
                                            && ($myClass->getName() === $myRuleInstanceName
                                                || $myClass->getExtendsOf() === $myRuleInstanceName)) {
                                            CustomAnalysis::returnObjectCreateObject(
                                                $context,
                                                $myExpr,
                                                $customRule,
                                                $myFuncorDef
                                            );
                                        }
                                    }
                                }
                            }
                        } elseif (!$definition->isInstance()/*
                                && is_null($myFuncorDef->getMyClass())*/) {
                            CustomAnalysis::returnObjectCreateObject(
                                $context,
                                $myExpr,
                                $customRule,
                                $myFuncorDef
                            );
                        }
                    }
                }
            }
        }
    }

    public static function mustVerifyDefinition($context, $instruction, $myFunc, $myClass)
    {
        $customRules = $context->inputs->getCustomRules();
        foreach ($customRules as $customRule) {
            if ($customRule->getType() === MyCustomRule::TYPE_FUNCTION
                && ($customRule->getAction() === "MUST_VERIFY_DEFINITION"
                    || $customRule->getAction() === "MUST_NOT_VERIFY_DEFINITION")) {
                $functionDefinition = $customRule->getDefinition();

                if (!is_null($functionDefinition)) {
                    if ($functionDefinition->getName() === $myFunc->getName()
                        && ((!$functionDefinition->isInstance() && is_null($myClass))
                            || (!is_null($myClass) && $functionDefinition->isInstance()
                                && $functionDefinition->getInstanceOfName() === $myClass->getName()))) {
                        $nbParams = 0;
                        $isGlobalValid = true;

                        while (true) {
                            if (!$instruction->isPropertyExist("argdef$nbParams")) {
                                break;
                            }

                            $defArg = $instruction->getProperty("argdef$nbParams");
                            $valuesParameter = $functionDefinition->getParameterValues($nbParams + 1);

                            if (!is_null($valuesParameter)) {
                                $isGlobalValid = false;

                                foreach ($valuesParameter as $valueParameter) {
                                    $isValid = true;
                                    $defLastKnownValues = [];

                                    if (isset($valueParameter->is_array)
                                        && $valueParameter->is_array === true
                                            && isset($valueParameter->array_index)) {
                                        if ($defArg->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                                            $copyArrays = $defArg->getCopyArrays();
                                            foreach ($copyArrays as $copyArray) {
                                                foreach ($copyArray[0] as $copyIndex => $copyValue) {
                                                    if ($copyIndex === $valueParameter->array_index) {
                                                        $defLastKnownValues = $copyArray[1]->getLastKnownValues();

                                                        break 2;
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        $defLastKnownValues = $defArg->getLastKnownValues();
                                    }

                                    foreach ($defLastKnownValues as $lastKnownValue) {
                                        if (($valueParameter->value !== $lastKnownValue
                                            && $customRule->getAction() === "MUST_VERIFY_DEFINITION")
                                                || ($valueParameter->value === $lastKnownValue
                                                    && $customRule->getAction() === "MUST_NOT_VERIFY_DEFINITION")) {
                                            $isValid = false;
                                            break;
                                        }
                                    }

                                    $isGlobalValid = $isValid;

                                    // if for one defined parameter value
                                    // all last know values are valid parameter is verified
                                    if ($isValid) {
                                        break;
                                    }
                                }

                                // of one parameter is not valid
                                if (!$isGlobalValid) {
                                    break;
                                }
                            }

                            $nbParams ++;
                        }

                        if (!$isGlobalValid) {
                            $hashedValue = $myFunc->getLine();
                            $hashedValue.= "-".$customRule->getAction()."-".$myFunc->getSourceMyFile()->getName();
                            $idVuln = hash("sha256", $hashedValue);

                            $temp["vuln_rule"] = Utils::encodeCharacters($customRule->getAction());
                            $temp["vuln_name"] = Utils::encodeCharacters($customRule->getAttack());
                            $temp["vuln_line"] = $myFunc->getLine();
                            $temp["vuln_column"] = $myFunc->getColumn();
                            $temp["vuln_file"] = Utils::encodeCharacters($myFunc->getSourceMyFile()->getName());
                            $temp["vuln_description"] = Utils::encodeCharacters($customRule->getDescription());
                            $temp["vuln_cwe"] = Utils::encodeCharacters($customRule->getCwe());
                            $temp["vuln_id"] = $idVuln;
                            $temp["vuln_type"] = "custom";
                            $context->outputs->addResult($temp);
                        }
                    }
                }
            }
        }
    }

    public static function mustVerifyCallFlow($context)
    {
        if ($context->getAnalyzeHardrules()) {
            $rulesVerifyCallFlow = [];
            $customRules = $context->inputs->getCustomRules();
            foreach ($customRules as $customRule) {
                if ($customRule->getType() === MyCustomRule::TYPE_SEQUENCE
                    && $customRule->getAction() === "MUST_VERIFY_CALL_FLOW") {
                    $sequence = $customRule->getSequence();

                    $customRule->setCurrentOrderNumber(0);
                    $rulesVerifyCallFlow[] = $customRule;

                    foreach ($sequence as $customFunction) {
                        $customFunction->setOrderNumberReal(-1);
                    }
                }
            }

            $function = $context->getFunctions()->getFunction("{main}");
            if (!is_null($function)) {
                $context->outputs->callgraph->addNode($function, null);

                foreach ($function->getBlocks() as $firstMyBlock) {
                    $calls = $context->outputs->callgraph->getCalls($firstMyBlock);
                    if (!is_null($calls)) {
                        foreach ($calls as $call) {
                            $context->outputs->callgraph->addEdge($function, null, $call[0], $call[1]);
                        }
                    }

                    break;
                }

                $NodeCG = new NodeCG(
                    $function->getName(),
                    $function->getLine(),
                    $function->getColumn(),
                    $function->getSourceMyFile()->getName(),
                    null
                );
                $nodes = $context->outputs->callgraph->getNodes();

                if (array_key_exists($NodeCG->getId(), $nodes)) {
                    $depthFirstSearch = new DepthFirstSearch(
                        $nodes,
                        new DFSVisitor($context, $rulesVerifyCallFlow)
                    );
                    $depthFirstSearch->init($nodes[$NodeCG->getId()]);
                }
            }
        }
    }
}
