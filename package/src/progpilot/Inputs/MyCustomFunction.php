<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyCustomFunction extends MySpecify
{
        private $parameters;
        private $has_parameters;

        private $action;
        private $order_number_expected;
        private $order_number_real;

        public function __construct($name, $language, $order_number_expected = 0)
        {

            parent::__construct($name, $language);
            $this->action = null;
            $this->order_number_expected = $order_number_expected;
            $this->order_number_real = -1;

            $this->has_parameters = false;
            $this->parameters = [];
        }

        public function add_parameter($parameter, $values = null)
        {
            $this->parameters[] = [$parameter, $values];
        }

        public function get_parameters()
        {
            return $this->parameters;
        }

        public function has_parameters()
        {
            return $this->has_parameters;
        }

        public function set_has_parameters($has_parameters)
        {
            $this->has_parameters = $has_parameters;
        }

        public function get_parameter_values($i)
        {
            foreach ($this->parameters as $parameter)
            {
                $index = $parameter[0];
                $values = $parameter[1];

                if ($index === $i)
                    return $values;
            }

            return null;
        }

        public function set_order_number_real($order_number_real)
        {
            $this->order_number_real = $order_number_real;
        }

        public function get_order_number_real()
        {
            return $this->order_number_real;
        }

        public function set_order_number_expected($order_number_expected)
        {
            $this->order_number_expected = $order_number_expected;
        }

        public function get_order_number_expected()
        {
            return $this->order_number_expected;
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
