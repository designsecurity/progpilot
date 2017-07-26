<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyFile extends MyOp {

	private $included_from_myfile;

	public function __construct($var_name, $var_line, $var_column) {

		parent::__construct($var_name, $var_line, $var_column);
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
