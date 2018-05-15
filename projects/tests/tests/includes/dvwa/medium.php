<?php

// Is there any input?
if (array_key_exists("b", $_GET) && $_GET[ 'b' ] != null) {
    // Feedback for end user
    $html .= '<pre>Hello ' . $_GET[ 'b' ] . '</pre>';
}
