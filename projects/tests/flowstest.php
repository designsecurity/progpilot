<?php

$framework->add_testbasis("./tests/flows/flow1.php");
$framework->add_output("./tests/flows/flow1.php", "\$var");
$framework->add_output("./tests/flows/flow1.php", 5);
$framework->add_output("./tests/flows/flow1.php", "\$param");
$framework->add_output("./tests/flows/flow1.php", 3);
$framework->add_output("./tests/flows/flow1.php", "\$var4");
$framework->add_output("./tests/flows/flow1.php", 10);
$framework->add_output("./tests/flows/flow1.php", "\$var7");
$framework->add_output("./tests/flows/flow1.php", 9);
$framework->add_output("./tests/flows/flow1.php", "\$_GET[\"p\"]");
$framework->add_output("./tests/flows/flow1.php", 9);


$framework->add_testbasis("./tests/flows/flow2.php");
$framework->add_output("./tests/flows/flow2.php", "\$this->object1");
$framework->add_output("./tests/flows/flow2.php", 6);
$framework->add_output("./tests/flows/flow2.php", "\$val");
$framework->add_output("./tests/flows/flow2.php", 8);
$framework->add_output("./tests/flows/flow2.php", "\$_GET[\"p\"]");
$framework->add_output("./tests/flows/flow2.php", 21);

$framework->add_testbasis("./tests/flows/flow3.php");
$framework->add_output("./tests/flows/flow3.php", "\$var1");
$framework->add_output("./tests/flows/flow3.php", 3);
$framework->add_output("./tests/flows/flow3.php", "\$_GET[\"p1\"]");
$framework->add_output("./tests/flows/flow3.php", 3);

?>
