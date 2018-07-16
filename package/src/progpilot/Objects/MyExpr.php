<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyExpr extends MyOp
{
    private $tainted;
    private $assign;
    private $assignIterator;
    private $assignDef;
    private $theDefs;
    private $isConcat;
    private $nbChars;

    public function __construct($varLine, $varColumn)
    {
        parent::__construct("", $varLine, $varColumn);

        $this->nbChars = [];
        $this->isConcat = false;
        $this->tainted = false;
        $this->assign = false;
        $this->assignIterator = false;
        $this->assignDef = null;
        $this->theDefs = [];
    }

    public function setNbChars($char, $nbChars)
    {
        $this->nbChars[$char] = $nbChars;
    }

    public function getNbChars($char)
    {
        if (isset($this->nbChars[$char])) {
            return $this->nbChars[$char];
        }

        return 0;
    }

    public function setIsConcat($concat)
    {
        $this->isConcat = $concat;
    }

    public function getIsConcat()
    {
        return $this->isConcat;
    }

    public function setTainted($tainted)
    {
        $this->tainted = $tainted;
    }

    public function isTainted()
    {
        foreach ($this->theDefs as $theDef) {
            if ($theDef->isTainted()) {
                return true;
            }
        }
        return false;
    }

    /* assignement utilisant cette expression */
    public function setAssignDef($def)
    {
        $this->assignDef = $def;
    }

    public function getAssignDef()
    {
        return $this->assignDef;
    }

    public function setAssignIterator($assignIterator)
    {
        $this->assignIterator = $assignIterator;
    }

    public function setAssign($assign)
    {
        $this->assign = $assign;
    }

    public function isAssign()
    {
        return $this->assign;
    }

    public function isAssignIterator()
    {
        return $this->assignIterator;
    }

    public function setDefs($defs)
    {
        $this->theDefs = $defs;
    }

    public function addDef($myDef)
    {
        if (!in_array($myDef, $this->theDefs, true)) {
            $this->theDefs[] = $myDef;
        }
    }

    public function getDefs()
    {
        return $this->theDefs;
    }
}
