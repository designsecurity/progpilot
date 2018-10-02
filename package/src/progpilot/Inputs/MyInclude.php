<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyInclude
{
    private $line;
    private $column;
    private $sourceFile;
    private $value;

    public function __construct($line, $column, $sourceFile, $value)
    {
        $this->line = $line;
        $this->column = $column;
        $this->sourceFile = $sourceFile;
        $this->value = $value;
    }

    public function getLine()
    {
        return $this->line;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getSourceFile()
    {
        return $this->sourceFile;
    }

    public function getValue()
    {
        return $this->value;
    }
}
