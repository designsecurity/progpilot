<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyProperty extends MyDefinition
{
    private $visibility;

    public function __construct($blockId, $myFile, $varLine, $varColumn, $varName)
    {
        parent::__construct($blockId, $myFile, $varLine, $varColumn, $varName);

        $this->addType(MyDefinition::TYPE_PROPERTY);
        $this->visibility = "public";
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }
}
