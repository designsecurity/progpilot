<?php

$tainted_source_inside_package = $_GET["p"];

function blabla()
{
    echo $_GET["p"];
}

class test_tainted
{
    public function return_tainted_source()
    {
        echo $_GET["p"];
    }
}
