<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyMethod extends MyOp {

	private $visibility;

	public function __construct() {

		parent::__construct("", 0, 0);
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
}

?>
