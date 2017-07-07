<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyProperty extends MyOp {

	private $myinstances;
	private $property_name;
	private $visibility;

	public function __construct() {

		parent::__construct(0, 0);

		$this->myinstances = [];
		$this->property_name = "";
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
	
	public function set_name($property_name)
	{
		$this->property_name = $property_name;
	}

	public function get_name()
	{
		return $this->property_name;
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
