<?php declare(strict_types = 1);
/**
 * @param mixed $x
 * @return mixed
 */
function g($x)
{
    return $x;
}
function h()
{
    return $_GET['a'];
}
$a = "Hello world.";
$a .= '..';
$b = g($a);
// ok
echo $b;
$s = g(h());
// tainted
echo $s;
function a()
{
    echo 'asd';
}
$a = $_GET['a'];
$b = 'asd';
$c = (int) $a;
// tainted
echo $a;
// ok
echo $b;
// ok
echo $c;
// tainted
$a();
// ok
a();
