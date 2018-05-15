<?php

$myvar3 = "olala"."ldfkldkfl"."lkdlkd";
$myvar4 = htmlentities($_GET["p"], ENT_QUOTES, 'UTF-8');
$myvar5 = htmlentities($myvar1, ENT_QUOTES, 'UTF-8');
$myvar6 = htmlentities($myvar1, ENT_QUOTES, 'UTF-8')."TEST";
$myvar7 = htmlentities($myvar1, ENT_QUOTES, 'UTF-8').$_GET["p"];


echo $myvar3;
echo $myvar4;
echo $myvar5;
echo $myvar6;
echo $myvar7;
