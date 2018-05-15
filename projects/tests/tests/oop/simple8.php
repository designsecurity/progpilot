<?php

class testc1
{
    private $boum1;
    public $boum2;
    protected $boum3;
};

$instance1 = new testc1;
$instance1->boum1 = $_GET["p"];
$instance1->boum2 = $instance1->boum1;

echo $instance1->boum2;

$instance1->boum2 = $_GET["p"];

echo $instance1->boum2;
