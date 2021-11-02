<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

use progpilot\Objects\MyDefinition;

class MySource extends MySpecify
{
    private $isObject;
    private $isArrayOfObjects;
    private $isArrayOfArrays;
    private $isArray;
    private $isFunction;
    private $arrayValue;
    private $returnArrayValue;
    private $isReturnArray;
    private $parameters;
    private $conditionsParameters;
    private $hasParameters;
    private $label;

    const CONDITION_ARRAY = "condition_array";

    public function __construct($name, $language)
    {
        parent::__construct($name, $language);

        $this->isObject = false;
        $this->isArrayOfObjects = false;
        $this->isArrayOfArrays = false;
        $this->isFunction = false;
        $this->returnArrayValue = null;
        $this->isReturnArray = false;
        $this->arrayValue = [];
        $this->isArray = false;
        $this->hasParameters = false;
        $this->parameters = [];
        $this->conditionsParameters = [];
        $this->label = MyDefinition::SECURITY_LOW;
    }

    public function getIsReturnArray()
    {
        return $this->isReturnArray;
    }

    public function setReturnArray($arr)
    {
        $this->isReturnArray = $arr;
    }

    public function setReturnArrayValue($arr)
    {
        $this->returnArrayValue = $arr;
    }

    public function getReturnArrayValue()
    {
        return $this->returnArrayValue;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getIsObject()
    {
        return $this->isObject;
    }

    public function setIsObject($isObject)
    {
        $this->isObject = $isObject;
    }

    public function getIsArrayOfObjects()
    {
        return $this->isArrayOfObjects;
    }

    public function setIsArrayOfObjects($isArrayOfObjects)
    {
        $this->isArrayOfObjects = $isArrayOfObjects;
    }

    public function getIsArrayOfArrays()
    {
        return $this->isArrayOfArrays;
    }

    public function setIsArrayOfArrays($isArrayOfArrays)
    {
        $this->isArrayOfArrays = $isArrayOfArrays;
    }

    public function getIsArray()
    {
        return $this->isArray;
    }

    public function setIsArray($isArray)
    {
        $this->isArray = $isArray;
    }

    public function isAnArrayValue($arr)
    {
        if (in_array($arr, $this->arrayValue, true)) {
            return true;
        }

        return false;
    }

    public function getArrayValue()
    {
        return $this->arrayValue;
    }

    public function setArrayValue($arrayValue)
    {
        $this->arrayValue = $arrayValue;
    }

    public function isFunction()
    {
        return $this->isFunction;
    }

    public function setIsFunction($isFunction)
    {
        $this->isFunction = $isFunction;
    }

    public function addconditionsParameter($parameter, $conditions, $value)
    {
        $this->conditionsParameters[$parameter][] = [$conditions, $value];
    }

    public function getconditionsParameter($parameter, $conditions)
    {
        foreach ($this->conditionsParameters[$parameter] as $conditionsParam) {
            if ($conditionsParam[0] === $conditions) {
                return $conditionsParam[1];
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
