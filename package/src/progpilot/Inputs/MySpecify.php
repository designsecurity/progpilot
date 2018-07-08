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
    private $isInstance;

    public function __construct($name, $language)
    {
        $this->name = $name;
        $this->language = $language;
        $this->instanceof_name = null;
        $this->isInstance = false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setIsInstance($isInstance)
    {
        $this->isInstance = $isInstance;
    }

    public function isInstance()
    {
        return $this->isInstance;
    }

    public function getInstanceOfName()
    {
        return $this->instanceof_name;
    }

    public function setInstanceOfName($name)
    {
        return $this->instanceof_name = $name;
    }
}
