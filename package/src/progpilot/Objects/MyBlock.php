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
    private $needUpdateOfState;
    private $hasBeenAnalyzed;
    private $loopParents;

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
        $this->loopParents = [];
        $this->virtualParents = [];
        $this->children = [];
        $this->needUpdateOfState = true;
        $this->hasBeenAnalyzed = false;
    }

    public function hasBeenAnalyzed()
    {
        return $this->hasBeenAnalyzed;
    }

    public function setHasBeenAnalyzed($hasBeenAnalyzed)
    {
        $this->hasBeenAnalyzed = $hasBeenAnalyzed;
    }

    public function setNeedUpdateOfState($update)
    {
        $this->needUpdateOfState = $update;
    }

    public function doNeedUpdateOfState()
    {
        return $this->needUpdateOfState;
    }

    public function addLoopParent($parent)
    {
        if (!in_array($parent, $this->loopParents, true)) {
            $this->loopParents[] = $parent;
        }
    }

    public function isLoopParent($parent)
    {
        return in_array($parent, $this->loopParents, true);
    }

    public function addVirtualParent($parent)
    {
        if (!in_array($parent, $this->virtualParents, true)) {
            $this->virtualParents[] = $parent;
        }
    }

    public function setVirtualParents($parents)
    {
        $this->virtualParents = $parents;
    }

    public function getVirtualParents()
    {
        return $this->virtualParents;
    }

    public function addParent($parent)
    {
        if (!in_array($parent, $this->parents, true)) {
            $this->parents[] = $parent;
        }
    }

    public function getParents()
    {
        return $this->parents;
    }

    public function addChild($child)
    {
        if (!in_array($child, $this->children, true)) {
            $this->children[] = $child;
        }
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function addReturnDef($def)
    {
        if (!in_array($def, $this->returnDefs, true)) {
            $this->returnDefs[] = $def;
        }
    }

    public function getReturnDefs()
    {
        return $this->returnDefs;
    }

    public function addAssertion($myassertion)
    {
        if (!in_array($myassertion, $this->assertions, true)) {
            $this->assertions[] = $myassertion;
        }
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
}
