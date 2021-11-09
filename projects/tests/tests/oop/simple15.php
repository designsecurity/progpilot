<?php

class testc1
{
    public $boum1;

    public function echo_boum1()
    {
        // block 34
        echo $this->boum1;
    }
};

// block 7
$instance1 = new testc1;

if (rand() % 2) {
    // block 13
    $instance1->boum1 = $_GET["p"];
} else {
    // block 23
    $instance1->boum1 = "eee";
}

// block 21
$instance1->echo_boum1();
