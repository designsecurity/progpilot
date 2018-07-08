<?php

class testc1
{
    private $member1;

    public $member2;

    public function print_members()
    {
        echo $this->member1;
        echo $this->member2;
    }
};


$testc1 = new testc1;

$testc1->member1 = $_GET["p"];

$testc1->member2 = $_GET["p"];

$testc1->print_members();
