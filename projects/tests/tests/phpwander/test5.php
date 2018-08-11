
<?php declare(strict_types = 1);
// ok
$file = '/file.php';
$user = require_once __DIR__ . $file;
// ok
if (array_key_exists('file', $_GET)) {
    //  tainted
    require_once __DIR__ . '/' . $_GET['file'] . '.php';
}
// ok, file doesn't exist
echo $user['id'];
