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
    private static $nb_objects = 0;

    protected $var_id;

    private $var_name;
    private $var_line;
    private $var_column;
    private $source_myfile;
    private $array_value;

    private $flags;

    const TYPE_VARIABLE = "type_variable";
    const TYPE_LITERAL = "type_literal";
    const TYPE_ARRAY = "type_array";
    const TYPE_ARRAY_EXPR = "type_array_expr";
    const TYPE_COPY_ARRAY = "type_copy_array";
    const TYPE_METHOD = "type_method";
    const TYPE_INSTANCE = "type_instance";
    const TYPE_PROPERTY = "type_property";
    const TYPE_FUNCCALL = "type_funccall";
    const TYPE_FUNCCALL_ARRAY = "type_funccall_array";
    const TYPE_CONST = "type_const";

    public function __construct($var_name, $var_line, $var_column)
    {
        $this->flags = 0;
        $this->var_id = MyOp::$nb_objects ++;
        $this->var_name = $var_name;
        $this->var_line = $var_line;
        $this->var_column = $var_column;
        $this->source_myfile = null;
        $this->array_value = false;
    }

    public function setId($var_id)
    {
        $this->var_id = $var_id;
    }

    public function getId()
    {
        return $this->var_id;
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

    public function setArrayValue($array_value)
    {
        $this->array_value = $array_value;
    }

    public function getArrayValue()
    {
        return $this->array_value;
    }

    public function getLine()
    {
        return $this->var_line;
    }

    public function getColumn()
    {
        return $this->var_column;
    }

    public function setLine($line)
    {
        $this->var_line = $line;
    }

    public function setColumn($column)
    {
        $this->var_column = $column;
    }

    public function getSourceMyFile()
    {
        return $this->source_myfile;
    }

    public function setSourceMyFile($source_myfile)
    {
        $this->source_myfile = $source_myfile;
    }

    public function setName($var_name)
    {
        $this->var_name = $var_name;
    }

    public function getName()
    {
        return $this->var_name;
    }
}
