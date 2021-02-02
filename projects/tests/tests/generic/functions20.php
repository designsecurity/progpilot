<?php

$p = $_GET["p"];

function thisfunctionexist($param)
{
  return "something";
}

$p = thisfunctionexist('something');

echo $p;


$t = $_GET["t"];
$t = thisfunctiondoesntexist('something');

echo $t;


function thisfunctionexistandreturn($p)
{
  return $p;
}

echo thisfunctionexistandreturn($_GET["p"]);
