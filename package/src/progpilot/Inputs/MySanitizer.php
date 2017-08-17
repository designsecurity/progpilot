<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MySanitizer extends MySpecify {

	private $prevent;
	private $parameters;
	private $has_parameters;

	public function __construct($name, $language, $prevent) {

		parent::__construct($name, $language);

		$this->prevent = $prevent;
		$this->has_parameters = false;
		$this->parameters = [];
	}

	public function get_prevent()
	{
		return $this->prevent;
	}

	public function add_parameter($parameter, $condition, $values = null)
	{
		$this->parameters[] = [$parameter, $condition, $values];
	}

	public function get_parameters()
	{
		return $this->parameters;
	}

	public function get_parameter_condition($i)
	{
		foreach($this->parameters as $parameter)
		{
			$index = $parameter[0];
			$condition = $parameter[1];

			if($index == $i)
				return $condition;
		}

		return null;
	}

	public function get_parameter_values($i)
	{
		foreach($this->parameters as $parameter)
		{
			$index = $parameter[0];
			$condition = $parameter[1];
			$values = $parameter[2];

			if($index == $i)
				return $values;
		}

		return null;
	}

	public function is_parameter($i)
	{
		foreach($this->parameters as $parameter)
		{
			$index = $parameter[0];
			$condition = $parameter[1];

			if($index == $i)
				return true;
		}

		return false;
	}

	public function has_parameters()
	{
		return $this->has_parameters;
	}

	public function set_has_parameters($has_parameters)
	{
		$this->has_parameters = $has_parameters;
	}
}

?>
