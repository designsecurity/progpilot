<?php

$framework->add_testbasis("./tests/custom/custom1.php");
$framework->add_output("./tests/custom/custom1.php", "bypass access control");
$framework->add_output("./tests/custom/custom1.php", "16");
$framework->add_output("./tests/custom/custom1.php", "165");
$framework->add_output("./tests/custom/custom1.php", "bypass access control");
$framework->add_output("./tests/custom/custom1.php", "16");
$framework->add_output("./tests/custom/custom1.php", "165");

$framework->add_testbasis("./tests/custom/custom2.php");
$framework->add_output("./tests/custom/custom2.php", "security misconfiguration");
$framework->add_output("./tests/custom/custom2.php", "5");
$framework->add_output("./tests/custom/custom2.php", "75");
$framework->add_output("./tests/custom/custom2.php", "security misconfiguration");
$framework->add_output("./tests/custom/custom2.php", "7");
$framework->add_output("./tests/custom/custom2.php", "144");
$framework->add_output("./tests/custom/custom2.php", "security misconfiguration");
$framework->add_output("./tests/custom/custom2.php", "9");
$framework->add_output("./tests/custom/custom2.php", "213");

$framework->add_testbasis("./tests/custom/custom3.php");
$framework->add_output("./tests/custom/custom3.php", "security misconfiguration");
$framework->add_output("./tests/custom/custom3.php", "11");
$framework->add_output("./tests/custom/custom3.php", "95");

/*
$framework->add_testbasis("./tests/custom/custom4.php");
$framework->add_output("./tests/custom/custom4.php", "security misconfiguration");
$framework->add_output("./tests/custom/custom4.php", "4");
$framework->add_output("./tests/custom/custom4.php", "44");
*/
?>
