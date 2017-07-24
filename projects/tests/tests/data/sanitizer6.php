<?php

class testc1
{
    public function mysanitizer()
    {
    
    }
}

$instance = new testc1;

$ret = $instance->mysanitizer($_GET["p"]);

echo "$ret";

mysql_query($ret);

?>	
