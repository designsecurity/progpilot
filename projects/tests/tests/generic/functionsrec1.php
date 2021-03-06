<?php

$nb = 0;

function testf1($var)
{
    if($nb < 5) {
      $nb ++;
      $ret = testf1($var);
    }

    return $var;
}

$var = testf1($_GET["p"]);
echo $var;
