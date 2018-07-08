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
    private $list_classes;

    public function __construct()
    {
        $this->list_classes = [];
    }

    public function getListClasses()
    {
        return $this->list_classes;
    }

    public function addMyclass($new_myclass)
    {
        /*
            if (!in_array($myclass, $this->list_classes, true))
                $this->list_classes[] = $myclass;
        */

        $continue = true;
        foreach ($this->list_classes as $myclass) {
            if ($myclass->getName() === $new_myclass->getName()) {
                $continue = false;
                break;
            }
        }

        if ($continue) {
            $this->list_classes[] = $new_myclass;
        }
    }

    public function getMyClass($name)
    {
        foreach ($this->list_classes as $myclass) {
            if ($myclass->getName() === $name) {
                return $myclass;
            }
        }

        return null;
    }
}
