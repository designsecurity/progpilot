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
    private $hasParameters;

    private $action;
    private $order_number_expected;
    private $order_number_real;

    public function __construct($name, $language, $order_number_expected = 0)
    {
        parent::__construct($name, $language);
        $this->action = null;
        $this->order_number_expected = $order_number_expected;
        $this->order_number_real = -1;

        $this->hasParameters = false;
        $this->parameters = [];
    }

    public function addParameter($parameter, $values = null)
    {
        $this->parameters[] = [$parameter, $values];
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function hasParameters()
    {
        return $this->hasParameters;
    }

    public function setHasParameters($hasParameters)
    {
        $this->hasParameters = $hasParameters;
    }

    public function getParameterValues($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $values = $parameter[1];

            if ($index === $i) {
                return $values;
            }
        }

        return null;
    }

    public function setOrderNumberReal($order_number_real)
    {
        $this->order_number_real = $order_number_real;
    }

    public function getOrderNumberReal()
    {
        return $this->order_number_real;
    }

    public function setOrderNumberExpected($order_number_expected)
    {
        $this->order_number_expected = $order_number_expected;
    }

    public function getOrderNumberExpected()
    {
        return $this->order_number_expected;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        return $this->action = $action;
    }
}
