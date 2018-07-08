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
    public static function mustVerifyDefinition($context, $instruction, $myfunc, $myclass)
    {
        $custom_rules = $context->inputs->getCustomRules();
        foreach ($custom_rules as $custom_rule) {
            if ($custom_rule->getType() === MyCustomRule::TYPE_FUNCTION
                && ($custom_rule->getAction() === "MUST_VERIFY_DEFINITION"
                    || $custom_rule->getAction() === "MUST_NOT_VERIFY_DEFINITION")) {
                $function_definition = $custom_rule->getFunctionDefinition();

                if (!is_null($function_definition)) {
                    if ($function_definition->getName() === $myfunc->getName()
                                && ((!$function_definition->isInstance() && is_null($myclass))
                                    || (!is_null($myclass) && $function_definition->isInstance()
                                        && $function_definition->getInstanceOfName() === $myclass->getName()))) {
                        $nbparams = 0;
                        $is_global_valid = true;

                        while (true) {
                            if (!$instruction->isPropertyExist("argdef$nbparams")) {
                                break;
                            }

                            $defarg = $instruction->getProperty("argdef$nbparams");
                            $values_parameter = $function_definition->getParameterValues($nbparams + 1);

                            if (!is_null($values_parameter)) {
                                $is_global_valid = false;

                                foreach ($values_parameter as $value_parameter) {
                                    $is_valid = true;
                                    $def_last_known_values = [];

                                    if (isset($value_parameter->is_array)
                                                && $value_parameter->is_array === true
                                                        && isset($value_parameter->array_index)) {
                                        if ($defarg->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                                            $copyArrays = $defarg->getCopyArrays();
                                            foreach ($copyArrays as $copyArray) {
                                                foreach ($copyArray[0] as $copy_index => $copy_value) {
                                                    if ($copy_index === $value_parameter->array_index) {
                                                        $def_last_known_values = $copyArray[1]->getLastKnownValues();

                                                        break 2;
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        $def_last_known_values = $defarg->getLastKnownValues();
                                    }

                                    foreach ($def_last_known_values as $last_known_value) {
                                        if (($value_parameter->value !== $last_known_value
                                            && $custom_rule->getAction() === "MUST_VERIFY_DEFINITION")
                                                || ($value_parameter->value === $last_known_value
                                                    && $custom_rule->getAction() === "MUST_NOT_VERIFY_DEFINITION")) {
                                            $is_valid = false;
                                            break;
                                        }
                                    }

                                    $is_global_valid = $is_valid;

                                    // if for one defined parameter value
                                    // all last know values are valid parameter is verified
                                    if ($is_valid) {
                                        break;
                                    }
                                }

                                // of one parameter is not valid
                                if (!$is_global_valid) {
                                    break;
                                }
                            }

                            $nbparams ++;
                        }

                        if (!$is_global_valid) {
                            $hashed_value = $custom_rule->getName()."-".$myfunc->getSourceMyFile()->getName();
                            $hash_id_vuln = hash("sha256", $hashed_value);

                            $temp["vuln_rule"] = Utils::encodeCharacters($custom_rule->getName());
                            $temp["vuln_name"] = Utils::encodeCharacters($custom_rule->getAttack());
                            $temp["vuln_line"] = $myfunc->getLine();
                            $temp["vuln_column"] = $myfunc->getColumn();
                            $temp["vuln_file"] = Utils::encodeCharacters($myfunc->getSourceMyFile()->getName());
                            $temp["vuln_description"] = Utils::encodeCharacters($custom_rule->getDescription());
                            $temp["vuln_cwe"] = Utils::encodeCharacters($custom_rule->getCwe());
                            $temp["vuln_id"] = $hash_id_vuln;
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
            $rules_verify_call_flow = [];
            $custom_rules = $context->inputs->getCustomRules();
            foreach ($custom_rules as $custom_rule) {
                if ($custom_rule->getType() === MyCustomRule::TYPE_SEQUENCE
                    && $custom_rule->getAction() === "MUST_VERIFY_CALL_FLOW") {
                    $sequence = $custom_rule->getSequence();

                    $custom_rule->setCurrentOrderNumber(0);
                    $rules_verify_call_flow[] = $custom_rule;

                    foreach ($sequence as $custom_function) {
                        $custom_function->setOrderNumberReal(-1);
                    }
                }
            }

            $function = $context->getFunctions()->getFunction("{main}");
            if (!is_null($function)) {
                $context->outputs->callgraph->addNode($function, null);

                foreach ($function->getBlocks() as $first_myblock) {
                    $calls = $context->outputs->callgraph->getCalls($first_myblock);
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
                    $depthfirstsearch = new DepthFirstSearch(
                        $nodes,
                        new DFSVisitor($context, $rules_verify_call_flow)
                    );
                    $depthfirstsearch->init($nodes[$NodeCG->getId()]);
                }
            }
        }
    }
}
