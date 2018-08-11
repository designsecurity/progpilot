<?php declare(strict_types = 1);
$a = $_GET['a'];
$b = basename($a);
include __DIR__ . '/' . $b;
// ok
echo $b;
