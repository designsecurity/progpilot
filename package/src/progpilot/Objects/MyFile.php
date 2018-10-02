<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyFile extends MyOp
{
    private $includedFromMyFile;

    public function __construct($varName, $varLine, $varColumn)
    {
        parent::__construct($varName, $varLine, $varColumn);
    }

    public function setIncludedFromMyfile($myFileFrom)
    {
        $this->includedFromMyFile = $myFileFrom;
    }

    public function getIncludedFromMyfile()
    {
        return $this->includedFromMyFile;
    }
}
