<?php

class testa
{
    public static $stavar;
};

$a = new testa;

// PHP Notice:  Accessing static property testa::$stavar as non static in... but it's work
$a->stavar = $_GET["p"];

// PHP Notice:  Accessing static property testa::$stavar as non static in... but it's work
echo $a->stavar;

