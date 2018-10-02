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
        /*
            if (!in_array($myClass, $this->listClasses, true))
                $this->listClasses[] = $myClass;
        */

        $continue = true;
        foreach ($this->listClasses as $myClass) {
            if ($myClass->getName() === $newMyClass->getName()) {
                $continue = false;
                break;
            }
        }

        if ($continue) {
            $this->listClasses[] = $newMyClass;
        }
    }

    public function getMyClass($name)
    {
        foreach ($this->listClasses as $myClass) {
            if ($myClass->getName() === $name) {
                return $myClass;
            }
        }

        return null;
    }
}
