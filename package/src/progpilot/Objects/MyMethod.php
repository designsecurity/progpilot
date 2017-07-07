<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyMethod extends MyOp {

	private $myinstances;
	private $method_name;
	private $visibility;

	public function __construct() {

		parent::__construct(0, 0);

		$this->myinstances = [];
		$this->method_name = "";
		$this->visibility = "public";
	}


	public function set_visibility($visibility)
	{
		$this->visibility = $visibility;
	}

	public function get_visibility()
	{
		return $this->visibility;
	}
	
	public function set_name($method_name)
	{
		$this->method_name = $method_name;
	}

	public function get_name()
	{
		return $this->method_name;
	}
	
	public function get_myinstances()
	{
		return $this->myinstances;
	}

	public function add_myinstance($myinstance)
	{
        if(!in_array($myinstance, $this->myinstances))
            $this->myinstances[] = $myinstance;
	}
}

?>
