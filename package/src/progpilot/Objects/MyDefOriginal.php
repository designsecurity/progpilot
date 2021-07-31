<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyDefOriginal
{
    private $def;
    private $arrayIndexAccessor;
    private $propertyAccessor;

    public function __construct()
    {
        $this->def = null;
        $this->arrayIndexAccessor = null;
        $this->propertyAccessor = null;
    }

    public function getDef()
    {
        return $this->def;
    }

    public function setDef($myDef)
    {
        $this->def = $myDef;
    }

    public function getPropertyAccessor()
    {
        return $this->propertyAccessor;
    }

    public function setPropertyAccessor($propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    public function getArrayIndexAccessor()
    {
        return $this->arrayIndexAccessor;
    }

    public function setArrayIndexAccessor($arrayIndexAccessor)
    {
        $this->arrayIndexAccessor = $arrayIndexAccessor;
    }
}
