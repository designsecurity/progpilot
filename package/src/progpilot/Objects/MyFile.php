<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyFile extends MyOp {

	private $name;
	private $included_from_myfile;

	public function __construct($name, $var_line, $var_column) {

		parent::__construct($var_line, $var_column);

		$this->name = $name;
	}

	public function set_name($name)
	{
		$this->name = $name;
	}

	public function get_name()
	{
		return $this->name;
	}
	
	public function set_included_from_myfile($myfile_from)
	{
        $this->included_from_myfile = $myfile_from;
	}
	
	public function get_included_from_myfile()
	{
        return $this->included_from_myfile;
	}
}

?>
