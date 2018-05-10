<?php

$framework->add_testbasis("./tests/custom/custom1.php");
$framework->add_output("./tests/custom/custom1.php", "rules_#1");
$framework->add_output("./tests/custom/custom1.php", "16");
$framework->add_output("./tests/custom/custom1.php", "165");
$framework->add_output("./tests/custom/custom1.php", "rules_#2");
$framework->add_output("./tests/custom/custom1.php", "16");
$framework->add_output("./tests/custom/custom1.php", "165");

$framework->add_testbasis("./tests/custom/custom2.php");
$framework->add_output("./tests/custom/custom2.php", "rules_#3");
$framework->add_output("./tests/custom/custom2.php", "5");
$framework->add_output("./tests/custom/custom2.php", "75");
$framework->add_output("./tests/custom/custom2.php", "rules_#3");
$framework->add_output("./tests/custom/custom2.php", "7");
$framework->add_output("./tests/custom/custom2.php", "144");
$framework->add_output("./tests/custom/custom2.php", "rules_#3");
$framework->add_output("./tests/custom/custom2.php", "9");
$framework->add_output("./tests/custom/custom2.php", "213");

?>
