<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyVuln {

	private $vuln_id;

	public function __construct($vuln_id) {

		$this->vuln_id = $vuln_id;
	}

	public function get_id()
	{
		return $this->vuln_id;
	}

	public function set_id($vuln_id)
	{
		return $this->vuln_id = $vuln_id;
	}
}

?>
