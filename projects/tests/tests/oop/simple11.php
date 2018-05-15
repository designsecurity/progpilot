<?php

class testc1
{
    public $boum1;

    public function set_boum1($boum1)
    {
        $this->boum1 = $boum1;
    }
};

$instance1 = new testc1;
$instance1->boum1 = $_GET["p"];
$instance1->boum1 = "ee";
echo $instance1->boum1;

$instance1->boum1 = $_GET["p"];

echo $instance1->boum1;
