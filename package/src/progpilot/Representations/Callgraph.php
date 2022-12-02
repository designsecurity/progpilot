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

    public function newBlock($myBlock)
    {
        $obj = new \stdClass;
        $obj->calls = [];
        $obj->children = [];

        $this->blocks[$myBlock] = $obj;
    }

    public function addNode($myFunc, $myClass)
    {
        $NodeCG = new NodeCG(
            $myFunc->getName(),
            $myFunc->getLine(),
            $myFunc->getColumn(),
            $myFunc->getSourceMyFile()->getName(),
            $myClass
        );

        if (!array_key_exists($NodeCG->getId(), $this->nodes)) {
            $this->nodes[$NodeCG->getId()] = $NodeCG;
        }
    }

    public function addEdge($myFuncCaller, $myClassCaller, $myFuncCallee, $myClassCallee)
    {
        $NodeCGCaller = new NodeCG(
            $myFuncCaller->getName(),
            $myFuncCaller->getLine(),
            $myFuncCaller->getColumn(),
            $myFuncCaller->getSourceMyFile()->getName(),
            $myClassCaller
        );
        $NodeCGCallee = new NodeCG(
            $myFuncCallee->getName(),
            $myFuncCallee->getLine(),
            $myFuncCallee->getColumn(),
            $myFuncCallee->getSourceMyFile()->getName(),
            $myClassCallee
        );

        if (array_key_exists($NodeCGCaller->getId(), $this->nodes)
            && array_key_exists($NodeCGCallee->getId(), $this->nodes)
                && $NodeCGCaller->getId() !== $NodeCGCallee->getId()) {
            if (!in_array($NodeCGCallee->getId(), $this->nodes[$NodeCGCaller->getId()]->getChildren(), true)) {
                $storage = $this->nodes[$NodeCGCaller->getId()]->getChildren();
                $storage[] = $NodeCGCallee->getId();
                $this->nodes[$NodeCGCaller->getId()]->setChildren($storage);

                $this->nodes[$NodeCGCallee->getId()]->setNbParents(
                    $this->nodes[$NodeCGCallee->getId()]->getNbParents() + 1
                );
            }
        }
    }

    public function addFuncCall($myBlock, $myFunc, $myClass)
    {
        if (!$this->blocks->contains($myBlock)) {
            $this->newBlock($myBlock);
        }

        if (!in_array($myFunc, $this->blocks[$myBlock]->calls, true)) {
            $storage = $this->blocks[$myBlock]->calls;
            $storage[] = [$myFunc, $myClass];
            $this->blocks[$myBlock]->calls = $storage;
        }
    }

    public function addChild($myBlockParent, $myBlockChild)
    {
        if ($myBlockParent !== $myBlockChild) {
            if (!$this->blocks->contains($myBlockParent)) {
                $this->newBlock($myBlockParent);
            }

            if (!$this->blocks->contains($myBlockChild)) {
                $this->newBlock($myBlockChild);
            }

            if (!in_array($myBlockChild, $this->blocks[$myBlockParent]->children, true)) {
                $storage = $this->blocks[$myBlockParent]->children;
                $storage[] = $myBlockChild;
                $this->blocks[$myBlockParent]->children = $storage;
            }
        }
    }

    public function getCalls($myBlock)
    {
        if ($this->blocks->contains($myBlock)) {
            return $this->blocks[$myBlock]->calls;
        }

        return null;
    }

    public function computeCallGraph()
    {
        // transform parents to children
        foreach ($this->blocks as $myBlock) {
            foreach ($myBlock->parents as $parent) {
                $this->addChild($parent, $myBlock);
            }
        }

        // handle circular graph like recursive function
        $nullNodes = [];
        // reduce graph
        foreach ($this->blocks as $myBlock) {
            do {
                $modification = false;
                $newChildren = [];

                foreach ($this->blocks[$myBlock]->children as $child) {
                    if ($myBlock !== $child) {
                        $callsChild = $this->getCalls($child);
                        if (is_null($callsChild) || count($callsChild) === 0) {
                            if (!in_array($child, $nullNodes, true)) {
                                $nullNodes[] = $child;
                                foreach ($this->blocks[$child]->children as $childFar) {
                                    if (!in_array($childFar, $newChildren, true)
                                                && $myBlock !== $childFar
                                                                 && $child !== $childFar) {
                                        $newChildren[] = $childFar;
                                        $modification = true;
                                    }
                                }
                            }
                        } else {
                            $newChildren[] = $child;
                        }
                    }
                }

                $this->blocks[$myBlock]->children = $newChildren;
            } while ($modification);
        }

        //calculate nodes
        foreach ($this->blocks as $myBlock) {
            foreach ($this->blocks[$myBlock]->calls as $call) {
                $this->addNode($call[0], $call[1]);
            }
        }

        // calculate edges
        foreach ($this->blocks as $myBlock) {
            $calls = $this->getCalls($myBlock);

            // calculate edges first case : sequential calls
            if (count($calls) > 1) {
                for ($i = 0; $i < count($calls) - 1; $i ++) {
                    $this->addEdge($calls[$i][0], $calls[$i][1], $calls[$i + 1][0], $calls[$i + 1][1]);
                }
            }

            // calculate edges second case : calls from parents
            if (!empty($calls)) {
                $lastCallParent = $calls[count($calls) - 1][0];
                $lastMyClassParent = $calls[count($calls) - 1][1];
                foreach ($this->blocks[$myBlock]->children as $child) {
                    $calls = $this->getCalls($child);
                    if (!is_null($calls) && !empty($calls)) {
                        $firstCallChild = $calls[0][0];
                        $firstMyClassChild = $calls[0][1];
                        $this->addEdge(
                            $lastCallParent,
                            $lastMyClassParent,
                            $firstCallChild,
                            $firstMyClassChild
                        );
                    }
                }
            }
        }
    }
}
