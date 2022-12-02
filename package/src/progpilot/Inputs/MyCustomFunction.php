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
    
    private $minNbArgs;
    private $maxNbArgs;

    public function __construct($name, $language, $orderNumberExpected = 0)
    {
        parent::__construct($name, $language);
        $this->action = null;
        $this->orderNumberExpected = $orderNumberExpected;
        $this->orderNumberReal = -1;

        $this->minNbArgs = 0;
        $this->maxNbArgs = PHP_INT_MAX;
        
        $this->hasParameters = false;
        $this->parameters = [];
    }

    public function addParameter(
        $parameter,
        $validbydefault,
        $fixed,
        $sufficient,
        $failifnotverified,
        $notequals,
        $values = null
    ) {
        $this->parameters[] = [
            $parameter,
            $values,
            $validbydefault,
            $fixed,
            $sufficient,
            $failifnotverified,
            $notequals];
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

    public function isParameterSufficient($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $sufficient = $parameter[4];

            if ($index === $i) {
                return $sufficient;
            }
        }

        return false;
    }

    public function isParameterFixed($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
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

    public function setMinNbArgs($minNbArgs)
    {
        return $this->minNbArgs = $minNbArgs;
    }

    public function getMinNbArgs()
    {
        return $this->minNbArgs;
    }

    public function setMaxNbArgs($maxNbArgs)
    {
        return $this->maxNbArgs = $maxNbArgs;
    }

    public function getMaxNbArgs()
    {
        return $this->maxNbArgs;
    }
}
