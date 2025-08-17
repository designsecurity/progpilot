<?php

namespace progpilot\Representations;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class AbstractSyntaxTree extends NodeVisitorAbstract
{
    private $nodes;
    private $edges;

    public function __construct()
    {
        $this->nodes = [];
        $this->edges = [];
    }

    public function getNodes()
    {
        return $this->nodes;
    }

    public function getEdges()
    {
        return $this->edges;
    }

    public function addNode($node)
    {
        $this->nodes[] = $node;
    }

    public function addEdge($caller, $callee)
    {
        $this->edges[] = [$caller, $callee];
    }

    public function beforeTraverse(array $nodes) {}

    public function enterNode(Node $node)
    {
        foreach ($node->getSubNodeNames() as $name) {
            $subNode = &$node->$name;

            if (is_object($subNode)) {
                $this->addEdge($node, $subNode);
            }
        }
    }

    public function leaveNode(Node $node) {}

    public function afterTraverse(array $nodes) {}
}
