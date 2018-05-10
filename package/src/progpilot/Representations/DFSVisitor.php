<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

class DFSVisitor
{
        private $rules;
        private $context;

        public function __construct($context, $rules)
        {
            $this->rules = $rules;
            $this->context = $context;
        }

        public function initialize_node($node)
        {
            $node->set_color("white");
            $node->set_nb_views(0);
        }

        public function examine_node($node)
        {
            $node->set_nb_views($node->get_nb_views() + 1);

            foreach ($this->rules as $rule)
            {
                foreach ($rule->get_sequence() as $sequence)
                {
                    if ($node->get_name() === $sequence->get_name())
                    {
                        $mod = count($rule->get_sequence());
                        $rule->set_current_order_number($rule->get_current_order_number() + 1);

                        if (($rule->get_current_order_number() % $mod)
                                !== ($sequence->get_order_number_expected() % $mod))
                        {
                            $temp["vuln_name"] = \progpilot\Utils::encode_characters($rule->get_name());
                            $temp["vuln_line"] = $node->get_line();
                            $temp["vuln_column"] = $node->get_column();
                            $temp["vuln_file"] = \progpilot\Utils::encode_characters($node->get_file());
                            $temp["vuln_description"] = \progpilot\Utils::encode_characters($rule->get_name());

                            $this->context->outputs->add_result($temp);
                        }
                    }
                }
            }
        }

        public function examine_node_target($node)
        {
            if ($node->get_nb_views() >= $node->get_nb_parents())
                $node->set_color("black");
        }
}

?>
