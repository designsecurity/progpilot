<?php

$framework->add_testbasis("./tests/generic/alias1.php");
$framework->add_output("./tests/generic/alias1.php", array("\$var1"));
$framework->add_output("./tests/generic/alias1.php", array("9"));
$framework->add_output("./tests/generic/alias1.php", "xss");

$framework->add_testbasis("./tests/generic/alias2.php");
$framework->add_output("./tests/generic/alias2.php", array("\$var6"));
$framework->add_output("./tests/generic/alias2.php", array("4"));
$framework->add_output("./tests/generic/alias2.php", "xss");

$framework->add_testbasis("./tests/generic/alias3.php");
$framework->add_output("./tests/generic/alias3.php", array("\$var5", "\$var6"));
$framework->add_output("./tests/generic/alias3.php", array("3", "4"));
$framework->add_output("./tests/generic/alias3.php", "xss");

$framework->add_testbasis("./tests/generic/alias4.php");
$framework->add_output("./tests/generic/alias4.php", array("\$var5"));
$framework->add_output("./tests/generic/alias4.php", array("3"));
$framework->add_output("./tests/generic/alias4.php", "xss");

$framework->add_testbasis("./tests/generic/alias5.php");
$framework->add_output("./tests/generic/alias5.php", array("\$var5[\"t\"]"));
$framework->add_output("./tests/generic/alias5.php", array("3"));
$framework->add_output("./tests/generic/alias5.php", "xss");

$framework->add_testbasis("./tests/generic/mix1.php");
$framework->add_output("./tests/generic/mix1.php", array("\$var1[0]"));
$framework->add_output("./tests/generic/mix1.php", array("5"));
$framework->add_output("./tests/generic/mix1.php", "xss");

$framework->add_testbasis("./tests/generic/mix2.php");
$framework->add_output("./tests/generic/mix2.php", array("\$var1"));
$framework->add_output("./tests/generic/mix2.php", array("9"));
$framework->add_output("./tests/generic/mix2.php", "xss");

$framework->add_testbasis("./tests/generic/mix3.php");
$framework->add_output("./tests/generic/mix3.php", array("\$var2"));
$framework->add_output("./tests/generic/mix3.php", array("12"));
$framework->add_output("./tests/generic/mix3.php", "xss");

$framework->add_testbasis("./tests/generic/simple1.php");
$framework->add_output("./tests/generic/simple1.php", array("\$myvar4"));
$framework->add_output("./tests/generic/simple1.php", array("9"));
$framework->add_output("./tests/generic/simple1.php", "xss");

$framework->add_testbasis("./tests/generic/simple2.php");
$framework->add_output("./tests/generic/simple2.php", array("\$myvar2"));
$framework->add_output("./tests/generic/simple2.php", array("3"));
$framework->add_output("./tests/generic/simple2.php", "xss");

$framework->add_testbasis("./tests/generic/simple3.php");
$framework->add_output("./tests/generic/simple3.php", array("\$var7"));
$framework->add_output("./tests/generic/simple3.php", array("5"));
$framework->add_output("./tests/generic/simple3.php", "xss");

$framework->add_testbasis("./tests/generic/simple4.php");
$framework->add_output("./tests/generic/simple4.php", array("\$var4"));
$framework->add_output("./tests/generic/simple4.php", array("5"));
$framework->add_output("./tests/generic/simple4.php", "xss");

$framework->add_testbasis("./tests/generic/simple5.php");
$framework->add_output("./tests/generic/simple5.php", array("\$myvar1[11]"));
$framework->add_output("./tests/generic/simple5.php", array("3"));
$framework->add_output("./tests/generic/simple5.php", "xss");

$framework->add_testbasis("./tests/generic/simple6.php");
$framework->add_output("./tests/generic/simple6.php", array("\$var4"));
$framework->add_output("./tests/generic/simple6.php", array("5"));
$framework->add_output("./tests/generic/simple6.php", "xss");

$framework->add_testbasis("./tests/generic/simple7.php");
$framework->add_output("./tests/generic/simple7.php", array("\$myvar1"));
$framework->add_output("./tests/generic/simple7.php", array("3"));
$framework->add_output("./tests/generic/simple7.php", "xss");

$framework->add_testbasis("./tests/generic/simple8.php");
$framework->add_output("./tests/generic/simple8.php", array("\$ret[0]"));
$framework->add_output("./tests/generic/simple8.php", array("8"));
$framework->add_output("./tests/generic/simple8.php", "xss");
$framework->add_output("./tests/generic/simple8.php", array("\$var_gauche[0]"));
$framework->add_output("./tests/generic/simple8.php", array("3"));
$framework->add_output("./tests/generic/simple8.php", "xss");

$framework->add_testbasis("./tests/generic/concat1.php");
$framework->add_output("./tests/generic/concat1.php", array("\$myvar7"));
$framework->add_output("./tests/generic/concat1.php", array("7"));
$framework->add_output("./tests/generic/concat1.php", "xss");

$framework->add_testbasis("./tests/generic/concat2.php");
$framework->add_output("./tests/generic/concat2.php", array("\$query"));
$framework->add_output("./tests/generic/concat2.php", array("12"));
$framework->add_output("./tests/generic/concat2.php", "sql_injection");

$framework->add_testbasis("./tests/generic/concat3.php");
$framework->add_output("./tests/generic/concat3.php", array("\$aaa"));
$framework->add_output("./tests/generic/concat3.php", array("3"));
$framework->add_output("./tests/generic/concat3.php", "xss");
$framework->add_output("./tests/generic/concat3.php", array("\$bbb"));
$framework->add_output("./tests/generic/concat3.php", array("5"));
$framework->add_output("./tests/generic/concat3.php", "xss");

$framework->add_testbasis("./tests/generic/arrays1.php");
$framework->add_output("./tests/generic/arrays1.php", array("\$newmyarr[11][9865]"));
$framework->add_output("./tests/generic/arrays1.php", array("4"));
$framework->add_output("./tests/generic/arrays1.php", "xss");

$framework->add_testbasis("./tests/generic/arrays2.php");
$framework->add_output("./tests/generic/arrays2.php", array("\$newmyarr[11][9865]"));
$framework->add_output("./tests/generic/arrays2.php", array("3"));
$framework->add_output("./tests/generic/arrays2.php", "xss");

$framework->add_testbasis("./tests/generic/arrays3.php");
$framework->add_output("./tests/generic/arrays3.php", array("\$newmyarr[11]"));
$framework->add_output("./tests/generic/arrays3.php", array("4"));
$framework->add_output("./tests/generic/arrays3.php", "xss");

$framework->add_testbasis("./tests/generic/arrays4.php");
$framework->add_output("./tests/generic/arrays4.php", array("\$newmyarr[11]"));
$framework->add_output("./tests/generic/arrays4.php", array("4"));
$framework->add_output("./tests/generic/arrays4.php", "xss");

$framework->add_testbasis("./tests/generic/arrays5.php");
$framework->add_output("./tests/generic/arrays5.php", array("\$var1"));
$framework->add_output("./tests/generic/arrays5.php", array("3"));
$framework->add_output("./tests/generic/arrays5.php", "xss");

$framework->add_testbasis("./tests/generic/arrays6.php");
$framework->add_output("./tests/generic/arrays6.php", array("\$_GET[\"t\"]"));
$framework->add_output("./tests/generic/arrays6.php", array("6"));
$framework->add_output("./tests/generic/arrays6.php", "xss");

$framework->add_testbasis("./tests/generic/arrays7.php");
$framework->add_output("./tests/generic/arrays7.php", array("\$onearr[9865]"));
$framework->add_output("./tests/generic/arrays7.php", array("3"));
$framework->add_output("./tests/generic/arrays7.php", "xss");

$framework->add_testbasis("./tests/generic/arrays8.php");
$framework->add_output("./tests/generic/arrays8.php", array("\$arr[1113]"));
$framework->add_output("./tests/generic/arrays8.php", array("6"));
$framework->add_output("./tests/generic/arrays8.php", "xss");

$framework->add_testbasis("./tests/generic/arrays9.php");
$framework->add_output("./tests/generic/arrays9.php", array("\$onearr[11][6661]"));
$framework->add_output("./tests/generic/arrays9.php", array("4"));
$framework->add_output("./tests/generic/arrays9.php", "xss");

$framework->add_testbasis("./tests/generic/arrays10.php");
$framework->add_output("./tests/generic/arrays10.php", array("\$arr[0]"));
$framework->add_output("./tests/generic/arrays10.php", array("3"));
$framework->add_output("./tests/generic/arrays10.php", "xss");

$framework->add_testbasis("./tests/generic/arrays11.php");
$framework->add_output("./tests/generic/arrays11.php", array("\$arr[0][2]"));
$framework->add_output("./tests/generic/arrays11.php", array("3"));
$framework->add_output("./tests/generic/arrays11.php", "xss");

$framework->add_testbasis("./tests/generic/arrays12.php");
$framework->add_output("./tests/generic/arrays12.php", array("\$var1[1]"));
$framework->add_output("./tests/generic/arrays12.php", array("9"));
$framework->add_output("./tests/generic/arrays12.php", "xss");

$framework->add_testbasis("./tests/generic/arrays13.php");
$framework->add_output("./tests/generic/arrays13.php", array("\$_GET[\"t\"]"));
$framework->add_output("./tests/generic/arrays13.php", array("5"));
$framework->add_output("./tests/generic/arrays13.php", "xss");

$framework->add_testbasis("./tests/generic/arrays14.php");
$framework->add_output("./tests/generic/arrays14.php", array("\$var1[11][1]"));
$framework->add_output("./tests/generic/arrays14.php", array("9"));
$framework->add_output("./tests/generic/arrays14.php", "xss");

$framework->add_testbasis("./tests/generic/arrays15.php");
$framework->add_output("./tests/generic/arrays15.php", array("\$var"));
$framework->add_output("./tests/generic/arrays15.php", array("8"));
$framework->add_output("./tests/generic/arrays15.php", "xss");

$framework->add_testbasis("./tests/generic/arrays16.php");
$framework->add_output("./tests/generic/arrays16.php", array("\$var[\"t\"]"));
$framework->add_output("./tests/generic/arrays16.php", array("3"));
$framework->add_output("./tests/generic/arrays16.php", "xss");

$framework->add_testbasis("./tests/generic/arraysrec1.php");
$framework->add_output("./tests/generic/arraysrec1.php", array("\$var1[1]"));
$framework->add_output("./tests/generic/arraysrec1.php", array("8"));
$framework->add_output("./tests/generic/arraysrec1.php", "xss");

$framework->add_testbasis("./tests/generic/arraysexpr1.php");
$framework->add_output("./tests/generic/arraysexpr1.php", array("\$newmyarr[2]"));
$framework->add_output("./tests/generic/arraysexpr1.php", array("3"));
$framework->add_output("./tests/generic/arraysexpr1.php", "xss");

$framework->add_testbasis("./tests/generic/arraysexpr2.php");
$framework->add_output("./tests/generic/arraysexpr2.php", array("\$newmyarr[2][1][2]"));
$framework->add_output("./tests/generic/arraysexpr2.php", array("3"));
$framework->add_output("./tests/generic/arraysexpr2.php", "xss");

$framework->add_testbasis("./tests/generic/arraysexpr3.php");
$framework->add_output("./tests/generic/arraysexpr3.php", array("\$onearr[11][6661]"));
$framework->add_output("./tests/generic/arraysexpr3.php", array("3"));
$framework->add_output("./tests/generic/arraysexpr3.php", "xss");

$framework->add_testbasis("./tests/generic/arraysexpr4.php");
$framework->add_output("./tests/generic/arraysexpr4.php", array("\$var_main[\"TEST1\"]"));
$framework->add_output("./tests/generic/arraysexpr4.php", array("4"));
$framework->add_output("./tests/generic/arraysexpr4.php", "xss");

$framework->add_testbasis("./tests/generic/functions1.php");
$framework->add_output("./tests/generic/functions1.php", array("\$parama"));
$framework->add_output("./tests/generic/functions1.php", array("3"));
$framework->add_output("./tests/generic/functions1.php", "xss");

$framework->add_testbasis("./tests/generic/functions2.php");
$framework->add_output("./tests/generic/functions2.php", array("\$safea"));
$framework->add_output("./tests/generic/functions2.php", array("8"));
$framework->add_output("./tests/generic/functions2.php", "xss");

$framework->add_testbasis("./tests/generic/functions3.php");
$framework->add_output("./tests/generic/functions3.php", array("\$testf_return[0]"));
$framework->add_output("./tests/generic/functions3.php", array("7"));
$framework->add_output("./tests/generic/functions3.php", "xss");

$framework->add_testbasis("./tests/generic/functions4.php");
$framework->add_output("./tests/generic/functions4.php", array("\$testf_return"));
$framework->add_output("./tests/generic/functions4.php", array("5"));
$framework->add_output("./tests/generic/functions4.php", "xss");

$framework->add_testbasis("./tests/generic/functions5.php");
$framework->add_output("./tests/generic/functions5.php", array("\$testf_return[0]"));
$framework->add_output("./tests/generic/functions5.php", array("5"));
$framework->add_output("./tests/generic/functions5.php", "xss");

$framework->add_testbasis("./tests/generic/functions6.php");
$framework->add_output("./tests/generic/functions6.php", array("\$_GET[\"p\"]"));
$framework->add_output("./tests/generic/functions6.php", array("15"));
$framework->add_output("./tests/generic/functions6.php", "xss");

$framework->add_testbasis("./tests/generic/functions7.php");
$framework->add_output("./tests/generic/functions7.php", array("\$var1"));
$framework->add_output("./tests/generic/functions7.php", array("5"));
$framework->add_output("./tests/generic/functions7.php", "xss");

$framework->add_testbasis("./tests/generic/functions8.php");
$framework->add_output("./tests/generic/functions8.php", array("\$var1"));
$framework->add_output("./tests/generic/functions8.php", array("7"));
$framework->add_output("./tests/generic/functions8.php", "xss");

$framework->add_testbasis("./tests/generic/functions9.php");
$framework->add_output("./tests/generic/functions9.php", array("\$arr[8989][1]"));
$framework->add_output("./tests/generic/functions9.php", array("5"));
$framework->add_output("./tests/generic/functions9.php", "xss");

$framework->add_testbasis("./tests/generic/functions10.php");
$framework->add_output("./tests/generic/functions10.php", array("\$arr[8989][1][989]"));
$framework->add_output("./tests/generic/functions10.php", array("5"));
$framework->add_output("./tests/generic/functions10.php", "xss");

$framework->add_testbasis("./tests/generic/functions11.php");
$framework->add_output("./tests/generic/functions11.php", array("\$ret[0]"));
$framework->add_output("./tests/generic/functions11.php", array("8"));
$framework->add_output("./tests/generic/functions11.php", "xss");

$framework->add_testbasis("./tests/generic/functions12.php");
$framework->add_output("./tests/generic/functions12.php", array("\$arr[8989][1][989]"));
$framework->add_output("./tests/generic/functions12.php", array("5"));
$framework->add_output("./tests/generic/functions12.php", "xss");

$framework->add_testbasis("./tests/generic/functions13.php");
$framework->add_output("./tests/generic/functions13.php", array("\$testf1_return[0]"));
$framework->add_output("./tests/generic/functions13.php", array("5"));
$framework->add_output("./tests/generic/functions13.php", "xss");

$framework->add_testbasis("./tests/generic/functions14.php");
$framework->add_output("./tests/generic/functions14.php", array("\$param"));
$framework->add_output("./tests/generic/functions14.php", array("3"));
$framework->add_output("./tests/generic/functions14.php", "xss");

$framework->add_testbasis("./tests/generic/functions15.php");
$framework->add_output("./tests/generic/functions15.php", array("\$var[1][12]"));
$framework->add_output("./tests/generic/functions15.php", array("9"));
$framework->add_output("./tests/generic/functions15.php", "xss");

$framework->add_testbasis("./tests/generic/functions16.php");
$framework->add_output("./tests/generic/functions16.php", array("\$var[1][12]"));
$framework->add_output("./tests/generic/functions16.php", array("9"));
$framework->add_output("./tests/generic/functions16.php", "xss");

$framework->add_testbasis("./tests/generic/functions17.php");
$framework->add_output("./tests/generic/functions17.php", array("\$param2"));
$framework->add_output("./tests/generic/functions17.php", array("3"));
$framework->add_output("./tests/generic/functions17.php", "xss");

$framework->add_testbasis("./tests/generic/functions18.php");
$framework->add_output("./tests/generic/functions18.php", array("\$param2"));
$framework->add_output("./tests/generic/functions18.php", array("5"));
$framework->add_output("./tests/generic/functions18.php", "xss");

$framework->add_testbasis("./tests/generic/functionsrec1.php");
$framework->add_output("./tests/generic/functionsrec1.php", array("\$var"));
$framework->add_output("./tests/generic/functionsrec1.php", array("10"));
$framework->add_output("./tests/generic/functionsrec1.php", "xss");

$framework->add_testbasis("./tests/generic/strings1.php");
$framework->add_output("./tests/generic/strings1.php", array("\$vuln2"));
$framework->add_output("./tests/generic/strings1.php", array("7"));
$framework->add_output("./tests/generic/strings1.php", "command_injection");
$framework->add_output("./tests/generic/strings1.php", array("\$vuln3"));
$framework->add_output("./tests/generic/strings1.php", array("11"));
$framework->add_output("./tests/generic/strings1.php", "command_injection");
$framework->add_output("./tests/generic/strings1.php", array("\$vuln4"));
$framework->add_output("./tests/generic/strings1.php", array("15"));
$framework->add_output("./tests/generic/strings1.php", "command_injection");
$framework->add_output("./tests/generic/strings1.php", array("\$id1"));
$framework->add_output("./tests/generic/strings1.php", array("19"));
$framework->add_output("./tests/generic/strings1.php", "sql_injection");
$framework->add_output("./tests/generic/strings1.php", array("\$id2"));
$framework->add_output("./tests/generic/strings1.php", array("22"));
$framework->add_output("./tests/generic/strings1.php", "sql_injection");
$framework->add_output("./tests/generic/strings1.php", array("\$id3"));
$framework->add_output("./tests/generic/strings1.php", array("25"));
$framework->add_output("./tests/generic/strings1.php", "sql_injection");
$framework->add_output("./tests/generic/strings1.php", array("\$id5"));
$framework->add_output("./tests/generic/strings1.php", array("31"));
$framework->add_output("./tests/generic/strings1.php", "sql_injection");
$framework->add_output("./tests/generic/strings1.php", array("\$id7"));
$framework->add_output("./tests/generic/strings1.php", array("35"));
$framework->add_output("./tests/generic/strings1.php", "sql_injection");
$framework->add_output("./tests/generic/strings1.php", array("\$tainted1"));
$framework->add_output("./tests/generic/strings1.php", array("48"));
$framework->add_output("./tests/generic/strings1.php", "xss");
$framework->add_output("./tests/generic/strings1.php", array("\$tainted2"));
$framework->add_output("./tests/generic/strings1.php", array("51"));
$framework->add_output("./tests/generic/strings1.php", "xss");
$framework->add_output("./tests/generic/strings1.php", array("\$tainted3"));
$framework->add_output("./tests/generic/strings1.php", array("54"));
$framework->add_output("./tests/generic/strings1.php", "xss");
$framework->add_output("./tests/generic/strings1.php", array("\$tainted21"));
$framework->add_output("./tests/generic/strings1.php", array("64"));
$framework->add_output("./tests/generic/strings1.php", "xss");
$framework->add_output("./tests/generic/strings1.php", array("\$tainted31"));
$framework->add_output("./tests/generic/strings1.php", array("70"));
$framework->add_output("./tests/generic/strings1.php", "xss");
$framework->add_output("./tests/generic/strings1.php", array("\$tainted32"));
$framework->add_output("./tests/generic/strings1.php", array("73"));
$framework->add_output("./tests/generic/strings1.php", "xss");

$framework->add_testbasis("./tests/generic/foreach1.php");
$framework->add_output("./tests/generic/foreach1.php", array("\$array_value"));
$framework->add_output("./tests/generic/foreach1.php", array("6"));
$framework->add_output("./tests/generic/foreach1.php", "xss");

$framework->add_testbasis("./tests/generic/global1.php");
$framework->add_output("./tests/generic/global1.php", array("\$myvar1"));
$framework->add_output("./tests/generic/global1.php", array("4"));
$framework->add_output("./tests/generic/global1.php", "xss");

$framework->add_testbasis("./tests/generic/global2.php");
$framework->add_output("./tests/generic/global2.php", array("\$myvar1"));
$framework->add_output("./tests/generic/global2.php", array("4"));
$framework->add_output("./tests/generic/global2.php", "xss");

$framework->add_testbasis("./tests/generic/global3.php");
$framework->add_output("./tests/generic/global3.php", array("\$myvar1"));
$framework->add_output("./tests/generic/global3.php", array("3"));
$framework->add_output("./tests/generic/global3.php", "xss");

?>
