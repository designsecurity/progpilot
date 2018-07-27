<?php

include("test3A.php");

$a = new A($_GET);

echo $a->getSource('a');
