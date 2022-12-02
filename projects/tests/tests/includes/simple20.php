<?php

include "simple20_include.php";

$comments = $wpdb->get_results("SE");
echo $comments->post;  
