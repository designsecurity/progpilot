<?php

function test1($a)
{
    echo $a;
}

$var = "test1";

call_user_func($var, $_GET["p"]);
