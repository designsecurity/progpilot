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
    private $orderNumberExpected;
    private $orderNumberReal;

    public function __construct($name, $language, $orderNumberExpected = 0)
    {
        parent::__construct($name, $language);
        $this->action = null;
        $this->orderNumberExpected = $orderNumberExpected;
        $this->orderNumberReal = -1;

        $this->hasParameters = false;
        $this->parameters = [];
    }

    public function addParameter($parameter, $validbydefault, $fixed, $values = null)
    {
        $this->parameters[] = [$parameter, $values, $validbydefault, $fixed];
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

    public function isParameterFixed($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $values = $parameter[1];
            $validbydefault = $parameter[2];
            $fixed = $parameter[3];

            if ($index === $i) {
                return $fixed;
            }
        }

        return false;
    }

    public function isParameterValidByDefault($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $values = $parameter[1];
            $validbydefault = $parameter[2];

            if ($index === $i) {
                return $validbydefault;
            }
        }

        return false;
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

    public function setOrderNumberReal($orderNumberReal)
    {
        $this->orderNumberReal = $orderNumberReal;
    }

    public function getOrderNumberReal()
    {
        return $this->orderNumberReal;
    }

    public function setOrderNumberExpected($orderNumberExpected)
    {
        $this->orderNumberExpected = $orderNumberExpected;
    }

    public function getOrderNumberExpected()
    {
        return $this->orderNumberExpected;
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
