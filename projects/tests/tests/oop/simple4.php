<?php

class testc1
{
    private $boum1;
    public $boum2;

    public function testf1()
    {
        echo $_GET["p"];
    }
};

$instance1 = new testc1();
$instance1->testf1();
