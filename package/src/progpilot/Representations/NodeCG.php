<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

class NodeCG
{
    private $myclass;
    private $name;
    private $line;
    private $column;
    private $file;
    private $nb_parents;
    private $nb_views;
    private $children;
    private $color;

    public function __construct($name, $line, $column, $file, $myclass)
    {
        $this->myclass = $myclass;
        $this->name = $name;
        $this->line = $line;
        $this->column = $column;
        $this->file = $file;

        $this->nb_parents = 0;
        $this->nb_views = 0;
        $this->children = [];
        $this->color = "white";
    }

    public function getMyClass()
    {
        return $this->myclass;
    }

    public function setMyClass($myclass)
    {
        $this->myclass = $myclass;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLine()
    {
        return $this->line;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getNbParents()
    {
        return $this->nb_parents;
    }

    public function getNbViews()
    {
        return $this->nb_views;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setChildren($children)
    {
        $this->children = $children;
    }

    public function setNbViews($nb_views)
    {
        $this->nb_views = $nb_views;
    }

    public function setNbParents($nb_parents)
    {
        $this->nb_parents = $nb_parents;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLine($line)
    {
        $this->line = $line;
    }

    public function setColumn($column)
    {
        $this->column = $column;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getId()
    {
        return hash("sha256", $this->name);
    }
}
