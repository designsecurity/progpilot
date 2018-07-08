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
    private $isFunction;
    private $array_value;
    private $return_array_value;
    private $is_return_array;
    private $parameters;
    private $conditions_parameters;
    private $hasParameters;

    const CONDITION_ARRAY = "condition_array";

    public function __construct($name, $language)
    {
        parent::__construct($name, $language);

        $this->isFunction = false;
        $this->return_array_value = null;
        $this->is_return_array = false;
        $this->array_value = null;
        $this->is_array = false;
        $this->hasParameters = false;
        $this->parameters = [];
        $this->conditions_parameters = [];
    }

    public function getIsReturnArray()
    {
        return $this->is_return_array;
    }

    public function setReturnArray($arr)
    {
        $this->is_return_array = $arr;
    }

    public function setReturnArrayValue($arr)
    {
        $this->return_array_value = $arr;
    }

    public function getReturnArrayValue()
    {
        return $this->return_array_value;
    }

    public function getIsArray()
    {
        return $this->is_array;
    }

    public function setIsArray($is_array)
    {
        $this->is_array = $is_array;
    }

    public function getArrayValue()
    {
        return $this->array_value;
    }

    public function setArrayValue($array_value)
    {
        $this->array_value = $array_value;
    }

    public function isFunction()
    {
        return $this->isFunction;
    }

    public function setIsFunction($isFunction)
    {
        $this->isFunction = $isFunction;
    }

    public function addConditionParameter($parameter, $condition, $value)
    {
        $this->conditions_parameters[$parameter][] = [$condition, $value];
    }

    public function getConditionParameter($parameter, $condition)
    {
        foreach ($this->conditions_parameters[$parameter] as $condition_param) {
            if ($condition_param[0] === $condition) {
                return $condition_param[1];
            }
        }

        return null;
    }

    public function addParameter($parameter)
    {
        $this->parameters[] = $parameter;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function isParameter($i)
    {
        foreach ($this->parameters as $parameter) {
            if ($parameter === $i) {
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
