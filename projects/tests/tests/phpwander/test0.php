<?php declare(strict_types = 1);
function id($s)
{
    return $s;
}
// tainted
$a = file_get_contents(__DIR__ . '/' . id($_GET['f']));
// tainted, infinite recursion or any file in given directory
$b = file_get_contents(__DIR__ . '/' . basename($_GET['f']));
// tainted
$c = file_get_contents(__DIR__ . '/' . $_GET['f']);
// tainted
print_r($b);
// tainted
echo $c;
