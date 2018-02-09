<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

use progpilot\Code\Opcodes;

class ControlFlowGraph
{

        private $nodes;
        private $edges;
        private $myblock_text;

        public function __construct()
        {

            $this->nodes = [];
            $this->edges = [];
            $this->myblock_text = [];
        }

        public function get_textofmyblock($id)
        {
            if (isset($this->myblock_text["$id"]))
                return $this->myblock_text["$id"];

            return "";
        }

        public function add_textofmyblock($id, $text)
        {
            if (isset($this->myblock_text["$id"]))
                $this->myblock_text["$id"] = $this->myblock_text["$id"]."$text";
            else
                $this->myblock_text["$id"] = "$text";
        }

        public function get_nodes()
        {
            return $this->nodes;
        }

        public function get_edges()
        {
            return $this->edges;
        }

        public function add_node($id, $block)
        {
            $this->nodes["$id"] = $block;
        }

        public function add_edge($caller, $callee)
        {
            $this->edges[] = [$caller, $callee];
        }
}

?>
