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
        const TYPE_FUNCTION = "function";
        const TYPE_SEQUENCE = "sequence";

        private $action;
        private $type;
        private $function_definition;
        private $name_rule;
        private $attack;
        private $cwe;
        private $description_rule;
        private $sequence_rule;
        private $current_order_number;

        public function __construct($name_rule, $description_rule)
        {
            $this->action = null;
            $this->type = MyCustomRule::TYPE_FUNCTION;
            $this->name_rule = $name_rule;
            $this->description_rule = $description_rule;
            $this->sequence_rule = [];
            $this->current_order_number = 0;
            $this->function_definition = null;
            $this->attack = null;
            $this->cwe = null;
        }

        public function get_attack()
        {
            return $this->attack;
        }

        public function set_attack($attack)
        {
            $this->attack = $attack;
        }

        public function get_cwe()
        {
            return $this->cwe;
        }

        public function set_cwe($cwe)
        {
            $this->cwe = $cwe;
        }

        public function get_type()
        {
            return $this->type;
        }

        public function set_type($type)
        {
            $this->type = $type;
        }

        public function get_function_definition()
        {
            return $this->function_definition;
        }

        public function set_function_definition($function_definition)
        {
            $this->function_definition = $function_definition;
        }

        public function get_name()
        {
            return $this->name_rule;
        }

        public function set_name($name_rule)
        {
            $this->name_rule = $name_rule;
        }

        public function get_description()
        {
            return $this->description_rule;
        }

        public function set_description($description_rule)
        {
            $this->description_rule = $description_rule;
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

        public function add_to_sequence_with_action($function_name, $language, $action)
        {
            $this->current_order_number ++;
            $mycustomfunction = new MyCustomFunction($function_name, $language, $this->current_order_number);
            $mycustomfunction->set_action($action);
            $this->sequence_rule[] = $mycustomfunction;

            return $mycustomfunction;
        }

        public function add_to_sequence($function_name, $language)
        {
            $this->current_order_number ++;
            $mycustomfunction = new MyCustomFunction($function_name, $language, $this->current_order_number);
            $this->sequence_rule[] = $mycustomfunction;

            return $mycustomfunction;
        }

        public function add_function_definition($function_name, $language)
        {
            $mycustomfunction = new MyCustomFunction($function_name, $language);
            $this->function_definition = $mycustomfunction;

            return $mycustomfunction;
        }

        public function get_action()
        {
            return $this->action;
        }

        public function set_action($action)
        {
            return $this->action = $action;
        }
}

?>
