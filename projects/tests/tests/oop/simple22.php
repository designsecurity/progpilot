<?php


class Testc1
{
    public $data;
}

$a = new Testc1;

$a->data = $_GET["p"];

$b = $a;

echo $a->data;


echo $b->data;

$b->data = "eee";

echo $a->data;

echo $b->data;
