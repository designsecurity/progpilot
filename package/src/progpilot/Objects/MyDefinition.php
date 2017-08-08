<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

use PHPCfg\Op;
use progpilot\Objects\MyOp;

class MyDefinition extends MyOp {

	private $is_copy_array;
	private $block_id;
	private $is_tainted;
	private $is_ref;
	private $ref_name;
	private $is_ref_arr;
	private $ref_arr_value;
	private $thearrays;
	private $theexprs;
	private $taintedbyexpr;
	private $instance;
	private $property_name;
	private $class_name;
	private $is_sanitized;
	private $type_sanitized;
	private $assign_id;
	private $myclasses;
	private $value_from_def;

	public $property;

	public function __construct($var_line, $var_column, $var_name) {

		parent::__construct($var_name, $var_line, $var_column);

		$this->is_copy_array = false;
		$this->value_from_def = null;

		$this->block_id = -1;
		$this->is_tainted = false;
		$this->is_ref = false;
		$this->is_ref_arr = false;
		$this->ref_arr_value = null;
		$this->instance = false;
		$this->thearrays = [];
		$this->theexprs = [];
		$this->taintedbyexpr = null;
		$this->class_name = "";
		$this->myclasses = [];

		$this->is_sanitized = false;
		$this->type_sanitized = [];

		$this->last_known_value = "";
		$this->assign_id = -1;

		$this->property = new MyProperty;
	}

	public function print_stdout()
	{
		echo "def name = ".htmlentities($this->get_name(), ENT_QUOTES, 'UTF-8')." :: assign_id = ".$this->get_assign_id()." :: line = ".$this->getLine()." :: column = ".$this->getColumn()." :: tainted = ".$this->is_tainted()." :: ref = ".$this->is_ref()." :: type = ".$this->get_type()." :: blockid = ".$this->get_block_id()."\n";
		if($this->get_is_array())
		{
			echo "array index value :\n";
			var_dump($this->get_array_value());
		}

		if($this->get_type() == MyOp::TYPE_PROPERTY)
		{
			echo "property : ".htmlentities($this->property->get_name(), ENT_QUOTES, 'UTF-8')."\n";
			echo "class_name : ".htmlentities($this->get_class_name(), ENT_QUOTES, 'UTF-8')."\n";
			echo "visibility : ".htmlentities($this->property->get_visibility(), ENT_QUOTES, 'UTF-8')."\n";
		}

		if($this->get_type() == MyOp::TYPE_INSTANCE)
		{
			echo "instance : ".htmlentities($this->get_class_name(), ENT_QUOTES, 'UTF-8')."\n";
			$myclasses = $this->get_all_myclass();
			foreach($myclasses as $myclass)
			{
				echo "of myclass ".$myclass->get_name()."\n";
				foreach($myclass->get_properties() as $property)
					echo "property : '".$property->get_name()."'\n";

				foreach($myclass->get_methods() as $method)
					echo "method : '".$method->get_name()."'\n";
			}
		}

		if($this->get_is_copy_array())
		{
			echo "copyarray start =================\n";
			foreach($this->get_copyarrays() as $copy_array)
			{
				$copy_array[1]->print_stdout();
			}
			echo "copyarray end =================\n";
		}
	}

	public function set_value_from_def($def)
	{
		$this->value_from_def = $def;
	}

	public function get_value_from_def()
	{
		return $this->value_from_def;
	}

	public function last_known_value($value)
	{
		$this->last_known_value = $value;
	}

	public function get_last_known_value()
	{
		return $this->last_known_value;
	}

	public function add_myclass($myclass)
	{
		$this->myclasses[] = $myclass;
	}

	public function get_all_myclass()
	{
		return $this->myclasses;
	}

	public function get_class_name()
	{
		return $this->class_name;
	}

	public function set_class_name($class_name)
	{
		$this->class_name = $class_name;
	}

	public function get_is_copy_array()
	{
		return $this->is_copy_array;
	}

	public function set_is_copy_array($arr)
	{
		$this->is_copy_array = $arr;
	}

	public function is_ref_arr()
	{
		return $this->is_ref_arr;
	}

	public function set_ref_arr($arr)
	{
		$this->is_ref_arr = $arr;
	}

	public function set_is_ref($is_ref)
	{
		$this->is_ref = $is_ref;
	}

	public function is_ref()
	{
		return $this->is_ref;
	}

	public function get_ref_name()
	{
		return $this->ref_name;
	}

	public function set_ref_name($refname)
	{
		$this->ref_name = $refname;
	}

	public function is_tainted()
	{
		return $this->is_tainted;
	}

	public function set_tainted($tainted)
	{
		$this->is_tainted = $tainted;
	}

	public function set_taintedbyexpr($expr)
	{
		$this->taintedbyexpr = $expr;
	}

	public function get_taintedbyexpr()
	{
		return $this->taintedbyexpr;
	}

	public function get_ref_arr_value()
	{
		return $this->ref_arr_value;
	}

	public function set_ref_arr_value($arr)
	{
		$this->ref_arr_value = $arr;
	}

	public function get_block_id()
	{
		return $this->block_id;
	}

	public function set_block_id($block_id)
	{
		$this->block_id = $block_id;
	}

	public function add_copyarray($arr, $def)
	{
		$this->thearrays[] = [$arr, $def];
	}

	public function set_copyarrays($thearrays)
	{
		$this->thearrays = $thearrays;
	}

	public function get_copyarrays()
	{
		return $this->thearrays;
	}

	public function get_assign_id()
	{
		return $this->assign_id;
	}

	public function set_assign_id($assign_id)
	{
		$this->assign_id = $assign_id;
	}

	public function set_exprs($exprs)
	{
		$this->theexprs = $exprs;
	}

	public function add_expr($myexpr)
	{
		if(!in_array($myexpr, $this->theexprs, true))
			$this->theexprs[] = $myexpr;
	}

	public function get_exprs()
	{
		return $this->theexprs;
	}

	public function set_sanitized($is_sanitized)
	{
		$this->is_sanitized = $is_sanitized;
	}

	public function is_sanitized()
	{
		return $this->is_sanitized;
	}

	public function set_type_sanitized($type_sanitized)
	{
		$this->type_sanitized = $type_sanitized;
	}

	public function get_type_sanitized()
	{
		return $this->type_sanitized;
	}

	public function add_type_sanitized($type_sanitized)
	{
		if(!in_array($type_sanitized, $this->type_sanitized, true))
			$this->type_sanitized[] = $type_sanitized;
	}

	public function is_type_sanitized($type_sanitized)
	{
		if(in_array($type_sanitized, $this->type_sanitized, true))
			return true;

		return false;
	}
}

?>
