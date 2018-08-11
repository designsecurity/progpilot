<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyValidator extends MySpecify
{
    private $parameters;
    private $hasParameters;

    public function __construct($name, $language)
    {
        parent::__construct($name, $language);

        $this->hasParameters = false;
        $this->parameters = [];
    }

    public function addParameter($parameter, $conditions, $values = null)
    {
        $this->parameters[] = [$parameter, $conditions, $values];
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getParameterconditions($i)
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

    public function getParameterValues($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $conditions = $parameter[1];
            $values = $parameter[2];

            if ($index === $i) {
                return $values;
            }
        }

        return null;
    }

    public function isParameter($i)
    {
        foreach ($this->parameters as $parameter) {
            $index = $parameter[0];
            $conditions = $parameter[1];

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
}
