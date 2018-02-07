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

    public function set_visibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function get_visibility()
    {
        return $this->visibility;
    }

    public function set_properties($properties)
    {
        $this->properties = $properties;
    }

    public function get_properties()
    {
        return $this->properties;
    }

    public function add_property($property)
    {
        $this->properties[] = $property;
    }

    public function pop_property()
    {
        return array_pop($this->properties);
    }
}

?>
