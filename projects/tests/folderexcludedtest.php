<?php

$framework->add_testbasis("./tests/folders/folder1");
$framework->add_output("./tests/folders/folder1", array("\$var1[0]"));
$framework->add_output("./tests/folders/folder1", array("5"));
$framework->add_output("./tests/folders/folder1", "xss");
$framework->add_output("./tests/folders/folder1", array("\$var1"));
$framework->add_output("./tests/folders/folder1", array("9"));
$framework->add_output("./tests/folders/folder1", "xss");
$framework->add_output("./tests/folders/folder1", array("\$var2"));
$framework->add_output("./tests/folders/folder1", array("12"));
$framework->add_output("./tests/folders/folder1", "xss");

$framework->add_testbasis("./tests/folders/folder2");
$framework->add_output("./tests/folders/folder2", array("\$var1[0]"));
$framework->add_output("./tests/folders/folder2", array("5"));
$framework->add_output("./tests/folders/folder2", "xss");
$framework->add_output("./tests/folders/folder2", array("\$var1"));
$framework->add_output("./tests/folders/folder2", array("9"));
$framework->add_output("./tests/folders/folder2", "xss");

?>
