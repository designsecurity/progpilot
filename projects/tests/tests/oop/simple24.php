<?php


class Testc1
{
    public $data;
    
    public function change_data($data)
    {
        $this->data = $data;
    }
}

$a = new Testc1;

if (rand() === 1) {
    $a->change_data($_GET["p"]);
} else {
    $a->change_data("eee");
}

echo $a->data;

$b = new Testc1;
if (rand() === 1) {
    $b->change_data("eee");
} else {
    $b->change_data($_GET["p"]);
}

echo $b->data;
