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

    public function set_nb_chars($char, $nb_chars)
    {
        $this->nb_chars[$char] = $nb_chars;
    }

    public function get_nb_chars($char)
    {
        if (isset($this->nb_chars[$char]))
            return $this->nb_chars[$char];

        return 0;
    }

    public function set_is_concat($concat)
    {
        $this->is_concat = $concat;
    }

    public function get_is_concat()
    {
        return $this->is_concat;
    }

    public function set_tainted($tainted)
    {
        $this->tainted = $tainted;
    }

    public function is_tainted()
    {
        foreach ($this->thedefs as $thedef)
        {
            if ($thedef->is_tainted())
                return true;
        }
        return false;
    }

    /* assignement utilisant cette expression */
    public function set_assign_def($def)
    {
        $this->assign_def = $def;
    }

    public function get_assign_def()
    {
        return $this->assign_def;
    }

    public function set_assign_iterator($assign_iterator)
    {
        $this->assign_iterator = $assign_iterator;
    }

    public function set_assign($assign)
    {
        $this->assign = $assign;
    }

    public function is_assign()
    {
        return $this->assign;
    }

    public function is_assign_iterator()
    {
        return $this->assign_iterator;
    }

    public function set_defs($defs)
    {
        $this->thedefs = $defs;
    }

    public function add_def($mydef)
    {
        if (!in_array($mydef, $this->thedefs, true))
            $this->thedefs[] = $mydef;
    }

    public function get_defs()
    {
        return $this->thedefs;
    }
}

?>
