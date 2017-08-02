<?php

    require_once './vendor/autoload.php';

    $print_arr = ""; 
    
    $arr = array("bla" => false);
    
    \progpilot\Utils::print_array($arr, $print_arr);

    $print_arr = ""; 
    
    $arr = array("bla" => array("biouuu" => false));
    
    \progpilot\Utils::print_array($arr, $print_arr);
    
    echo "$print_arr\n";
    
?>



