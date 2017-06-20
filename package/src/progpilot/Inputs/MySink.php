<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MySink {

	private $name;
	private $language;
	private $attack;

	public function __construct($name, $language, $attack) {

		$this->name = $name;
		$this->language = $language;
		$this->attack = $attack;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_language()
	{
		return $this->language;
	}

	public function get_attack()
	{
		return $this->attack;
	}
}

?>
