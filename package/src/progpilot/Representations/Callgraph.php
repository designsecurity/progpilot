<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

use progpilot\Objects\MyFunction;

class Callgraph
{
    private $nodes;
    private $blocks;

    public function __construct()
    {
        $this->nodes = [];
        $this->blocks = new \SplObjectStorage;
    }

    public function getNodes()
    {
        return $this->nodes;
    }

    public function newBlock($myblock)
    {
        $obj = new \stdClass;
        $obj->calls = [];
        $obj->children = [];

        $this->blocks[$myblock] = $obj;
    }

    public function addNode($myfunc, $myclass)
    {
        $NodeCG = new NodeCG(
            $myfunc->getName(),
            $myfunc->getLine(),
            $myfunc->getColumn(),
            $myfunc->getSourceMyFile()->getName(),
            $myclass
        );

        if (!array_key_exists($NodeCG->getId(), $this->nodes)) {
            $this->nodes[$NodeCG->getId()] = $NodeCG;
        }
    }

    public function addEdge($myfunc_caller, $myclass_caller, $myfunc_callee, $myclass_callee)
    {
        $NodeCG_caller = new NodeCG(
            $myfunc_caller->getName(),
            $myfunc_caller->getLine(),
            $myfunc_caller->getColumn(),
            $myfunc_caller->getSourceMyFile()->getName(),
            $myclass_caller
        );
        $NodeCG_callee = new NodeCG(
            $myfunc_callee->getName(),
            $myfunc_callee->getLine(),
            $myfunc_callee->getColumn(),
            $myfunc_callee->getSourceMyFile()->getName(),
            $myclass_callee
        );

        if (array_key_exists($NodeCG_caller->getId(), $this->nodes)
                    && array_key_exists($NodeCG_callee->getId(), $this->nodes)
                    && $NodeCG_caller->getId() !== $NodeCG_callee->getId()) {
            if (!in_array($NodeCG_callee->getId(), $this->nodes[$NodeCG_caller->getId()]->getChildren(), true)) {
                $storage = $this->nodes[$NodeCG_caller->getId()]->getChildren();
                $storage[] = $NodeCG_callee->getId();
                $this->nodes[$NodeCG_caller->getId()]->setChildren($storage);

                $this->nodes[$NodeCG_callee->getId()]->setNbParents(
                    $this->nodes[$NodeCG_callee->getId()]->getNbParents() + 1
                );
            }
        }
    }

    public function addFuncCall($myblock, $myfunc, $myclass)
    {
        if (!$this->blocks->contains($myblock)) {
            $this->newBlock($myblock);
        }

        if (!in_array($myfunc, $this->blocks[$myblock]->calls, true)) {
            $storage = $this->blocks[$myblock]->calls;
            $storage[] = [$myfunc, $myclass];
            $this->blocks[$myblock]->calls = $storage;
        }
    }

    public function addChild($myblock_parent, $myblock_child)
    {
        if ($myblock_parent !== $myblock_child) {
            if (!$this->blocks->contains($myblock_parent)) {
                $this->newBlock($myblock_parent);
            }

            if (!$this->blocks->contains($myblock_child)) {
                $this->newBlock($myblock_child);
            }

            if (!in_array($myblock_child, $this->blocks[$myblock_parent]->children, true)) {
                $storage = $this->blocks[$myblock_parent]->children;
                $storage[] = $myblock_child;
                $this->blocks[$myblock_parent]->children = $storage;
            }
        }
    }

    public function getCalls($myblock)
    {
        if ($this->blocks->contains($myblock)) {
            return $this->blocks[$myblock]->calls;
        }

        return null;
    }

    public function computeCallGraph()
    {
        // transform parents to children
        foreach ($this->blocks as $myblock) {
            foreach ($myblock->parents as $parent) {
                $this->addChild($parent, $myblock);
            }
        }

        // handle circular graph like recursive function
        $null_nodes = [];
        // reduce graph
        foreach ($this->blocks as $myblock) {
            do {
                $modification = false;
                $new_children = [];

                foreach ($this->blocks[$myblock]->children as $child) {
                    if ($myblock !== $child) {
                        $calls_child = $this->getCalls($child);
                        if (is_null($calls_child) || count($calls_child) === 0) {
                            if (!in_array($child, $null_nodes, true)) {
                                $null_nodes[] = $child;
                                foreach ($this->blocks[$child]->children as $child_far) {
                                    if (!in_array($child_far, $new_children, true)
                                                && $myblock !== $child_far
                                                                 && $child !== $child_far) {
                                        $new_children[] = $child_far;
                                        $modification = true;
                                    }
                                }
                            }
                        } else {
                            $new_children[] = $child;
                        }
                    }
                }

                $this->blocks[$myblock]->children = $new_children;
            } while ($modification);
        }

        //calculate nodes
        foreach ($this->blocks as $myblock) {
            foreach ($this->blocks[$myblock]->calls as $call) {
                $this->addNode($call[0], $call[1]);
            }
        }

        // calculate edges
        foreach ($this->blocks as $myblock) {
            $calls = $this->getCalls($myblock);

            // calculate edges first case : sequential calls
            if (count($calls) > 1) {
                for ($i = 0; $i < count($calls) - 1; $i ++) {
                    $this->addEdge($calls[$i][0], $calls[$i][1], $calls[$i + 1][0], $calls[$i + 1][1]);
                }
            }

            // calculate edges second case : calls from parents
            if (count($calls) > 0) {
                $last_call_parent = $calls[count($calls) - 1][0];
                $last_myclass_parent = $calls[count($calls) - 1][1];
                foreach ($this->blocks[$myblock]->children as $child) {
                    $calls = $this->getCalls($child);
                    if (!is_null($calls) && count($calls) > 0) {
                        $first_call_child = $calls[0][0];
                        $first_myclass_child = $calls[0][1];
                        $this->addEdge(
                            $last_call_parent,
                            $last_myclass_parent,
                            $first_call_child,
                            $first_myclass_child
                        );
                    }
                }
            }
        }
    }
}
