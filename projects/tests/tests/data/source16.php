<?php

while($row = mysql_fetch_object($result)) {
    echo $row->fullname;
}

/*
$row = mysql_fetch_object($result);
    echo $row->fullname;
*/
