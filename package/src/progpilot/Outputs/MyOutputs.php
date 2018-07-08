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

class MyOutputs
{
    private $results;
    private $resolveIncludes;
    private $resolveIncludesFile;
    private $taintedFlow;

    public $current_includes_file;
    public $cfg;
    public $callgraph;
    public $ast;

    public function __construct()
    {
        $this->resolveIncludes = false;
        $this->resolveIncludesFile = null;
        $this->current_includes_file = [];
        $this->results = [];
        $this->taintedFlow = false;

        $this->resetRepresentations();
    }

    public function resetRepresentations()
    {
        //$this->results = [];
        $this->cfg = new ControlFlowGraph;
        $this->callgraph = new Callgraph;
        $this->ast = new AbstractSyntaxTree;
    }

    public function getAst()
    {
        $nodesjson = [];
        $linksjson = [];

        foreach ($this->ast->getNodes() as $node) {
            $hash = spl_object_hash($node);

            $nodesjson[] = array('name' => get_class($node), 'id' => $hash);
        }

        foreach ($this->ast->getEdges() as $edge) {
            $caller = $edge[0];
            $callee = $edge[1];

            $hashcaller = spl_object_hash($caller);
            $hashcallee = spl_object_hash($callee);

            if ($hashcaller !== $hashcallee) {
                $linksjson[] = array('target' => $hashcallee, 'source' => $hashcaller);
            }
        }

        $outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);

        return $outputjson;
    }

    public function getCfg()
    {
        $nodesjson = [];
        $linksjson = [];
        $real_nodes = [];

        foreach ($this->cfg->getNodes() as $id => $node) {
            $real_nodes[] = $id;
            $nodesjson[] = array('name' => $this->cfg->getTextOfMyBlock($id), 'id' => $id);
        }

        foreach ($this->cfg->getEdges() as $edge) {
            $caller_id = $this->cfg->getIdOfNode($edge[0]);
            $callee_id = $this->cfg->getIdOfNode($edge[1]);

            if ($caller_id !== $callee_id
                                    && in_array($caller_id, $real_nodes, true)
                                    && in_array($callee_id, $real_nodes, true)) {
                $linksjson[] = array('source' => $caller_id, 'target' => $callee_id);
            }
        }

        $outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);
        return $outputjson;
    }

    public function getCallGraph()
    {
        $nodesjson = [];
        $linksjson = [];
        $real_nodes = [];

        $nodes = $this->callgraph->getNodes();

        foreach ($nodes as $node_caller) {
            $real_nodes[] = $node_caller->getId();
            $nodesjson[] = array('name' => $node_caller->getName(), 'id' => $node_caller->getId());
        }

        foreach ($nodes as $key => $node_caller) {
            foreach ($node_caller->getChildren() as $key => $node_callee_id) {
                $node_callee = $nodes[$node_callee_id];
                if ($node_caller->getId() !== $node_callee->getId()
                                                    && in_array($node_caller->getId(), $real_nodes, true)
                                                    && in_array($node_callee->getId(), $real_nodes, true)) {
                    $linksjson[] = array('source' => $node_caller->getId(), 'target' => $node_callee->getId());
                }
            }
        }

        $outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);
        return $outputjson;
    }

    public function addResult($temp)
    {
        if (!in_array($temp, $this->results, true)) {
            $this->results[] = $temp;
        }
    }

    public function setResults(&$results)
    {
        $this->results = &$results;
    }

    public function &getResults()
    {
        return $this->results;
    }

    public function getResolveIncludes()
    {
        return $this->resolveIncludes;
    }

    public function resolveIncludes($option)
    {
        $this->resolveIncludes = $option;
    }

    public function resolveIncludesFile($file)
    {
        $this->resolveIncludesFile = $file;
    }

    public function getresolveIncludesFile()
    {
        return $this->resolveIncludesFile;
    }

    public function taintedFlow($bool)
    {
        $this->taintedFlow = $bool;
    }

    public function getTaintedFlow()
    {
        return $this->taintedFlow;
    }

    public function writeIncludesFile()
    {
        if ($this->resolveIncludes) {
            $fp = fopen($this->resolveIncludesFile, "w");
            if ($fp) {
                $myarray = "";
                if (count($this->current_includes_file) > 0) {
                    $myarray = [];
                    foreach ($this->current_includes_file as $include_file) {
                        $myarray[] = [$include_file->getName(), $include_file->getLine(), $include_file->getColumn()];
                    }
                }

                $outputjson = array('includes_not_resolved' => $myarray);
                fwrite($fp, json_encode($outputjson, JSON_UNESCAPED_SLASHES));
                fclose($fp);
            }
        }
    }
}
