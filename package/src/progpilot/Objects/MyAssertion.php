<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyAssertion {

	private $arr;
	private $type_assertion;

	private $mydef;

	public function __construct($mydef, $type_assertion) {

		$this->type_assertion = $type_assertion;
		$this->mydef = $mydef;
	}

	public function add_def($mydef)
	{
		$this->mydef = $mydef;
	}

	public function get_def()
	{
		return $this->mydef;
	}

	public function add_type($type_assertion)
	{
		$this->type_assertion = $type_assertion;
	}

	public function get_type()
	{
		return $this->type_assertion;
	}
}

?>
