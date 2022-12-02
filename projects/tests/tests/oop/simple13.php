<?php

class testc1
{
    public $boum1;

    public function dosomething()
    {
        // block 52
    }
    
    public function sanitize()
    {
        // block 56
        $this->boum1 = htmlentities($this->boum1);
    }
    
};

// block 3
$instance1 = new testc1;
$instance1->boum1 = $_GET["p"];

if (rand() % 2) { // block 7
    // block 20
    $instance1->sanitize();
    echo $instance1->boum1;
    $instance1->dosomething();
    echo $instance1->boum1;
} else {
    // block 42
    echo $instance1->boum1;
}

// block 35
echo $instance1->boum1;
