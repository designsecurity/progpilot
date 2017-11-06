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

    private $var_name;
    private $var_line;
    private $var_column;
    private $source_myfile;
    private $array_value;

    private $flags;

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
        $this->var_name = $var_name;
        $this->var_line = $var_line;
        $this->var_column = $var_column;
        $this->source_myfile = null;
        $this->array_value = false;
    }

    public function set_type($flags)
    {
        $this->flags = $flags;
    }

    public function get_type()
    {
        return $this->flags;
    }

    public function is_type($type)
    {
        return (bool) ($this->flags & $type);
    }

    public function add_type($type)
    {
        $this->flags |= $type;
    }

    public function remove_type($type)
    {
        $this->flags ^= $type;
    }

    public function set_array_value($array_value)
    {
        $this->array_value = $array_value;
    }

    public function get_array_value()
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

    public function get_source_myfile()
    {
        return $this->source_myfile;
    }

    public function set_source_myfile($source_myfile)
    {
        $this->source_myfile = $source_myfile;
    }

    public function set_name($var_name)
    {
        $this->var_name = $var_name;
    }

    public function get_name()
    {
        return $this->var_name;
    }
}

?>
