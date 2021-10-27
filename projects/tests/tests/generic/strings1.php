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
mysql_query("select * from table where id = '$id5"); // vuln FN, but not realistic, not a valid sql query

$id6 = addslashes($_GET["p"]);
$id7 = addslashes($_GET["p"]);
mysql_query("select * from table where id = '$id6' and name = '$id7"); // vuln FN, but not realistic, not a valid sql query


function testf1($aa)
{
    return "ee";
}

$ret = testf1($_GET["p"]);

echo $ret; // safe

$tainted1 = $_GET["p"];
echo "'$tainted1'"; // vuln

$tainted2 = $_GET["p"];
echo "<a href='$tainted2'>click</a>"; // vuln

$tainted3 = $_GET["p"];
echo "<a href=$tainted3>click</a>"; // vuln


$tainted11 = htmlentities($_GET["p"]);
echo "'$tainted11'"; // safe

$tainted12 = htmlentities($_GET["p"], ENT_QUOTES);
echo "'$tainted12'"; // safe

$tainted21 = htmlentities($_GET["p"]);
echo "<a href='$tainted21'>click</a>"; // vuln

$tainted22 = htmlentities($_GET["p"], ENT_QUOTES);
echo "<a href='$tainted22'>click</a>"; // safe

$tainted31 =  htmlentities($_GET["p"]);
echo "<a href=$tainted31>click</a>"; // vuln

$tainted32 =  htmlentities($_GET["p"], ENT_QUOTES);
echo "<a href=$tainted32>click</a>"; // vuln
