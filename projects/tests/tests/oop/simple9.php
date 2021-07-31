<?php

class testc1
{
    private $boum1;

    public function boum1($boum1)
    {
        echo $boum1;
    }
};

class testc2
{
    private $boum1;

    public function boum1($boum1)
    {
        echo htmlentities($boum1);
    }
};

if (true) {
    $instance = new testc1;
} else {
    $instance = new testc2;
}

$instance->boum1($_GET["p"]);
