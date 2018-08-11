<?php
$a = true ? 'abc' : $_GET['a'];
//if (empty($_GET['a'])) {
//	$a = 'abc';
//} else {
//	$a = $_GET['a'];
//}
echo $a;
