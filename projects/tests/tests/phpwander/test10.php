<?php 

include("test10B.php");

$a = new B($_GET);
// tainted
echo $a->getSource('x');
// ok
echo (int) $a->getSource('y');
