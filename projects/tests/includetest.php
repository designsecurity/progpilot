<?php

$framework->add_testbasis("./tests/includes/simple1.php");
$framework->add_output("./tests/includes/simple1.php", array("\$var1"));
$framework->add_output("./tests/includes/simple1.php", array("3"));
$framework->add_output("./tests/includes/simple1.php", "xss");

$framework->add_testbasis("./tests/includes/simple2.php");
$framework->add_output("./tests/includes/simple2.php", array("\$var1"));
$framework->add_output("./tests/includes/simple2.php", array("3"));
$framework->add_output("./tests/includes/simple2.php", "xss");

$framework->add_testbasis("./tests/includes/simple3.php");
$framework->add_output("./tests/includes/simple3.php", array("\$var1"));
$framework->add_output("./tests/includes/simple3.php", array("3"));
$framework->add_output("./tests/includes/simple3.php", "xss");

$framework->add_testbasis("./tests/includes/simple4.php");
$framework->add_output("./tests/includes/simple4.php", array("\$var1"));
$framework->add_output("./tests/includes/simple4.php", array("3"));
$framework->add_output("./tests/includes/simple4.php", "xss");

$framework->add_testbasis("./tests/includes/simple5.php");
$framework->add_output("./tests/includes/simple5.php", array("\$var1"));
$framework->add_output("./tests/includes/simple5.php", array("3"));
$framework->add_output("./tests/includes/simple5.php", "xss");

$framework->add_testbasis("./tests/includes/simple6.php");
$framework->add_output("./tests/includes/simple6.php", array("\$var1"));
$framework->add_output("./tests/includes/simple6.php", array("10"));
$framework->add_output("./tests/includes/simple6.php", "xss");

$framework->add_testbasis("./tests/includes/simple7.php");
$framework->add_output("./tests/includes/simple7.php", array("\$var1"));
$framework->add_output("./tests/includes/simple7.php", array("9"));
$framework->add_output("./tests/includes/simple7.php", "xss");

$framework->add_testbasis("./tests/includes/simple8.php");
$framework->add_output("./tests/includes/simple8.php", array("\$_GET[\"p\"]"));
$framework->add_output("./tests/includes/simple8.php", array("3"));
$framework->add_output("./tests/includes/simple8.php", "xss");

$framework->add_testbasis("./tests/includes/simple9.php");
$framework->add_output("./tests/includes/simple9.php", array("\$pLocation"));
$framework->add_output("./tests/includes/simple9.php", array("492"));
$framework->add_output("./tests/includes/simple9.php", "header_injection");
$framework->add_output("./tests/includes/simple9.php", array("\$page[\"body\"]"));
$framework->add_output("./tests/includes/simple9.php", array("52"));
$framework->add_output("./tests/includes/simple9.php", "xss");
$framework->add_output("./tests/includes/simple9.php", "security misconfiguration");
$framework->add_output("./tests/includes/simple9.php", "148");
$framework->add_output("./tests/includes/simple9.php", "3388");
$framework->add_output("./tests/includes/simple9.php", "security misconfiguration");
$framework->add_output("./tests/includes/simple9.php", "149");
$framework->add_output("./tests/includes/simple9.php", "3467");

$framework->add_testbasis("./tests/includes/simple10.php");
$framework->add_output("./tests/includes/simple10.php", array("\$var1"));
$framework->add_output("./tests/includes/simple10.php", array("3"));
$framework->add_output("./tests/includes/simple10.php", "xss");

$framework->add_testbasis("./tests/includes/simple11.php");
$framework->add_output("./tests/includes/simple11.php", array("\$var1"));
$framework->add_output("./tests/includes/simple11.php", array("4"));
$framework->add_output("./tests/includes/simple11.php", "xss");

$framework->add_testbasis("./tests/includes/simple12.php");
$framework->add_output("./tests/includes/simple12.php", array("\${main}_return[\"cb36d7468e442c354c5037bbb4d59b1c\"]"));
$framework->add_output("./tests/includes/simple12.php", array("7"));
$framework->add_output("./tests/includes/simple12.php", "xss");

$framework->add_testbasis("./tests/includes/simple13.php");
$framework->add_output("./tests/includes/simple13.php", array("\$var1"));
$framework->add_output("./tests/includes/simple13.php", array("4"));
$framework->add_output("./tests/includes/simple13.php", "xss");

$framework->add_testbasis("./tests/includes/simple14.php");
$framework->add_output("./tests/includes/simple14.php", array("\$var1"));
$framework->add_output("./tests/includes/simple14.php", array("4"));
$framework->add_output("./tests/includes/simple14.php", "xss");

$framework->add_testbasis("./tests/includes/simple15_circular.php");
$framework->add_output("./tests/includes/simple15_circular.php", array("\$_GET[\"p\"]"));
$framework->add_output("./tests/includes/simple15_circular.php", array("5"));
$framework->add_output("./tests/includes/simple15_circular.php", "xss");

$framework->add_testbasis("./tests/includes/simple16.php");
$framework->add_output("./tests/includes/simple16.php", array("\$var"));
$framework->add_output("./tests/includes/simple16.php", array("3"));
$framework->add_output("./tests/includes/simple16.php", "xss");

$framework->add_testbasis("./tests/includes/simple17.php");
$framework->add_output("./tests/includes/simple17.php", array("\$var"));
$framework->add_output("./tests/includes/simple17.php", array("3"));
$framework->add_output("./tests/includes/simple17.php", "xss");

?>
