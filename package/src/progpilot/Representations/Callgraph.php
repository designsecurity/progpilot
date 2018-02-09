<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

use progpilot\Code\Opcodes;

class Callgraph
{

        private $nodes;
        private $edges;
        private $current_func;

        public function __construct()
        {

            $this->nodes = [];
            $this->edges = [];
        }

        public function get_nodes()
        {
            return $this->nodes;
        }

        public function get_edges()
        {
            return $this->edges;
        }

        public function add_node($func)
        {
            $this->nodes[] = $func;
        }

        public function add_edge($caller, $callee)
        {
            $this->edges[] = [$caller, $callee];
        }
}

?>
