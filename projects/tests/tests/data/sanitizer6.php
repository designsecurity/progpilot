<?php

class testccc1
{
    public function mysanitizer()
    {
    }
}

$instance = new testccc1;

$ret = $instance->mysanitizer($_GET["p"]);

echo "$ret";

mysql_query($ret);
