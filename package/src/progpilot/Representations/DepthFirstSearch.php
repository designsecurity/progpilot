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
        foreach ($this->nodes as $key => $value) {
            $this->visitor->initializeNode($value);
        }

        $this->search($root);
    }

    public function search($node)
    {
        if (!is_null($node) && array_key_exists($node->getId(), $this->nodes)) {
            $this->visitor->examineNode($node);

            foreach ($node->getChildren() as $childId) {
                if (array_key_exists($childId, $this->nodes)) {
                    $child = $this->nodes[$childId];
                    if ($child->getColor() === "white") {
                        $this->visitor->examineNodeTarget($node);

                        $this->search($child);
                    }
                }
            }
        }
    }
}
