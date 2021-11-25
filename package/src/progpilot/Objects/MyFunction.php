<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

use PHPCfg\Op;
use PHPCfg\Script;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;

class MyFunction extends MyOp
{
    const TYPE_FUNC_PROPERTY = 0x0001;
    const TYPE_FUNC_STATIC = 0x0002;
    const TYPE_FUNC_METHOD = 0x0004;

    private $lastLine;
    private $lastColumn;
    private $firstBlockId;
    private $lastBlockIds;

    private $nbParams;
    private $params;
    private $returnDefs;
    private $initialReturnDefs;
    private $defs;
    private $opInformations;
    private $blocks;
    private $visibility;
    private $myClass;
    private $blockId;
    private $nameInstance;
    
    private $thisDef;
    private $instanceClassName;

    private $thisHasBeenUpdated;
    private $isVisited;
    private $isVisitedFromInclude;

    private $myCode;

    public function __construct($name)
    {
        parent::__construct($name, 0, 0);

        $this->args = [];
        $this->params = [];
        $this->initialReturnDefs = [];
        $this->returnDefs = [];
        $this->visibility = "public";
        $this->myClass = null;
        $this->nameInstance = null;
        $this->thisDef = null;
        $this->instanceClassName = "";
        $this->blockId = 0;
        $this->firstBlockId = 0;
        $this->nbParams = 0;

        $this->lastLine = 0;
        $this->lastColumn = 0;
        $this->lastBlockIds = [];
        $this->lastExecutionTime = 0;
        $this->startExecutionTime = 0;
        $this->nbExecutions = 0;

        $this->thisHasBeenUpdated = false;
        $this->isVisited = false;
        $this->isVisitedFromInclude = false;
        $this->hasGlobalVariables = false;

        $this->defs = new Definitions;
        $this->opInformations = [];
        $this->blocks = [];

        $this->myCode = new \progpilot\Code\MyCode;
    }

    public function reset()
    {
        $this->opInformations = [];
    }

    public function setNbExecutions($nbExecutions)
    {
        $this->nbExecutions = $nbExecutions;
    }

    public function getNbExecutions()
    {
        return $this->nbExecutions;
    }

    public function setStartExecutionTime($startExecutionTime)
    {
        $this->startExecutionTime = $startExecutionTime;
    }

    public function getStartExecutionTime()
    {
        return $this->startExecutionTime;
    }

    public function setLastExecutionTime($lastExecutionTime)
    {
        $this->lastExecutionTime = $lastExecutionTime;
    }

    public function getLastExecutionTime()
    {
        return $this->lastExecutionTime;
    }

    public function setThisHasBeenUpdated($thisHasBeenUpdated)
    {
        $this->thisHasBeenUpdated = $thisHasBeenUpdated;
    }

    public function thisHasBeenUpdated()
    {
        return $this->thisHasBeenUpdated;
    }

    public function setHasGlobalVariables($hasGlobalVariables)
    {
        $this->hasGlobalVariables = $hasGlobalVariables;
    }

    public function hasGlobalVariables()
    {
        return $this->hasGlobalVariables;
    }

    public function setIsVisitedFromInclude($isVisited)
    {
        $this->isVisitedFromInclude = $isVisited;
    }

    public function isVisitedFromInclude()
    {
        return $this->isVisitedFromInclude;
    }

    public function setIsVisited($isVisited)
    {
        $this->isVisited = $isVisited;
    }

    public function isVisited()
    {
        return $this->isVisited;
    }

    public function setMyCode($myCode)
    {
        $this->myCode = $myCode;
    }

    public function getMyCode()
    {
        return $this->myCode;
    }

    public function setLastLine($lastLine)
    {
        $this->lastLine = $lastLine;
    }

    public function setLastColumn($lastColumn)
    {
        $this->lastColumn = $lastColumn;
    }

    public function setLastBlockIds($lastBlockIds)
    {
        $this->lastBlockIds = $lastBlockIds;
    }

    public function getLastBlockIds()
    {
        return $this->lastBlockIds;
    }

    public function addLastBlockId($id)
    {
        if (!in_array($id, $this->lastBlockIds, true)) {
            $this->lastBlockIds[] = $id;
        }
    }

    public function getLastLine()
    {
        return $this->lastLine;
    }

    public function getLastColumn()
    {
        return $this->lastColumn;
    }

    public function getMyClass()
    {
        return $this->myClass;
    }

    public function setMyClass($myClass)
    {
        $this->myClass = $myClass;
    }

    public function getThisDef()
    {
        return $this->thisDef;
    }

    public function setThisDef($thisDef)
    {
        $this->thisDef = $thisDef;
    }

    public function getInstanceClassName()
    {
        return $this->instanceClassName;
    }

    public function setInstanceClassName($instanceClassName)
    {
        $this->instanceClassName = $instanceClassName;
    }

    public function getNameInstance()
    {
        return $this->nameInstance;
    }

    public function setNameInstance($nameInstance)
    {
        $this->nameInstance = $nameInstance;
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function getBlockById($id)
    {
        foreach ($this->blocks as $block) {
            if ($block->getId() === $id) {
                return $block;
            }
        }

        return null;
    }

    public function setOpInformations($opInformations)
    {
        $this->opInformations = $opInformations;
    }

    public function getOpInformations()
    {
        return $this->opInformations;
    }

    public function getOpId($op)
    {
        if (is_object($op)) {
            return spl_object_hash($op);
        }
        
        return null;
    }

    public function getNbsOpInformations()
    {
        $nb = 0;
        if (is_array($this->opInformations)) {
            foreach ($this->opInformations as $opInformation) {
                if (isset($opInformation["chained_results"])) {
                    $nb += count($opInformation["chained_results"]);
                }

                if (isset($opInformation["valid_when_returning"])) {
                    $nb += 1;
                }
            
                if (isset($opInformation["condition_defs"])) {
                    $nb += count($opInformation["condition_defs"]);
                }
            }
        }

        return $nb;
    }

    public function cleanOpInformations()
    {
        $this->opInformations = null;
    }

    public function cleanOpInformation($id)
    {
        if (isset($this->opInformations[$id])) {
            unset($this->opInformations[$id]);
        }
    }

    public function getOpInformation($id)
    {
        if (isset($this->opInformations[$id])) {
            return $this->opInformations[$id];
        }

        return null;
    }

    public function storeOpInformation($id, $infos)
    {
        if (!empty($id)) {
            $this->opInformations[$id] = $infos;
        }
    }

    public function setDefs($defs)
    {
        $this->defs = $defs;
    }

    public function getDefs()
    {
        return $this->defs;
    }

    public function getStatePastArguments()
    {
        return $this->args;
    }

    public function addStatePastArgument($nbparam, $state)
    {
        $this->args[$nbparam][] = $state;
    }

    public function addParam($param)
    {
        $this->params[] = $param;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setNbParams($nbParams)
    {
        $this->nbParams = $nbParams;
    }

    public function getNbParams()
    {
        return $this->nbParams;
    }

    public function getParam($i)
    {
        if (isset($this->params[$i])) {
            return $this->params[$i];
        }

        return null;
    }

    public function getReturnDefs()
    {
        return $this->returnDefs;
    }

    public function addReturnDef($return_def)
    {
        $this->returnDefs[] = $return_def;
    }

    public function setReturnDefs($returndefs)
    {
        $this->returnDefs = $returndefs;
    }

    public function getInitialReturnDefs()
    {
        return $this->initialReturnDefs;
    }

    public function addInitialReturnDef($returnDef)
    {
        $this->initialReturnDefs[] = $returnDef;
    }

    public function setInitialReturnDefs($returndefs)
    {
        $this->initialReturnDefs = $returndefs;
    }

    public function getFirstBlockId()
    {
        return $this->firstBlockId;
    }

    public function setFirstBlockId($blockId)
    {
        $this->firstBlockId = $blockId;
    }

    public function getBlockId()
    {
        return $this->blockId;
    }

    public function setBlockId($blockId)
    {
        $this->blockId = $blockId;
    }
}
