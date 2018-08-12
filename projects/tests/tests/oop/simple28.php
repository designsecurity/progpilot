<?php
class SomeClass1
{
}

class SomeClass2 extends SomeClass1
{
    public function query($tata)
    {
    }
}

$a = new SomeClass2;
$a->query($_GET["p"]);
