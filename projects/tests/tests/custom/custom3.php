<?php

class testc
{
    public function __construct($test)
    {
        echo $test;
    }
}

$a = new testc("not_vuln");
