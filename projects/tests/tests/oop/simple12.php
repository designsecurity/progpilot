<?php

class testc1
{
    public $boum1;
};

$instance1 = new testc1;
$instance1->boum1 = $_GET["p"]; // block 3

if (rand() % 2) {
    $instance1->boum1 = "eee"; // block 16
    echo $instance1->boum1;
} else {
    echo $instance1->boum1; // block 18
}
