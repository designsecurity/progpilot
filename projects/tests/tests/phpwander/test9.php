<?php declare(strict_types = 1);
$items = [
    3,
    $_GET['b'],
    'str',
];
$i = count($items);
do {
    echo $items[--$i];
} while ($i >= 0);
