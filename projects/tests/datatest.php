<?php

$framework->add_testbasis("./tests/data/sink1.php");
$framework->add_output("./tests/data/sink1.php", array("\$var7"));
$framework->add_output("./tests/data/sink1.php", array("3"));
$framework->add_output("./tests/data/sink1.php", "xss");

$framework->add_testbasis("./tests/data/sink2.php");
$framework->add_output("./tests/data/sink2.php", array("\$var7"));
$framework->add_output("./tests/data/sink2.php", array("3"));
$framework->add_output("./tests/data/sink2.php", "xss");

$framework->add_testbasis("./tests/data/sink3.php");
$framework->add_output("./tests/data/sink3.php", array("\$var7"));
$framework->add_output("./tests/data/sink3.php", array("3"));
$framework->add_output("./tests/data/sink3.php", "xss");

$framework->add_testbasis("./tests/data/sink4.php");
$framework->add_output("./tests/data/sink4.php", array("\$var7"));
$framework->add_output("./tests/data/sink4.php", array("3"));
$framework->add_output("./tests/data/sink4.php", "xss");

$framework->add_testbasis("./tests/data/source1.php");
$framework->add_output("./tests/data/source1.php", array("\$var7"));
$framework->add_output("./tests/data/source1.php", array("3"));
$framework->add_output("./tests/data/source1.php", "xss");

$framework->add_testbasis("./tests/data/source2.php");
$framework->add_output("./tests/data/source2.php", array("\$var7"));
$framework->add_output("./tests/data/source2.php", array("3"));
$framework->add_output("./tests/data/source2.php", "xss");

$framework->add_testbasis("./tests/data/source3.php");
$framework->add_output("./tests/data/source3.php", array("\$var"));
$framework->add_output("./tests/data/source3.php", array("3"));
$framework->add_output("./tests/data/source3.php", "xss");

$framework->add_testbasis("./tests/data/source4.php");
$framework->add_output("./tests/data/source4.php", array("\$var2"));
$framework->add_output("./tests/data/source4.php", array("5"));
$framework->add_output("./tests/data/source4.php", "xss");

$framework->add_testbasis("./tests/data/source5.php");
$framework->add_output("./tests/data/source5.php", array("\$var2"));
$framework->add_output("./tests/data/source5.php", array("13"));
$framework->add_output("./tests/data/source5.php", "xss");

$framework->add_testbasis("./tests/data/source6.php");
$framework->add_output("./tests/data/source6.php", array("\$var"));
$framework->add_output("./tests/data/source6.php", array("26"));
$framework->add_output("./tests/data/source6.php", "xss");

$framework->add_testbasis("./tests/data/source7.php");
$framework->add_output("./tests/data/source7.php", array("\$return"));
$framework->add_output("./tests/data/source7.php", array("13"));
$framework->add_output("./tests/data/source7.php", "xss");

$framework->add_testbasis("./tests/data/source8.php");
$framework->add_output("./tests/data/source8.php", array("\$return"));
$framework->add_output("./tests/data/source8.php", array("8"));
$framework->add_output("./tests/data/source8.php", "xss");

$framework->add_testbasis("./tests/data/source9.php");
$framework->add_output("./tests/data/source9.php", array("\$return"));
$framework->add_output("./tests/data/source9.php", array("8"));
$framework->add_output("./tests/data/source9.php", "xss");

$framework->add_testbasis("./tests/data/source10.php");
$framework->add_output("./tests/data/source10.php", array("\$return"));
$framework->add_output("./tests/data/source10.php", array("8"));
$framework->add_output("./tests/data/source10.php", "xss");

$framework->add_testbasis("./tests/data/source11.php");
$framework->add_output("./tests/data/source11.php", array("\$inst->member1"));
$framework->add_output("./tests/data/source11.php", array("9"));
$framework->add_output("./tests/data/source11.php", "xss");

$framework->add_testbasis("./tests/data/source12.php");
$framework->add_output("./tests/data/source12.php", array("\$var2"));
$framework->add_output("./tests/data/source12.php", array("5"));
$framework->add_output("./tests/data/source12.php", "xss");

$framework->add_testbasis("./tests/data/source13.php");
$framework->add_output("./tests/data/source13.php", array("\$var1"));
$framework->add_output("./tests/data/source13.php", array("3"));
$framework->add_output("./tests/data/source13.php", "xss");

$framework->add_testbasis("./tests/data/source14.php");
$framework->add_output("./tests/data/source14.php", array("\$tainted"));
$framework->add_output("./tests/data/source14.php", array("7"));
$framework->add_output("./tests/data/source14.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer1.php");
$framework->add_output("./tests/data/sanitizer1.php", array("\$var7safe"));
$framework->add_output("./tests/data/sanitizer1.php", array("5"));
$framework->add_output("./tests/data/sanitizer1.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer2.php");
$framework->add_output("./tests/data/sanitizer2.php", array("\$var7safe3"));
$framework->add_output("./tests/data/sanitizer2.php", array("5"));
$framework->add_output("./tests/data/sanitizer2.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer3.php");
$framework->add_output("./tests/data/sanitizer3.php", array("\$var7"));
$framework->add_output("./tests/data/sanitizer3.php", array("3"));
$framework->add_output("./tests/data/sanitizer3.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer4.php");
$framework->add_output("./tests/data/sanitizer4.php", array("\$var7safe3"));
$framework->add_output("./tests/data/sanitizer4.php", array("5"));
$framework->add_output("./tests/data/sanitizer4.php", "xss");

$framework->add_testbasis("./tests/data/sanitizer5.php");
$framework->add_output("./tests/data/sanitizer5.php", array("\$ret"));
$framework->add_output("./tests/data/sanitizer5.php", array("8"));
$framework->add_output("./tests/data/sanitizer5.php", "sql_injection");

$framework->add_testbasis("./tests/data/sanitizer6.php");
$framework->add_output("./tests/data/sanitizer6.php", array("\$ret"));
$framework->add_output("./tests/data/sanitizer6.php", array("13"));
$framework->add_output("./tests/data/sanitizer6.php", "sql_injection");

?>
