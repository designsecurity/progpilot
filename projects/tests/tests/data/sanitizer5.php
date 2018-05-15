<?php

function mysanitizer()
{
}

$ret = mysanitizer($_GET["p"]);

echo "$ret";

mysql_query($ret);
