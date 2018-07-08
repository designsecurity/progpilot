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
    private $assign_iterator;
    private $assign_def;
    private $thedefs;
    private $is_concat;
    private $nb_chars;

    public function __construct($var_line, $var_column)
    {
        parent::__construct("", $var_line, $var_column);

        $this->nb_chars = [];
        $this->is_concat = false;
        $this->tainted = false;
        $this->assign = false;
        $this->assign_iterator = false;
        $this->assign_def = null;
        $this->thedefs = [];
    }

    public function setNbChars($char, $nb_chars)
    {
        $this->nb_chars[$char] = $nb_chars;
    }

    public function getNbChars($char)
    {
        if (isset($this->nb_chars[$char])) {
            return $this->nb_chars[$char];
        }

        return 0;
    }

    public function setIsConcat($concat)
    {
        $this->is_concat = $concat;
    }

    public function getIsConcat()
    {
        return $this->is_concat;
    }

    public function setTainted($tainted)
    {
        $this->tainted = $tainted;
    }

    public function isTainted()
    {
        foreach ($this->thedefs as $thedef) {
            if ($thedef->isTainted()) {
                return true;
            }
        }
        return false;
    }

    /* assignement utilisant cette expression */
    public function setAssignDef($def)
    {
        $this->assign_def = $def;
    }

    public function getAssignDef()
    {
        return $this->assign_def;
    }

    public function setAssignIterator($assign_iterator)
    {
        $this->assign_iterator = $assign_iterator;
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
        return $this->assign_iterator;
    }

    public function setDefs($defs)
    {
        $this->thedefs = $defs;
    }

    public function addDef($mydef)
    {
        if (!in_array($mydef, $this->thedefs, true)) {
            $this->thedefs[] = $mydef;
        }
    }

    public function getDefs()
    {
        return $this->thedefs;
    }
}
