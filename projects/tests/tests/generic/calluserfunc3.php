<?php

function test1($a)
{
    echo $a;
}

call_user_func_array("test1", array($_GET["p"]));
