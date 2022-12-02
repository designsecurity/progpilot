<?php

function function1($param)
{
  return $param;
}

function function2()
{
  $ret1 = function1($_GET["p"]);
  
  echo $ret1;
  
  $ret2 = function1($_GET["t"]);
  
  echo $ret2;
}

function2();
