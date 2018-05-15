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

    public function get_objects()
    {
        return $this->objects;
    }

    public function add_object()
    {
        $id_object = count($this->objects);
        $this->objects[$id_object] = null;

        return $id_object;
    }

    public function add_myclass_to_object($id_object, $myclass)
    {
        $this->objects[$id_object] = $myclass;
    }

    public function get_myclass_from_object($id_object)
    {
        if (isset($this->objects[$id_object])) {
            return $this->objects[$id_object];
        }

        return null;
    }
}
