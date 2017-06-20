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

	private $name;
	private $nb_params;
	private $params;
	private $return_defs;
	private $defs;
	private $start_address_func;
	private $end_address_func;
	private $visibility;
	private $is_method;
	private $is_instance;
	private $myclass;
	private $instance;
	private $block_id;

	public function __construct($name) {

		parent::__construct(0, 0);

		$this->name = $name;
		$this->params = [];
		$this->return_defs = [];
		$this->visibility = "public";
		$this->is_method = false;
		$this->myclass = null;
		$this->name_instance = null;
		$this->block_id = 0;
		$this->nb_params = 0;
	}

	public function is_method()
	{
		return $this->is_method;
	}

	public function set_is_method($method)
	{
		$this->is_method = $method;
	}

	public function get_myclass()
	{
		return $this->myclass;
	}

	public function set_myclass($myclass)
	{
		$this->myclass = $myclass;
	}




	public function is_instance()
	{
		return $this->is_instance;
	}

	public function set_is_instance($instance)
	{
		$this->is_instance = $instance;
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

	public function get_name()
	{
		return $this->name;
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
