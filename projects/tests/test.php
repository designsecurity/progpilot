<?php

$tainted = "cat /tmp/tainted.txt";

$var = "'$tainted'.php"; 

echo "$var";

?>
