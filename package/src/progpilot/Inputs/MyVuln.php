<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyVuln
{
    private $vulnId;

    public function __construct($vulnId)
    {
        $this->vulnId = $vulnId;
    }

    public function getId()
    {
        return $this->vulnId;
    }

    public function setId($vulnId)
    {
        return $this->vulnId = $vulnId;
    }
}
