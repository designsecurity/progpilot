<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyValidator {

	private $name;
	private $language;
	private $instanceof_name;
	private $is_instance;
	private $parameters;
	private $has_parameters;

	public function __construct($name, $language) {

		$this->name = $name;
		$this->language = $language;
		$this->instanceof_name = null;
		$this->is_instance = false;
		$this->has_parameters = false;
		$this->parameters = [];
	}

	public function add_parameter($parameter, $condition)
	{
		$this->parameters[] = [$parameter, $condition];
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

	public function get_name()
	{
		return $this->name;
	}

	public function get_language()
	{
		return $this->language;
	}

	public function set_is_instance($is_instance)
	{
		$this->is_instance = $is_instance;
	}

	public function is_instance()
	{
		return $this->is_instance;
	}

	public function get_instanceof_name()
	{
		return $this->is_instance;
	}

	public function set_instanceof_name($name)
	{
		return $this->instanceof_name = $name;
	}
}

?>
