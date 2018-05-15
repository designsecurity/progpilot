<?php

$var7 = $_POST["pe"];

$var7safe3 = htmlentities("ddd").$var7;

echo "$var7safe3";

$query = addslashes($_GET["p"]);

mysql_query("select * from table where id = '$query'");
