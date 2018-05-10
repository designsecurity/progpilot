<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MySink extends MySpecify
{

        private $attack;
        private $cwe;
        private $parameters;
        private $has_parameters;

        public function __construct($name, $language, $attack, $cwe)
        {

            parent::__construct($name, $language);

            $this->attack = $attack;
            $this->cwe = $cwe;
            $this->has_parameters = false;
            $this->parameters = [];
            $this->global_conditions = [];
        }

        public function add_global_condition($condition)
        {
            $this->global_conditions[] = $condition;
        }

        public function is_global_condition($condition)
        {
            foreach ($this->global_conditions as $condition_global)
            {
                if ($condition === $condition_global)
                    return true;
            }

            return false;
        }

        public function add_parameter($id, $condition = null)
        {
            $parameter = [$id, $condition];
            $this->parameters[] = $parameter;
        }

        public function get_parameters()
        {
            return $this->parameters;
        }

        public function get_parameter_condition($i)
        {
            foreach ($this->parameters as $parameter)
            {
                $index = $parameter[0];
                $condition = $parameter[1];

                if ($index === $i)
                    return $condition;
            }

            return null;
        }

        public function is_parameter($i)
        {
            foreach ($this->parameters as $parameter)
            {
                $index = $parameter[0];
                if ($index === $i)
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

        public function get_attack()
        {
            return $this->attack;
        }

        public function get_cwe()
        {
            return $this->cwe;
        }
}

?>
