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
    private $startAddressBlock;
    private $endAddressBlock;
    private $id;
    private $loop;

    public $parents;
    public $assertions;

    public function __construct()
    {
        parent::__construct("", 0, 0);

        $this->startAddressBlock = -1;
        $this->endAddressBlock = -1;
        $this->assertions = [];
        $this->parents = [];
        $this->loop = false;
    }

    public function addParent($parent)
    {
        $this->parents[] = $parent;
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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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
