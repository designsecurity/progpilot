<?php
class SomeClass1
{
    private $baba;
    
    public function bobo1($taint1)
    {
        echo $taint1;
    }
}

class SomeClass2 extends SomeClass1
{
    private $toto;
    public function babar($taint2)
    {
        echo $taint2;
    }
}

$a = new SomeClass2;
$a->babar($_GET["p"]);
$a->bobo1($_GET["t"]);
