<?php

$framework->add_testbasis("./tests/conditions/condition1.php");
$framework->add_output("./tests/conditions/condition1.php", array("\$_GET[\"p1\"]"));
$framework->add_output("./tests/conditions/condition1.php", array("8"));
$framework->add_output("./tests/conditions/condition1.php", "xss");

$framework->add_testbasis("./tests/conditions/condition4.php");
$framework->add_output("./tests/conditions/condition4.php", array("\$blabla"));
$framework->add_output("./tests/conditions/condition4.php", array("3"));
$framework->add_output("./tests/conditions/condition4.php", "xss");

$framework->add_testbasis("./tests/conditions/condition5.php");
$framework->add_output("./tests/conditions/condition5.php", array("\$tainted"));
$framework->add_output("./tests/conditions/condition5.php", array("8"));
$framework->add_output("./tests/conditions/condition5.php", "xss");

$framework->add_testbasis("./tests/conditions/condition6.php");
$framework->add_output("./tests/conditions/condition6.php", array("\$tainted"));
$framework->add_output("./tests/conditions/condition6.php", array("3"));
$framework->add_output("./tests/conditions/condition6.php", "xss");

$framework->add_testbasis("./tests/conditions/condition7.php");
$framework->add_output("./tests/conditions/condition7.php", array("\$tainted"));
$framework->add_output("./tests/conditions/condition7.php", array("3"));
$framework->add_output("./tests/conditions/condition7.php", "xss");

$framework->add_testbasis("./tests/conditions/condition8.php");
$framework->add_output("./tests/conditions/condition8.php", array("\$tainted"));
$framework->add_output("./tests/conditions/condition8.php", array("53"));
$framework->add_output("./tests/conditions/condition8.php", "xss");
$framework->add_output("./tests/conditions/condition8.php", array("\$tainted"));
$framework->add_output("./tests/conditions/condition8.php", array("60"));
$framework->add_output("./tests/conditions/condition8.php", "xss");


?>
