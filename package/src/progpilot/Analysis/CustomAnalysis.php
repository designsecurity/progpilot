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
use progpilot\Utils;

class CustomAnalysis
{
    public static function mustVerifyDefinition($context, $instruction, $myFunc, $myClass)
    {
        $customRules = $context->inputs->getCustomRules();
        foreach ($customRules as $customRule) {
            if ($customRule->getType() === MyCustomRule::TYPE_FUNCTION
                && ($customRule->getAction() === "MUST_VERIFY_DEFINITION"
                    || $customRule->getAction() === "MUST_NOT_VERIFY_DEFINITION")) {
                $functionDefinition = $customRule->getFunctionDefinition();

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
                            $hashedValue = $customRule->getName()."-".$myFunc->getSourceMyFile()->getName();
                            $idVuln = hash("sha256", $hashedValue);

                            $temp["vuln_rule"] = Utils::encodeCharacters($customRule->getName());
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
