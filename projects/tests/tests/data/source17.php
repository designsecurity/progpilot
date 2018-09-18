<?php

$res = $_GET["p"];

if (settype($res, "float")) {
    $res = $res ;
} else {
    $res = 0.0 ;
}

while ($data = mysql_fetch_array($res)) {

    print_r($data) ;

    echo $data;
    
    echo $data["trou"];
}
