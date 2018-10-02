<?php

$res = create_function($_GET["p1"], $_GET["t1"]);
$res = create_function('', $_GET["t1"]);
$res = create_function($_GET["p1"], '');
/*
$res = create_function('$a = 10*10', "echo 'test';echo \$a;");

$res();
*/
