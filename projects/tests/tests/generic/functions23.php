<?php

function function1($param)
{
  return $param;
}

function function2()
{
  return $_GET["p"];
}

// we analyze a first time function1

$a = function1("foo");

echo $a;

$b = function1(function2());

echo $b;