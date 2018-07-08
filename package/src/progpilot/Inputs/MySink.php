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

    public function __construct($name, $language, $attack, $cwe)
    {
        parent::__construct($name, $language);

        $this->attack = $attack;
        $this->cwe = $cwe;
        $this->hasParameters = false;
        $this->parameters = [];
        $this->global_conditions = [];
    }

    public function addGlobalCondition($condition)
    {
        $this->global_conditions[] = $condition;
    }

    public function isGlobalCondition($condition)
    {
        foreach ($this->global_conditions as $condition_global) {
            if ($condition === $condition_global) {
                return true;
            }
        }

        return false;
    }

    public function addParameter($id, $condition = null)
    {
        $parameter = [$id, $condition];
        $this->parameters[] = $parameter;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getParameterCondition($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $condition = $parameter[1];

            if ($index === $i) {
                return $condition;
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
