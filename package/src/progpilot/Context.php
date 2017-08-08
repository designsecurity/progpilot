<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot;

class Context {

	private $mycode;
	private $current_op;
	private $current_block;
	private $current_line;
	private $current_column;
	private $current_func;
	private $first_file;
	private $classes;
	private $functions;
	private $path;
	private $analyze_includes;
	private $analyze_js;

	public $inputs;
	public $outputs;

	public function __construct() 
	{
		// !!!??? mettre dans analyzer.php?
		$this->analyze_includes = true;
		$this->analyze_js = true;

		$this->current_op = null;
		$this->current_block = null;
		$this->current_line = -1;
		$this->current_column = -1;
		$this->current_func = null;
		$this->first_file = "";
		$this->path = null;

		$this->classes = new \progpilot\Dataflow\Classes;
		$this->functions = new \progpilot\Dataflow\Functions;
		$this->mycode = new \progpilot\Code\MyCode;

		$this->inputs = new \progpilot\Inputs\MyInputs;
		$this->outputs = new \progpilot\Outputs\MyOutputs;
	}

	public function get_analyze_js()
	{
		return $this->analyze_js;
	}

	public function get_analyze_includes()
	{
		return $this->analyze_includes;
	}

	public function set_analyze_js($analyze_js)
	{
		$this->analyze_js = $analyze_js;
	}

	public function set_analyze_includes($analyze_includes)
	{
		$this->analyze_includes = $analyze_includes;
	}

	public function get_mycode()
	{
		return $this->mycode;
	}

	public function get_current_op()
	{
		return $this->current_op;
	}

	public function get_current_block()
	{
		return $this->current_block;
	}

	public function get_current_line()
	{
		return $this->current_line;
	}

	public function get_current_column()
	{
		return $this->current_column;
	}

	public function get_current_func()
	{
		return $this->current_func;
	}

	public function get_classes()
	{
		return $this->classes;
	}

	public function get_functions()
	{
		return $this->functions;
	}

	public function get_inputs()
	{
		return $this->inputs;
	}

	public function get_outputs()
	{
		return $this->outputs;
	}

	public function get_path()
	{
		return $this->path;
	}

	public function get_first_file()
	{
		return $this->first_file;
	}

	public function set_first_file($first_file)
	{
		$this->first_file = $first_file;
	}

	public function set_path($path)
	{
		$this->path = $path;
	}


	public function set_mycode($mycode)
	{
		$this->mycode = $mycode;
	}

	public function set_current_op($current_op)
	{
		$this->current_op = $current_op;
	}

	public function set_current_block($current_block)
	{
		$this->current_block = $current_block;
	}

	public function set_current_line($current_line)
	{
		$this->current_line = $current_line;
	}

	public function set_current_column($current_column)
	{
		$this->current_column = $current_column;
	}

	public function set_current_func($current_func)
	{
		$this->current_func = $current_func;
	}

	public function set_classes($classes)
	{
		$this->classes = $classes;
	}

	public function set_functions($functions)
	{
		$this->functions = $functions;
	}

	public function set_inputs($inputs)
	{
		$this->inputs = $inputs;
	}
}

?>
