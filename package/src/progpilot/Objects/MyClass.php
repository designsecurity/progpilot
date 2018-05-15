<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyClass extends MyOp
{
    private $properties;
    private $methods;
    private $object_id_this;

    public function __construct($var_line, $var_column, $var_name)
    {
        parent::__construct($var_name, $var_line, $var_column);

        $this->properties = [];
        $this->methods = [];
        $this->object_id_this = null;
    }

    public function __clone()
    {
        for ($i = 0; $i < count($this->properties); $i++) {
            $this->properties[$i] = clone $this->properties[$i];
        }

        for ($i = 0; $i < count($this->methods); $i++) {
            $this->methods[$i] = clone $this->methods[$i];
        }
    }

    public function add_method($method)
    {
        $exist = false;
        foreach ($this->methods as $method_class) {
            if ($method_class->get_name() === $method->get_name()) {
                $exist = true;
                break;
            }
        }

        if (!$exist) {
            $this->methods[] = $method;
        }
    }

    public function get_method($name)
    {
        foreach ($this->methods as $method) {
            if ($method->get_name() === $name) {
                return $method;
            }
        }

        return null;
    }

    public function get_methods()
    {
        return $this->methods;
    }

    public function get_properties()
    {
        return $this->properties;
    }

    public function add_property($property)
    {
        $exist = false;
        foreach ($this->properties as $property_class) {
            if ($property_class->property->get_properties() === $property->property->get_properties()) {
                $exist = true;
                break;
            }
        }

        if (!$exist) {
            $this->properties[] = $property;
        }
    }

    public function get_property($name)
    {
        foreach ($this->properties as $property) {
            if ($property->property->get_properties()[0] === $name) {
                return $property;
            }
        }

        return null;
    }

    public function set_object_id_this($object_id)
    {
        $this->object_id_this = $object_id;
    }

    public function get_object_id_this()
    {
        return $this->object_id_this;
    }
}
