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
    private $start_address_block;
    private $end_address_block;
    private $id;

    public $parents;
    public $assertions;

    public function __construct()
    {
        parent::__construct("", 0, 0);

        $this->start_address_block = -1;
        $this->end_address_block = -1;
        $this->assertions = [];
        $this->parents = [];
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
        $this->start_address_block = $address;
    }

    public function setEndAddressBlock($address)
    {
        $this->end_address_block = $address;
    }

    public function getStartAddressBlock()
    {
        return $this->start_address_block;
    }

    public function getEndAddressBlock()
    {
        return $this->end_address_block;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}
