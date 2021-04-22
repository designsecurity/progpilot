<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Code;

class MyInstruction
{
    const MYBLOCK = 1;
    const MYBLOCK_IF = 2;
    const MYBLOCK_ELSE = 3;
    const MYFUNC = 4;
    const NOT_BOOLEAN = 5;
    const EXPR = 6;
    const MYCLASS = 7;
    const DEF = 8;
    const RETURN_DEFS = 9;
    const FUNCNAME = 10;
    const TYPE_INCLUDE = 11;
    const MYFUNC_CALL = 12;
    const ARR = 13;
    const TEMPORARY = 14;
    const PHI = 15;
    const CHAINED_DEF = 16;

    private $properties;
    private $opcode;

    public function __construct($opcode)
    {
        $this->properties = [];
        $this->opcode = $opcode;
    }

    public function addProperty($index, $property)
    {
        $this->properties[$index] = $property;
    }

    public function isPropertyExist($index)
    {
        return isset($this->properties[$index]);
    }

    public function getProperty($index)
    {
        return $this->properties[$index];
    }

    public function getOpcode()
    {
        return $this->opcode;
    }
}
