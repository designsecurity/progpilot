<?php

require_once './vendor/autoload.php';

$f2 = new testnsfirstlevel1\nssecondlevel2\Foo2();
$f2->callfoo1("toto");
$f2->callfoo1($_GET["t"]);
