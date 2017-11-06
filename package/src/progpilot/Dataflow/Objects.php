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

    public function get_all_myclasses($id)
    {
        if (isset($this->objects[$id]))
            return $this->objects[$id];

        return [];
    }

    public function get_myclass($id, $myclass)
    {
        if (isset($this->objects[$id]))
        {
            $myclasses = $this->objects[$id];

            foreach ($myclasses as $one_class)
            {
                if ($one_class->get_name() === $myclass->get_name())
                    return $one_class;
            }
        }

        return null;
    }

    public function get_objects()
    {
        return $this->objects;
    }

    public function add_object()
    {
        $id_object = count($this->objects);
        $this->objects[$id_object] = [];

        return $id_object;
    }

    public function replace_myclass_to_object($id, $myclass)
    {
        $exist = false;
        $myclasses = [];

        if (isset($this->objects[$id]))
            $myclasses = $this->objects[$id];

        foreach ($myclasses as $key => $one_class)
        {
            if ($one_class->get_name() === $myclass->get_name())
            {
                $this->objects[$id][$key] = $myclass;
                break;
            }
        }
    }

    public function add_myclass_to_object($id, $myclass)
    {
        $exist = false;
        $myclasses = [];

        if (isset($this->objects[$id]))
            $myclasses = $this->objects[$id];

        foreach ($myclasses as $one_class)
        {
            if ($one_class->get_name() === $myclass->get_name())
            {
                $exist = true;
                break;
            }
        }

        if (!$exist)
            $this->objects[$id][] = $myclass;
    }
}

?>
