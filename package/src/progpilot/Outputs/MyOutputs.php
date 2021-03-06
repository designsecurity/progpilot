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
        
        $this->cfg = [];
        $this->callgraph = [];
        $this->ast = [];
    }

    public function createRepresentationsForFunction($myFunc)
    {
        if (!is_null($myFunc)) {
            $this->cfg[$myFunc->getId()] = new ControlFlowGraph;
            $this->callgraph[$myFunc->getId()] = new Callgraph;
            $this->ast[$myFunc->getId()] = new AbstractSyntaxTree;
        }
    }
    
    // cfg accessors
    public function cfgAddTextOfMyBlock($myFunc, $id, $text)
    {
        if (!is_null($myFunc) && isset($this->cfg[$myFunc->getId()])) {
            $tmpCfg = $this->cfg[$myFunc->getId()];
            $tmpCfg->addTextOfMyBlock($id, $text);
        }
    }

    public function cfgAddNode($myFunc, $id, $block)
    {
        if (!is_null($myFunc) && isset($this->cfg[$myFunc->getId()])) {
            $tmpCfg = $this->cfg[$myFunc->getId()];
            $tmpCfg->addNode($id, $text);
        }
    }

    public function cfgAddEdge($myFunc, $caller, $callee)
    {
        if (!is_null($myFunc) && isset($this->cfg[$myFunc->getId()])) {
            $tmpCfg = $this->cfg[$myFunc->getId()];
            $tmpCfg->addEdge($caller, $callee);
        }
    }

    // callgraph accessors
    public function callgraphAddNode($myFunc, $myFunccall, $myClass)
    {
        if (!is_null($myFunc) && isset($this->callgraph[$myFunc->getId()])) {
            $tmpCallgraph = $this->callgraph[$myFunc->getId()];
            $tmpCallgraph->addNode($myFunccall, $myClass);
        }
    }

    public function callgraphAddEdge($myFunc, $myFuncCaller, $myClassCaller, $myFuncCallee, $myClassCallee)
    {
        if (!is_null($myFunc) && isset($this->callgraph[$myFunc->getId()])) {
            $tmpCallgraph = $this->callgraph[$myFunc->getId()];
            $tmpCallgraph->addEdge($myFuncCaller, $myClassCaller, $myFuncCallee, $myClassCallee);
        }
    }

    public function callgraphAddFuncCall($myFunc, $myBlock, $myFunccall, $myClass)
    {
        if (!is_null($myFunc) && isset($this->callgraph[$myFunc->getId()])) {
            $tmpCallgraph = $this->callgraph[$myFunc->getId()];
            $tmpCallgraph->addFuncCall($myBlock, $myFunccall, $myClass);
        }
    }

    public function callgraphAddChild($myFunc, $myBlockParent, $myBlockChild)
    {
        if (!is_null($myFunc) && isset($this->callgraph[$myFunc->getId()])) {
            $tmpCallgraph = $this->callgraph[$myFunc->getId()];
            $tmpCallgraph->addChild($myBlockParent, $myBlockChild);
        }
    }

    public function getAst($myFunc)
    {
        $nodesjson = [];
        $linksjson = [];

        if (!is_null($myFunc) && isset($this->ast[$myFunc->getId()])) {
            $tmpAst = $this->ast[$myFunc->getId()];

            foreach ($tmpAst->getNodes() as $node) {
                $hash = spl_object_hash($node);

                $nodesjson[] = array('name' => get_class($node), 'id' => $hash);
            }

            foreach ($tmpAst->getEdges() as $edge) {
                $caller = $edge[0];
                $callee = $edge[1];

                $hashcaller = spl_object_hash($caller);
                $hashcallee = spl_object_hash($callee);

                if ($hashcaller !== $hashcallee) {
                    $linksjson[] = array('target' => $hashcallee, 'source' => $hashcaller);
                }
            }
        }

        return array('nodes' => $nodesjson, 'links' => $linksjson);
    }

    public function getCfg($myFunc)
    {
        $nodesjson = [];
        $linksjson = [];
        $realNodes = [];

        if (!is_null($myFunc) && isset($this->cfg[$myFunc->getId()])) {
            $tmpCfg = $this->cfg[$myFunc->getId()];

            foreach ($tmpCfg->getNodes() as $id => $node) {
                $realNodes[] = $id;
                $nodesjson[] = array('name' => $tmpCfg->getTextOfMyBlock($id), 'id' => $id);
            }

            foreach ($tmpCfg->getEdges() as $edge) {
                $callerId = $tmpCfg->getIdOfNode($edge[0]);
                $calleeId = $tmpCfg->getIdOfNode($edge[1]);

                if ($callerId !== $calleeId
                    && in_array($callerId, $realNodes, true)
                        && in_array($calleeId, $realNodes, true)) {
                    $linksjson[] = array('source' => $callerId, 'target' => $calleeId);
                }
            }
        }

        return array('nodes' => $nodesjson, 'links' => $linksjson);
    }

    public function getCallGraph($myFunc)
    {
        $nodesjson = [];
        $linksjson = [];
        $realNodes = [];

        if (!is_null($myFunc) && isset($this->callgraph[$myFunc->getId()])) {
            $tmpCallgraph = $this->callgraph[$myFunc->getId()];
            $nodes = $tmpCallgraph->getNodes();

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
        }

        return array('nodes' => $nodesjson, 'links' => $linksjson);
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
