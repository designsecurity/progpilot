<?php

// Is there any input?
if (array_key_exists("a", $_GET) && $_GET[ 'a' ] != null) {
    // Feedback for end user
    $html .= '<pre>Hello ' . $_GET[ 'a' ] . '</pre>';
}

if (true) {
    $html = $_GET["p"];
} else {
    $html = "eee";
}
