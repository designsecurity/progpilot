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
use progpilot\Helpers\Analysis as HelpersAnalysis;

class CustomAnalysis
{
    public static function disclosureOfInformation($context, $defs, $defassign)
    {
        $customRules = $context->inputs->getCustomRules();
        foreach ($customRules as $customRule) {
            if ($customRule->getType() === MyCustomRule::TYPE_VARIABLE
                && $customRule->getAction() === "ASSIGNMENT_DISCLOSE_HIGH_VALUE") {
                $result = HelpersAnalysis::checkIfDefEqualDefRule($context, $defs, $customRule, $defassign);
                                        
                if ($result) {
                    $hashedValue = $defassign->getLine();
                    $hashedValue.= "-".$customRule->getAction()."-".$defassign->getSourceMyFile()->fileName;
                    $idVuln = hash("sha256", $hashedValue);

                    if (is_null($context->inputs->getFalsePositiveById($idVuln))) {
                        $temp["vuln_rule"] = Utils::encodeCharacters($customRule->getAction());
                        $temp["vuln_name"] = Utils::encodeCharacters($customRule->getAttack());
                        $temp["vuln_line"] = $defassign->getLine();
                        $temp["vuln_column"] = $defassign->getColumn();
                        $temp["vuln_file"] = Utils::encodeCharacters($defassign->getSourceMyFile()->getName());
                        $temp["vuln_description"] = Utils::encodeCharacters($customRule->getDescription());
                        $temp["vuln_cwe"] = Utils::encodeCharacters($customRule->getCwe());
                        $temp["vuln_id"] = $idVuln;
                        $temp["vuln_type"] = "custom";
                        $context->outputs->addResult($temp);
                    }
                }
            }
        }
        
        return null;
    }
    
    public static function defineObject($context, $instruction, $myFuncorDef, $myClassFound, $virtualReturnDef)
    {
        $customRules = $context->inputs->getCustomRules();
        foreach ($customRules as $customRule) {
            if ($customRule->getType() === MyCustomRule::TYPE_VARIABLE
                && $customRule->getAction() === "DEFINE_OBJECT"
                    && !is_null($customRule->getExtra())) {
                $result = HelpersAnalysis::checkIfDefEqualDefRule(
                    $context,
                    null,
                    $customRule,
                    $myFuncorDef,
                    $myClassFound
                );

                if ($result) {
                    return CustomAnalysis::returnObjectCreateObject(
                        $context,
                        $customRule,
                        $myFuncorDef,
                        $virtualReturnDef
                    );
                }
            }
        }
        
        return null;
    }
    
    public static function returnObjectCreateObject($context, $customRule, $myFuncorDef, $virtualReturnDef)
    {
        $myFakeInstance = null;

        // $this->foo->bar (we want to define an object on bar)
        if ($myFuncorDef->isType(MyDefinition::TYPE_PROPERTY)) {
            $myFakeInstance = $myFuncorDef;
            $myFakeInstance->addType(MyDefinition::TYPE_INSTANCE);
            $myFakeInstance->setClassName($customRule->getExtra());
        } elseif (!is_null($virtualReturnDef)) {
            $myFakeInstance = $virtualReturnDef;
            $myFakeInstance->addType(MyDefinition::TYPE_INSTANCE);
            $myFakeInstance->setClassName($customRule->getExtra());
        }

        if (!is_null($myFakeInstance)) {
            HelpersAnalysis::createObject($context, $myFakeInstance);
            return $myFakeInstance;
        }
    }
    
    public static function returnObject($context, $myFuncorDef, $myClass, $instruction, $virtualReturnDef)
    {
        $customRules = $context->inputs->getCustomRules();
        foreach ($customRules as $customRule) {
            if ($customRule->getType() === MyCustomRule::TYPE_FUNCTION
                    && $customRule->getAction() === "DEFINE_OBJECT"
                        && !is_null($customRule->getExtra())) {
                $result = HelpersAnalysis::checkIfDefEqualDefRule(
                    $context,
                    null,
                    $customRule,
                    $myFuncorDef,
                    $myClass
                );
                if ($result) {
                    return CustomAnalysis::returnObjectCreateObject(
                        $context,
                        $customRule,
                        $myFuncorDef,
                        $virtualReturnDef
                    );
                }
            }
        }
        
        return null;
    }

    public static function mustVerifyDefinition($context, $instruction, $myFunc, $myClass = null)
    {
        $customRules = $context->inputs->getCustomRules();
        foreach ($customRules as $customRule) {
            if ($customRule->getType() === MyCustomRule::TYPE_FUNCTION
                && ($customRule->getAction() === "MUST_VERIFY_DEFINITION"
                    || $customRule->getAction() === "MUST_NOT_VERIFY_DEFINITION")) {
                $functionDefinition = $customRule->getDefinition();
                
                if (!is_null($functionDefinition)) {
                    $result = HelpersAnalysis::checkIfFuncEqualMySpecify(
                        $context,
                        $functionDefinition,
                        $myFunc,
                        $myClass
                    );
                    if ($result) {
                        if ($myFunc->getNbParams() < $functionDefinition->getMinNbArgs()
                            || $myFunc->getNbParams() > $functionDefinition->getMaxNbArgs()) {
                            $isValid = true;
                        } else {
                            $isValid = false;
                            $params = $functionDefinition->getParameters();
                            
                            // if one parameter is not valid all the rule is not valid
                            foreach ($params as $param) {
                                $isValid = false;

                                $idParam = $param[0] - 1;
                                $valuesParameter = $param[1];
                                $validbydefault = $param[2];
                                $isParameterFixed = $param[3];
                                $isParameterSufficient = $param[4];
                                $isParameterFailIfNotVerifed = $param[5];
                                $isParameterNotEquals = $param[6];

                                if (!is_null($valuesParameter)) {
                                    if (!$instruction->isPropertyExist("argdef$idParam")) {
                                        $isValid = $validbydefault;
                                        break;
                                    }
                                    
                                    $defArg = $instruction->getProperty("argdef$idParam");
                        
                                    foreach ($valuesParameter as $valueParameter) {
                                        $defLastKnownValues = [];

                                        if (isset($valueParameter->is_array)
                                            && $valueParameter->is_array === true
                                                && isset($valueParameter->array_index)) {
                                            $arrayfound = false;
                                            
                                            if ($defArg->getCurrentState()->isType(MyDefinition::TYPE_ARRAY)) {
                                                foreach ($defArg->getCurrentState()->getArrayIndexes() as $arrayIndex) {
                                                    if ($arrayIndex->index === $valueParameter->array_index) {
                                                        $defLastKnownValues =
                                                            $arrayIndex->def->getCurrentState()->getLastKnownValues();
                                                        $arrayfound = true;

                                                        break;
                                                    }
                                                }
                                            }
                                            
                                            if (!$arrayfound) {
                                                $isValid = $validbydefault;
                                                break 2;
                                            }
                                        } else {
                                            $defLastKnownValues = $defArg->getCurrentState()->getLastKnownValues();
                                        }
                                        
                                        if (count($defLastKnownValues) === 0) {
                                            $isValid = false;
                                        }

                                        // we check all the values of a param
                                        $validForAllValues = false;
                                        foreach ($defLastKnownValues as $lastKnownValue) {
                                            // if it's valid we continue
                                            if (($valueParameter->value === $lastKnownValue
                                                && !$isParameterNotEquals)
                                                || ($valueParameter->value !== $lastKnownValue
                                                && $isParameterNotEquals)) {
                                                $validForAllValues = true;
                                            } else {
                                                // it's not valid we can break
                                                $validForAllValues = false;

                                                // we just need to found one parameter that is equals
                                                if ($isParameterNotEquals) {
                                                    break 2;
                                                } else {
                                                    break;
                                                }
                                            }
                                        }

                                        $isValid = $validForAllValues;
                                        // we found a value of the param valid, we don't need to continue on
                                        // other possible values of the rule
                                        if ($isValid) {
                                            break;
                                        }
                                    }

                                    // for must_verify definition
                                    //   * if one parameter is valid (respect conditions):
                                    //      * it can be enough (if sufficient) to valid the rule (no issue)
                                    //   * if one parameter is not valid:
                                    //      * the rule is not valid except if raise_if_not_verified set to false
                                    //      * the rule is valid if fixed (required) option is set

                                    // for must_not_verify definition
                                    //   * if one parameter is valid (respect conditions):
                                    //      * the rule is not valid  except if raise_if_not_verified set to false
                                    //      * the rule is vali  except if fixed (required) option is set
                                    //   * if one parameter is not valid (doesn't respect conditions):
                                    //      * it can be enough (if sufficient) to valid the rule (no issue)

                                    // one parameter is not valid and required
                                    if (!$isValid
                                        && $isParameterFixed) {
                                        $isValid = true;
                                        break;
                                    }

                                    if ($customRule->getAction() === "MUST_NOT_VERIFY_DEFINITION") {
                                        $isValid = !$isValid;
                                    }

                                    // one parameter is valid and enough
                                    if ($isValid
                                        && $isParameterSufficient) {
                                        $isValid = true;
                                        break;
                                    }

                                    // one parameter is not valid but should not fail and continue with other params
                                    if (!$isValid
                                        && !$isParameterFailIfNotVerifed) {
                                        $isValid = true;
                                    }

                                    // one parameter is not valid
                                    if (!$isValid) {
                                        break;
                                    }
                                }
                            }
                        }
                        
                        if (!$isValid) {
                            $hashedValue = $myFunc->getLine();
                            $hashedValue.= "-".$customRule->getAction()."-".$myFunc->getSourceMyFile()->fileName;
                            $idVuln = hash("sha256", $hashedValue);
                            
                            if (is_null($context->inputs->getFalsePositiveById($idVuln))) {
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
    }

    public static function mustVerifyCallFlow($context, $callgraph)
    {
        $firstCustomFunctions = [];
        $rulesVerifyCallFlow = [];
        $customRules = $context->inputs->getCustomRules();
        foreach ($customRules as $customRule) {
            if ($customRule->getType() === MyCustomRule::TYPE_SEQUENCE
                    && $customRule->getAction() === "MUST_VERIFY_CALL_FLOW") {
                $sequence = $customRule->getSequence();

                $customRule->setCurrentOrderNumber(0);
                $rulesVerifyCallFlow[] = $customRule;

                if (is_array($sequence) && !empty($sequence)) {
                    $firstCustomFunctions[] = $sequence[0];
                    foreach ($sequence as $customFunction) {
                        $customFunction->setOrderNumberReal(-1);
                    }
                }
            }
        }

        foreach ($firstCustomFunctions as $firstCustomFunction) {
            $functions = $context->getFunctions()->getAllFunctions($firstCustomFunction->getName());
            foreach ($functions as $function) {
                if (!is_null($function)) {
                    $callgraph->addNode($function, null);

                    foreach ($function->getBlocks() as $firstMyBlock) {
                        $calls = $callgraph->getCalls($firstMyBlock);
                        if (!is_null($calls)) {
                            foreach ($calls as $call) {
                                $callgraph->addEdge($function, null, $call[0], $call[1]);
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
                    $nodes = $callgraph->getNodes();

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
}
