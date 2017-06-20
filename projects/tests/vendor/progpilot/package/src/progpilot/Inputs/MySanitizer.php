<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MySanitizer {

	private $name;
	private $language;
	private $type;
	private $prevent;

	public function __construct($name, $language, $type, $prevent) {

		$this->name = $name;
		$this->language = $language;
		$this->type = $type;
		$this->prevent = $prevent;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_language()
	{
		return $this->language;
	}

	public function get_type()
	{
		return $this->type;
	}

	public function get_prevent()
	{
		return $this->prevent;
	}
}

?>
