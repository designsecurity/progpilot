<?php

$framework->add_testbasis("./tests/real/ClassLoader.php");

$framework->add_testbasis("./tests/real/mutliplecall_memory.php");
$framework->add_output("./tests/real/mutliplecall_memory.php", array("\$var"));
$framework->add_output("./tests/real/mutliplecall_memory.php", array("6"));
$framework->add_output("./tests/real/mutliplecall_memory.php", "xss");

?>
