<?php

class testc1
{
    private $boum1; 

    public function set_boum1($boum1)
    {
        $this->boum1 = $boum1; // block 23
    }
    
    public function get_boum1()
    {
        return $this->boum1; // block 30
    }
};

class testc2
{
    public $boum1;
};

if (true) {
    $instance = new testc1; // block 3
} else {
    $instance = new testc2;
}

if (true) {
    $instance->boum1 = $_GET["p"];
} else {
    $instance->set_boum1($_GET["p"]); // block 3
}

echo $instance->get_boum1(); // block 3
