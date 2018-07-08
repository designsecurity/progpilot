<?php

namespace testns;

class testc
{
    public function __construct()
    {
        echo $_GET["p"];
    }
}

$a = new \testns\testc;
