<?php

class testc1
{
    public $boum1;

    public function sanitize()
    {
        $this->boum1 = htmlentities($this->boum1);
    }
};

$instance1 = new testc1;
$instance1->boum1 = $_GET["p"];

if (rand() % 2) {
    $instance1->sanitize();
    echo $instance1->boum1;
} else {
    echo $instance1->boum1;
}
