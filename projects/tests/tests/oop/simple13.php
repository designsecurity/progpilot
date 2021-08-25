<?php

class testc1
{
    public $boum1;

    public function dosomething()
    {
        // block 33
    }
    
    public function sanitize()
    {
        // block 36
        $this->boum1 = htmlentities($this->boum1);
    }
    
};

// block 3
$instance1 = new testc1;
$instance1->boum1 = $_GET["p"];

if (rand() % 2) {
    // block 15
    $instance1->sanitize();
    echo $instance1->boum1;
    $instance1->dosomething();
    echo $instance1->boum1;
} else {
    // block 26
    echo $instance1->boum1;
}

// block 21
echo $instance1->boum1;
