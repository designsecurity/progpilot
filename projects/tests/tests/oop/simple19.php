<?php

class testc1
{
    public $object1;

    public function set_object1($val)
    {
        $this->object1 = $val;
    }
};

class testc2
{
    public $object2;

    public function set_object2($val)
    {
        $this->object2 = $val;
    }
};


$testc1 = new testc1;

$testc1->object1 = new testc2;

$testc1->object1->object2 = $_GET["p"];

$toto = $testc1->object1->object2;

echo $toto; // NOT OK



$newtestc1 = new testc1;

$newtestc1->object1 = $_GET["p"];

echo $newtestc1->object1; // NOT OK


$newsettestc1 = new testc1;

$newsettestc1->set_object1($_GET["p"]);

echo $newsettestc1->object1; // NOT OK



$testc1_encore = new testc1;

$testc1_encore->object1->object2 = $_GET["p"];

$testc1_encore->object1 = new testc2;

echo $testc1_encore->object1->object2; // OK



$testc1_encore2 = new testc1;

$testc1_encore2->member1 = $_GET["p"];

$val = $testc1_encore2->member1;

echo $testc1_encore2->member1; // NOT OK

echo $val; // NOT OK





