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

class MyOutputsInternalApi
{
    protected $results;
    protected $writeIncludeFailures;
    protected $includeFailuresFile;
    protected $onAddResult;
    protected $taintedFlow;
    protected $countfilesanalyzed;

    public $currentIncludesFile;
    public $cfg;
    public $callgraph;
    public $ast;

    public function __construct()
    {
        $this->writeIncludeFailures = false;
        $this->includeFailuresFile = null;
        $this->currentIncludesFile = [];
        $this->results = [];
        $this->taintedFlow = false;
        $this->onAddResult = null;
        $this->countfilesanalyzed = 0;
        
        $this->cfg = [];
        $this->callgraph = [];
        $this->ast = [];
    }

    public function resetRepresentationsForAllFunctions()
    {
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
        if (!is_null($myFunc)
            && isset($this->callgraph[$myFunc->getId()])) {
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

    public function getCountAnalyzedFiles()
    {
        return $this->countfilesanalyzed;
    }

    public function setCountAnalyzedFiles($nb)
    {
        $this->countfilesanalyzed = $nb;
    }

    public function getWriteIncludeFailures()
    {
        return $this->writeIncludeFailures;
    }

    public function setWriteIncludeFailures($writeIncludeFailures)
    {
        $this->writeIncludeFailures = $writeIncludeFailures;
    }

    public function writeIncludesFile()
    {
        if ($this->writeIncludeFailures) {
            $fp = fopen($this->includeFailuresFile, "w");
            if ($fp) {
                $myArray = "";
                if (count($this->currentIncludesFile) > 0) {
                    $myArray = [];
                    foreach ($this->currentIncludesFile as $includeFile) {
                        $myArray[] = [$includeFile->getName(), $includeFile->getLine(), $includeFile->getColumn()];
                    }
                }

                $outputjson = array('include_failures' => $myArray);
                fwrite($fp, json_encode($outputjson, JSON_UNESCAPED_SLASHES));
                fclose($fp);
            }
        }
    }
}
