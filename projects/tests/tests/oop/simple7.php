<?php

class testc1
{
    public $boum1;

    public function set_boum1($boum1)
    {
        $this->boum1 = $boum1;
    }
};

$instance = new testc1;

$instance->boum1 = $_GET["p"];

echo $instance->boum1;

$instance = "dkdkdk";

$instance->boum1 = $_GET["p"];

echo $instance->boum1;
