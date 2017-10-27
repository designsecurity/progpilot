<?php

// Is there any input?
if( array_key_exists( "c", $_GET ) && $_GET[ 'c' ] != NULL ) {
	// Feedback for end user
	$html .= '<pre>Hello ' . $_GET[ 'c' ] . '</pre>';
}


?>
