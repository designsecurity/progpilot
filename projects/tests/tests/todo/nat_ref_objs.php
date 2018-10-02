<?php

class testc1
{
    public $boum1;
};

$instance1 = new testc1;

$instance2 = $instance1;

$instance1->boum1 = $_GET["p"];

echo $instance2->boum1;
