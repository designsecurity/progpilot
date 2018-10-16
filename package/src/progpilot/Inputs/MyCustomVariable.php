<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyCustomVariable extends MySpecify
{
    public function __construct($name, $language)
    {
        parent::__construct($name, $language);
    }
}
