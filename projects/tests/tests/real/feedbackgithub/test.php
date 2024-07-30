<?php

function test_procedural($link, $id) {
    mysqli_query($link, 'SELECT * FROM table WHERE id = '.$id);
}
$link = mysqli_connect();
test_procedural($link, $_POST['id']); // should trigger, but no

function test_object($mysqli, $id) {
    $mysqli->query('SELECT * FROM table WHERE id = '.$id);
}
$mysqli = new mysqli('host', 'user', 'password', 'database');
test_object($mysqli, $_POST['id']); // should trigger, but no
$mysqli->query('SELECT * FROM table WHERE id = '.$_POST['id']); // triggers