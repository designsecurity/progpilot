<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyBlock extends MyOp
{
    private $returnDefs;
    private $startAddressBlock;
    private $endAddressBlock;
    private $loop;

    public $children;
    public $parents;
    public $virtualParents;
    public $assertions;

    public function __construct($startLine, $startColumn)
    {
        parent::__construct("", $startLine, $startColumn);

        $this->returnDefs = [];
        $this->startAddressBlock = -1;
        $this->endAddressBlock = -1;
        $this->assertions = [];
        $this->parents = [];
        $this->virtualParents = [];
        $this->children = [];
        $this->loop = false;
    }

    public function addVirtualParent($parent)
    {
        $this->virtualParents[] = $parent;
    }

    public function getVirtualParents()
    {
        return $this->virtualParents;
    }

    public function addParent($parent)
    {
        $this->parents[] = $parent;
    }

    public function getParents()
    {
        return $this->parents;
    }

    public function addChild($child)
    {
        $this->children[] = $child;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function addReturnDef($def)
    {
        $this->returnDefs[] = $def;
    }

    public function getReturnDefs()
    {
        return $this->returnDefs;
    }

    public function addAssertion($myassertion)
    {
        $this->assertions[] = $myassertion;
    }

    public function getAssertions()
    {
        return $this->assertions;
    }

    public function setStartAddressBlock($address)
    {
        $this->startAddressBlock = $address;
    }

    public function setEndAddressBlock($address)
    {
        $this->endAddressBlock = $address;
    }

    public function getStartAddressBlock()
    {
        return $this->startAddressBlock;
    }

    public function getEndAddressBlock()
    {
        return $this->endAddressBlock;
    }

    public function setIsLoop($loop)
    {
        $this->loop = $loop;
    }

    public function getIsLoop()
    {
        return $this->loop;
    }
}
