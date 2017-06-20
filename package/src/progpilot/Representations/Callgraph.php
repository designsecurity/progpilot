<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

use progpilot\Code\Opcodes;

class Callgraph {

	private $mycode;
	private $nodes;
	private $edges; 
	private $current_func;

	public function __construct() {

		$this->nodes = [];
		$this->edges = []; 
		$this->current_func = null;
	}

	public function get_graphjson()
	{
		foreach($this->nodes as $node)
		{
			$hash = spl_object_hash($node);
			$nodesjson[] = array('name' => $node->get_name(), 'id' => $hash);
		}

		foreach($this->edges as $edge)
		{
			$caller = &$edge[0];
			$callee = &$edge[1];

			$hashcaller = spl_object_hash($caller);
			$hashcallee = spl_object_hash($callee);

			$linksjson[] = array('target' => $hashcallee, 'source' => $hashcaller);
		}

		$outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);
		return $outputjson;
	}

	public function add_node($func)
	{
		$this->nodes[] = &$func;
	}

	public function add_edge($caller, $callee)
	{
		$this->edges[] = [&$caller, &$callee];
	}

	public function set_mycode(&$mycode) {

		$this->mycode = &$mycode;
	}

	public function analyze() {

		$index = 0;
		$code = $this->mycode->getcodes();

		do
		{
			$instruction = $code[$index];
			switch($instruction->get_opcode())
			{
				case Opcodes::ENTER_FUNCTION:
					{
						$this->current_func = $instruction->get_property("func");
						$this->add_node($this->current_func);

						break;
					}

				case Opcodes::FUNC_CALL:
					{
						$myfunc = $instruction->get_property("func");

						$this->add_edge($this->current_func, $myfunc);

						break;
					}
			}

			$index = $index + 1;
		}
		while(isset($code[$index]));
	}
}

?>
