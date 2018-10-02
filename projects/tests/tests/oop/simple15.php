<?php

class testc1
{
    public $boum1;

    public function echo_boum1()
    {
        echo $this->boum1;
    }
};

$instance1 = new testc1;

if (rand() % 2) {
    $instance1->boum1 = $_GET["p"];
} else {
    $instance1->boum1 = "eee";
}

$instance1->echo_boum1();
