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
use progpilot\Representations\AbstractSyntaxTree;

use PhpParser\NodeTraverser;

class MyOutputs {

	private $results;
	private $resolve_includes;
	private $resolve_includes_file;
    private $tainted_flow;
	
	public $current_includes_file;
	public $cfg;
	public $callgraph;
	public $ast;

	public function __construct() {

		$this->resolve_includes = false;
		$this->resolve_includes_file = null;
		$this->current_includes_file = [];
		$this->results = "";
		$this->tainted_flow = false;

		$this->cfg = new ControlFlowGraph;
		$this->callgraph = new Callgraph;
		$this->ast = new AbstractSyntaxTree;
	}
	
	public function get_ast()
	{
        $nodesjson = [];
        $linksjson = [];
        
		foreach($this->ast->get_nodes() as $node)
		{
			$hash = spl_object_hash($node); 
            
			$nodesjson[] = array('name' => get_class($node), 'id' => $hash);
		}

		foreach($this->ast->get_edges() as $edge)
		{
			$caller = $edge[0];
			$callee = $edge[1];

			$hashcaller = spl_object_hash($caller);
			$hashcallee = spl_object_hash($callee);
			
			if($hashcaller != $hashcallee)
            {
                $linksjson[] = array('target' => $hashcallee, 'source' => $hashcaller);
            }
		}

		$outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);

		return $outputjson;
	}

	public function get_cfg()
	{
        $nodesjson = [];
        $linksjson = [];
        
		foreach($this->cfg->get_nodes() as $id => $node)
		{
			$hash = spl_object_hash($node); 

            $text = $this->cfg->get_textofmyblock($id);
            
			$nodesjson[] = array('name' => $text, 'id' => $hash);
		}

		foreach($this->cfg->get_edges() as $edge)
		{
			$caller = $edge[0];
			$callee = $edge[1];

			$hashcaller = spl_object_hash($caller);
			$hashcallee = spl_object_hash($callee);
			
			if($hashcaller != $hashcallee)
            {
                $linksjson[] = array('target' => $hashcallee, 'source' => $hashcaller);
            }
		}

		$outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);

		return $outputjson;
	}

	public function get_callgraph()
	{
        $nodesjson = [];
        $linksjson = [];
        $real_nodes = [];
        
		foreach($this->callgraph->get_nodes() as $node)
		{
            $function_name = \progpilot\Utils::print_function($node);
			$hash = hash("sha256", $function_name);
			
			$real_nodes[] = $function_name;
			
			$nodesjson[] = array('name' => $node->get_name(), 'id' => $hash);
		}
        
		foreach($this->callgraph->get_edges() as $edge)
		{
			$caller = $edge[0];
			$callee = $edge[1];
			
			$hashcaller = hash("sha256", \progpilot\Utils::print_function($caller));
			$hashcallee = hash("sha256", \progpilot\Utils::print_function($callee));
			
            $function_name1 = \progpilot\Utils::print_function($caller);
            $function_name2 = \progpilot\Utils::print_function($callee);
			
			if($hashcaller != $hashcallee 
                && in_array($function_name1, $real_nodes, true) 
                    && in_array($function_name2, $real_nodes, true))
            {
                $linksjson[] = array('target' => $hashcallee, 'source' => $hashcaller);
            }
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
	
	public function tainted_flow($bool)
	{
        $this->tainted_flow = $bool;
	}
	
	public function get_tainted_flow()
	{
        return $this->tainted_flow;
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
                $myarray = "";
                if(count($this->current_includes_file) > 0)
                {
                    $myarray = [];
                    foreach($this->current_includes_file as $include_file)
                    {
                        $myarray[] = [$include_file->get_name(), $include_file->getLine(), $include_file->getColumn()];
                    }
                }
                
				$outputjson = array('includes_not_resolved' => $myarray); 
				fwrite($fp, json_encode($outputjson, JSON_UNESCAPED_SLASHES));
				fclose($fp);
			}
		}
	}

}

?>
