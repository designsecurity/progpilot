<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyInstance extends MyOp {

	private $name_instance;
	private $myclass;

	public function __construct($name) {

		parent::__construct(0, 0);

		$this->name_instance = $name;
	}

	public function get_name_instance()
	{
		return $this->name_instance;
	}

	public function get_myclass()
	{
		return $this->myclass;
	}

	public function set_myclass($myclass)
	{
		return $this->myclass = $myclass;
	}

}

?>
