<?php

$show_updated = $_POST['show_updated'];
if ($show_updated != 'Y') {
    $show_updated = 'N';
}

echo $show_updated;