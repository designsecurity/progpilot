<?php

$framework->add_testbasis("./tests/data/sink1.php");
$framework->add_output("./tests/data/sink1.php", array("var7"));
$framework->add_output("./tests/data/sink1.php", array("3"));
$framework->add_output("./tests/data/sink1.php", "xss");

$framework->add_testbasis("./tests/data/sink2.php");
$framework->add_output("./tests/data/sink2.php", array("var7"));
$framework->add_output("./tests/data/sink2.php", array("3"));
$framework->add_output("./tests/data/sink2.php", "xss");

$framework->add_testbasis("./tests/data/sink3.php");
$framework->add_output("./tests/data/sink3.php", array("var7"));
$framework->add_output("./tests/data/sink3.php", array("3"));
$framework->add_output("./tests/data/sink3.php", "xss");

$framework->add_testbasis("./tests/data/sink4.php");
$framework->add_output("./tests/data/sink4.php", array("var7"));
$framework->add_output("./tests/data/sink4.php", array("3"));
$framework->add_output("./tests/data/sink4.php", "xss");

$framework->add_testbasis("./tests/data/source1.php");
$framework->add_output("./tests/data/source1.php", array("var7"));
$framework->add_output("./tests/data/source1.php", array("3"));
$framework->add_output("./tests/data/source1.php", "xss");

$framework->add_testbasis("./tests/data/source2.php");
$framework->add_output("./tests/data/source2.php", array("var7"));
$framework->add_output("./tests/data/source2.php", array("3"));
$framework->add_output("./tests/data/source2.php", "xss");

$framework->add_testbasis("./tests/data/source3.php");
$framework->add_output("./tests/data/source3.php", array("var"));
$framework->add_output("./tests/data/source3.php", array("3"));
$framework->add_output("./tests/data/source3.php", "xss");

$framework->add_testbasis("./tests/data/source4.php");
$framework->add_output("./tests/data/source4.php", array("var2"));
$framework->add_output("./tests/data/source4.php", array("5"));
$framework->add_output("./tests/data/source4.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer1.php");
$framework->add_output("./tests/data/sanitizer1.php", array("var7safe"));
$framework->add_output("./tests/data/sanitizer1.php", array("5"));
$framework->add_output("./tests/data/sanitizer1.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer2.php");
$framework->add_output("./tests/data/sanitizer2.php", array("var7safe3"));
$framework->add_output("./tests/data/sanitizer2.php", array("5"));
$framework->add_output("./tests/data/sanitizer2.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer3.php");
$framework->add_output("./tests/data/sanitizer3.php", array("var7"));
$framework->add_output("./tests/data/sanitizer3.php", array("3"));
$framework->add_output("./tests/data/sanitizer3.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer4.php");
$framework->add_output("./tests/data/sanitizer4.php", array("var7safe3"));
$framework->add_output("./tests/data/sanitizer4.php", array("5"));
$framework->add_output("./tests/data/sanitizer4.php", "xss");

?>
