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

class CustomAnalysis
{

        public static function must_verify_definition($context, $instruction, $myfunc, $myclass)
        {
            $custom_rules = $context->inputs->get_custom_rules();
            foreach ($custom_rules as $custom_rule)
            {
                if ($custom_rule->get_type() === MyCustomRule::FUNCTION
                                                  && $custom_rule->get_action() === "MUST_VERIFY_DEFINITION")
                {
                    $function_definition = $custom_rule->get_function_definition();

                    if (!is_null($function_definition))
                    {
                        if ($function_definition->get_name() === $myfunc->get_name())
                        {
                            $nbparams = 0;
                            $is_global_valid = true;

                            while (true)
                            {
                                if (!$instruction->is_property_exist("argdef$nbparams"))
                                    break;

                                $exprarg = $instruction->get_property("argexpr$nbparams");
                                $values_parameter = $function_definition->get_parameter_values($nbparams + 1);

                                if (!is_null($values_parameter))
                                {
                                    $thedefsargs = $exprarg->get_defs();
                                    if (count($thedefsargs) > 0)
                                    {
                                        $is_global_valid = false;

                                        foreach ($values_parameter as $value_parameter)
                                        {
                                            $is_valid = true;

                                            foreach ($thedefsargs as $defarg)
                                            {
                                                foreach ($defarg->get_last_known_values() as $last_known_value)
                                                {
                                                    if ($value_parameter->value !== $last_known_value)
                                                    {
                                                        $is_valid = false;
                                                        break;
                                                    }
                                                }
                                            }

                                            $is_global_valid = $is_valid;

                                            // if for one defined parameter value all last know values are valid parameter is verified
                                            if ($is_valid)
                                                break;
                                        }

                                        // of one parameter is not valid
                                        if (!$is_global_valid)
                                            break;
                                    }
                                }

                                $nbparams ++;
                            }

                            if (!$is_global_valid)
                            {
                                $temp["vuln_name"] = \progpilot\Utils::encode_characters($custom_rule->get_name());
                                $temp["vuln_line"] = $myfunc->getLine();
                                $temp["vuln_column"] = $myfunc->getColumn();
                                $temp["vuln_file"] = \progpilot\Utils::encode_characters($myfunc->get_source_myfile()->get_name());
                                $temp["vuln_description"] = \progpilot\Utils::encode_characters($custom_rule->get_description());
                                $context->outputs->add_result($temp);
                            }
                        }
                    }
                }
            }
        }

        public static function must_verify_call_flow($context)
        {
            if ($context->get_analyze_hardrules())
            {
                $rules_verify_call_flow = [];
                $custom_rules = $context->inputs->get_custom_rules();
                foreach ($custom_rules as $custom_rule)
                {
                    if ($custom_rule->get_type() === MyCustomRule::SEQUENCE
                                                      && $custom_rule->get_action() === "MUST_VERIFY_CALL_FLOW")
                    {
                        $sequence = $custom_rule->get_sequence();

                        $custom_rule->set_current_order_number(0);
                        $rules_verify_call_flow[] = $custom_rule;

                        foreach ($sequence as $custom_function)
                            $custom_function->set_order_number_real(-1);
                    }
                }

                $function = $context->get_functions()->get_function("{main}");
                if (!is_null($function))
                {
                    $context->outputs->callgraph->add_node($function);

                    foreach ($function->get_blocks() as $first_myblock)
                    {
                        $calls = $context->outputs->callgraph->get_calls($first_myblock);
                        if (!is_null($calls))
                        {
                            foreach ($calls as $func_call)
                                $context->outputs->callgraph->add_edge($function, $func_call);
                        }

                        break;
                    }

                    $NodeCG = new NodeCG($function->get_name(), $function->getLine(), $function->getColumn(), $function->get_source_myfile()->get_name());
                    $nodes = $context->outputs->callgraph->get_nodes();

                    if (array_key_exists($NodeCG->get_id(), $nodes))
                    {
                        $depthfirstsearch = new DepthFirstSearch($nodes, new DFSVisitor($context, $rules_verify_call_flow));
                        $depthfirstsearch->init($nodes[$NodeCG->get_id()]);
                    }
                }
            }
        }
}
