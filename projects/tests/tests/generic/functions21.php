<?php

function function1()
{
  $p = $_GET["p"];
  
  return $p;
}

function function2()
{
  $notused = function1();
  
  echo "blabla";
  
  $ret = function1();
  
  echo $ret;
}

function2();
