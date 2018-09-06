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
    private $onAddResult;
    private $taintedFlow;
    private $countfilesanalyzed;

    public $currentIncludesFile;
    public $cfg;
    public $callgraph;
    public $ast;

    public function __construct()
    {
        $this->resolveIncludes = false;
        $this->resolveIncludesFile = null;
        $this->currentIncludesFile = [];
        $this->results = [];
        $this->taintedFlow = false;
        $this->onAddResult = null;
        $this->countfilesanalyzed = 0;
        
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
        $realNodes = [];

        foreach ($this->cfg->getNodes() as $id => $node) {
            $realNodes[] = $id;
            $nodesjson[] = array('name' => $this->cfg->getTextOfMyBlock($id), 'id' => $id);
        }

        foreach ($this->cfg->getEdges() as $edge) {
            $callerId = $this->cfg->getIdOfNode($edge[0]);
            $calleeId = $this->cfg->getIdOfNode($edge[1]);

            if ($callerId !== $calleeId
                && in_array($callerId, $realNodes, true)
                    && in_array($calleeId, $realNodes, true)) {
                $linksjson[] = array('source' => $callerId, 'target' => $calleeId);
            }
        }

        $outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);
        return $outputjson;
    }

    public function getCallGraph()
    {
        $nodesjson = [];
        $linksjson = [];
        $realNodes = [];

        $nodes = $this->callgraph->getNodes();

        foreach ($nodes as $nodeCaller) {
            $realNodes[] = $nodeCaller->getId();
            $nodesjson[] = array('name' => $nodeCaller->getName(), 'id' => $nodeCaller->getId());
        }

        foreach ($nodes as $key => $nodeCaller) {
            foreach ($nodeCaller->getChildren() as $key => $nodeCalleeId) {
                $nodeCallee = $nodes[$nodeCalleeId];
                if ($nodeCaller->getId() !== $nodeCallee->getId()
                                                    && in_array($nodeCaller->getId(), $realNodes, true)
                                                    && in_array($nodeCallee->getId(), $realNodes, true)) {
                    $linksjson[] = array('source' => $nodeCaller->getId(), 'target' => $nodeCallee->getId());
                }
            }
        }

        $outputjson = array('nodes' => $nodesjson, 'links' => $linksjson);
        return $outputjson;
    }
    
    public function setOnAddResult($func)
    {
        $this->onAddResult = $func;
    }
    
    public function getOnAddResult()
    {
        return $this->onAddResult;
    }

    public function addResult($temp)
    {
        if (!in_array($temp, $this->results, true)) {
            if (!is_null($this->onAddResult)) {
                $params = array($temp);
                call_user_func($this->onAddResult, $params);
            }
            
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

    public function getCountAnalyzedFiles()
    {
        return $this->countfilesanalyzed;
    }

    public function setCountAnalyzedFiles($nb)
    {
        $this->countfilesanalyzed = $nb;
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
                $myArray = "";
                if (count($this->currentIncludesFile) > 0) {
                    $myArray = [];
                    foreach ($this->currentIncludesFile as $includeFile) {
                        $myArray[] = [$includeFile->getName(), $includeFile->getLine(), $includeFile->getColumn()];
                    }
                }

                $outputjson = array('includes_not_resolved' => $myArray);
                fwrite($fp, json_encode($outputjson, JSON_UNESCAPED_SLASHES));
                fclose($fp);
            }
        }
    }
}
