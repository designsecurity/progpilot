<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MySource extends MySpecify
{

        private $is_array;
        private $is_function;
        private $array_value;
        private $return_array_value;
        private $is_return_array;
        private $parameters;
        private $conditions_parameters;
        private $has_parameters;

        const CONDITION_ARRAY = "condition_array";

        public function __construct($name, $language)
        {

            parent::__construct($name, $language);

            $this->is_function = false;
            $this->return_array_value = null;
            $this->is_return_array = false;
            $this->array_value = null;
            $this->is_array = false;
            $this->has_parameters = false;
            $this->parameters = [];
            $this->conditions_parameters = [];
        }

        public function get_is_return_array()
        {
            return $this->is_return_array;
        }

        public function set_return_array($arr)
        {
            $this->is_return_array = $arr;
        }

        public function set_return_array_value($arr)
        {
            $this->return_array_value = $arr;
        }

        public function get_return_array_value()
        {
            return $this->return_array_value;
        }

        public function get_is_array()
        {
            return $this->is_array;
        }

        public function set_is_array($is_array)
        {
            $this->is_array = $is_array;
        }

        public function get_array_value()
        {
            return $this->array_value;
        }

        public function set_array_value($array_value)
        {
            $this->array_value = $array_value;
        }

        public function is_function()
        {
            return $this->is_function;
        }

        public function set_is_function($is_function)
        {
            $this->is_function = $is_function;
        }

        public function add_condition_parameter($parameter, $condition, $value)
        {
            $this->conditions_parameters[$parameter][] = [$condition, $value];
        }

        public function get_condition_parameter($parameter, $condition)
        {
            foreach ($this->conditions_parameters[$parameter] as $condition_param)
            {
                if ($condition_param[0] === $condition)
                    return $condition_param[1];
            }

            return null;
        }

        public function add_parameter($parameter)
        {
            $this->parameters[] = $parameter;
        }

        public function get_parameters()
        {
            return $this->parameters;
        }

        public function is_parameter($i)
        {
            foreach ($this->parameters as $parameter)
            {
                if ($parameter === $i)
                    return true;
            }

            return false;
        }

        public function has_parameters()
        {
            return $this->has_parameters;
        }

        public function set_has_parameters($has_parameters)
        {
            $this->has_parameters = $has_parameters;
        }
}

?>
