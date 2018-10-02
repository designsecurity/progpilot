<?php

class testc1
{
    public $member1;
}

$inst = new testc1;
$inst->member1 = $_GET["p"];
echo $inst->member1;

echo $inst;

echo $inst->member2;
