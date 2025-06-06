<?php
$tainted = 'Constant';

function test() {
    $GLOBALS['tainted'] = $_POST["tainted"];
    $db = mysqli_connect("127.0.0.1", "root", "123456");
    mysqli_select_db($db, "testcasesqli");
    $query = "select * from users where id=".$GLOBALS["tainted"];
    $result = mysqli_query($db, $query);
    if ($result == false) {
        exit("Database error !<br />");
    }
    $row = mysqli_fetch_array($result);
    if ($row == null) {
        exit("Error ID or password.<br />");
    }
    print("Login successfully!<br />welcome,".$row[1]."<br />");
}

test();