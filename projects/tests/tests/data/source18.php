<?php

$query = "blabla";

$mysqli = new mysqli("localhost", "my_user", "my_password", "world");

$result = $mysqli->query($query);

$row = $result->fetch_array();

echo $row[1];

