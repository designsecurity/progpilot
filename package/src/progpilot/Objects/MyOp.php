<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyOp {

	private $var_line;
	private $var_column;
	private $source_file;

	public function __construct($var_line, $var_column) {

		$this->var_line = $var_line;
		$this->var_column = $var_column;
		$this->source_file = "";
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

	public function get_source_file()
	{
		return $this->source_file;
	}

	public function set_source_file($source_file)
	{
		$this->source_file = $source_file;
	}
}

?>
