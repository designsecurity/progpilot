<?php

$safe1 = htmlentities($_GET["p"], ENT_QUOTES);

system("blabla '$safe1'"); // safe {def is quoted, sanitize type contains QUOTE}

$vuln2 = htmlentities($_GET["p"]);

system("blabla '$vuln2'"); // vuln {def is quoted, sanitize type NOT contains QUOTE}

$vuln3 = htmlentities($_GET["p"], ENT_QUOTES);

system("blabla $vuln3"); // vuln {def is not quoted, sanitize type contains QUOTE}

$vuln4 = htmlentities($_GET["p"]);

system("blabla $vuln4"); // vuln {def is not quoted, sanitize type NOT contains QUOTE}

$id1 = $_GET["p"];
mysql_query("select * from table where id = $id1"); // vuln

$id2 = $_GET["p"];
mysql_query("select * from table where id = '$id2'"); // vuln

$id3 = addslashes($_GET["p"]);
mysql_query("select * from table where id = $id3"); // vuln

$id4 = addslashes($_GET["p"]);
mysql_query("select * from table where id = '$id4'"); // safe

$id5 = addslashes($_GET["p"]);
mysql_query("select * from table where id = '$id5"); // vuln

$id6 = addslashes($_GET["p"]);
$id7 = addslashes($_GET["p"]);
mysql_query("select * from table where id = '$id6' and name = '$id7"); // vuln


function testf1($aa)
{
    return "ee";
}

$ret = testf1($_GET["p"]);

echo $ret;

?>	
