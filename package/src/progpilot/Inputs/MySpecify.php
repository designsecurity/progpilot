<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MySpecify
{

    private $name;
    private $language;
    private $instanceof_name;
    private $is_instance;

    public function __construct($name, $language)
    {

        $this->name = $name;
        $this->language = $language;
        $this->instanceof_name = null;
        $this->is_instance = false;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_language()
    {
        return $this->language;
    }

    public function set_is_instance($is_instance)
    {
        $this->is_instance = $is_instance;
    }

    public function is_instance()
    {
        return $this->is_instance;
    }

    public function get_instanceof_name()
    {
        return $this->instanceof_name;
    }

    public function set_instanceof_name($name)
    {
        return $this->instanceof_name = $name;
    }
}

?>
