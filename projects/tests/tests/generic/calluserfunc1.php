<?php

function test1($a)
{
    echo $a;
}

call_user_func("test1", $_GET["p"]);
