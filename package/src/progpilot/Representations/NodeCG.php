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

    public function get_myclass()
    {
        return $this->myclass;
    }

    public function set_myclass($myclass)
    {
        $this->myclass = $myclass;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_line()
    {
        return $this->line;
    }

    public function get_column()
    {
        return $this->column;
    }

    public function get_file()
    {
        return $this->file;
    }

    public function get_nb_parents()
    {
        return $this->nb_parents;
    }

    public function get_nb_views()
    {
        return $this->nb_views;
    }

    public function get_children()
    {
        return $this->children;
    }

    public function get_color()
    {
        return $this->color;
    }

    public function set_color($color)
    {
        $this->color = $color;
    }

    public function set_children($children)
    {
        $this->children = $children;
    }

    public function set_nb_views($nb_views)
    {
        $this->nb_views = $nb_views;
    }

    public function set_nb_parents($nb_parents)
    {
        $this->nb_parents = $nb_parents;
    }

    public function set_name($name)
    {
        $this->name = $name;
    }

    public function set_line($line)
    {
        $this->line = $line;
    }

    public function set_column($column)
    {
        $this->column = $column;
    }

    public function set_file($file)
    {
        $this->file = $file;
    }

    public function get_id()
    {
        return hash("sha256", $this->name);
    }
}
