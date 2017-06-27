<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

use PHPCfg\Op;

class MyDefinition extends MyOp {

	private $var_name;
	private $block_id;
	private $is_tainted;
	private $is_copyarray;
	private $is_ref;
	private $ref_name;
	private $is_arr;
	private $arr_value;
	private $is_ref_arr;
	private $ref_arr_value;
	private $thearrays;
	private $theexprs;
	private $taintedbyexpr;
	private $visibility;
	private $instance;
	private $myinstance;
	private $is_property;
	private $property_name;
	private $class_name;
	private $is_sanitized;
	private $type_sanitized;

	public function __construct($var_line, $var_column, $var_name, $is_ref, $is_arr) {

		parent::__construct($var_line, $var_column);

		$this->var_name = $var_name;
		$this->block_id = -1;
		$this->is_tainted = false;
		$this->is_ref = $is_ref;
		$this->is_arr = $is_arr;
		$this->is_copyarray = false;
		//$this->references = new SplObjectStorage();
		$this->thearrays = [];
		$this->theexprs = [];
		$this->arr_value = null;
		$this->is_ref_arr = false;
		$this->ref_arr_value = null;
		$this->taintedbyexpr = null;
		$this->visibility = "public";
		$this->instance = false;
		$this->myinstance = null;
		$this->class_name = "";
		$this->is_property = false;
		$this->property_name = "";

		$this->is_sanitized = false;
		$this->type_sanitized = [];
		
		$this->last_known_value = "";
	}

	public function print_stdout()
	{
		echo "def name = ".htmlentities($this->get_name(), ENT_QUOTES, 'UTF-8')." :: line = ".$this->getLine()." :: column = ".$this->getColumn()." :: tainted = ".$this->is_tainted()." :: ref = ".$this->is_ref()." :: arr = ".$this->is_arr()." :: copyarray = ".$this->is_copyarray()." :: is_instance = ".$this->is_instance()." :: is_property = ".$this->is_property()." :: visibility = ".$this->get_visibility()." :: blockid = ".$this->get_block_id()."\n";
		if($this->is_arr())
		{
			echo "arr :\n";
			var_dump($this->get_arr_value());
		}

		if($this->is_property())
		{
			echo "property : ".htmlentities($this->get_property_name(), ENT_QUOTES, 'UTF-8')."\n";
		}

		if($this->is_copyarray())
		{
			echo "copyarray :\n";
			var_dump($this->get_copyarrays());
		}
	}
	
	public function last_known_value($value)
	{
        $this->last_known_value = $value;
    }
    
    public function get_last_known_value()
	{
        return $this->last_known_value;
    }

	public function set_property($property)
	{
		$this->is_property = $property;
	}

	public function is_property()
	{
		return $this->is_property;
	}

	public function set_property_name($property_name)
	{
		$this->property_name = $property_name;
	}

	public function get_property_name()
	{
		return $this->property_name;
	}




	public function is_instance()
	{
		return $this->instance;
	}

	public function set_instance($instance)
	{
		$this->instance = $instance;
	}

	public function get_myinstance()
	{
		return $this->myinstance;
	}

	public function set_myinstance($myinstance)
	{
		$this->myinstance = $myinstance;
	}



	public function get_class_name()
	{
		return $this->class_name;
	}

	public function set_class_name($class_name)
	{
		$this->class_name = $class_name;
	}


	public function is_arr()
	{
		return $this->is_arr;
	}

	public function set_arr($arr)
	{
		$this->is_arr = $arr;
	}

	public function is_ref_arr()
	{
		return $this->is_ref_arr;
	}

	public function set_ref_arr($arr)
	{
		$this->is_ref_arr = $arr;
	}

	public function set_visibility($visibility)
	{
		$this->visibility = $visibility;
	}

	public function get_visibility()
	{
		return $this->visibility;
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

	public function set_arr_value($arr)
	{
		$this->arr_value = $arr;
	}

	public function get_ref_arr_value()
	{
		return $this->ref_arr_value;
	}

	public function set_ref_arr_value($arr)
	{
		$this->ref_arr_value = $arr;
	}

	public function get_arr_value()
	{
		return $this->arr_value;
	}

	public function get_name()
	{
		return $this->var_name;
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

	public function is_copyarray()
	{
		return $this->is_copyarray;
	}

	public function set_copyarray($arr)
	{
		$this->is_copyarray = $arr;
	}

	public function set_exprs($exprs)
	{
		$this->theexprs = $exprs;
	}
	
	/* expressions utilisant la définition */
	public function add_expr($myexpr)
	{
		if(!in_array($myexpr, $this->theexprs))
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
		if(!in_array($type_sanitized, $this->type_sanitized))
			$this->type_sanitized[] = $type_sanitized;
	}

	public function is_type_sanitized($type_sanitized)
	{
		if(in_array($type_sanitized, $this->type_sanitized))
			return true;

		return false;
	}
}

?>
