<?php

#$tainted_source_inside_package = $_GET["p"];
$tainted_source_inside_package = "salut";

function blabla()
{
  return "blabla";
}

class test_tainted
{
  
public static function return_tainted_source()
{
  return "salut";
}

}

?>
