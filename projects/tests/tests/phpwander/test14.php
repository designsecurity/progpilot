<?php declare(strict_types = 1);

include("test14F.php");

$conn = new mysqli('localhost');
$user = $conn->query('SELECT * FROM user WHERE id = ' . $_GET['id']);
F::sensitive($_GET['1']);
