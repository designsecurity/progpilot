<?php

class testc1
{
    public function methodc1()
    {
    }
};

class testc2
{
    public function boum1()
    {
    }
};

if (true) {
    $instance = new testc1;
} else {
    $instance = new testc2;
}

$var = $instance->methodc1();

echo $var;
