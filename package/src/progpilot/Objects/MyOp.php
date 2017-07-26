<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyOp {

	private $var_name;
	private $var_line;
	private $var_column;
	private $source_myfile;

	const TYPE_LITERAL = "type_literal";
	const TYPE_ARRAY = "type_array";
	const TYPE_ARRAY_EXPR = "type_array_expr";
	const TYPE_COPY_ARRAY = "type_copy_array";
	const TYPE_METHOD = "type_method";
	const TYPE_INSTANCE = "type_instance";
	const TYPE_PROPERTY = "type_property";
	const TYPE_FUNCCALL = "type_funccall";
	const TYPE_FUNCCALL_ARRAY = "type_funccall_array";

	public function __construct($var_name, $var_line, $var_column) {

		$this->var_name = $var_name;
		$this->var_line = $var_line;
		$this->var_column = $var_column;
		$this->source_myfile = null;
		$this->type = MyOp::TYPE_LITERAL;
	}

	public function get_type()
	{
		return $this->type;
	}

	public function set_type($type)
	{
		$this->type = $type;
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
