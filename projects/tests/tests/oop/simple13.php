<?php

class testc1
{
    public $boum1;

    public function sanitize()
    {
        // block 28
        $this->boum1 = htmlentities($this->boum1);
    }
    
};

// block 3
$instance1 = new testc1;
$instance1->boum1 = $_GET["p"];

if (rand() % 2) {
    // block 16
    $instance1->sanitize();
    echo $instance1->boum1;
} else {
    echo $instance1->boum1;
}
