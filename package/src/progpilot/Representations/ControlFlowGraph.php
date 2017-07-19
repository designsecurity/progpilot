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
	
	public function get_current_block_text()
	{
        return $this->current_block_text;
	}
	
	public function set_current_block_text($text)
	{
        $this->current_block_text = $text;
	}
	
	public function concat_current_block_text($text)
	{
        $this->current_block_text = $this->current_block_text.$text;
	}

	public function store_myblock($myblock, $value)
	{
        $this->storagemyblocks[$myblock] = $value;
	}

	public function get_myblock_from_storage($myblock)
	{
        if(isset($this->storagemyblocks[$myblock]))
            return $this->storagemyblocks[$myblock];
            
        return null;
	}

	public function get_nodes()
	{
		return $this->nodes;
	}

	public function get_edges()
	{
		return $this->edges;
	}

	public function add_node($block)
	{
		$this->nodes[] = $block;
	}

	public function add_edge($caller, $callee)
	{
		$this->edges[] = [$caller, $callee];
	}
}

?>
