<?php

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__GET__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__GET__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__POST__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__POST__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__SESSION__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__SESSION__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__array-GET__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__array-GET__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__backticks__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__backticks__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__exec__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__exec__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__fopen__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__fopen__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__object-Array__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__object-Array__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__object-classicGet__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__object-classicGet__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__object-directGet__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__object-directGet__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__object-indexArray__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__object-indexArray__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__popen__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__popen__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__proc_open__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__proc_open__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__shell_exec__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__shell_exec__whitelist_using_array__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__system__ternary_white_list__fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__system__whitelist_using_array__fopen.php");

/* FALSE POSITIVE */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__unserialize__ternary_white_list__fopen.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/safe/CWE_862_Fopen__unserialize__whitelist_using_array__fopen.php");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__func_preg_replace__fopen.php", array("48"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__no_sanitizing__fopen.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__POST__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__POST__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__POST__func_preg_replace__fopen.php", array("48"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__POST__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__POST__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__POST__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__POST__no_sanitizing__fopen.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__POST__no_sanitizing__fopen.php", "idor");

/* FALSE POSITIVES */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__SESSION__func_preg_replace__fopen.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__SESSION__func_preg_replace__fopen.php", array("\$tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__SESSION__func_preg_replace__fopen.php", array("48"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__SESSION__func_preg_replace__fopen.php", "idor");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__SESSION__no_sanitizing__fopen.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__SESSION__no_sanitizing__fopen.php", array("\$tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__SESSION__no_sanitizing__fopen.php", array("46"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__SESSION__no_sanitizing__fopen.php", "idor");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__array-GET__func_preg_replace__fopen.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__array-GET__func_preg_replace__fopen.php", array("\$tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__array-GET__func_preg_replace__fopen.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__array-GET__func_preg_replace__fopen.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__array-GET__no_sanitizing__fopen.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__array-GET__no_sanitizing__fopen.php", array("\$tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__array-GET__no_sanitizing__fopen.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__array-GET__no_sanitizing__fopen.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__backticks__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__backticks__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__backticks__func_preg_replace__fopen.php", array("48"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__backticks__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__backticks__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__backticks__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__backticks__no_sanitizing__fopen.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__backticks__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__exec__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__exec__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__exec__func_preg_replace__fopen.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__exec__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__exec__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__exec__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__exec__no_sanitizing__fopen.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__exec__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__fopen__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__fopen__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__fopen__func_preg_replace__fopen.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__fopen__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__fopen__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__fopen__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__fopen__no_sanitizing__fopen.php", array("50"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__fopen__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-Array__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-Array__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-Array__func_preg_replace__fopen.php", array("67"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-Array__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-Array__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-Array__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-Array__no_sanitizing__fopen.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-Array__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-classicGet__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-classicGet__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-classicGet__func_preg_replace__fopen.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-classicGet__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-classicGet__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-classicGet__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-classicGet__no_sanitizing__fopen.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-classicGet__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-directGet__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-directGet__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-directGet__func_preg_replace__fopen.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-directGet__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-directGet__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-directGet__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-directGet__no_sanitizing__fopen.php", array("55"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-directGet__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-indexArray__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-indexArray__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-indexArray__func_preg_replace__fopen.php", array("66"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-indexArray__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-indexArray__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-indexArray__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-indexArray__no_sanitizing__fopen.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__object-indexArray__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__popen__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__popen__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__popen__func_preg_replace__fopen.php", array("50"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__popen__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__popen__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__popen__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__popen__no_sanitizing__fopen.php", array("47"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__popen__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__proc_open__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__proc_open__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__proc_open__func_preg_replace__fopen.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__proc_open__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__proc_open__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__proc_open__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__proc_open__no_sanitizing__fopen.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__proc_open__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__shell_exec__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__shell_exec__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__shell_exec__func_preg_replace__fopen.php", array("48"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__shell_exec__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__shell_exec__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__shell_exec__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__shell_exec__no_sanitizing__fopen.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__shell_exec__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__system__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__system__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__system__func_preg_replace__fopen.php", array("48"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__system__func_preg_replace__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__system__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__system__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__system__no_sanitizing__fopen.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__system__no_sanitizing__fopen.php", "idor");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__func_preg_replace__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__func_preg_replace__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__func_preg_replace__fopen.php", array("50"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__func_preg_replace__fopen.php", "idor");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__func_preg_replace__fopen.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__func_preg_replace__fopen.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__func_preg_replace__fopen.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__no_sanitizing__fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__no_sanitizing__fopen.php", array("\$tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__no_sanitizing__fopen.php", array("47"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__no_sanitizing__fopen.php", "idor");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__no_sanitizing__fopen.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__no_sanitizing__fopen.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__unserialize__no_sanitizing__fopen.php", "code_injection");





$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__GET__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__POST__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__SESSION__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__array-GET__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__backticks__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__exec__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__fopen__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-Array__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-classicGet__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-directGet__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__object-indexArray__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__popen__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__proc_open__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__shell_exec__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__CAST-cast_int__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__CAST-cast_int__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__ESAPI__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__ESAPI__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__ESAPI__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__ESAPI__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__Indirect_reference__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__Indirect_reference__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__Indirect_reference__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__Indirect_reference__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__ternary_white_list__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__ternary_white_list__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__ternary_white_list__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__ternary_white_list__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__whitelist_using_array__non_prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__whitelist_using_array__prepared_query-no_right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__whitelist_using_array__prepared_query-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__system__whitelist_using_array__select_from_where-interpretation_simple_quote.php");

/* TRUE NEGATIVES */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__CAST-cast_int__non_prepared_query-right_verification.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__CAST-cast_int__prepared_query-right_verification.php");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__non_prepared_query-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__non_prepared_query-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__non_prepared_query-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__non_prepared_query-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__prepared_query-no_right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__prepared_query-no_right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__prepared_query-no_right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__prepared_query-no_right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__prepared_query-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__prepared_query-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__prepared_query-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__prepared_query-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__select_from_where-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__select_from_where-interpretation_simple_quote.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ESAPI__select_from_where-interpretation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__non_prepared_query-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__non_prepared_query-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__non_prepared_query-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__non_prepared_query-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-no_right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-no_right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-no_right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-no_right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__select_from_where-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__select_from_where-interpretation_simple_quote.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__Indirect_reference__select_from_where-interpretation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__non_prepared_query-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__non_prepared_query-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__non_prepared_query-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__non_prepared_query-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-no_right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-no_right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-no_right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-no_right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__select_from_where-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__select_from_where-interpretation_simple_quote.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__ternary_white_list__select_from_where-interpretation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__non_prepared_query-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__non_prepared_query-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__non_prepared_query-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__non_prepared_query-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-no_right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-no_right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-no_right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-no_right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__select_from_where-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__select_from_where-interpretation_simple_quote.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/safe/CWE_862_SQL__unserialize__whitelist_using_array__select_from_where-interpretation_simple_quote.php", "code_injection");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__GET__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__GET__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__POST__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__POST__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__SESSION__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__SESSION__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__array-GET__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__array-GET__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__backticks__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__backticks__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__exec__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__exec__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__fopen__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__fopen__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__object-Array__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__object-Array__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__object-classicGet__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__object-classicGet__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__object-directGet__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__object-directGet__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__object-indexArray__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__object-indexArray__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__popen__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__popen__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__proc_open__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__proc_open__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__shell_exec__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__shell_exec__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__system__CAST-cast_int__prepared_query-no_right_verification.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__system__CAST-cast_int__select_from_where-interpretation_simple_quote.php");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__unserialize__CAST-cast_int__prepared_query-no_right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__unserialize__CAST-cast_int__prepared_query-no_right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__unserialize__CAST-cast_int__prepared_query-no_right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__unserialize__CAST-cast_int__prepared_query-no_right_verification.php", "code_injection");

//////////////////////////////////// false positive
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__unserialize__CAST-cast_int__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__unserialize__CAST-cast_int__select_from_where-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__unserialize__CAST-cast_int__select_from_where-interpretation_simple_quote.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_SQL/unsafe/CWE_862_SQL__unserialize__CAST-cast_int__select_from_where-interpretation_simple_quote.php", "code_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__GET__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__GET__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__GET__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__GET__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__GET__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__POST__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__POST__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__POST__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__POST__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__POST__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__SESSION__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__SESSION__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__SESSION__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__SESSION__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__SESSION__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__array-GET__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__array-GET__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__array-GET__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__array-GET__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__array-GET__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__backticks__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__backticks__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__backticks__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__backticks__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__backticks__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__exec__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__exec__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__exec__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__exec__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__exec__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__fopen__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__fopen__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__fopen__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__fopen__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__fopen__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-Array__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-Array__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-Array__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-Array__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-Array__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-classicGet__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-classicGet__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-classicGet__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-classicGet__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-classicGet__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-directGet__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-directGet__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-directGet__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-directGet__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-directGet__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-indexArray__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-indexArray__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-indexArray__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-indexArray__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__object-indexArray__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__popen__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__popen__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__popen__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__popen__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__popen__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__proc_open__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__proc_open__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__proc_open__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__proc_open__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__proc_open__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__shell_exec__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__shell_exec__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__shell_exec__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__shell_exec__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__shell_exec__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__system__CAST-cast_int__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__system__ternary_white_list__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__system__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__system__whitelist_using_array__concatenation-right_verification.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__system__whitelist_using_array__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__CAST-cast_int__concatenation-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__CAST-cast_int__concatenation-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__CAST-cast_int__concatenation-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__CAST-cast_int__concatenation-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__ternary_white_list__concatenation-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__ternary_white_list__concatenation-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__ternary_white_list__concatenation-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__ternary_white_list__concatenation-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__ternary_white_list__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__ternary_white_list__username_at-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__ternary_white_list__username_at-concatenation_simple_quote.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__ternary_white_list__username_at-concatenation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__whitelist_using_array__concatenation-right_verification.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__whitelist_using_array__concatenation-right_verification.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__whitelist_using_array__concatenation-right_verification.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__whitelist_using_array__concatenation-right_verification.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__whitelist_using_array__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__whitelist_using_array__username_at-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__whitelist_using_array__username_at-concatenation_simple_quote.php", array("46"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/safe/CWE_862_XPath__unserialize__whitelist_using_array__username_at-concatenation_simple_quote.php", "code_injection");


// FALSE POSITIVES
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__GET__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__GET__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__GET__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__GET__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__POST__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__POST__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__POST__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__POST__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__SESSION__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__SESSION__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__SESSION__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__SESSION__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__array-GET__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__array-GET__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__array-GET__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__array-GET__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__backticks__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__backticks__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__backticks__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__backticks__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__exec__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__exec__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__exec__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__exec__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__fopen__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__fopen__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__fopen__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__fopen__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-Array__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-Array__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-Array__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-Array__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-classicGet__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-classicGet__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-classicGet__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-classicGet__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-directGet__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-directGet__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-directGet__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-directGet__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-indexArray__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-indexArray__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-indexArray__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__object-indexArray__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__popen__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__popen__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__popen__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__popen__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__proc_open__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__proc_open__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__proc_open__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__proc_open__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__shell_exec__CAST-cast_int__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__shell_exec__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__shell_exec__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__shell_exec__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__system__CAST-cast_int__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__system__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__system__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__system__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__unserialize__CAST-cast_int__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__unserialize__CAST-cast_int__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__unserialize__CAST-cast_int__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_XPath/unsafe/CWE_862_XPath__unserialize__CAST-cast_int__username_at-concatenation_simple_quote.php", "file_inclusion");
 */

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__GET__CAST-func_settype_int__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__GET__CAST-func_settype_int__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__GET__func_FILTER-CLEANING-magic_quotes_filter__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__GET__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__GET__func_htmlentities__cat-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__GET__func_htmlspecialchars__ls-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__GET__func_preg_replace2__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__GET__ternary_white_list__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__CAST-cast_float__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__CAST-cast_int__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__CAST-cast_int_sort_of2__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__CAST-func_settype_float__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_FILTER-CLEANING-number_int_filter__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_FILTER-VALIDATION-number_int_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_FILTER-VALIDATION-number_int_filter__find_size-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_escapeshellarg__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_htmlentities__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_intval__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_match-letters_numbers__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_match-letters_numbers__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_match-letters_numbers__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_match-letters_numbers__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_replace__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_replace__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_replace__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__func_preg_replace__ls-sprintf_%s_simple_quote.php", "command_injection");



$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__POST__ternary_white_list__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_FILTER-CLEANING-number_float_filter__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_FILTER-CLEANING-number_float_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_addslashes__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_floatval__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_intval__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_preg_match-letters_numbers__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_preg_match-letters_numbers__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__func_preg_replace__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__ternary_white_list__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__SESSION__whitelist_using_array__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__CAST-cast_int_sort_of2__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__CAST-func_settype_float__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__func_intval__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__func_mysql_real_escape_string__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__func_preg_replace__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__whitelist_using_array__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__array-GET__whitelist_using_array__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__CAST-func_settype_int__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_FILTER-CLEANING-magic_quotes_filter__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_htmlspecialchars__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_htmlspecialchars__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_preg_match-only_numbers__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_preg_replace2__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__func_preg_replace__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__ternary_white_list__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__ternary_white_list__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__backticks__whitelist_using_array__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__exec__CAST-cast_int__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__exec__func_addslashes__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__exec__func_htmlspecialchars__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__exec__whitelist_using_array__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__exec__whitelist_using_array__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__CAST-cast_int__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__CAST-cast_int_sort_of2__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php");

/* false positive */
//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__CAST-func_settype_float__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__func_FILTER-CLEANING-magic_quotes_filter__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__func_addslashes__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__func_floatval__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__func_htmlentities__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__func_preg_match-letters_numbers__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__func_preg_replace2__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__ternary_white_list__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__fopen__whitelist_using_array__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__CAST-func_settype_float__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_FILTER-CLEANING-number_int_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_escapeshellarg__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_htmlentities__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_preg_match-only_letters__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_preg_match-only_letters__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_preg_match-only_numbers__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_preg_replace__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_preg_replace__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_preg_replace__cat-sprintf_%s_simple_quote.php", array("67"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__func_preg_replace__cat-sprintf_%s_simple_quote.php", "command_injection");



$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__ternary_white_list__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__whitelist_using_array__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-Array__whitelist_using_array__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_FILTER-VALIDATION-number_int_filter__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlentities__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlentities__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlentities__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlentities__ls-sprintf_%s_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlentities__ls-sprintf_%s_simple_quote.php", "command_injection");



$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlspecialchars__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlspecialchars__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php", "command_injection");



$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_preg_match-only_letters__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_preg_replace__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_preg_replace__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_preg_replace__ls-sprintf_%s_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__func_preg_replace__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__ternary_white_list__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__ternary_white_list__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-classicGet__whitelist_using_array__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__CAST-cast_int__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_FILTER-CLEANING-number_int_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_addslashes__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_addslashes__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_addslashes__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_addslashes__ls-sprintf_%s_simple_quote.php", array("58"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_addslashes__ls-sprintf_%s_simple_quote.php", "command_injection");




$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_escapeshellarg__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_intval__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php", array("58"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_preg_match-letters_numbers__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__func_preg_replace__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__ternary_white_list__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__ternary_white_list__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__whitelist_using_array__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__whitelist_using_array__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-directGet__whitelist_using_array__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__CAST-cast_int__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__CAST-func_settype_int__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php", array("69"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_FILTER-VALIDATION-number_float_filter__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_addslashes__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_escapeshellarg__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", array("69"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_floatval__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_htmlspecialchars__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_htmlspecialchars__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_htmlspecialchars__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_htmlspecialchars__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_htmlspecialchars__ls-sprintf_%s_simple_quote.php", array("67"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_htmlspecialchars__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_intval__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_preg_replace2__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_preg_replace2__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_preg_replace2__ls-sprintf_%s_simple_quote.php", array("67"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__func_preg_replace2__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__ternary_white_list__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__ternary_white_list__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__whitelist_using_array__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__whitelist_using_array__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__object-indexArray__whitelist_using_array__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__CAST-cast_int_sort_of__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_FILTER-CLEANING-magic_quotes_filter__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_FILTER-CLEANING-number_float_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_FILTER-CLEANING-number_float_filter__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_escapeshellarg__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_floatval__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_intval__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_intval__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_preg_match-only_letters__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_preg_replace2__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_preg_replace2__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_preg_replace2__cat-sprintf_%s_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__func_preg_replace2__cat-sprintf_%s_simple_quote.php", "command_injection");



$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__ternary_white_list__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__popen__whitelist_using_array__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__CAST-cast_int__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__CAST-func_settype_float__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_FILTER-CLEANING-number_float_filter__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_FILTER-CLEANING-number_int_filter__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_FILTER-VALIDATION-number_int_filter__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_escapeshellarg__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", "command_injection");



$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_escapeshellarg__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_mysql_real_escape_string__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_preg_match-letters_numbers__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_preg_replace__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_preg_replace__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_preg_replace__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_preg_replace__ls-sprintf_%s_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__func_preg_replace__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__proc_open__whitelist_using_array__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_FILTER-VALIDATION-number_int_filter__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_FILTER-VALIDATION-number_int_filter__find_size-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_htmlentities__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_htmlentities__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_preg_replace2__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_preg_replace2__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_preg_replace2__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__func_preg_replace2__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__ternary_white_list__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__ternary_white_list__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__whitelist_using_array__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__whitelist_using_array__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__shell_exec__whitelist_using_array__ls-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__CAST-func_settype_float__find_size-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__CAST-func_settype_int__find_size-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_addslashes__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_escapeshellarg__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_htmlentities__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_match-only_letters__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_match-only_letters__cat-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_match-only_letters__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_replace2__cat-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_replace2__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_replace2__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_replace2__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_replace2__ls-sprintf_%s_simple_quote.php", "command_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_replace__cat-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__func_preg_replace__ls-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__system__whitelist_using_array__cat-concatenation_simple_quote.php");

/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__unserialize__func_FILTER-CLEANING-magic_quotes_filter__ls-interpretation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__unserialize__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__unserialize__func_preg_match-letters_numbers__ls-interpretation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__unserialize__func_preg_match-only_letters__ls-interpretation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__unserialize__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__unserialize__func_preg_replace__ls-interpretation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/safe/CWE_78__unserialize__ternary_white_list__cat-concatenation_simple_quote.php");
 */



/* FALSE POSITIVES */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", "command_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-VALIDATION-email_filter__ls-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-VALIDATION-email_filter__ls-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-VALIDATION-email_filter__ls-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-VALIDATION-email_filter__ls-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__no_sanitizing__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__no_sanitizing__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__no_sanitizing__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__GET__no_sanitizing__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__POST__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__POST__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__POST__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__POST__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", "command_injection");

/* FALSE POSITIVES */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-email_filter__cat-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-email_filter__cat-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-email_filter__cat-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-email_filter__cat-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_preg_match-no_filtering__ls-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_preg_match-no_filtering__ls-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__no_sanitizing__ls-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__no_sanitizing__ls-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__no_sanitizing__ls-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__SESSION__no_sanitizing__ls-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__array-GET__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__array-GET__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__array-GET__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__array-GET__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__array-GET__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__array-GET__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__array-GET__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__array-GET__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php", "command_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", "command_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-full_special_chars_filter__ls-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-full_special_chars_filter__ls-concatenation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-full_special_chars_filter__ls-concatenation_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__func_FILTER-CLEANING-full_special_chars_filter__ls-concatenation_simple_quote.php", "command_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__no_sanitizing__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__no_sanitizing__find_size-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__no_sanitizing__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__backticks__no_sanitizing__find_size-concatenation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", array("66"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__cat-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__cat-interpretation_simple_quote.php", array("70"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__cat-interpretation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", array("70"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("70"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__no_sanitizing__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__no_sanitizing__find_size-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__no_sanitizing__find_size-concatenation_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__fopen__no_sanitizing__find_size-concatenation_simple_quote.php", "command_injection");

/* FALSE POSITIVES */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-Array__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-Array__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-Array__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-Array__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-Array__func_FILTER-VALIDATION-email_filter__ls-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-Array__func_FILTER-VALIDATION-email_filter__ls-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-Array__func_FILTER-VALIDATION-email_filter__ls-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-Array__func_FILTER-VALIDATION-email_filter__ls-sprintf_%s_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", array("68"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", "command_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", array("63"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", "command_injection");
 */
/* FALSE POSITIVES */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-classicGet__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", "file_inclusion");
 */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("58"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", "command_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", array("58"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", "command_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_preg_match-no_filtering__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", array("66"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-directGet__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", array("71"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", "command_injection");

/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__ls-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__ls-sprintf_%s_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__ls-sprintf_%s_simple_quote.php", array("66"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__ls-sprintf_%s_simple_quote.php", "command_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("75"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__object-indexArray__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", array("55"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", array("55"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", "command_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", array("53"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", "command_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", array("59"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("59"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__no_sanitizing__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__no_sanitizing__cat-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__no_sanitizing__cat-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__popen__no_sanitizing__cat-interpretation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php", array("66"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php", "command_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-full_special_chars_filter__cat-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-full_special_chars_filter__cat-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-full_special_chars_filter__cat-interpretation_simple_quote.php", array("63"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-full_special_chars_filter__cat-interpretation_simple_quote.php", "command_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("63"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", "command_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", array("63"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", "command_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__ls-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__ls-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__ls-interpretation_simple_quote.php", array("63"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_FILTER-CLEANING-special_chars_filter__ls-interpretation_simple_quote.php", "command_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", array("70"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", array("70"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("70"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__no_sanitizing__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__no_sanitizing__ls-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__no_sanitizing__ls-concatenation_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__proc_open__no_sanitizing__ls-concatenation_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__shell_exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__shell_exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__shell_exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__shell_exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__shell_exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__shell_exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__shell_exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__shell_exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", "command_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", "command_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", "command_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-special_chars_filter__ls-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-special_chars_filter__ls-sprintf_%s_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-special_chars_filter__ls-sprintf_%s_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__system__func_FILTER-CLEANING-special_chars_filter__ls-sprintf_%s_simple_quote.php", "command_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", "command_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", "command_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", array("54"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", "command_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__cat-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__cat-sprintf_%s_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__cat-sprintf_%s_simple_quote.php", "command_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__cat-sprintf_%s_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__cat-sprintf_%s_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__cat-sprintf_%s_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-concatenation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-concatenation_simple_quote.php", "command_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-concatenation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-concatenation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-sprintf_%s_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-sprintf_%s_simple_quote.php", "command_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-sprintf_%s_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-sprintf_%s_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_78/unsafe/CWE_78__unserialize__no_sanitizing__find_size-sprintf_%s_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__CAST-cast_float_sort_of__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__CAST-cast_int__multiple_AS-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__CAST-cast_int__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__CAST-cast_int_sort_of2__multiple_select-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__CAST-func_settype_float__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__CAST-func_settype_float__select_from_where-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__func_intval__multiple_AS-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__func_intval__select_from_where-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__GET__ternary_white_list__select_from_where-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__CAST-cast_float_sort_of__multiple_select-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__CAST-cast_int__multiple_AS-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__CAST-cast_int__multiple_AS-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__CAST-cast_int__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__CAST-cast_int_sort_of__multiple_select-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__CAST-func_settype_float__select_from_where-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__func_floatval__select_from_where-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__POST__func_preg_match-only_numbers__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__CAST-cast_int_sort_of2__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__CAST-cast_int_sort_of__multiple_AS-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__CAST-cast_int_sort_of__select_from_where-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__func_floatval__multiple_select-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__func_floatval__select_from_where-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__ternary_white_list__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__SESSION__whitelist_using_array_from__select_from-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__CAST-cast_float_sort_of__multiple_select-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__CAST-cast_float_sort_of__select_from_where-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__CAST-cast_int__multiple_AS-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__CAST-cast_int_sort_of2__multiple_AS-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__CAST-cast_int_sort_of__multiple_AS-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__CAST-func_settype_float__multiple_AS-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__func_floatval__multiple_select-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__func_htmlentities__join-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__func_intval__multiple_select-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__array-GET__func_intval__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__CAST-cast_int_sort_of__multiple_AS-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_floatval__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_htmlspecialchars__join-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_mysql_real_escape_string__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_mysql_real_escape_string__multiple_AS-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_mysql_real_escape_string__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_mysql_real_escape_string__multiple_AS-sprintf_%s_simple_quote.php", "sql_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__func_preg_match-only_numbers__select_from_where-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__backticks__whitelist_using_array__join-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__CAST-func_settype_int__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__func_floatval__multiple_select-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__func_intval__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__func_mysql_real_escape_string__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__func_mysql_real_escape_string__multiple_select-sprintf_%d.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__func_mysql_real_escape_string__multiple_select-sprintf_%d.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__func_mysql_real_escape_string__multiple_select-sprintf_%d.php", "sql_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__exec__whitelist_using_array__multiple_AS-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__CAST-cast_float__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__CAST-cast_int_sort_of2__select_from_where-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__func_preg_replace__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__func_preg_replace__select_from-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__func_preg_replace__select_from-sprintf_%s_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__func_preg_replace__select_from-sprintf_%s_simple_quote.php", "sql_injection");


//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__no_sanitizing__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__ternary_white_list__multiple_AS-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__ternary_white_list__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__fopen__whitelist_using_array__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__CAST-cast_int__multiple_select-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__CAST-cast_int__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__CAST-cast_int_sort_of__multiple_AS-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__CAST-cast_int_sort_of__select_from_where-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__CAST-func_settype_float__multiple_AS-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__CAST-func_settype_float__select_from_where-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php", array("66"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php", "sql_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_floatval__multiple_AS-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_floatval__multiple_select-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_floatval__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_floatval__select_from_where-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-Array__func_intval__multiple_AS-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__CAST-cast_float__multiple_AS-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__CAST-cast_int__select_from_where-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__CAST-func_settype_float__multiple_AS-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__CAST-func_settype_int__multiple_AS-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__CAST-func_settype_int__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__CAST-func_settype_int__select_from_where-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_floatval__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_htmlentities__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_htmlentities__join-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_htmlentities__join-sprintf_%s_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_htmlentities__join-sprintf_%s_simple_quote.php", "sql_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_preg_match-only_numbers__multiple_AS-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__func_preg_match-only_numbers__multiple_select-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__ternary_white_list__join-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-classicGet__ternary_white_list__select_from-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__CAST-cast_float_sort_of__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__CAST-cast_int__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__CAST-cast_int_sort_of2__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__CAST-cast_int_sort_of__multiple_select-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_mysql_real_escape_string__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_mysql_real_escape_string__multiple_select-sprintf_%u_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_mysql_real_escape_string__multiple_select-sprintf_%u_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_mysql_real_escape_string__multiple_select-sprintf_%u_simple_quote.php", "sql_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_mysql_real_escape_string__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_mysql_real_escape_string__select_from_where-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_mysql_real_escape_string__select_from_where-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__func_mysql_real_escape_string__select_from_where-sprintf_%s_simple_quote.php", "sql_injection");


//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-directGet__no_sanitizing__multiple_AS-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-indexArray__CAST-cast_float_sort_of__multiple_select-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-indexArray__CAST-cast_int__multiple_select-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-indexArray__CAST-cast_int_sort_of__multiple_select-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-indexArray__CAST-func_settype_float__multiple_AS-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-indexArray__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-indexArray__func_preg_match-only_numbers__multiple_select-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-indexArray__whitelist_using_array__join-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__object-indexArray__whitelist_using_array__select_from-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__CAST-cast_float__multiple_select-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__CAST-cast_float__select_from_where-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__CAST-func_settype_int__multiple_select-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__func_floatval__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__func_intval__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__func_mysql_real_escape_string__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__func_mysql_real_escape_string__multiple_AS-sprintf_%d.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__func_mysql_real_escape_string__multiple_AS-sprintf_%d.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__func_mysql_real_escape_string__multiple_AS-sprintf_%d.php", "sql_injection");


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__ternary_white_list__multiple_AS-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__popen__ternary_white_list__multiple_select-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__CAST-cast_float__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__CAST-cast_float_sort_of__multiple_select-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__CAST-cast_int__select_from_where-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__CAST-cast_int_sort_of2__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__CAST-cast_int_sort_of__multiple_AS-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__func_intval__select_from_where-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__func_intval__select_from_where-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__func_preg_match-only_numbers__select_from_where-concatenation.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__no_sanitizing__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__whitelist_using_array__multiple_AS-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__proc_open__whitelist_using_array__select_from_where-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__CAST-cast_int_sort_of2__multiple_AS-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__CAST-cast_int_sort_of__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__func_intval__multiple_AS-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__ternary_white_list__select_from_where-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__shell_exec__whitelist_using_array__multiple_select-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__CAST-cast_float__multiple_AS-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__CAST-func_settype_float__multiple_select-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__CAST-func_settype_float__select_from_where-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__func_FILTER-CLEANING-magic_quotes_filter__select_from-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__func_preg_match-only_numbers__select_from_where-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__func_preg_replace2__join-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__ternary_white_list__multiple_select-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__ternary_white_list__multiple_select-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__whitelist_using_array__multiple_AS-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__system__whitelist_using_array__multiple_select-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__CAST-cast_float_sort_of__multiple_AS-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__CAST-cast_int__multiple_AS-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__CAST-cast_int__multiple_AS-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__CAST-func_settype_float__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_floatval__multiple_AS-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_intval__multiple_select-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_intval__select_from_where-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_preg_match-only_letters__select_from-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__func_preg_match-only_numbers__multiple_select-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__ternary_white_list__select_from_where-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/safe/CWE_89__unserialize__whitelist_using_array__multiple_select-sprintf_%s_simple_quote.php");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", "sql_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__func_FILTER-VALIDATION-email_filter__select_from-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__func_FILTER-VALIDATION-email_filter__select_from-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__func_FILTER-VALIDATION-email_filter__select_from-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__func_FILTER-VALIDATION-email_filter__select_from-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__join-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__join-sprintf_%s_simple_quote.php", "sql_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__join-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__join-sprintf_%s_simple_quote.php", "xss");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__multiple_AS-interpretation.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__multiple_AS-interpretation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__multiple_AS-interpretation.php", "sql_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__multiple_AS-interpretation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__GET__no_sanitizing__multiple_AS-interpretation.php", "xss");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__POST__func_FILTER-CLEANING-full_special_chars_filter__join-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__POST__func_FILTER-CLEANING-full_special_chars_filter__join-concatenation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__POST__func_FILTER-CLEANING-full_special_chars_filter__join-concatenation_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__POST__func_FILTER-CLEANING-full_special_chars_filter__join-concatenation_simple_quote.php", "sql_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__SESSION__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__SESSION__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__SESSION__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__SESSION__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_FILTER-CLEANING-special_chars_filter__select_from-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_FILTER-CLEANING-special_chars_filter__select_from-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_FILTER-CLEANING-special_chars_filter__select_from-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_FILTER-CLEANING-special_chars_filter__select_from-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_preg_match-no_filtering__select_from-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_preg_match-no_filtering__select_from-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_preg_match-no_filtering__select_from-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__array-GET__func_preg_match-no_filtering__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_FILTER-CLEANING-full_special_chars_filter__join-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_FILTER-CLEANING-full_special_chars_filter__join-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_FILTER-CLEANING-full_special_chars_filter__join-interpretation_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_FILTER-CLEANING-full_special_chars_filter__join-interpretation_simple_quote.php", "sql_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_preg_match-no_filtering__join-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_preg_match-no_filtering__join-concatenation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__backticks__func_preg_match-no_filtering__join-concatenation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", "sql_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", array("54"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", "sql_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_select-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_select-interpretation_simple_quote.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_select-interpretation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_select-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_select-interpretation_simple_quote.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__exec__no_sanitizing__multiple_select-interpretation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", array("60"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", array("60"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", "sql_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", array("58"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", "sql_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__no_sanitizing__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__no_sanitizing__select_from-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__no_sanitizing__select_from-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__no_sanitizing__select_from-sprintf_%s_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__no_sanitizing__select_from-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__no_sanitizing__select_from-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-directGet__no_sanitizing__select_from-sprintf_%s_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("68"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("68"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_preg_match-no_filtering__join-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("75"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_preg_match-no_filtering__join-concatenation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("75"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__object-indexArray__func_preg_match-no_filtering__join-concatenation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("55"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("55"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", array("59"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", array("59"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__popen__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", "sql_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_FILTER-VALIDATION-email_filter__join-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_FILTER-VALIDATION-email_filter__join-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_FILTER-VALIDATION-email_filter__join-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_FILTER-VALIDATION-email_filter__join-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_mysql_real_escape_string__multiple_select-interpretation.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_mysql_real_escape_string__multiple_select-interpretation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_mysql_real_escape_string__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_mysql_real_escape_string__multiple_select-interpretation.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_mysql_real_escape_string__multiple_select-interpretation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_mysql_real_escape_string__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__func_mysql_real_escape_string__multiple_select-interpretation.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-sprintf_%s_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__shell_exec__no_sanitizing__multiple_AS-sprintf_%s_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_preg_match-no_filtering__join-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_preg_match-no_filtering__join-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_preg_match-no_filtering__join-interpretation_simple_quote.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_preg_match-no_filtering__join-interpretation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_preg_match-no_filtering__join-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_preg_match-no_filtering__join-interpretation_simple_quote.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__func_preg_match-no_filtering__join-interpretation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__no_sanitizing__multiple_AS-concatenation.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__no_sanitizing__multiple_AS-concatenation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__no_sanitizing__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__no_sanitizing__multiple_AS-concatenation.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__no_sanitizing__multiple_AS-concatenation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__no_sanitizing__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__system__no_sanitizing__multiple_AS-concatenation.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", "xss");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_89/unsafe/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php", "sql_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_pg_escape_literal__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_preg_match-letters_numbers__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_preg_match-letters_numbers__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_preg_match-only_letters__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_preg_replace_ldap_char_white_list__userByMail-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__func_str_replace_ldap_char_black_list__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__whitelist_using_array__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__whitelist_using_array__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__whitelist_using_array__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__GET__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_FILTER-CLEANING-full_special_chars_filter__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_FILTER-CLEANING-full_special_chars_filter__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_FILTER-CLEANING-full_special_chars_filter__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_FILTER-CLEANING-special_chars_filter__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_preg_match-only_letters__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_preg_match-only_letters__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_preg_match-only_letters__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__func_str_replace_ldap_char_black_list__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__ternary_white_list__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__POST__whitelist_using_array__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_pg_escape_literal__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_preg_match-only_letters__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_preg_replace_ldap_char_white_list__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_preg_replace_ldap_char_white_list__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__func_str_replace_ldap_char_black_list__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__ternary_white_list__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__ternary_white_list__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__whitelist_using_array__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__SESSION__whitelist_using_array__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__array-GET__func_FILTER-CLEANING-full_special_chars_filter__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__array-GET__func_FILTER-CLEANING-special_chars_filter__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__array-GET__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__array-GET__func_str_replace_ldap_char_black_list__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__array-GET__ternary_white_list__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__array-GET__ternary_white_list__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__array-GET__ternary_white_list__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__array-GET__ternary_white_list__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__backticks__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__backticks__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-interpretation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__backticks__ternary_white_list__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__backticks__ternary_white_list__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__backticks__ternary_white_list__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__backticks__ternary_white_list__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_pg_escape_literal__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_pg_escape_literal__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_preg_match-letters_numbers__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_preg_match-letters_numbers__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_preg_match-letters_numbers__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_preg_match-only_letters__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__func_str_replace_ldap_char_black_list__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__ternary_white_list__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__exec__whitelist_using_array__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_FILTER-CLEANING-special_chars_filter__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_pg_escape_literal__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_preg_match-only_letters__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_preg_match-only_letters__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_preg_replace_ldap_char_white_list__userByCN-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__func_str_replace_ldap_char_black_list__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__fopen__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_pg_escape_literal__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_preg_match-only_letters__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_preg_match-only_letters__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_preg_match-only_letters__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_preg_match-only_letters__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_str_replace_ldap_char_black_list__name-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_str_replace_ldap_char_black_list__name-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__func_str_replace_ldap_char_black_list__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-Array__whitelist_using_array__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__func_preg_match-letters_numbers__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__func_preg_match-letters_numbers__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__func_preg_replace_ldap_char_white_list__not_name-interpretation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__func_str_replace_ldap_char_black_list__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__ternary_white_list__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__ternary_white_list__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__whitelist_using_array__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-classicGet__whitelist_using_array__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__func_pg_escape_literal__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__func_pg_escape_literal__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__func_str_replace_ldap_char_black_list__not_name-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__func_str_replace_ldap_char_black_list__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__ternary_white_list__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-directGet__ternary_white_list__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-indexArray__func_FILTER-CLEANING-special_chars_filter__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-indexArray__func_pg_escape_literal__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-indexArray__func_preg_match-letters_numbers__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-indexArray__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-indexArray__func_str_replace_ldap_char_black_list__userByCN-interpretation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-indexArray__func_str_replace_ldap_char_black_list__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__object-indexArray__ternary_white_list__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__func_FILTER-CLEANING-full_special_chars_filter__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__func_preg_match-letters_numbers__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__func_preg_match-letters_numbers__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__func_preg_match-letters_numbers__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__func_preg_match-letters_numbers__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__func_preg_match-only_letters__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__func_preg_match-only_letters__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__whitelist_using_array__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__whitelist_using_array__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__whitelist_using_array__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__popen__whitelist_using_array__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_FILTER-CLEANING-full_special_chars_filter__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_FILTER-CLEANING-special_chars_filter__userByCN-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_pg_escape_literal__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_preg_match-letters_numbers__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_preg_replace_ldap_char_white_list__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__func_str_replace_ldap_char_black_list__name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__proc_open__ternary_white_list__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_FILTER-CLEANING-special_chars_filter__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_preg_match-letters_numbers__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_preg_match-letters_numbers__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_preg_match-only_letters__not_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_preg_match-only_letters__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__func_preg_replace_ldap_char_white_list__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__ternary_white_list__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__ternary_white_list__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__ternary_white_list__userByMail-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__whitelist_using_array__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__shell_exec__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__func_FILTER-CLEANING-full_special_chars_filter__name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__func_FILTER-CLEANING-full_special_chars_filter__not_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__func_FILTER-CLEANING-full_special_chars_filter__userByMail-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__func_pg_escape_literal__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__func_pg_escape_literal__userByCN-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__func_str_replace_ldap_char_black_list__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__ternary_white_list__name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__ternary_white_list__not_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__system__ternary_white_list__userByMail-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_FILTER-CLEANING-full_special_chars_filter__name-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_pg_escape_literal__name-interpretation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_pg_escape_literal__name-sprintf_%s_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_pg_escape_literal__not_name-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_pg_escape_literal__userByCN-sprintf_%s_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_preg_match-only_letters__name-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/safe/CWE_90__unserialize__whitelist_using_array__userByCN-concatenation_simple_quote.php");
 */
// f21518eb985aa38453f8250971fbb915b672f48fbd811c88316d21090923c260

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-magic_quotes_filter__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-magic_quotes_filter__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-magic_quotes_filter__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_FILTER-CLEANING-magic_quotes_filter__not_name-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_addslashes__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_pg_escape_string__userByCN-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_pg_escape_string__userByCN-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_pg_escape_string__userByMail-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_pg_escape_string__userByMail-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_pg_escape_string__userByMail-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_pg_escape_string__userByMail-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace2__userByMail-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace2__userByMail-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace2__userByMail-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace2__userByMail-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace__userByCN-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace__userByCN-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace__userByCN-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__func_preg_replace__userByCN-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__no_sanitizing__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__no_sanitizing__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__no_sanitizing__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__GET__no_sanitizing__not_name-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-CLEANING-email_filter__userByMail-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-CLEANING-email_filter__userByMail-interpretation_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-CLEANING-email_filter__userByMail-interpretation_simple_quote.php", array("53"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-CLEANING-email_filter__userByMail-interpretation_simple_quote.php", "ldap_injection");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_addslashes__name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_addslashes__name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_addslashes__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_addslashes__name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_addslashes__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_addslashes__userByMail-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_addslashes__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_addslashes__userByMail-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_htmlentities__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__userByMail-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__userByMail-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__userByMail-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__userByMail-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__userByMail-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__userByMail-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__userByMail-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__func_pg_escape_string__userByMail-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__userByCN-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__userByMail-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__POST__no_sanitizing__userByMail-concatenation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-email_filter__userByMail-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-email_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-email_filter__userByMail-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-email_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_addslashes__name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_addslashes__name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_addslashes__name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_addslashes__name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_addslashes__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_addslashes__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_addslashes__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_addslashes__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlentities__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlentities__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlentities__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlentities__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlentities__name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlentities__name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlentities__name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlentities__name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlspecialchars__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlspecialchars__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlspecialchars__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_htmlspecialchars__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_pg_escape_string__userByMail-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_pg_escape_string__userByMail-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_pg_escape_string__userByMail-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_pg_escape_string__userByMail-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByCN-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByCN-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByCN-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByCN-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByMail-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByMail-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace2__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace__userByMail-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace__userByMail-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace__userByMail-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__func_preg_replace__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__no_sanitizing__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__no_sanitizing__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__no_sanitizing__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__SESSION__no_sanitizing__userByMail-concatenation_simple_quote.php", "file_inclusion");
 */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlentities__name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlentities__name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlentities__name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlentities__name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlentities__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlentities__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlentities__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlentities__not_name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_pg_escape_string__userByCN-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_pg_escape_string__userByCN-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_pg_escape_string__userByCN-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_pg_escape_string__userByCN-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_replace2__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_replace2__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_replace2__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_replace2__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_replace__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_replace__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_replace__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__func_preg_replace__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__no_sanitizing__name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__no_sanitizing__name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__no_sanitizing__name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__no_sanitizing__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__no_sanitizing__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__no_sanitizing__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__no_sanitizing__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__array-GET__no_sanitizing__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", array("53"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_addslashes__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_addslashes__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_addslashes__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_addslashes__not_name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_addslashes__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_addslashes__userByCN-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_addslashes__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_addslashes__userByCN-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_htmlentities__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_htmlentities__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_htmlentities__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_htmlentities__userByCN-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_pg_escape_string__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_pg_escape_string__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_pg_escape_string__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_pg_escape_string__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace2__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace2__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace2__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace2__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__func_preg_replace__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__no_sanitizing__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__no_sanitizing__userByMail-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__no_sanitizing__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__backticks__no_sanitizing__userByMail-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_addslashes__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_addslashes__name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_addslashes__name-sprintf_%s_simple_quote.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_addslashes__name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlentities__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlentities__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlentities__not_name-sprintf_%s_simple_quote.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlentities__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlentities__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlentities__userByMail-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlentities__userByMail-concatenation_simple_quote.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlentities__userByMail-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlspecialchars__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("52"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_htmlspecialchars__not_name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", array("58"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace2__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace2__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace2__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace2__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace2__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace2__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace2__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace2__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__exec__func_preg_replace__name-sprintf_%s_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__name-interpretation_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByCN-interpretation_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByCN-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByCN-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByCN-sprintf_%s_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByMail-sprintf_%s_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_addslashes__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlentities__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlentities__name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlentities__name-sprintf_%s_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlentities__name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_preg_replace__userByCN-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_preg_replace__userByCN-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_preg_replace__userByCN-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__func_preg_replace__userByCN-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__no_sanitizing__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("62"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__fopen__no_sanitizing__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", array("68"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", array("68"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", array("68"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__userByMail-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__userByMail-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__userByMail-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-CLEANING-magic_quotes_filter__userByMail-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-VALIDATION-email_filter__not_name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-VALIDATION-email_filter__not_name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-VALIDATION-email_filter__not_name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-VALIDATION-email_filter__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_addslashes__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_addslashes__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_addslashes__userByCN-interpretation_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_addslashes__userByCN-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_htmlentities__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_htmlentities__not_name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_htmlentities__not_name-concatenation_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_htmlentities__not_name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_htmlentities__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_htmlentities__userByMail-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_htmlentities__userByMail-concatenation_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_htmlentities__userByMail-concatenation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_pg_escape_string__userByCN-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_pg_escape_string__userByCN-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_preg_replace2__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_preg_replace2__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_preg_replace2__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_preg_replace2__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_preg_replace2__userByCN-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_preg_replace2__userByCN-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_preg_replace2__userByCN-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-Array__func_preg_replace2__userByCN-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php", array("65"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_addslashes__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_addslashes__name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_addslashes__name-concatenation_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_addslashes__name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_addslashes__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_addslashes__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_match-no_filtering__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_match-no_filtering__name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_match-no_filtering__name-concatenation_simple_quote.php", array("72"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_match-no_filtering__name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", array("72"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace2__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace2__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace2__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace2__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace__userByMail-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace__userByMail-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace__userByMail-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-classicGet__func_preg_replace__userByMail-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", array("60"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", array("60"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_addslashes__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_addslashes__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__name-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__not_name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__userByMail-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_htmlspecialchars__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", array("\$query"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", array("56"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php", array("66"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php", array("66"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php", array("66"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_replace__userByMail-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_replace__userByMail-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_replace__userByMail-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__func_preg_replace__userByMail-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__no_sanitizing__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__no_sanitizing__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__no_sanitizing__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__no_sanitizing__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__no_sanitizing__userByMail-sprintf_%s_simple_quote.php", array("56"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-directGet__no_sanitizing__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__not_name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__not_name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__not_name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__not_name-sprintf_%s_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__not_name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__not_name-concatenation_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__not_name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByCN-interpretation_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByCN-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByCN-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByCN-sprintf_%s_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByMail-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByMail-interpretation_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlentities__userByMail-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlspecialchars__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlspecialchars__not_name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_pg_escape_string__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_pg_escape_string__not_name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace2__name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace2__name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace2__name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace2__name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace2__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace2__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace2__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace2__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace__userByMail-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace__userByMail-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace__userByMail-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__func_preg_replace__userByMail-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__no_sanitizing__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__no_sanitizing__name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__no_sanitizing__name-concatenation_simple_quote.php", array("64"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__object-indexArray__no_sanitizing__name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("55"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php", array("55"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-magic_quotes_filter__userByCN-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-magic_quotes_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-magic_quotes_filter__userByCN-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_FILTER-CLEANING-magic_quotes_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__not_name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__not_name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__userByCN-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_pg_escape_string__userByCN-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", array("59"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_replace2__name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_replace2__name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_replace2__name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_replace2__name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_replace__userByMail-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_replace__userByMail-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_replace__userByMail-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__func_preg_replace__userByMail-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__name-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__userByCN-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__userByCN-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__userByMail-sprintf_%s_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__popen__no_sanitizing__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("65"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_addslashes__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_addslashes__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_htmlentities__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_htmlentities__not_name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_htmlentities__not_name-concatenation_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_htmlentities__not_name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_htmlentities__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_htmlentities__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__not_name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__not_name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__not_name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__userByCN-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__userByCN-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", array("70"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace2__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace2__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace2__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace2__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace__not_name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace__not_name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace__not_name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace__not_name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace__userByMail-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace__userByMail-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__func_preg_replace__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__no_sanitizing__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__no_sanitizing__name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__no_sanitizing__name-sprintf_%s_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__no_sanitizing__name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__no_sanitizing__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("61"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__proc_open__no_sanitizing__not_name-sprintf_%s_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_addslashes__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_addslashes__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_addslashes__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_addslashes__userByMail-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_addslashes__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_addslashes__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_htmlentities__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_htmlentities__name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_htmlentities__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_htmlentities__name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_htmlentities__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_htmlentities__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_htmlentities__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_htmlentities__userByCN-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_pg_escape_string__userByCN-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_pg_escape_string__userByCN-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_pg_escape_string__userByMail-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_pg_escape_string__userByMail-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_pg_escape_string__userByMail-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_pg_escape_string__userByMail-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace2__not_name-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace2__not_name-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace2__not_name-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace2__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace2__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace__name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace__name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace__name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace__name-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__func_preg_replace__not_name-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__no_sanitizing__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__no_sanitizing__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__shell_exec__no_sanitizing__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_addslashes__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_addslashes__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_addslashes__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlentities__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlentities__userByCN-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlentities__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlentities__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlspecialchars__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlspecialchars__userByCN-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlspecialchars__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlspecialchars__userByCN-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlspecialchars__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_htmlspecialchars__userByMail-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_pg_escape_string__not_name-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_pg_escape_string__not_name-interpretation_simple_quote.php", "file_inclusion");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php", array("57"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__no_sanitizing__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__no_sanitizing__not_name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__no_sanitizing__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__system__no_sanitizing__not_name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", array("55"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_addslashes__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_addslashes__userByCN-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_addslashes__userByCN-concatenation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_addslashes__userByCN-concatenation_simple_quote.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_addslashes__userByCN-concatenation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_addslashes__userByCN-concatenation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_addslashes__userByCN-concatenation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__name-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__name-interpretation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__name-interpretation_simple_quote.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__name-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__not_name-interpretation_simple_quote.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__not_name-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__not_name-interpretation_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", array("51"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_htmlspecialchars__userByCN-interpretation_simple_quote.php", "ldap_injection");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_pg_escape_string__name-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_pg_escape_string__name-concatenation_simple_quote.php", array("\$string"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_pg_escape_string__name-concatenation_simple_quote.php", array("51"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_pg_escape_string__name-concatenation_simple_quote.php", "code_injection");
 */
$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_pg_escape_string__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_pg_escape_string__not_name-interpretation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", "code_injection");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", array("\$query"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", array("59"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace2__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace2__not_name-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace2__not_name-concatenation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace2__not_name-concatenation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace2__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace2__userByMail-interpretation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace2__userByMail-interpretation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace2__userByMail-interpretation_simple_quote.php", "code_injection");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace__userByMail-concatenation_simple_quote.php", array("\$string"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace__userByMail-concatenation_simple_quote.php", array("45"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_90/unsafe/CWE_90__unserialize__func_preg_replace__userByMail-concatenation_simple_quote.php", "code_injection");

// 23a27cc66d3d97e2849446df929084b7f70f0fe2be3c4b17b6c34d7a61951cc2

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__CAST-cast_float__ID_test-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__CAST-cast_int_sort_of2__ID_test-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__func_intval__ID_test-concatenation.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__func_mysql_real_escape_string__ID_at-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__func_preg_match-letters_numbers__username-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__object-func_mysql_real_escape_stringGetter__data-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__object-func_mysql_real_escape_stringGetter__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__GET__ternary_white_list__ID_test-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__CAST-cast_float__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__CAST-cast_float_sort_of__ID_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__func_floatval__ID_test-interpretation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__func_mysql_real_escape_string__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__func_preg_match-only_letters__username_text-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__func_preg_match-only_numbers__ID_test-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__func_preg_match-only_numbers__ID_test-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__ternary_white_list__username_at-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__POST__whitelist_using_array__ID_test-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__CAST-cast_int_sort_of2__ID_test-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__CAST-func_settype_int__ID_test-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__func_floatval__ID_test-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__func_preg_replace2__username_text-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__func_preg_replace__data-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__func_preg_replace__username-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__func_preg_replace__username-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__func_preg_replace__username-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__object-func_mysql_real_escape_string__username_at-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__SESSION__whitelist_using_array__username-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__CAST-cast_int_sort_of2__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__func_floatval__ID_test-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__func_mysql_real_escape_string__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__func_preg_match-only_letters__data-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__array-GET__object-func_mysql_real_escape_string__username_text-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__backticks__CAST-func_settype_int__ID_test-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__backticks__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__backticks__func_addslashes__username_text-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__backticks__ternary_white_list__username-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__exec__func_htmlspecialchars__username-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__CAST-cast_float_sort_of__ID_test-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__CAST-func_settype_int__ID_test-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__func_FILTER-CLEANING-magic_quotes_filter__data-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__func_FILTER-CLEANING-magic_quotes_filter__username_text-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__func_floatval__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__ternary_white_list__ID_test-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__ternary_white_list__username-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__ternary_white_list__username_at-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__fopen__whitelist_using_array__ID_test-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-Array__CAST-cast_int__ID_test-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-Array__CAST-cast_int__ID_test-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-Array__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-Array__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-Array__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-Array__func_intval__ID_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-Array__func_preg_match-letters_numbers__data-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-classicGet__CAST-cast_float__ID_test-interpretation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-classicGet__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-classicGet__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-classicGet__func_mysql_real_escape_string__ID_test-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-classicGet__no_sanitizing__ID_at-sprintf_%u_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-classicGet__object-func_mysql_real_escape_string__username-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-directGet__CAST-cast_int_sort_of__ID_test-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-directGet__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-directGet__func_preg_match-only_letters__username_text-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-directGet__whitelist_using_array__ID_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__CAST-func_settype_float__ID_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__CAST-func_settype_float__ID_test-sprintf_%d.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__username_text-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__func_addslashes__username_text-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__func_preg_match-only_letters__username_text-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__func_preg_match-only_numbers__ID_test-concatenation.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__ternary_white_list__data-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__object-indexArray__ternary_white_list__username_text-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__popen__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__popen__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__popen__whitelist_using_array__username_text-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__func_addslashes__username_text-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__func_htmlspecialchars__username_text-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__func_intval__ID_at-sprintf_%u.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__func_mysql_real_escape_string__ID_test-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__func_preg_match-only_letters__username_at-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__object-func_mysql_real_escape_stringGetter__username-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__object-func_mysql_real_escape_stringGetter__username-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__object-func_mysql_real_escape_string__username_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__proc_open__whitelist_using_array__data-concatenation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__shell_exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__shell_exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__shell_exec__func_preg_match-only_letters__username_text-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__CAST-cast_int_sort_of2__ID_test-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__CAST-cast_int_sort_of__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__func_htmlentities__username_at-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__func_preg_match-letters_numbers__username_text-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__func_preg_match-only_letters__username-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__func_preg_replace2__username_at-interpretation_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__func_preg_replace__username_text-sprintf_%s_simple_quote.php");

//$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__system__object-func_mysql_real_escape_string__username-concatenation_simple_quote.php");
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__CAST-cast_float__ID_test-concatenation.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__CAST-cast_float_sort_of__ID_test-interpretation.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__func_addslashes__username_at-concatenation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__func_preg_match-letters_numbers__data-interpretation_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__func_preg_match-only_numbers__ID_at-sprintf_%s_simple_quote.php");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/safe/CWE_91__unserialize__object-func_mysql_real_escape_string__data-concatenation_simple_quote.php");
 */
// d08fa3a5ae4406da894223ba9fa4e479698faa81bbc2ff1e9e3980153bba0965

/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-VALIDATION-email_filter__username_text-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-VALIDATION-email_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-VALIDATION-email_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__func_FILTER-VALIDATION-email_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__no_sanitizing__username_text-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__no_sanitizing__username_text-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__no_sanitizing__username_text-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__GET__no_sanitizing__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__func_FILTER-VALIDATION-email_filter__username_at-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__func_FILTER-VALIDATION-email_filter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__func_FILTER-VALIDATION-email_filter__username_at-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__func_FILTER-VALIDATION-email_filter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__no_sanitizing__ID_test-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__no_sanitizing__ID_test-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__no_sanitizing__ID_test-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__POST__no_sanitizing__ID_test-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_preg_match-no_filtering__username-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_preg_match-no_filtering__username-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_preg_match-no_filtering__username-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_preg_match-no_filtering__username-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_preg_match-no_filtering__username-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_preg_match-no_filtering__username-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_preg_match-no_filtering__username-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__SESSION__func_preg_match-no_filtering__username-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__no_sanitizing__data-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__no_sanitizing__data-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__no_sanitizing__data-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__array-GET__no_sanitizing__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__no_sanitizing__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__no_sanitizing__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__no_sanitizing__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__backticks__no_sanitizing__username-sprintf_%s_simple_quote.php", "file_inclusion");
 */
/*
     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__no_sanitizing__data-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__no_sanitizing__data-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__no_sanitizing__data-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__exec__no_sanitizing__data-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__fopen__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__fopen__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__fopen__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__fopen__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__fopen__func_preg_match-no_filtering__username-concatenation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__fopen__func_preg_match-no_filtering__username-concatenation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__fopen__func_preg_match-no_filtering__username-concatenation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__fopen__func_preg_match-no_filtering__username-concatenation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__username_at-interpretation_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__username_at-interpretation_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__username_at-interpretation_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

     $framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__username_text-sprintf_%s_simple_quote.php");
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
     $framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_FILTER-CLEANING-full_special_chars_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-Array__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-email_filter__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-email_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-email_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-email_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-special_chars_filter__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-special_chars_filter__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-special_chars_filter__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_FILTER-CLEANING-special_chars_filter__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_preg_match-no_filtering__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_preg_match-no_filtering__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_preg_match-no_filtering__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__func_preg_match-no_filtering__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__no_sanitizing__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__no_sanitizing__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__no_sanitizing__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-classicGet__no_sanitizing__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-email_filter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-email_filter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-email_filter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-email_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__no_sanitizing__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__no_sanitizing__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__no_sanitizing__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-directGet__no_sanitizing__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-special_chars_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-special_chars_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-special_chars_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-CLEANING-special_chars_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-VALIDATION-email_filter__data-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-VALIDATION-email_filter__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-VALIDATION-email_filter__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_FILTER-VALIDATION-email_filter__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_preg_match-no_filtering__data-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_preg_match-no_filtering__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_preg_match-no_filtering__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__func_preg_match-no_filtering__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__data-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__object-indexArray__no_sanitizing__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-special_chars_filter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-special_chars_filter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-special_chars_filter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_FILTER-CLEANING-special_chars_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_preg_match-no_filtering__data-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_preg_match-no_filtering__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_preg_match-no_filtering__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__func_preg_match-no_filtering__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__no_sanitizing__data-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__no_sanitizing__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__no_sanitizing__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__popen__no_sanitizing__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-email_filter__username-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-email_filter__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-email_filter__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-email_filter__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-full_special_chars_filter__username-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-full_special_chars_filter__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-full_special_chars_filter__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-full_special_chars_filter__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-special_chars_filter__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-special_chars_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-special_chars_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__proc_open__func_FILTER-CLEANING-special_chars_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__data-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__username-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-special_chars_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-special_chars_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-special_chars_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_FILTER-CLEANING-special_chars_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__no_sanitizing__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__no_sanitizing__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__no_sanitizing__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__shell_exec__no_sanitizing__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_preg_match-no_filtering__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_preg_match-no_filtering__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_preg_match-no_filtering__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__func_preg_match-no_filtering__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__no_sanitizing__username-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__no_sanitizing__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__no_sanitizing__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__system__no_sanitizing__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_FILTER-VALIDATION-email_filter__username-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_FILTER-VALIDATION-email_filter__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_FILTER-VALIDATION-email_filter__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_FILTER-VALIDATION-email_filter__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__no_sanitizing__username-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__no_sanitizing__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__no_sanitizing__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__no_sanitizing__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__no_sanitizing__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__no_sanitizing__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__no_sanitizing__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_91/unsafe/CWE_91__unserialize__no_sanitizing__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

// 6feffcc04ba99c804cdb4df0292bb85c2b197f1f5c280d3a198518a5d7f9dbcf

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__GET__CAST-cast_int_sort_of2__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__GET__CAST-cast_int_sort_of__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__GET__func_FILTER-CLEANING-number_int_filter__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__POST__CAST-cast_int_sort_of__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__POST__func_floatval__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__POST__whitelist_using_array__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__SESSION__CAST-cast_float__variable-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__SESSION__CAST-cast_int_sort_of2__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__SESSION__func_preg_match-letters_numbers__echo-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__SESSION__whitelist_using_array__echo-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__array-GET__CAST-cast_int_sort_of2__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__array-GET__func_FILTER-VALIDATION-number_int_filter__variable-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__array-GET__func_floatval__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__array-GET__func_htmlentities__echo-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__array-GET__func_htmlentities__echo-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__array-GET__func_mysql_real_escape_string__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__array-GET__func_preg_replace2__echo-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__array-GET__ternary_white_list__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__backticks__CAST-cast_float__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__backticks__func_FILTER-VALIDATION-number_float_filter__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__backticks__ternary_white_list__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__exec__func_floatval__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__exec__func_preg_replace__echo-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__exec__whitelist_using_array__echo-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__exec__whitelist_using_array__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__fopen__func_FILTER-VALIDATION-number_int_filter__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__fopen__func_mysql_real_escape_string__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-Array__CAST-cast_int_sort_of2__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-Array__CAST-cast_int_sort_of__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-Array__func_FILTER-CLEANING-magic_quotes_filter__echo-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-Array__func_floatval__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-Array__func_preg_match-only_letters__echo-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-Array__func_preg_match-only_numbers__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-Array__whitelist_using_array__echo-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-classicGet__func_FILTER-CLEANING-number_int_filter__variable-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-classicGet__ternary_white_list__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-indexArray__func_FILTER-CLEANING-number_int_filter__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-indexArray__func_preg_replace2__echo-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__object-indexArray__whitelist_using_array__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__popen__CAST-cast_int__variable-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__popen__CAST-cast_int_sort_of__variable-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__popen__func_preg_match-letters_numbers__echo-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__popen__func_preg_replace2__echo-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__popen__func_preg_replace__echo-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__proc_open__func_FILTER-CLEANING-magic_quotes_filter__echo-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__proc_open__func_FILTER-VALIDATION-number_float_filter__variable-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__proc_open__func_FILTER-VALIDATION-number_int_filter__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__proc_open__func_mysql_real_escape_string__variable-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__proc_open__func_mysql_real_escape_string__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__shell_exec__func_preg_match-only_letters__echo-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__system__CAST-func_settype_int__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__system__func_preg_match-only_numbers__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__unserialize__CAST-func_settype_float__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__unserialize__func_FILTER-CLEANING-number_float_filter__variable-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__unserialize__func_FILTER-VALIDATION-number_float_filter__variable-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/safe/CWE_95__unserialize__func_floatval__variable-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-full_special_chars_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-full_special_chars_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-full_special_chars_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-full_special_chars_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__GET__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__func_preg_match-no_filtering__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__no_sanitizing__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__no_sanitizing__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__no_sanitizing__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__POST__no_sanitizing__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__SESSION__func_FILTER-CLEANING-email_filter__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__SESSION__func_FILTER-CLEANING-email_filter__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__SESSION__func_FILTER-CLEANING-email_filter__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__SESSION__func_FILTER-CLEANING-email_filter__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__array-GET__func_preg_match-no_filtering__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__array-GET__func_preg_match-no_filtering__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__array-GET__func_preg_match-no_filtering__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__array-GET__func_preg_match-no_filtering__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__backticks__no_sanitizing__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__backticks__no_sanitizing__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__backticks__no_sanitizing__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__backticks__no_sanitizing__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__fopen__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-Array__func_FILTER-VALIDATION-email_filter__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-Array__func_FILTER-VALIDATION-email_filter__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-Array__func_FILTER-VALIDATION-email_filter__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-Array__func_FILTER-VALIDATION-email_filter__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-classicGet__func_FILTER-CLEANING-special_chars_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-classicGet__func_FILTER-CLEANING-special_chars_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-classicGet__func_FILTER-CLEANING-special_chars_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-classicGet__func_FILTER-CLEANING-special_chars_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-classicGet__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-classicGet__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-classicGet__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-classicGet__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-directGet__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-directGet__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-directGet__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-directGet__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-directGet__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-directGet__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-directGet__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-directGet__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-indexArray__no_sanitizing__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-indexArray__no_sanitizing__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-indexArray__no_sanitizing__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__object-indexArray__no_sanitizing__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__no_sanitizing__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__no_sanitizing__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__no_sanitizing__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__no_sanitizing__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__no_sanitizing__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__no_sanitizing__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__no_sanitizing__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__popen__no_sanitizing__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__func_FILTER-CLEANING-full_special_chars_filter__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__func_FILTER-CLEANING-full_special_chars_filter__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__func_FILTER-CLEANING-full_special_chars_filter__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__func_FILTER-CLEANING-full_special_chars_filter__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__no_sanitizing__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__no_sanitizing__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__no_sanitizing__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__proc_open__no_sanitizing__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__shell_exec__no_sanitizing__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__shell_exec__no_sanitizing__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__shell_exec__no_sanitizing__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__shell_exec__no_sanitizing__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__system__no_sanitizing__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__system__no_sanitizing__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__system__no_sanitizing__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__system__no_sanitizing__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__system__no_sanitizing__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__system__no_sanitizing__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__system__no_sanitizing__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__system__no_sanitizing__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__unserialize__func_preg_match-no_filtering__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__unserialize__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__unserialize__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_95/unsafe/CWE_95__unserialize__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", "file_inclusion");

// b296ea59a2d8901f7f124b9a50f0c66e5124282d16355560ea1be992008a2d79


$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__GET__CAST-cast_float_sort_of__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__GET__CAST-cast_float_sort_of__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__GET__CAST-cast_int_sort_of2__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__GET__func_FILTER-CLEANING-number_float_filter__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__GET__func_FILTER-CLEANING-number_int_filter__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__GET__func_htmlentities__include_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__GET__func_preg_replace2__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__GET__func_preg_replace__include_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__CAST-func_settype_float__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__func_FILTER-CLEANING-number_float_filter__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__func_FILTER-VALIDATION-number_int_filter__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__func_addslashes__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__func_intval__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__func_preg_match-only_letters__require_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__func_preg_replace2__require_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__ternary_white_list__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__POST__whitelist_using_array__require_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__SESSION__CAST-cast_float__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__SESSION__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__SESSION__func_FILTER-CLEANING-number_float_filter__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__SESSION__func_addslashes__require_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__SESSION__func_floatval__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__SESSION__func_mysql_real_escape_string__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__SESSION__ternary_white_list__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__SESSION__ternary_white_list__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__CAST-cast_int__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__CAST-cast_int_sort_of2__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__CAST-cast_int_sort_of2__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__CAST-func_settype_int__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__func_FILTER-CLEANING-number_int_filter__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__func_floatval__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__func_htmlspecialchars__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__func_preg_match-only_letters__require_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__func_preg_replace__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__ternary_white_list__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__array-GET__whitelist_using_array__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__backticks__CAST-func_settype_float__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__backticks__func_FILTER-CLEANING-number_int_filter__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__backticks__func_FILTER-CLEANING-number_int_filter__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__backticks__func_FILTER-VALIDATION-number_float_filter__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__backticks__func_intval__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__backticks__func_preg_replace2__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__backticks__ternary_white_list__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__backticks__whitelist_using_array__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__exec__func_addslashes__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__exec__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__fopen__CAST-cast_int_sort_of__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__fopen__func_FILTER-VALIDATION-number_int_filter__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__fopen__func_FILTER-VALIDATION-number_int_filter__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__fopen__func_htmlspecialchars__include_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__fopen__func_mysql_real_escape_string__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__fopen__func_mysql_real_escape_string__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__fopen__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__fopen__ternary_white_list__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-Array__CAST-cast_int_sort_of2__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-Array__CAST-cast_int_sort_of2__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-Array__CAST-func_settype_float__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-Array__func_FILTER-VALIDATION-number_float_filter__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-Array__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-classicGet__func_FILTER-CLEANING-number_float_filter__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-classicGet__func_FILTER-CLEANING-number_float_filter__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-classicGet__func_intval__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-classicGet__func_intval__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-classicGet__func_intval__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-classicGet__func_preg_replace2__require_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-classicGet__whitelist_using_array__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-classicGet__whitelist_using_array__require_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-directGet__CAST-func_settype_float__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-directGet__func_FILTER-VALIDATION-number_float_filter__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-directGet__func_preg_match-only_numbers__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-directGet__func_preg_match-only_numbers__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-directGet__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-directGet__ternary_white_list__include_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-directGet__ternary_white_list__include_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__CAST-cast_int_sort_of2__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__CAST-cast_int_sort_of2__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__CAST-func_settype_float__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__func_FILTER-VALIDATION-number_float_filter__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__func_addslashes__include_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__func_addslashes__require_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__func_intval__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__func_mysql_real_escape_string__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__func_preg_match-letters_numbers__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__whitelist_using_array__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__object-indexArray__whitelist_using_array__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__CAST-cast_float_sort_of__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__CAST-cast_float_sort_of__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__CAST-cast_int__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__CAST-cast_int_sort_of__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__CAST-func_settype_int__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__CAST-func_settype_int__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__func_FILTER-VALIDATION-number_int_filter__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__func_intval__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__func_preg_replace__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__popen__ternary_white_list__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__CAST-func_settype_float__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__func_FILTER-CLEANING-number_float_filter__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__func_floatval__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__func_htmlspecialchars__include_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__func_htmlspecialchars__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__func_intval__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__func_preg_match-letters_numbers__include_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__proc_open__ternary_white_list__require_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__shell_exec__CAST-cast_int__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__shell_exec__func_FILTER-CLEANING-number_int_filter__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__shell_exec__func_addslashes__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__shell_exec__func_preg_match-only_letters__require_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__shell_exec__ternary_white_list__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__CAST-cast_float_sort_of__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__CAST-cast_float_sort_of__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__CAST-cast_int__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__func_FILTER-CLEANING-number_float_filter__include_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__func_FILTER-CLEANING-number_int_filter__require_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__func_mysql_real_escape_string__require_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__func_preg_match-only_numbers__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__ternary_white_list__include_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__ternary_white_list__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__system__whitelist_using_array__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__unserialize__CAST-cast_float__include_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__unserialize__CAST-cast_float_sort_of__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__unserialize__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__unserialize__func_addslashes__require_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__unserialize__func_preg_match-letters_numbers__include_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__unserialize__func_preg_match-only_numbers__require_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/safe/CWE_98__unserialize__whitelist_using_array__include_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-CLEANING-special_chars_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-CLEANING-special_chars_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-CLEANING-special_chars_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-CLEANING-special_chars_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__no_sanitizing__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__no_sanitizing__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__no_sanitizing__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__no_sanitizing__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__no_sanitizing__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__no_sanitizing__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__no_sanitizing__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__GET__no_sanitizing__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_FILTER-CLEANING-email_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_FILTER-CLEANING-email_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_FILTER-CLEANING-email_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_FILTER-CLEANING-email_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__no_sanitizing__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__no_sanitizing__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__no_sanitizing__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__POST__no_sanitizing__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__SESSION__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__no_sanitizing__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__no_sanitizing__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__no_sanitizing__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__array-GET__no_sanitizing__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-CLEANING-special_chars_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-CLEANING-special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-CLEANING-special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-CLEANING-special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_preg_match-no_filtering__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_preg_match-no_filtering__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_preg_match-no_filtering__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__func_preg_match-no_filtering__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__no_sanitizing__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__no_sanitizing__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__no_sanitizing__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__no_sanitizing__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__no_sanitizing__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__no_sanitizing__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__no_sanitizing__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__backticks__no_sanitizing__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__fopen__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__fopen__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__fopen__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__fopen__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__fopen__func_FILTER-CLEANING-special_chars_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__fopen__func_FILTER-CLEANING-special_chars_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__fopen__func_FILTER-CLEANING-special_chars_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__fopen__func_FILTER-CLEANING-special_chars_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__no_sanitizing__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__no_sanitizing__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__no_sanitizing__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__no_sanitizing__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__no_sanitizing__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__no_sanitizing__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__no_sanitizing__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-Array__no_sanitizing__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__no_sanitizing__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__no_sanitizing__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__no_sanitizing__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-classicGet__no_sanitizing__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-directGet__func_preg_match-no_filtering__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-directGet__func_preg_match-no_filtering__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-directGet__func_preg_match-no_filtering__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-directGet__func_preg_match-no_filtering__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__func_FILTER-CLEANING-special_chars_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__func_FILTER-CLEANING-special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__func_FILTER-CLEANING-special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__func_FILTER-CLEANING-special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__no_sanitizing__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__no_sanitizing__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__no_sanitizing__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__object-indexArray__no_sanitizing__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-CLEANING-special_chars_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-CLEANING-special_chars_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-CLEANING-special_chars_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-CLEANING-special_chars_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__no_sanitizing__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__no_sanitizing__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__no_sanitizing__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__no_sanitizing__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__no_sanitizing__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__no_sanitizing__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__no_sanitizing__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__popen__no_sanitizing__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__no_sanitizing__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__no_sanitizing__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__no_sanitizing__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__proc_open__no_sanitizing__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__shell_exec__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__no_sanitizing__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__no_sanitizing__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__no_sanitizing__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__no_sanitizing__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__no_sanitizing__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__no_sanitizing__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__no_sanitizing__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__system__no_sanitizing__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__no_sanitizing__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__no_sanitizing__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__no_sanitizing__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/Injection/CWE_98/unsafe/CWE_98__unserialize__no_sanitizing__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/safe/CWE_311__sha256_with_crypt_function__store_in_cookie.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/safe/CWE_311__sha256_with_crypt_function__store_in_database.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/unsafe/CWE_311__no_encryption__store_in_cookie.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/unsafe/CWE_311__no_encryption__store_in_cookie.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/unsafe/CWE_311__no_encryption__store_in_cookie.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/unsafe/CWE_311__no_encryption__store_in_cookie.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/unsafe/CWE_311__no_encryption__store_in_database.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/unsafe/CWE_311__no_encryption__store_in_database.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/unsafe/CWE_311__no_encryption__store_in_database.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_311/unsafe/CWE_311__no_encryption__store_in_database.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__password_hash.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__password_hash.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__password_hash.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__password_hash.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__sha256_crypt_function.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__sha256_crypt_function.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__sha256_crypt_function.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__sha256_crypt_function.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__sha512_crypt_function.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__sha512_crypt_function.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__sha512_crypt_function.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/safe/CWE_327__no_sanitizing__sha512_crypt_function.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__des_crypt_function.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__des_crypt_function.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__des_crypt_function.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__des_crypt_function.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__md5.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__md5.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__md5.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__md5.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__md5_crypt_function.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__md5_crypt_function.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__md5_crypt_function.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__md5_crypt_function.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__sha1.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__sha1.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__sha1.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__sha1.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__str_rot13.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__str_rot13.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__str_rot13.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SDE/CWE_327/unsafe/CWE_327__no_sanitizing__str_rot13.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/safe/CWE_209__error_reporting(0)__current_dir_location-fopen.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/safe/CWE_209__error_reporting(0)__current_dir_location-fopen_with_condition.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/safe/CWE_209__error_reporting(0)__error_message-try_catch.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/safe/CWE_209__no_sanitizing__current_dir_location-fopen_with_condition.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/safe/CWE_209__no_sanitizing__error_message-try_catch.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__error_reporting(0)__config_location-try_catch.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__error_reporting(0)__config_location-try_catch.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__error_reporting(0)__config_location-try_catch.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__error_reporting(0)__config_location-try_catch.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__no_sanitizing__config_location-try_catch.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__no_sanitizing__config_location-try_catch.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__no_sanitizing__config_location-try_catch.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__no_sanitizing__config_location-try_catch.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__no_sanitizing__current_dir_location-fopen.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__no_sanitizing__current_dir_location-fopen.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__no_sanitizing__current_dir_location-fopen.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/SM/CWE_209/unsafe/CWE_209__no_sanitizing__current_dir_location-fopen.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__GET__CAST-cast_float__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__GET__CAST-func_settype_float__http_redirect_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__GET__func_FILTER-CLEANING-number_int_filter__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__GET__ternary_white_list__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__POST__CAST-cast_int__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__POST__func_FILTER-CLEANING-number_int_filter__http_redirect_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__POST__func_preg_match-letters_numbers__header_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__POST__func_preg_match-only_numbers__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__POST__ternary_white_list__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__POST__whitelist_using_array__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__POST__whitelist_using_array__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__SESSION__CAST-cast_float__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__SESSION__func_FILTER-CLEANING-number_int_filter__http_redirect_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__SESSION__func_preg_match-letters_numbers__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__SESSION__func_preg_match-only_numbers__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__SESSION__func_preg_replace2__header_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__SESSION__ternary_white_list__http_redirect_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__SESSION__whitelist_using_array__http_redirect_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__array-GET__ternary_white_list__header_url-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__array-GET__whitelist_using_array__http_redirect_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__array-GET__whitelist_using_array__http_redirect_url-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__CAST-cast_float_sort_of__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__CAST-cast_float_sort_of__header_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__CAST-cast_float_sort_of__http_redirect_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__CAST-cast_int__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__CAST-cast_int_sort_of2__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__CAST-func_settype_int__header_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__func_FILTER-CLEANING-number_float_filter__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__func_floatval__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__func_floatval__http_redirect_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__backticks__whitelist_using_array__http_redirect_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__exec__func_FILTER-VALIDATION-number_float_filter__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__exec__func_FILTER-VALIDATION-number_int_filter__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__exec__func_intval__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__exec__func_preg_match-letters_numbers__http_redirect_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__exec__whitelist_using_array__header_url-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__exec__whitelist_using_array__http_redirect_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__exec__whitelist_using_array__http_redirect_url-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__fopen__CAST-cast_int_sort_of__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__fopen__CAST-cast_int_sort_of__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__fopen__func_FILTER-VALIDATION-number_int_filter__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__fopen__func_preg_match-only_letters__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__fopen__ternary_white_list__header_url-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__fopen__whitelist_using_array__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__fopen__whitelist_using_array__header_url-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-Array__CAST-cast_int__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-Array__func_FILTER-VALIDATION-number_int_filter__http_redirect_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-Array__func_preg_match-letters_numbers__header_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-Array__func_preg_replace2__header_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__CAST-cast_float__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__CAST-cast_int__http_redirect_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__func_FILTER-CLEANING-number_int_filter__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__func_preg_match-letters_numbers__header_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__func_preg_match-letters_numbers__http_redirect_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__func_preg_match-only_letters__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__func_preg_match-only_letters__http_redirect_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__ternary_white_list__http_redirect_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-classicGet__whitelist_using_array__header_url-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-directGet__CAST-cast_int__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-directGet__CAST-cast_int_sort_of__header_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-directGet__whitelist_using_array__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-directGet__whitelist_using_array__header_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-directGet__whitelist_using_array__header_url-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-directGet__whitelist_using_array__http_redirect_file_name-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__CAST-cast_int__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__CAST-cast_int__http_redirect_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__CAST-func_settype_int__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__CAST-func_settype_int__header_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__CAST-func_settype_int__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__func_preg_match-letters_numbers__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__func_preg_match-only_numbers__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__func_preg_replace2__http_redirect_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__ternary_white_list__http_redirect_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__whitelist_using_array__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__whitelist_using_array__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__object-indexArray__whitelist_using_array__http_redirect_url-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__CAST-cast_float_sort_of__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__CAST-cast_float_sort_of__header_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__CAST-cast_int__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__CAST-func_settype_int__header_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__func_FILTER-CLEANING-number_float_filter__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__func_floatval__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__func_preg_match-letters_numbers__http_redirect_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__ternary_white_list__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__whitelist_using_array__header_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__popen__whitelist_using_array__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__proc_open__func_FILTER-CLEANING-number_float_filter__header_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__proc_open__func_FILTER-VALIDATION-number_int_filter__http_redirect_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__proc_open__func_intval__http_redirect_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__proc_open__whitelist_using_array__http_redirect_file_name-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__shell_exec__CAST-cast_float__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__shell_exec__CAST-cast_float__http_redirect_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__shell_exec__func_preg_match-only_numbers__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__system__CAST-cast_float_sort_of__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__system__CAST-func_settype_float__http_redirect_file_id-sprintf_%d_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__system__CAST-func_settype_int__header_file_id-concatenation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__system__func_FILTER-CLEANING-number_float_filter__http_redirect_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__system__func_intval__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__system__func_preg_match-only_letters__header_file_name-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__system__whitelist_using_array__http_redirect_url-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__system__whitelist_using_array__http_redirect_url-sprintf_%s_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/safe/CWE_601__unserialize__whitelist_using_array__header_file_id-interpretation_simple_quote.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-CLEANING-full_special_chars_filter__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-CLEANING-full_special_chars_filter__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-CLEANING-full_special_chars_filter__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-CLEANING-full_special_chars_filter__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__header_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__header_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__header_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__header_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__http_redirect_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_FILTER-VALIDATION-email_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_addslashes__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_addslashes__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_addslashes__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_addslashes__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlentities__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlentities__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlentities__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlentities__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlspecialchars__header_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlspecialchars__header_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlspecialchars__header_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlspecialchars__header_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_preg_match-only_letters__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_preg_match-only_letters__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_preg_match-only_letters__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_preg_match-only_letters__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_preg_match-only_letters__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_preg_match-only_letters__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_preg_match-only_letters__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__func_preg_match-only_letters__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__no_sanitizing__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__no_sanitizing__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__no_sanitizing__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__GET__no_sanitizing__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-email_filter__header_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-email_filter__header_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-email_filter__header_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-email_filter__header_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_addslashes__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_addslashes__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_addslashes__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_addslashes__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_htmlentities__header_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_htmlentities__header_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_htmlentities__header_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_htmlentities__header_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_mysql_real_escape_string__http_redirect_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_mysql_real_escape_string__http_redirect_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_mysql_real_escape_string__http_redirect_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__func_mysql_real_escape_string__http_redirect_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__POST__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_addslashes__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_addslashes__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_addslashes__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_addslashes__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_preg_replace__header_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_preg_replace__header_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_preg_replace__header_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_preg_replace__header_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_preg_replace__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_preg_replace__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_preg_replace__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__func_preg_replace__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__header_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__SESSION__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_FILTER-CLEANING-email_filter__http_redirect_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_FILTER-CLEANING-email_filter__http_redirect_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_FILTER-CLEANING-email_filter__http_redirect_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_FILTER-CLEANING-email_filter__http_redirect_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_htmlspecialchars__header_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_htmlspecialchars__header_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_htmlspecialchars__header_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_htmlspecialchars__header_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_mysql_real_escape_string__header_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_mysql_real_escape_string__header_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_mysql_real_escape_string__header_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__array-GET__func_mysql_real_escape_string__header_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-email_filter__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-email_filter__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-email_filter__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-email_filter__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__header_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__header_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__header_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__header_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-magic_quotes_filter__header_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-magic_quotes_filter__header_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-magic_quotes_filter__header_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-magic_quotes_filter__header_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-special_chars_filter__header_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-special_chars_filter__header_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-special_chars_filter__header_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-CLEANING-special_chars_filter__header_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-VALIDATION-email_filter__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-VALIDATION-email_filter__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-VALIDATION-email_filter__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-VALIDATION-email_filter__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-VALIDATION-email_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-VALIDATION-email_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-VALIDATION-email_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_FILTER-VALIDATION-email_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_htmlspecialchars__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_htmlspecialchars__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_htmlspecialchars__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_htmlspecialchars__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_preg_replace2__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_preg_replace2__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_preg_replace2__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_preg_replace2__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_preg_replace__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_preg_replace__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_preg_replace__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__func_preg_replace__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__backticks__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-full_special_chars_filter__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-full_special_chars_filter__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-full_special_chars_filter__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-full_special_chars_filter__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-special_chars_filter__http_redirect_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-special_chars_filter__http_redirect_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-special_chars_filter__http_redirect_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-CLEANING-special_chars_filter__http_redirect_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_htmlentities__header_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_htmlentities__header_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_htmlentities__header_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_htmlentities__header_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__no_sanitizing__header_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__no_sanitizing__header_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__no_sanitizing__header_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__no_sanitizing__header_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__no_sanitizing__http_redirect_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__no_sanitizing__http_redirect_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__no_sanitizing__http_redirect_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__exec__no_sanitizing__http_redirect_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_FILTER-CLEANING-email_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_FILTER-CLEANING-special_chars_filter__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_FILTER-CLEANING-special_chars_filter__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_FILTER-CLEANING-special_chars_filter__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_FILTER-CLEANING-special_chars_filter__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_htmlspecialchars__http_redirect_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_htmlspecialchars__http_redirect_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_htmlspecialchars__http_redirect_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_htmlspecialchars__http_redirect_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_mysql_real_escape_string__http_redirect_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_mysql_real_escape_string__http_redirect_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_mysql_real_escape_string__http_redirect_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_mysql_real_escape_string__http_redirect_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_preg_match-letters_numbers__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_preg_match-letters_numbers__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_preg_match-letters_numbers__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__fopen__func_preg_match-letters_numbers__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_FILTER-VALIDATION-email_filter__header_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_FILTER-VALIDATION-email_filter__header_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_FILTER-VALIDATION-email_filter__header_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_FILTER-VALIDATION-email_filter__header_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_addslashes__header_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_addslashes__header_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_addslashes__header_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_addslashes__header_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-Array__func_htmlspecialchars__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-classicGet__func_preg_replace__header_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-classicGet__func_preg_replace__header_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-classicGet__func_preg_replace__header_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-classicGet__func_preg_replace__header_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_FILTER-VALIDATION-email_filter__header_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_FILTER-VALIDATION-email_filter__header_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_FILTER-VALIDATION-email_filter__header_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_FILTER-VALIDATION-email_filter__header_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_htmlentities__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_htmlentities__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_htmlentities__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_htmlentities__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_match-letters_numbers__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_match-letters_numbers__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_match-letters_numbers__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_match-letters_numbers__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_replace__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_replace__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_replace__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_replace__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_replace__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_replace__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_replace__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__func_preg_replace__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__no_sanitizing__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__no_sanitizing__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__no_sanitizing__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__no_sanitizing__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__no_sanitizing__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__no_sanitizing__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__no_sanitizing__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-directGet__no_sanitizing__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-CLEANING-email_filter__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-CLEANING-email_filter__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-CLEANING-email_filter__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-CLEANING-email_filter__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_htmlentities__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_htmlentities__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_htmlentities__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_htmlentities__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_htmlspecialchars__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_htmlspecialchars__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_htmlspecialchars__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_htmlspecialchars__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_mysql_real_escape_string__header_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_mysql_real_escape_string__header_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_mysql_real_escape_string__header_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_mysql_real_escape_string__header_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_preg_replace__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_preg_replace__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_preg_replace__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__func_preg_replace__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__no_sanitizing__header_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__no_sanitizing__header_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__no_sanitizing__header_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__object-indexArray__no_sanitizing__header_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_FILTER-VALIDATION-email_filter__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_FILTER-VALIDATION-email_filter__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_FILTER-VALIDATION-email_filter__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_FILTER-VALIDATION-email_filter__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_FILTER-VALIDATION-email_filter__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_addslashes__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_addslashes__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_addslashes__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_addslashes__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_htmlspecialchars__header_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_htmlspecialchars__header_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_htmlspecialchars__header_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_htmlspecialchars__header_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-letters_numbers__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-letters_numbers__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-letters_numbers__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-letters_numbers__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-no_filtering__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-no_filtering__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-no_filtering__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-no_filtering__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-no_filtering__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-no_filtering__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-no_filtering__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__func_preg_match-no_filtering__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__popen__no_sanitizing__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-magic_quotes_filter__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-special_chars_filter__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-special_chars_filter__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-special_chars_filter__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-CLEANING-special_chars_filter__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlentities__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlentities__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlentities__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlentities__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlentities__http_redirect_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlspecialchars__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlspecialchars__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlspecialchars__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_htmlspecialchars__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_match-no_filtering__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_match-no_filtering__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_match-no_filtering__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_match-no_filtering__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_match-no_filtering__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_match-no_filtering__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_match-no_filtering__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_match-no_filtering__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_replace__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_replace__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_replace__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__proc_open__func_preg_replace__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-CLEANING-special_chars_filter__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-CLEANING-special_chars_filter__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-CLEANING-special_chars_filter__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-CLEANING-special_chars_filter__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-VALIDATION-email_filter__header_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-VALIDATION-email_filter__header_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-VALIDATION-email_filter__header_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_FILTER-VALIDATION-email_filter__header_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_htmlspecialchars__http_redirect_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_htmlspecialchars__http_redirect_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_htmlspecialchars__http_redirect_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_htmlspecialchars__http_redirect_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-letters_numbers__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-letters_numbers__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-letters_numbers__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-letters_numbers__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-only_letters__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-only_letters__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-only_letters__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-only_letters__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-only_letters__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-only_letters__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-only_letters__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_match-only_letters__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_replace__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_replace__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_replace__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__func_preg_replace__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__no_sanitizing__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__no_sanitizing__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__no_sanitizing__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__shell_exec__no_sanitizing__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-email_filter__header_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-email_filter__header_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-email_filter__header_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-email_filter__header_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-email_filter__http_redirect_url-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-email_filter__http_redirect_url-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-email_filter__http_redirect_url-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-email_filter__http_redirect_url-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-full_special_chars_filter__header_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-full_special_chars_filter__header_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-full_special_chars_filter__header_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-full_special_chars_filter__header_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-full_special_chars_filter__http_redirect_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-special_chars_filter__http_redirect_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-special_chars_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-special_chars_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-CLEANING-special_chars_filter__http_redirect_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_FILTER-VALIDATION-email_filter__header_url-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_addslashes__header_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_addslashes__header_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_addslashes__header_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_addslashes__header_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_addslashes__http_redirect_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_addslashes__http_redirect_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_addslashes__http_redirect_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_addslashes__http_redirect_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_mysql_real_escape_string__header_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_preg_replace__http_redirect_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_preg_replace__http_redirect_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_preg_replace__http_redirect_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__system__func_preg_replace__http_redirect_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__unserialize__func_preg_match-no_filtering__http_redirect_url-concatenation_simple_quote.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__unserialize__func_preg_match-no_filtering__http_redirect_url-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__unserialize__func_preg_match-no_filtering__http_redirect_url-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/URF/CWE_601/unsafe/CWE_601__unserialize__func_preg_match-no_filtering__http_redirect_url-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__CAST-cast_float__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__CAST-cast_int__Unsafe_use_untrusted_data-style.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__CAST-cast_int_sort_of2__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__CAST-cast_int_sort_of2__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__CAST-cast_int_sort_of__Use_untrusted_data_attribute-unquoted_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__CAST-cast_int_sort_of__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__func_FILTER-CLEANING-email_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__func_addslashes__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__func_floatval__Unsafe_use_untrusted_data-attribute_Name.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__func_intval__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__func_preg_replace2__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__ternary_white_list__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__ternary_white_list__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__CAST-cast_float__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__CAST-cast_float__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__CAST-cast_float_sort_of__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__CAST-func_settype_int__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__func_floatval__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__func_htmlentities__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__func_htmlspecialchars__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__func_htmlspecialchars__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__POST__func_mysql_real_escape_string__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__CAST-cast_float__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__CAST-cast_int_sort_of__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__CAST-func_settype_float__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__func_http_build_query__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__func_intval__Use_untrusted_data_script-window_SetInterval.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__func_preg_replace2__Unsafe_use_untrusted_data-style.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__func_preg_replace2__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__func_preg_replace2__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__SESSION__func_preg_replace2__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__CAST-cast_float_sort_of__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__CAST-cast_int_sort_of2__Unsafe_use_untrusted_data-comment.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__CAST-cast_int_sort_of__Unsafe_use_untrusted_data-style.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__CAST-cast_int_sort_of__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__CAST-func_settype_int__Unsafe_use_untrusted_data-tag_Name.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__CAST-func_settype_int__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_floatval__Unsafe_use_untrusted_data-style.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_floatval__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_floatval__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__func_mysql_real_escape_string__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__array-GET__whitelist_using_array__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__CAST-cast_int__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__CAST-cast_int__Use_untrusted_data_script-window_SetInterval.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__CAST-cast_int_sort_of__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__CAST-func_settype_float__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__CAST-func_settype_int__Unsafe_use_untrusted_data-comment.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__CAST-func_settype_int__Unsafe_use_untrusted_data-script.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__CAST-func_settype_int__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__func_floatval__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__func_intval__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__backticks__func_urlencode__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__CAST-cast_float__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__CAST-cast_float__Use_untrusted_data_propertyValue_CSS-property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__CAST-cast_int__Unsafe_use_untrusted_data-script.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__CAST-cast_int_sort_of2__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__CAST-func_settype_float__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__func_preg_replace2__Unsafe_use_untrusted_data-comment.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__func_preg_replace2__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__exec__func_urlencode__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__CAST-cast_float__Unsafe_use_untrusted_data-script.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__CAST-cast_float_sort_of__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__CAST-cast_int_sort_of2__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__CAST-cast_int_sort_of__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__CAST-func_settype_float__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__fopen__func_http_build_query__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-Array__CAST-cast_float_sort_of__Unsafe_use_untrusted_data-tag_Name.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-Array__CAST-cast_int__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-Array__CAST-cast_int_sort_of__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-Array__CAST-func_settype_float__Unsafe_use_untrusted_data-style.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-Array__CAST-func_settype_int__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-Array__func_floatval__Use_untrusted_data_propertyValue_CSS-property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-Array__func_preg_replace2__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-Array__func_preg_replace2__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__CAST-cast_int__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__CAST-cast_int_sort_of2__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__CAST-cast_int_sort_of__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_htmlentities__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_http_build_query__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_intval__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_preg_replace2__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_rawurlencode__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-classicGet__func_urlencode__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__CAST-cast_float__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__CAST-cast_int_sort_of2__Use_untrusted_data_propertyValue_CSS-property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__CAST-cast_int_sort_of__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__CAST-func_settype_float__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__CAST-func_settype_int__Unsafe_use_untrusted_data-attribute_Name.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_addslashes__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_addslashes__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_htmlentities__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_htmlspecialchars__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_htmlspecialchars__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_htmlspecialchars__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_mysql_real_escape_string__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_urlencode__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-directGet__func_urlencode__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__CAST-cast_float_sort_of__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__CAST-cast_float_sort_of__Use_untrusted_data_script-window_SetInterval.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__CAST-cast_int_sort_of2__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__CAST-cast_int_sort_of__Unsafe_use_untrusted_data-style.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__CAST-cast_int_sort_of__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__func_addslashes__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__func_htmlentities__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__func_http_build_query__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__func_intval__Unsafe_use_untrusted_data-comment.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__object-indexArray__ternary_white_list__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__CAST-cast_float__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__CAST-cast_int_sort_of2__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__CAST-func_settype_float__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__CAST-func_settype_int__Unsafe_use_untrusted_data-style.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__CAST-func_settype_int__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__CAST-func_settype_int__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__func_addslashes__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__func_intval__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__popen__func_preg_replace2__Unsafe_use_untrusted_data-tag_Name.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__CAST-cast_int__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__CAST-cast_int__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__CAST-cast_int_sort_of2__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__CAST-func_settype_int__Use_untrusted_data_attribute-unquoted_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__CAST-func_settype_int__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data-body.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__proc_open__func_preg_replace2__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__shell_exec__CAST-cast_int__Use_untrusted_data_script-window_SetInterval.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__shell_exec__CAST-cast_int_sort_of2__Use_untrusted_data_script-window_SetInterval.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__shell_exec__CAST-func_settype_float__Unsafe_use_untrusted_data-script.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__shell_exec__func_FILTER-CLEANING-email_filter__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__shell_exec__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__shell_exec__func_mysql_real_escape_string__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__CAST-cast_float__Unsafe_use_untrusted_data-comment.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__CAST-cast_float_sort_of__Unsafe_use_untrusted_data-comment.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__CAST-cast_int_sort_of2__Unsafe_use_untrusted_data-style.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__CAST-func_settype_float__Unsafe_use_untrusted_data-script.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__CAST-func_settype_float__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__CAST-func_settype_int__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_script-doublequoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__func_addslashes__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__func_floatval__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__func_preg_replace2__Use_untrusted_data_attribute-unquoted_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__system__ternary_white_list__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__CAST-cast_float_sort_of__Use_untrusted_data_script-quoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__CAST-func_settype_int__Unsafe_use_untrusted_data-tag_Name.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__CAST-func_settype_int__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data-div.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-side_Quoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_floatval__Unsafe_use_untrusted_data-attribute_Name.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_floatval__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_floatval__Use_untrusted_data_script-doublequoted_String.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_htmlentities__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_http_build_query__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_preg_replace2__Use_untrusted_data_script-quoted_Event_Handler.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_preg_replace2__Use_untrusted_data_script-window_SetInterval.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_urlencode__Use_untrusted_data_attribute-Double_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/safe/CWE_79__unserialize__func_urlencode__Use_untrusted_data_attribute-simple_Quote_Attr.php");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-unquoted_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-unquoted_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-unquoted_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-unquoted_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-quoted_String.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-quoted_String.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-quoted_String.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-quoted_String.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Use_untrusted_data_script-doublequoted_Event_Handler.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Use_untrusted_data_script-doublequoted_Event_Handler.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Use_untrusted_data_script-doublequoted_Event_Handler.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_mysql_real_escape_string__Use_untrusted_data_script-doublequoted_Event_Handler.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_preg_replace__Use_untrusted_data-body.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_preg_replace__Use_untrusted_data-body.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_preg_replace__Use_untrusted_data-body.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_preg_replace__Use_untrusted_data-body.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_preg_replace__Use_untrusted_data_script-doublequoted_Event_Handler.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_preg_replace__Use_untrusted_data_script-doublequoted_Event_Handler.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_preg_replace__Use_untrusted_data_script-doublequoted_Event_Handler.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_preg_replace__Use_untrusted_data_script-doublequoted_Event_Handler.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_urlencode__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_urlencode__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_urlencode__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__func_urlencode__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__ternary_white_list__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__ternary_white_list__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__ternary_white_list__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__ternary_white_list__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data-body.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data-body.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data-body.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data-body.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__GET__whitelist_using_array__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-email_filter__Use_untrusted_data_attribute-simple_Quote_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-email_filter__Use_untrusted_data_attribute-simple_Quote_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-email_filter__Use_untrusted_data_attribute-simple_Quote_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-email_filter__Use_untrusted_data_attribute-simple_Quote_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_script-window_SetInterval.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_script-window_SetInterval.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_script-window_SetInterval.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_script-window_SetInterval.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__whitelist_using_array__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__whitelist_using_array__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__whitelist_using_array__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__POST__whitelist_using_array__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__no_sanitizing__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__no_sanitizing__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__no_sanitizing__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__SESSION__no_sanitizing__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-email_filter__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-email_filter__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-email_filter__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-email_filter__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-special_chars_filter__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-special_chars_filter__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-special_chars_filter__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-CLEANING-special_chars_filter__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_mysql_real_escape_string__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_mysql_real_escape_string__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_mysql_real_escape_string__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__func_mysql_real_escape_string__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__no_sanitizing__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__no_sanitizing__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__no_sanitizing__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__no_sanitizing__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__whitelist_using_array__Use_untrusted_data_script-window_SetInterval.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__whitelist_using_array__Use_untrusted_data_script-window_SetInterval.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__whitelist_using_array__Use_untrusted_data_script-window_SetInterval.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__array-GET__whitelist_using_array__Use_untrusted_data_script-window_SetInterval.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-email_filter__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-email_filter__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-email_filter__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-email_filter__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-window_SetInterval.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-window_SetInterval.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-window_SetInterval.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-window_SetInterval.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_http_build_query__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_http_build_query__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_http_build_query__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_http_build_query__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__no_sanitizing__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__no_sanitizing__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__no_sanitizing__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__backticks__no_sanitizing__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-window_SetInterval.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-window_SetInterval.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-window_SetInterval.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_script-window_SetInterval.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_http_build_query__Use_untrusted_data_attribute-unquoted_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_http_build_query__Use_untrusted_data_attribute-unquoted_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_http_build_query__Use_untrusted_data_attribute-unquoted_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_http_build_query__Use_untrusted_data_attribute-unquoted_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_rawurlencode__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_rawurlencode__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_rawurlencode__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_rawurlencode__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__exec__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_addslashes__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_addslashes__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_addslashes__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__fopen__func_addslashes__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-email_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-email_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-email_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-email_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-magic_quotes_filter__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-magic_quotes_filter__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-magic_quotes_filter__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-magic_quotes_filter__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_FILTER-VALIDATION-number_float_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_htmlspecialchars__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_htmlspecialchars__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_htmlspecialchars__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_htmlspecialchars__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_http_build_query__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_http_build_query__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_http_build_query__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_http_build_query__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_mysql_real_escape_string__Use_untrusted_data_script-window_SetInterval.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_mysql_real_escape_string__Use_untrusted_data_script-window_SetInterval.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_mysql_real_escape_string__Use_untrusted_data_script-window_SetInterval.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_mysql_real_escape_string__Use_untrusted_data_script-window_SetInterval.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_preg_replace__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_preg_replace__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_preg_replace__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_preg_replace__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__func_rawurlencode__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__no_sanitizing__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__no_sanitizing__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__no_sanitizing__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__no_sanitizing__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__ternary_white_list__Use_untrusted_data_script-doublequoted_Event_Handler.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__ternary_white_list__Use_untrusted_data_script-doublequoted_Event_Handler.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__ternary_white_list__Use_untrusted_data_script-doublequoted_Event_Handler.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__ternary_white_list__Use_untrusted_data_script-doublequoted_Event_Handler.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-Array__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_htmlentities__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_htmlentities__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_htmlentities__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__func_htmlentities__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__no_sanitizing__Use_untrusted_data_script-window_SetInterval.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__no_sanitizing__Use_untrusted_data_script-window_SetInterval.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__no_sanitizing__Use_untrusted_data_script-window_SetInterval.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-classicGet__no_sanitizing__Use_untrusted_data_script-window_SetInterval.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_attribute-unquoted_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_attribute-unquoted_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_attribute-unquoted_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-number_float_filter__Use_untrusted_data_attribute-unquoted_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_htmlentities__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_htmlentities__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_htmlentities__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_htmlentities__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_http_build_query__Use_untrusted_data_attribute-unquoted_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_http_build_query__Use_untrusted_data_attribute-unquoted_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_http_build_query__Use_untrusted_data_attribute-unquoted_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_http_build_query__Use_untrusted_data_attribute-unquoted_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_http_build_query__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_http_build_query__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_http_build_query__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_http_build_query__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_mysql_real_escape_string__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_mysql_real_escape_string__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_mysql_real_escape_string__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_mysql_real_escape_string__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_mysql_real_escape_string__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_preg_replace__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_preg_replace__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_preg_replace__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__func_preg_replace__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__ternary_white_list__Use_untrusted_data_script-window_SetInterval.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__ternary_white_list__Use_untrusted_data_script-window_SetInterval.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__ternary_white_list__Use_untrusted_data_script-window_SetInterval.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-directGet__ternary_white_list__Use_untrusted_data_script-window_SetInterval.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-VALIDATION-number_float_filter__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-VALIDATION-number_float_filter__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-VALIDATION-number_float_filter__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_FILTER-VALIDATION-number_float_filter__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_htmlspecialchars__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_htmlspecialchars__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_htmlspecialchars__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_htmlspecialchars__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_mysql_real_escape_string__Use_untrusted_data_attribute-unquoted_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_mysql_real_escape_string__Use_untrusted_data_attribute-unquoted_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_mysql_real_escape_string__Use_untrusted_data_attribute-unquoted_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_mysql_real_escape_string__Use_untrusted_data_attribute-unquoted_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_mysql_real_escape_string__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_mysql_real_escape_string__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_mysql_real_escape_string__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_mysql_real_escape_string__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_urlencode__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_urlencode__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_urlencode__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_urlencode__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_urlencode__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_urlencode__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_urlencode__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__func_urlencode__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__no_sanitizing__Use_untrusted_data_script-side_Quoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__no_sanitizing__Use_untrusted_data_script-side_Quoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__no_sanitizing__Use_untrusted_data_script-side_Quoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__object-indexArray__no_sanitizing__Use_untrusted_data_script-side_Quoted_Expr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-email_filter__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-email_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-email_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-email_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-email_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-unquoted_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-unquoted_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-unquoted_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-CLEANING-number_int_filter__Use_untrusted_data_attribute-unquoted_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-side_Quoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-side_Quoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-side_Quoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_script-side_Quoted_Expr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_addslashes__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_addslashes__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_addslashes__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_addslashes__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_htmlspecialchars__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_htmlspecialchars__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_htmlspecialchars__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_htmlspecialchars__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_htmlspecialchars__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_htmlspecialchars__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_htmlspecialchars__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_htmlspecialchars__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_preg_replace__Use_untrusted_data_attribute-unquoted_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_preg_replace__Use_untrusted_data_attribute-unquoted_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_preg_replace__Use_untrusted_data_attribute-unquoted_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_preg_replace__Use_untrusted_data_attribute-unquoted_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_rawurlencode__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_rawurlencode__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_rawurlencode__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_rawurlencode__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_urlencode__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_urlencode__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_urlencode__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__func_urlencode__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__no_sanitizing__Use_untrusted_data_script-quoted_String.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__no_sanitizing__Use_untrusted_data_script-quoted_String.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__no_sanitizing__Use_untrusted_data_script-quoted_String.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__popen__no_sanitizing__Use_untrusted_data_script-quoted_String.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_addslashes__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_addslashes__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_addslashes__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_addslashes__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_mysql_real_escape_string__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_mysql_real_escape_string__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_mysql_real_escape_string__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_mysql_real_escape_string__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_rawurlencode__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_rawurlencode__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_rawurlencode__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__func_rawurlencode__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__whitelist_using_array__Use_untrusted_data_script-doublequoted_Event_Handler.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__whitelist_using_array__Use_untrusted_data_script-doublequoted_Event_Handler.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__whitelist_using_array__Use_untrusted_data_script-doublequoted_Event_Handler.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__proc_open__whitelist_using_array__Use_untrusted_data_script-doublequoted_Event_Handler.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-CLEANING-number_int_filter__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_FILTER-VALIDATION-number_int_filter__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_preg_replace__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_preg_replace__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_preg_replace__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_preg_replace__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_rawurlencode__Use_untrusted_data_script-window_SetInterval.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_rawurlencode__Use_untrusted_data_script-window_SetInterval.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_rawurlencode__Use_untrusted_data_script-window_SetInterval.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_rawurlencode__Use_untrusted_data_script-window_SetInterval.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_urlencode__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_urlencode__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_urlencode__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__func_urlencode__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__no_sanitizing__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__no_sanitizing__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__no_sanitizing__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__no_sanitizing__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__no_sanitizing__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__no_sanitizing__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__no_sanitizing__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__no_sanitizing__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__whitelist_using_array__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__whitelist_using_array__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__whitelist_using_array__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__shell_exec__whitelist_using_array__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-magic_quotes_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-VALIDATION-email_filter__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_FILTER-VALIDATION-number_int_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_addslashes__Unsafe_use_untrusted_data-script.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_addslashes__Unsafe_use_untrusted_data-script.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_addslashes__Unsafe_use_untrusted_data-script.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__func_addslashes__Unsafe_use_untrusted_data-script.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__no_sanitizing__Use_untrusted_data_attribute-Double_Quote_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__no_sanitizing__Use_untrusted_data_attribute-Double_Quote_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__no_sanitizing__Use_untrusted_data_attribute-Double_Quote_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__no_sanitizing__Use_untrusted_data_attribute-Double_Quote_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__ternary_white_list__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__ternary_white_list__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__ternary_white_list__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__system__ternary_white_list__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-email_filter__Use_untrusted_data_script-side_Quoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-email_filter__Use_untrusted_data_script-side_Quoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-email_filter__Use_untrusted_data_script-side_Quoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-email_filter__Use_untrusted_data_script-side_Quoted_Expr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_attribute-unquoted_Attr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_attribute-unquoted_Attr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_attribute-unquoted_Attr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-full_special_chars_filter__Use_untrusted_data_attribute-unquoted_Attr.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-magic_quotes_filter__Unsafe_use_untrusted_data-comment.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-magic_quotes_filter__Unsafe_use_untrusted_data-comment.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-magic_quotes_filter__Unsafe_use_untrusted_data-comment.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-magic_quotes_filter__Unsafe_use_untrusted_data-comment.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-style.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-style.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-style.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-number_float_filter__Unsafe_use_untrusted_data-style.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-CLEANING-special_chars_filter__Use_untrusted_data_propertyValue_CSS-span_Style_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_FILTER-VALIDATION-email_filter__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_http_build_query__Unsafe_use_untrusted_data-attribute_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_http_build_query__Unsafe_use_untrusted_data-attribute_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_http_build_query__Unsafe_use_untrusted_data-attribute_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_http_build_query__Unsafe_use_untrusted_data-attribute_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_http_build_query__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_http_build_query__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_http_build_query__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_http_build_query__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_rawurlencode__Unsafe_use_untrusted_data-tag_Name.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_rawurlencode__Unsafe_use_untrusted_data-tag_Name.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_rawurlencode__Unsafe_use_untrusted_data-tag_Name.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__func_rawurlencode__Unsafe_use_untrusted_data-tag_Name.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data-body.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data-body.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data-body.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data-body.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data-div.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data-div.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data-div.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data-div.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data_propertyValue_CSS-property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data_propertyValue_CSS-property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__no_sanitizing__Use_untrusted_data_propertyValue_CSS-property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-double_Quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_propertyValue_CSS-quoted_Property_Value.php", "file_inclusion");

$framework->add_testbasis("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_script-side_DoubleQuoted_Expr.php");
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("tainted"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", array("49"));
$framework->add_output("./tests/PHP-Vulnerability-test-suite/XSS/CWE_79/unsafe/CWE_79__unserialize__whitelist_using_array__Use_untrusted_data_script-side_DoubleQuoted_Expr.php", "file_inclusion");
 */


?>
