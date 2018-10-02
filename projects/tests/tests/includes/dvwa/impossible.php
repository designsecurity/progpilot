<?php

// Is there any input?
if (array_key_exists("d", $_GET) && $_GET[ 'd' ] != null) {
    // Feedback for end user
    $html .= '<pre>Hello ' . $_GET[ 'd' ] . '</pre>';
}
