<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyOp
{
    public static $nbObjects;
    protected $varId;

    private $varName;
    private $varLine;
    private $varColumn;
    private $sourceMyFile;

    private $flags;

    const TYPE_VARIABLE = "type_variable";
    const TYPE_LITERAL = "type_literal";
    const TYPE_ARRAY = "type_array";
    const TYPE_ARRAY_EXPR = "type_array_expr";
    const TYPE_ARRAY_ELEMENT = "type_array_element";
    const TYPE_METHOD = "type_method";
    const TYPE_INSTANCE = "type_instance";
    const TYPE_PROPERTY = "type_property";
    const TYPE_FUNCCALL = "type_funccall";
    const TYPE_FUNCCALL_ARRAY = "type_funccall_array";
    const TYPE_CONST = "type_const";
    const TYPE_STATIC_PROPERTY = "type_static_property";

    public function __construct($varName, $varLine, $varColumn)
    {
        $this->flags = 0;
        $this->varId = MyOp::$nbObjects ++;
        $this->varName = $varName;
        $this->varLine = $varLine;
        $this->varColumn = $varColumn;
        $this->sourceMyFile = null;
    }

    public function __clone()
    {
        $this->varId = MyOp::$nbObjects ++;
    }

    public function setType($flags)
    {
        $this->flags = $flags;
    }

    public function getType()
    {
        return $this->flags;
    }

    public function isType($type)
    {
        return (bool) ($this->flags & $type);
    }

    public function addType($type)
    {
        $this->flags |= $type;
    }

    public function removeType($type)
    {
        if ($this->isType($type)) {
            $this->flags ^= $type;
        }
    }

    public function setId($varId)
    {
        $this->varId = $varId;
    }

    public function getId()
    {
        return $this->varId;
    }

    public function getLine()
    {
        return $this->varLine;
    }

    public function getColumn()
    {
        return $this->varColumn;
    }

    public function setLine($line)
    {
        $this->varLine = $line;
    }

    public function setColumn($column)
    {
        $this->varColumn = $column;
    }

    public function getSourceMyFile()
    {
        return $this->sourceMyFile;
    }

    public function setSourceMyFile($sourceMyFile)
    {
        $this->sourceMyFile = $sourceMyFile;
    }

    public function setName($varName)
    {
        $this->varName = $varName;
    }

    public function getName()
    {
        return $this->varName;
    }
}
