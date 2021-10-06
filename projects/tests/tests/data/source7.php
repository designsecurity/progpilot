<?php

class testc1
{
    public function methodc1arr()
    {
    }
}

$var1 = new testc1;

$var2 = $var1->methodc1arr();

echo $var2;

echo $var2["tainted"];

echo $var2["not_tainted"];
