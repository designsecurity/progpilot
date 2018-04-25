<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

class DepthFirstSearch
{
        private $nodes;

        public function __construct($nodes, $visitor)
        {
            $this->nodes = $nodes;
            $this->visitor = $visitor;
        }

        public function init($root)
        {
            foreach($this->nodes as $key => $value)
            {
                $this->visitor->initialize_node($value);
            }

            $this->search($root);
        }

        public function search($node)
        {
            if (!is_null($node) && array_key_exists($node->get_id(), $this->nodes))
            {
                $this->visitor->examine_node($node);

                foreach ($node->get_children() as $child_id)
                {
                    if (array_key_exists($child_id, $this->nodes))
                    {
                        $child = $this->nodes[$child_id];
                        if ($child->get_color() === "white")
                        {
                            $this->visitor->examine_node_target($node);

                            $this->search($child);
                        }
                    }
                }
            }
        }
}

?>
