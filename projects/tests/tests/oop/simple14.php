<?php

class testc1
{
    public $boum1;
    public $boum2;
};

$instance1 = new testc1;
$instance1->boum1 = $_GET["p"];
$instance1->boum2 = $_GET["p"];

if (rand() % 2) {
    $instance1->boum1 = "eee";
    echo $instance1->boum1;
    echo $instance1->boum2;
}
