<?php

class testc1
{
    public function methodc1()
    {
        echo "ee";
    }
}

$var1 = new testc1;

$var2 = $var1->methodc1();

print("$var2");
