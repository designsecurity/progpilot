<?php

class testa
{
    private static $stavar;
    
    public function func() 
    {
        self::$stavar = $_GET["p"];

        echo self::$stavar;
    }
};

testa::$stavar = $_GET["p"];

echo testa::$stavar;

$a = new testa;

$a->func();

