<?php

$framework->add_testbasis("./tests/includes/simple1.php");
$framework->add_output("./tests/includes/simple1.php", array("var1"));
$framework->add_output("./tests/includes/simple1.php", array("3"));
$framework->add_output("./tests/includes/simple1.php", "xss");

$framework->add_testbasis("./tests/includes/simple2.php");
$framework->add_output("./tests/includes/simple2.php", array("var1"));
$framework->add_output("./tests/includes/simple2.php", array("3"));
$framework->add_output("./tests/includes/simple2.php", "xss");

$framework->add_testbasis("./tests/includes/simple3.php");
$framework->add_output("./tests/includes/simple3.php", array("var1"));
$framework->add_output("./tests/includes/simple3.php", array("3"));
$framework->add_output("./tests/includes/simple3.php", "xss");

$framework->add_testbasis("./tests/includes/simple4.php");
$framework->add_output("./tests/includes/simple4.php", array("var1"));
$framework->add_output("./tests/includes/simple4.php", array("3"));
$framework->add_output("./tests/includes/simple4.php", "xss");

$framework->add_testbasis("./tests/includes/simple5.php");
$framework->add_output("./tests/includes/simple5.php", array("var1"));
$framework->add_output("./tests/includes/simple5.php", array("3"));
$framework->add_output("./tests/includes/simple5.php", "xss");

?>
