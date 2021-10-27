<?php


class Testc1
{
    public $data;
    
    public function change_data($data)
    {   // block 48
        $this->data = $data;
    }
}

$a = new Testc1;

if (rand() === 1) {
    $a->change_data($_GET["p"]);
} else {
    $a->change_data("eee");
}

echo $a->data; // id 62

$b = new Testc1;
if (rand() === 1) {
    $b->change_data("eee");
} else { // block 35
    $b->change_data($_GET["p"]);
}
// block 30
echo $b->data; // id 76
