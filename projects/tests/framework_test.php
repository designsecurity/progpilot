<?php

class framework_test
{
	private $basis;
	private $inputs;
	private $outputs;
		
	public function __construct() {

		$this->basis = [];
		$this->inputs = [];
		$this->outputs = [];
	}
	
	public function get_testbasis()
	{
		return $this->basis;
	}
	
	public function get_input($testbasis)
	{
		return $this->inputs["$testbasis"];
	}
	
	public function get_output($testbasis)
	{
		return $this->outputs["$testbasis"];
	}
	
	public function check_outputs($testbasis, $basis_outputs)
	{
		$i = 0;
		
		foreach($this->outputs["$testbasis"] as $output)
		{
			if(isset($basis_outputs[$i]) && $output == $basis_outputs[$i])
				return true;
			
			$i ++;
		}
		
		return false;
	}
	
	public function add_testbasis($testbasis) {

		$this->basis[] = $testbasis;
		$this->inputs["$testbasis"] = [];
		$this->outputs["$testbasis"] = [];
	}

	public function add_input($testbasis, $input) {

		$this->inputs["$testbasis"][] = $input;
	}

	public function add_output($testbasis, $output) {

		$this->outputs["$testbasis"][] = $output;
	}
}
