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
	private $is_function;

	public function __construct($name, $language) {

		$this->name = $name;
		$this->language = $language;
		$this->is_function = false;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_language()
	{
		return $this->language;
	}

	public function is_function()
	{
		return $this->is_function;
	}

	public function set_is_function($is_function)
	{
		$this->is_function = $is_function;
	}
}

?>
