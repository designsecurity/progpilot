<?php


$myvar1 = $_GET["p"];

function test_global()
{
    global $myvar1;
    echo $myvar1;
}

test_global();
