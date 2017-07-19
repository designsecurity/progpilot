<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Outputs;

use progpilot\Lang;
use progpilot\Representations\Callgraph;
use progpilot\Representations\ControlFlowGraph;

class MyOutputs {

	private $results;
    private $resolve_includes;
    private $resolve_includes_file;
    
    public $current_includes_file;
    public $cfg;
    public $callgraph;

	public function __construct() {

		$this->resolve_includes = false;
		$this->resolve_includes_file = null;
		$this->current_includes_file = "";
		$this->results = "";
		
		$this->cfg = new ControlFlowGraph;
		$this->callgraph = new Callgraph;
	}

	public function get_cfg()
	{
		foreach($this->cfg->get_nodes() as $node)
		{
			$hash = spl_object_hash($node); 

			if(is_null($this->cfg->get_myblock_from_storage($node)))
				$this->cfg->store_myblock($node, "");

			$nodesjson[] = array('name' => $this->cfg->get_myblock_from_storage($node), 'id' => $hash);
		}

		foreach($this->cfg->get_edges() as $edge)
		{
			$caller = $edge[0];
			$callee = $edge[1];

			$hashcaller = spl_object_hash($caller);
			$hashcallee = spl_object_hash($callee);

			$linksjson[] = array('target' => $hashcallee, 'source' => $hashcaller);
		}

		$outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);

		return $outputjson;
	}
	
	public function get_callgraph()
	{
		foreach($this->callgraph->get_nodes() as $node)
		{
			$hash = spl_object_hash($node);
			$nodesjson[] = array('name' => $node->get_name(), 'id' => $hash);
		}

		foreach($this->callgraph->get_edges() as $edge)
		{
			$caller = $edge[0];
			$callee = $edge[1];

			$hashcaller = spl_object_hash($caller);
			$hashcallee = spl_object_hash($callee);

			$linksjson[] = array('target' => $hashcallee, 'source' => $hashcaller);
		}

		$outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);
		return $outputjson;
	}
	
	public function &get_results()
	{
		return $this->results;
	}

	public function set_results(&$results)
	{
		$this->results = &$results;
	}

	public function get_resolve_includes()
	{
		return $this->resolve_includes;
	}

	public function resolve_includes($option)
	{
		$this->resolve_includes = $option;
	}

	public function resolve_includes_file($file)
	{
		$this->resolve_includes_file = $file;
	}

	public function get_resolve_includes_file()
	{
        return $this->resolve_includes_file;
	}
	
	public function write_includes_file()
	{
        if($this->resolve_includes)
        {
			if(!file_exists($this->resolve_includes_file))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);
				
            $fp = fopen($this->resolve_includes_file, "w");
            if($fp)
            {
                $outputjson = array('includes_not_resolved' => $this->current_includes_file); 
                fwrite($fp, json_encode($outputjson, JSON_UNESCAPED_SLASHES));
                fclose($fp);
            }
        }
	}

}

?>
