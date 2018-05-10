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

        function get_myclass()
        {
            return $this->myclass;
        }

        function set_myclass($myclass)
        {
            $this->myclass = $myclass;
        }

        function get_name()
        {
            return $this->name;
        }

        function get_line()
        {
            return $this->line;
        }

        function get_column()
        {
            return $this->column;
        }

        function get_file()
        {
            return $this->file;
        }

        function get_nb_parents()
        {
            return $this->nb_parents;
        }

        function get_nb_views()
        {
            return $this->nb_views;
        }

        function get_children()
        {
            return $this->children;
        }

        function get_color()
        {
            return $this->color;
        }

        function set_color($color)
        {
            $this->color = $color;
        }

        function set_children($children)
        {
            $this->children = $children;
        }

        function set_nb_views($nb_views)
        {
            $this->nb_views = $nb_views;
        }

        function set_nb_parents($nb_parents)
        {
            $this->nb_parents = $nb_parents;
        }

        function set_name($name)
        {
            $this->name = $name;
        }

        function set_line($line)
        {
            $this->line = $line;
        }

        function set_column($column)
        {
            $this->column = $column;
        }

        function set_file($file)
        {
            $this->file = $file;
        }

        function get_id()
        {
            return hash("sha256", $this->name);
        }
}

?>
