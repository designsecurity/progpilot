<?php

class testc1
{
    private $boum1;

    public function set_boum1($boum1)
    {
        $this->boum1 = $boum1;
    }
};

class testc2
{
    public $boum1;
};

if (true) {
    $instance = new testc1;
} else {
    $instance = new testc2;
}

$instance->boum1 = $_GET["p"];

echo $instance->boum1;
