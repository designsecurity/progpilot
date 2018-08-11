<?php
class SomeClass1
{
    private $baba;
    
    public function bobo1()
    {
        echo $_GET["p"];
    }
}

class SomeClass2 extends SomeClass1
{
    private $toto;
    public function babar()
    {
        echo $_GET["t"];
    }
}

$a = new SomeClass2;
$a->babar();
$a->bobo1();
