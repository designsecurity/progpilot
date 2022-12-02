<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

class Classes
{
    private $listClasses;

    public function __construct()
    {
        $this->listClasses = [];
    }

    public function getListClasses()
    {
        return $this->listClasses;
    }

    public function addMyclass($newMyClass)
    {
        if (!isset($this->listClasses[$newMyClass->getName()])) {
            $this->listClasses[$newMyClass->getName()] = $newMyClass;
        }
    }

    public function getMyClass($name)
    {
        if (isset($this->listClasses[$name])) {
            return $this->listClasses[$name];
        }
        
        return null;
    }
}
