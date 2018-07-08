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
    private $source_file;
    private $value;

    public function __construct($line, $column, $source_file, $value)
    {
        $this->line = $line;
        $this->column = $column;
        $this->source_file = $source_file;
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
        return $this->source_file;
    }

    public function getValue()
    {
        return $this->value;
    }
}
