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
    private $hasParameters;
    private $globalconditions;

    public function __construct($name, $language, $attack, $cwe)
    {
        parent::__construct($name, $language);

        $this->attack = $attack;
        $this->cwe = $cwe;
        $this->hasParameters = false;
        $this->parameters = [];
        $this->globalconditions = [];
    }

    public function addGlobalconditions($conditions)
    {
        $this->globalconditions[] = $conditions;
    }

    public function isGlobalcondition($condition)
    {
        foreach ($this->globalconditions as $conditionsGlobal) {
            if ($condition === $conditionsGlobal) {
                return true;
            }
        }

        return false;
    }

    public function addParameter($id, $conditions = null)
    {
        $parameter = [$id, $conditions];
        $this->parameters[] = $parameter;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
    
    public function parameterHasconditions($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $conditions = $parameter[1];

            if ($index === $i) {
                return !is_null($conditions);
            }
        }

        return false;
    }

    public function isParametercondition($i, $condition)
    {
        if (is_null($condition)) {
            return true;
        }
            
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $conditions = $parameter[1];

            if ($i === $index) {
                if (is_array($conditions)) {
                    return in_array($condition, $conditions, true);
                } else {
                    if ($conditions === $condition) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function getParameterConditions($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $conditions = $parameter[1];

            if ($index === $i) {
                return $conditions;
            }
        }

        return null;
    }

    public function isParameter($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            if ($index === $i) {
                return true;
            }
        }

        return false;
    }

    public function hasParameters()
    {
        return $this->hasParameters;
    }

    public function setHasParameters($hasParameters)
    {
        $this->hasParameters = $hasParameters;
    }

    public function getAttack()
    {
        return $this->attack;
    }

    public function getCwe()
    {
        return $this->cwe;
    }
}
