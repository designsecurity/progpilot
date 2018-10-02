<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyAssertion
{
    private $arr;
    private $typeAssertion;

    private $myDef;

    public function __construct($myDef, $typeAssertion)
    {
        $this->typeAssertion = $typeAssertion;
        $this->mydef = $myDef;
    }

    public function addDef($myDef)
    {
        $this->mydef = $myDef;
    }

    public function getDef()
    {
        return $this->mydef;
    }

    public function addType($typeAssertion)
    {
        $this->typeAssertion = $typeAssertion;
    }

    public function getType()
    {
        return $this->typeAssertion;
    }
}
