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
	private $instanceof_name;
	private $is_instance;
	private $arr_value;
	private $is_arr;

	public function __construct($name, $language) {

		$this->name = $name;
		$this->language = $language;
		$this->is_function = false;
		$this->instanceof_name = null;
		$this->is_instance = false;
		$this->arr_value = null;
		$this->is_arr = false;
	}

	public function is_arr()
	{
		return $this->is_arr;
	}

	public function set_arr($arr)
	{
		$this->is_arr = $arr;
	}
	
	public function set_arr_value($arr)
	{
		$this->arr_value = $arr;
	}

	public function get_arr_value()
	{
		return $this->arr_value;
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
