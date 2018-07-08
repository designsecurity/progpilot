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
        $id_object = count($this->objects);
        $this->objects[$id_object] = null;

        return $id_object;
    }

    public function addMyclassToObject($id_object, $myclass)
    {
        $this->objects[$id_object] = $myclass;
    }

    public function getMyClassFromObject($id_object)
    {
        if (isset($this->objects[$id_object])) {
            return $this->objects[$id_object];
        }

        return null;
    }
}
