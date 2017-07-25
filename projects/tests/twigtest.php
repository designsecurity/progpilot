<?php

$framework->add_testbasis("./tests/twig/twig1.php");
$framework->add_output("./tests/twig/twig1.php", array("{{TEST1}}"));
$framework->add_output("./tests/twig/twig1.php", array("3"));
$framework->add_output("./tests/twig/twig1.php", "xss");

?>
