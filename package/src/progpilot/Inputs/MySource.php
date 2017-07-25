<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MySource extends MySpecify  {

	private $is_function;
	private $arr_value;
	private $is_arr;

	public function __construct($name, $language) {

		parent::__construct($name, $language);

		$this->is_function = false;
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
