<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyProperty extends MyOp
{
    private $visibility;
    private $properties;

    public function __construct()
    {
        parent::__construct("", 0, 0);
        $this->visibility = "public";
        $this->properties = [];
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function addProperty($property)
    {
        $this->properties[] = $property;
    }

    public function hasProperty($name)
    {
        if (is_array($this->properties)) {
            foreach ($this->properties as $property) {
                if ($property === $name) {
                    return true;
                }
            }
        }
        
        return false;
    }

    public function popProperty()
    {
        return array_pop($this->properties);
    }
}
