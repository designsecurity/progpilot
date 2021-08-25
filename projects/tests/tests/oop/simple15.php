<?php

class testc1
{
    public $boum1;

    public function echo_boum1()
    {
        // block 25
        echo $this->boum1;
    }
};

// block 6
$instance1 = new testc1;

if (rand() % 2) {
    // block 11
    $instance1->boum1 = $_GET["p"];
} else {
    // block 18
    $instance1->boum1 = "eee";
}

// block 16
$instance1->echo_boum1();
