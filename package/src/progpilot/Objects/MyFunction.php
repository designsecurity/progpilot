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

    private $nbParams;
    private $params;
    private $returnDefs;
    private $defs;
    private $blocks;
    private $visibility;
    private $myClass;
    private $instance;
    private $blockId;
    private $nameInstance;
    
    private $thisDef;
    private $backDef;

    private $lastLine;
    private $lastColumn;
    private $lastBlockId;

    private $isAnalyzed;
    private $isDataAnalyzed;

    private $myCode;
    private $castReturn;

    public $property;
    
    public function __construct($name)
    {
        parent::__construct($name, 0, 0);

        $this->params = [];
        $this->returnDefs = [];
        $this->visibility = "public";
        $this->myclass = null;
        $this->nameInstance = null;
        $this->thisDef = null;
        $this->backDef = null;
        $this->blockId = 0;
        $this->nbParams = 0;

        $this->lastLine = 0;
        $this->lastColumn = 0;
        $this->lastBlockId = 0;

        $this->isAnalyzed = false;
        $this->isDataAnalyzed = false;

        $this->property = new MyProperty;
        $this->defs = new Definitions;
        $this->blocks = new \SplObjectStorage;

        $this->myCode = new \progpilot\Code\MyCode;
        $this->castReturn = MyDefinition::CAST_NOT_SAFE;
    }

    public function __clone()
    {
        $this->property = clone $this->property;
        $this->blocks = clone $this->blocks;
        $this->defs = clone $this->defs;
    }

    public function setIsDataAnalyzed($isDataAnalyzed)
    {
        $this->isDataAnalyzed = $isDataAnalyzed;
    }

    public function isDataAnalyzed()
    {
        return $this->isDataAnalyzed;
    }

    public function setIsAnalyzed($isAnalyzed)
    {
        $this->isAnalyzed = $isAnalyzed;
    }

    public function isAnalyzed()
    {
        return $this->isAnalyzed;
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

    public function setLastBlockId($lastBlockId)
    {
        $this->lastBlockId = $lastBlockId;
    }

    public function getLastLine()
    {
        return $this->lastLine;
    }

    public function getLastColumn()
    {
        return $this->lastColumn;
    }

    public function getLastBlockId()
    {
        return $this->lastBlockId;
    }

    public function getMyClass()
    {
        return $this->myclass;
    }

    public function setMyClass($myClass)
    {
        $this->myclass = $myClass;
    }

    public function getThisDef()
    {
        return $this->thisDef;
    }

    public function setThisDef($thisDef)
    {
        $this->thisDef = $thisDef;
    }

    public function getBackDef()
    {
        return $this->backDef;
    }

    public function setBackDef($backDef)
    {
        $this->backDef = $backDef;
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

    public function setDefs($defs)
    {
        $this->defs = $defs;
    }

    public function getDefs()
    {
        return $this->defs;
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

    public function getBlockId()
    {
        return $this->blockId;
    }

    public function setBlockId($blockId)
    {
        $this->blockId = $blockId;
    }
    
    public function setCastReturn($cast)
    {
        $this->castReturn = $cast;
    }
    
    public function getCastReturn()
    {
        return $this->castReturn;
    }
}
