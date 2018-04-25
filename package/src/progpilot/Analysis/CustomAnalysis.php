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

class CustomAnalysis
{
        public static function must_verify_call_flow($context)
        {
            if ($context->get_analyze_hardrules())
            {
                $rules_verify_call_flow = [];
                $custom_rules = $context->inputs->get_custom_rules();
                foreach ($custom_rules as $custom_rule)
                {
                    $sequence = $custom_rule->get_sequence();
                    $last_function = $sequence[count($sequence) - 1];
                    if ($last_function->get_action() === "MUST_VERIFY_CALL_FLOW")
                    {
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

                    $NodeCG = new NodeCG($function->get_name(), $function->getLine(), $function->getColumn());
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
