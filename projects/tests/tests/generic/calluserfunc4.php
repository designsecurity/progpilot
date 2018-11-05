<?php

function test1($a)
{
    echo $a;
}

$tab = array($_GET["p"]);

call_user_func_array("test1", $tab);
