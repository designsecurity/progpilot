<?php

class testa
{
    public static $stavar;
};

//$a = new testa;

//$a::$stavar = $_GET["p"];

testa::$stavar = $_GET["p"];

//echo $a::$stavar;

echo testa::$stavar;

