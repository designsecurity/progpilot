<?php declare(strict_types = 1);
$conn = mysqli_connect('localhost', 'root', 'root', 'phpwander');
// tainted
$query = mysqli_query($conn, 'SELECT id FROM user WHERE username = "' . $_GET['user'] . '" AND password = "' . $_GET['password'] . '"');
return mysqli_fetch_assoc($query);
