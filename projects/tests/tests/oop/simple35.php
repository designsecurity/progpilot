<?php

class testc1
{
    private $boum1; // tainted on block 40

    public function set_boum1($boum1)
    {
        $this->boum1 = $boum1; // block 40 (tainted state = 26)
    }
    
    public function get_boum1()
    {
        return $this->boum1; // block 47
    }
};

// block 3
$instance = new testc1;

if (true) {
    // block 10
    echo "toto\n";
    echo $instance->get_boum1(); 
} else {
    // block 26
    $instance->set_boum1($_GET["p"]); 
    echo $instance->get_boum1(); 
}

// block 20
echo $instance->get_boum1(); 
