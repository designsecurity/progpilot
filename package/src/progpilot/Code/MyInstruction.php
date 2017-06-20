<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Code;

class MyInstruction {

	private $properties;
	private $opcode;

	public function __construct($opcode) {

		$this->properties = [];
		$this->opcode = $opcode;
	}

	public function add_property($index, $property) {

		$this->properties[$index] = $property;
	}

	public function is_property_exist($index)
	{
		return isset($this->properties[$index]);
	}

	public function get_property($index) {

		return $this->properties[$index];
	}

	public function get_opcode() {

		return $this->opcode;
	}
}
