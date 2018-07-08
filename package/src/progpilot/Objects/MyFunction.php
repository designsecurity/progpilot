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

class MyFunction extends MyOp
{
    const TYPE_FUNC_PROPERTY = 0x0001;
    const TYPE_FUNC_STATIC = 0x0002;
    const TYPE_FUNC_METHOD = 0x0004;

    private $nb_params;
    private $params;
    private $return_defs;
    private $defs;
    private $blocks;
    private $visibility;
    private $myclass;
    private $instance;
    private $block_id;

    private $this_def;
    private $back_def;

    private $last_line;
    private $last_column;
    private $last_block_id;

    private $isAnalyzed;
    private $isDataAnalyzed;

    private $mycode;

    public $property;

    public function __construct($name)
    {
        parent::__construct($name, 0, 0);

        $this->params = [];
        $this->return_defs = [];
        $this->visibility = "public";
        $this->myclass = null;
        $this->name_instance = null;
        $this->this_def = null;
        $this->back_def = null;
        $this->block_id = 0;
        $this->nb_params = 0;

        $this->last_line = 0;
        $this->last_column = 0;
        $this->last_block_id = 0;

        $this->isAnalyzed = false;
        $this->isDataAnalyzed = false;

        $this->property = new MyProperty;

        $this->mycode = new \progpilot\Code\MyCode;
    }

    public function __clone()
    {
        $this->property = clone $this->property;
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

    public function setMyCode($mycode)
    {
        $this->mycode = $mycode;
    }

    public function getMyCode()
    {
        return $this->mycode;
    }

    public function setLastLine($last_line)
    {
        $this->last_line = $last_line;
    }

    public function setLastColumn($last_column)
    {
        $this->last_column = $last_column;
    }

    public function setLastBlockId($last_block_id)
    {
        $this->last_block_id = $last_block_id;
    }

    public function getLastLine()
    {
        return $this->last_line;
    }

    public function getLastColumn()
    {
        return $this->last_column;
    }

    public function getLastBlockId()
    {
        return $this->last_block_id;
    }

    public function getMyClass()
    {
        return $this->myclass;
    }

    public function setMyClass($myclass)
    {
        $this->myclass = $myclass;
    }

    public function getThisDef()
    {
        return $this->this_def;
    }

    public function setThisDef($this_def)
    {
        $this->this_def = $this_def;
    }

    public function getBackDef()
    {
        return $this->back_def;
    }

    public function setBackDef($back_def)
    {
        $this->back_def = $back_def;
    }

    public function getNameInstance()
    {
        return $this->name_instance;
    }

    public function setNameInstance($name_instance)
    {
        $this->name_instance = $name_instance;
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

    public function setNbParams($nb_params)
    {
        $this->nb_params = $nb_params;
    }

    public function getNbParams()
    {
        return $this->nb_params;
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
        return $this->return_defs;
    }

    public function addReturnDef($return_def)
    {
        $this->return_defs[] = $return_def;
    }

    public function getBlockId()
    {
        return $this->block_id;
    }

    public function setBlockId($block_id)
    {
        $this->block_id = $block_id;
    }
}
