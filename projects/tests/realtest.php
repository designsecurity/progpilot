<?php

$framework->add_testbasis("./tests/real/ClassLoader.php");

$framework->add_testbasis("./tests/real/mutliplecall_memory.php");
$framework->add_output("./tests/real/mutliplecall_memory.php", array("\$var"));
$framework->add_output("./tests/real/mutliplecall_memory.php", array("6"));
$framework->add_output("./tests/real/mutliplecall_memory.php", "xss");

$framework->add_testbasis("./tests/real/composer/index.php");
$framework->add_output("./tests/real/composer/index.php", array("\$_GET[\"p\"]"));
$framework->add_output("./tests/real/composer/index.php", array("7"));
$framework->add_output("./tests/real/composer/index.php", "xss");
$framework->add_output("./tests/real/composer/index.php", array("\$_GET[\"p\"]"));
$framework->add_output("./tests/real/composer/index.php", array("14"));
$framework->add_output("./tests/real/composer/index.php", "xss");
