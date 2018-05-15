<?php

class testc1
{
    public $boum1;

    public function set_boum1($boum1)
    {
        $this->boum1[0] = $boum1;
    }
};

class testc2
{
    private $boum1;

    public function set_boum1($boum1)
    {
        $this->boum1 = "eee";
    }
};

if (rand() % 2) {
    $instance1 = new testc1;
} else {
    $instance1 = new testc2;
}

$instance1->set_boum1($_GET["p"]);

$copy = $instance1->boum1;

echo $copy[0];
echo $copy[1];
