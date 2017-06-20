<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

use progpilot\Code\Opcodes;

class ControlFlowGraph {

	private $mycode;
	private $nodes;
	private $edges;
	private $current_block_text;
	private $storagemyblocks;

	public function __construct() {

		$this->nodes = [];
		$this->edges = [];
		$this->current_block_text = "";
		$this->storagemyblocks = new \SplObjectStorage;
	}

	public function get_graphjson()
	{
		foreach($this->nodes as $node)
		{
			$hash = spl_object_hash($node); 

			if(!isset($this->storagemyblocks[$node]))
				$this->storagemyblocks[$node] = "";

			$nodesjson[] = array('name' => $this->storagemyblocks[$node], 'id' => $hash);
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

	public function add_node($block)
	{
		$this->nodes[] = &$block;
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
			switch($instruction->get_title())
			{

				case Opcodes::ENTER_FUNCTION:
					{
						$myfunc = $instruction->get_property("func");
						$this->current_block_text .= "enter_func ".$myfunc->get_name()."\n";

						break;
					}

				case Opcodes::LEAVE_FUNCTION:
					{
						$this->current_block_text .= "leave_func\n";

						break;
					}

				case Opcodes::FUNC_CALL:
					{
						$funcname = $instruction->get_property("funcname");
						$this->current_block_text .= "funccall $funcname\n";
						break;
					}

				case Opcodes::START_EXPRESSION:
					{
						$this->current_block_text .= "start_expression\n";
						break;
					}

				case Opcodes::END_EXPRESSION:
					{
						$this->current_block_text .= "end_expression\n";
						break;
					}

				case Opcodes::TEMPORARY:
					{
						$this->current_block_text .= "temporary_simple\n";
						break;
					}

				case Opcodes::DEFINITION:
					{
						$this->current_block_text .= "definition_simple\n";
						break;
					}


				case Opcodes::ENTER_BLOCK:
					{
						$this->current_block_text = "enter_block\n";
						$myblock = $instruction->get_property("myblock");
						$block = &$myblock->get_block();

						$this->add_node($block);

						foreach($block->parents as $parent)
						{
							$this->add_edge($block, $parent);
						}

						break;
					}

				case Opcodes::LEAVE_BLOCK:
					{
						$this->current_block_text .= "leave_block\n";
						$myblock = $instruction->get_property("myblock");
						$block = &$myblock->get_block();
						$this->storagemyblocks[$block] = $this->current_block_text;

						break;
					}
			}

			$index = $index + 1;
		}
		while(isset($code[$index]));
	}
}

?>
