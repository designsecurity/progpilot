<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MySource {

	private $name;
	private $language;

	public function __construct($name, $language) {

		$this->name = $name;
		$this->language = $language;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_language()
	{
		return $this->language;
	}
}

?>
