<?php

class testc1
{
    public $object;
}

class testc2
{
    public $member1;
}


$inst = new testc1;

$inst->object = new testc2;

$inst->object->member1 = $_GET["p"];

echo $inst->object->member1;

echo $inst;

echo $inst->object->member2;




class newtestc1
{
    public $object;
}

class newtestc2
{
    public $member1;
}


$inst1 = new newtestc1;

$inst1->object = new newtestc2;

$inst1->object->member1 = $_GET["p"];

echo $inst1->object->member1;

echo $inst1;

echo $inst1->object->member2;



class newtestc12
{
    public $object;
}


$inst12 = new newtestc12;

$inst12->object->member1 = $_GET["p"];

echo $inst12->object->member1;







$inst123->object->member1 = $_GET["p"];

echo $inst123->object->member1;
