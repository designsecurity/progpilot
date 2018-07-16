<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

use progpilot\Objects\MyOp;

class Objects
{
    private $objects;

    public function __construct()
    {
        $this->objects = [];
    }

    public function getObjects()
    {
        return $this->objects;
    }

    public function addObject()
    {
        $idObject = count($this->objects);
        $this->objects[$idObject] = null;

        return $idObject;
    }

    public function addMyclassToObject($idObject, $myClass)
    {
        $this->objects[$idObject] = $myClass;
    }

    public function getMyClassFromObject($idObject)
    {
        if (isset($this->objects[$idObject])) {
            return $this->objects[$idObject];
        }

        return null;
    }
}
