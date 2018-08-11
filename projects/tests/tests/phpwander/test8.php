<?php declare(strict_types = 1);
$items = [
    3,
    $_GET['b'],
    'str',
    4 => 1.4,
];
for ($i = 0; $i < count($items); $i++) {
    echo $items[$i];
}
