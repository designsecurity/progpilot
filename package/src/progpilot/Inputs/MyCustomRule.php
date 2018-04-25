<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyCustomRule
{
        private $name_rule;
        private $sequence_rule;
        private $current_order_number;

        public function __construct($name_rule)
        {
            $this->name_rule = $name_rule;
            $this->sequence_rule = [];
            $this->current_order_number = 0;
        }

        public function get_name()
        {
            return $this->name_rule;
        }

        public function set_name($name_rule)
        {
            $this->name_rule = $name_rule;
        }

        public function get_current_order_number()
        {
            return $this->current_order_number;
        }

        public function set_current_order_number($current_order_number)
        {
            $this->current_order_number = $current_order_number;
        }

        public function get_sequence()
        {
            return $this->sequence_rule;
        }

        public function add_to_sequence($function_name, $language)
        {
            $this->current_order_number ++;
            $this->sequence_rule[] = new MyCustomFunction($function_name, $language, $this->current_order_number);
        }

        public function add_to_sequence_with_action($function_name, $language, $action)
        {
            $this->current_order_number ++;
            $mycustomfunction = new MyCustomFunction($function_name, $language, $this->current_order_number);
            $mycustomfunction->set_action($action);

            $this->sequence_rule[] = $mycustomfunction;
        }
}

?>
