<?php


class Testc1
{
    public $data;
}

$a = new Testc1;

$a->data = $_GET["p"];

$b = $a;

echo $a->data; // KO


echo $b->data; // KO

$b->data = "eee";

echo $a->data; // OK

echo $b->data; // OK
