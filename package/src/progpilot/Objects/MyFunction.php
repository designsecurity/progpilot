<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

use PHPCfg\Op;
use PHPCfg\Script;

class MyFunction extends MyOp {

	private $nb_params;
	private $params;
	private $return_defs;
	private $defs;
	private $start_address_func;
	private $end_address_func;
	private $visibility;
	private $myclass;
	private $instance;
	private $block_id;

	private $this_def;
	private $back_def;

	private $last_line;
	private $last_column;
	private $last_block_id;
	private $is_property;

	public $property;

	public function __construct($name) {

		parent::__construct($name, 0, 0);

		$this->params = [];
		$this->return_defs = [];
		$this->visibility = "public";
		$this->myclass = null;
		$this->is_method = false;
		$this->name_instance = null;
		$this->this_def = null;
		$this->back_def = null;
		$this->block_id = 0;
		$this->nb_params = 0;

		$this->last_line = 0;
		$this->last_column = 0;
		$this->last_block_id = 0;

		$this->property = new MyProperty;

		$this->is_property = false;
	}

	public function __clone()
	{
		$this->property = clone $this->property;
	}

	public function set_is_property($is_property)
	{
		$this->is_property = $is_property;
	}

	public function get_is_property()
	{
		return $this->is_property;
	}

	public function set_is_method($is_method)
	{
		$this->is_method = $is_method;
	}

	public function get_is_method()
	{
		return $this->is_method;
	}

	public function set_last_line($last_line)
	{
		$this->last_line = $last_line;
	}

	public function set_last_column($last_column)
	{
		$this->last_column = $last_column;
	}

	public function set_last_block_id($last_block_id)
	{
		$this->last_block_id = $last_block_id;
	}

	public function get_last_line()
	{
		return $this->last_line;
	}

	public function get_last_column()
	{
		return $this->last_column;
	}

	public function get_last_block_id()
	{
		return $this->last_block_id;
	}

	public function get_myclass()
	{
		return $this->myclass;
	}

	public function set_myclass($myclass)
	{
		$this->myclass = $myclass;
	}

	public function get_this_def()
	{
		return $this->this_def;
	}

	public function set_this_def($this_def)
	{
		$this->this_def = $this_def;
	}

	public function get_back_def()
	{
		return $this->back_def;
	}

	public function set_back_def($back_def)
	{
		$this->back_def = $back_def;
	}

	public function get_name_instance()
	{
		return $this->name_instance;
	}

	public function set_name_instance($name_instance)
	{
		$this->name_instance = $name_instance;
	}

	public function set_visibility($visibility)
	{
		$this->visibility = $visibility;
	}

	public function get_visibility()
	{
		return $this->visibility;
	}

	public function set_start_address_func($address)
	{
		$this->start_address_func = $address;
	}

	public function set_end_address_func($address)
	{
		$this->end_address_func = $address;
	}

	public function get_start_address_func()
	{
		return $this->start_address_func;
	}

	public function get_end_address_func()
	{
		return $this->end_address_func;
	}

	public function set_defs($defs)
	{
		$this->defs = $defs;
	}

	public function get_defs()
	{
		return $this->defs;
	}

	public function add_param($param)
	{
		$this->params[] = $param;
	}

	public function get_params()
	{
		return $this->params;
	}

	public function set_nb_params($nb_params)
	{
		$this->nb_params = $nb_params;
	}

	public function get_nb_params()
	{
		return $this->nb_params;
	}

	public function get_param($i)
	{
		if(isset($this->params[$i]))
			return $this->params[$i];

		return null;
	}

	public function get_return_defs()
	{
		return $this->return_defs;
	}

	public function add_return_def($return_def)
	{
		$this->return_defs[] = $return_def;
	}

	public function get_block_id()
	{
		return $this->block_id;
	}

	public function set_block_id($block_id)
	{
		$this->block_id = $block_id;
	}
}

?>
