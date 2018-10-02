<?php

        return [
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__GET__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__GET__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__POST__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__POST__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__SESSION__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__SESSION__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__array-GET__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__array-GET__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__backticks__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__backticks__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__exec__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__exec__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__fopen__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__fopen__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-Array__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-Array__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-classicGet__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-classicGet__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-directGet__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-directGet__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-indexArray__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-indexArray__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__popen__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__popen__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__proc_open__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__proc_open__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__shell_exec__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__shell_exec__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__system__ternary_white_list__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__system__whitelist_using_array__fopen.php", []
                ],
                [
                    "./tests/vulntestsuite/CWE_862_Fopen__GET__func_preg_replace__fopen.php",
                        [["\$tainted", "48", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__GET__no_sanitizing__fopen.php",
                        [["\$tainted", "46", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__POST__func_preg_replace__fopen.php",
                        [["\$tainted", "48", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__POST__no_sanitizing__fopen.php",
                        [["\$tainted", "46", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__backticks__func_preg_replace__fopen.php",
                       [["\$tainted", "48", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__backticks__no_sanitizing__fopen.php",
                        [["\$tainted", "46", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__exec__func_preg_replace__fopen.php",
                        [["\$tainted", "51", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__exec__no_sanitizing__fopen.php",
                        [["\$tainted", "49", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__fopen__func_preg_replace__fopen.php",
                        [["\$tainted", "57", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__fopen__no_sanitizing__fopen.php",
                        [["\$tainted", "49", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-Array__func_preg_replace__fopen.php",
                        [["\$tainted", "66", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-Array__no_sanitizing__fopen.php",
                        [["\$tainted", "64", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-classicGet__func_preg_replace__fopen.php",
                        [["\$tainted", "63", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-classicGet__no_sanitizing__fopen.php",
                        [["\$tainted", "61", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-directGet__func_preg_replace__fopen.php",
                        [["\$tainted", "57", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-directGet__no_sanitizing__fopen.php",
                        [["\$tainted", "55", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-indexArray__func_preg_replace__fopen.php",
                        [["\$tainted", "66", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__object-indexArray__no_sanitizing__fopen.php",
                        [["\$tainted", "64", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__popen__func_preg_replace__fopen.php",
                        [["\$tainted", "50", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__popen__no_sanitizing__fopen.php",
                        [["\$tainted", "47", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__proc_open__func_preg_replace__fopen.php",
                        [["\$tainted", "60", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__proc_open__no_sanitizing__fopen.php",
                        [["\$tainted", "55", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__shell_exec__func_preg_replace__fopen.php",
                        [["\$tainted", "48", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__shell_exec__no_sanitizing__fopen.php",
                        [["\$tainted", "46", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__system__func_preg_replace__fopen.php",
                        [["\$tainted", "48", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__system__no_sanitizing__fopen.php",
                        [["\$tainted", "46", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__unserialize__func_preg_replace__fopen.php",
                        [["\$string", "46", "code_injection"],
                        ["\$tainted", "50", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_Fopen__unserialize__no_sanitizing__fopen.php",
                        [["\$string", "46", "code_injection"],
                        ["\$tainted", "47", "idor"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__ESAPI__non_prepared_query-right_verification.php", []
                ],

                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__CAST-cast_int__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__CAST-cast_int__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__ESAPI__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__ESAPI__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__ESAPI__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__ESAPI__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__Indirect_reference__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__Indirect_reference__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__Indirect_reference__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__Indirect_reference__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__ternary_white_list__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__ternary_white_list__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__ternary_white_list__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__ternary_white_list__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__whitelist_using_array__non_prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__whitelist_using_array__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__whitelist_using_array__prepared_query-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__whitelist_using_array__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__ESAPI__non_prepared_query-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__ESAPI__prepared_query-no_right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__ESAPI__prepared_query-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__ESAPI__select_from_where-interpretation_simple_quote.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__Indirect_reference__non_prepared_query-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-no_right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__Indirect_reference__prepared_query-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__Indirect_reference__select_from_where-interpretation_simple_quote.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__ternary_white_list__non_prepared_query-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-no_right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__ternary_white_list__prepared_query-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__ternary_white_list__select_from_where-interpretation_simple_quote.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__whitelist_using_array__non_prepared_query-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-no_right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__whitelist_using_array__prepared_query-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__whitelist_using_array__select_from_where-interpretation_simple_quote.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__GET__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__POST__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__SESSION__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__array-GET__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__backticks__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__exec__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__fopen__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-Array__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-classicGet__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-directGet__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__object-indexArray__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__popen__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__proc_open__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__shell_exec__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__CAST-cast_int__prepared_query-no_right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__system__CAST-cast_int__select_from_where-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__CAST-cast_int__prepared_query-no_right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_SQL__unserialize__CAST-cast_int__select_from_where-interpretation_simple_quote.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__GET__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__GET__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__GET__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__GET__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__GET__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__POST__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__POST__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__POST__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__POST__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__POST__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__SESSION__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__SESSION__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__SESSION__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__SESSION__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__SESSION__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__array-GET__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__array-GET__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__array-GET__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__array-GET__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__array-GET__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__backticks__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__backticks__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__backticks__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__backticks__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__backticks__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__exec__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__exec__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__exec__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__exec__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__exec__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__fopen__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__fopen__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__fopen__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__fopen__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__fopen__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-Array__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-Array__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-Array__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-Array__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-Array__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-classicGet__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-classicGet__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-classicGet__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-classicGet__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-classicGet__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-directGet__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-directGet__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-directGet__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-directGet__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-directGet__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-indexArray__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-indexArray__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-indexArray__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-indexArray__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__object-indexArray__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__popen__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__popen__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__popen__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__popen__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__popen__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__proc_open__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__proc_open__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__proc_open__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__proc_open__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__proc_open__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__shell_exec__CAST-cast_int__concatenation-right_verification.php", []
                ],

                [
                    "./tests/vulntestsuite/CWE_862_XPath__shell_exec__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__shell_exec__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__shell_exec__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__shell_exec__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__system__CAST-cast_int__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__system__ternary_white_list__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__system__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__system__whitelist_using_array__concatenation-right_verification.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__system__whitelist_using_array__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__unserialize__CAST-cast_int__concatenation-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__unserialize__ternary_white_list__concatenation-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__unserialize__ternary_white_list__username_at-concatenation_simple_quote.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__unserialize__whitelist_using_array__concatenation-right_verification.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_862_XPath__unserialize__whitelist_using_array__username_at-concatenation_simple_quote.php",
                        [["\$string", "46", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__GET__CAST-func_settype_int__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__GET__CAST-func_settype_int__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__GET__func_FILTER-CLEANING-magic_quotes_filter__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__GET__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__GET__ternary_white_list__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__CAST-cast_float__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__CAST-cast_int__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__CAST-cast_int_sort_of2__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__CAST-func_settype_float__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_FILTER-CLEANING-number_int_filter__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_FILTER-VALIDATION-number_int_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_FILTER-VALIDATION-number_int_filter__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_htmlentities__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_intval__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_preg_match-letters_numbers__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_preg_match-letters_numbers__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_preg_match-letters_numbers__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_preg_match-letters_numbers__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_preg_replace__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__ternary_white_list__find_size-concatenation_simple_quote.php", []
                ],



                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_FILTER-CLEANING-number_float_filter__find_size-concatenation_simple_quote.php", []
                ],




                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_FILTER-CLEANING-number_float_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_addslashes__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_floatval__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_intval__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_preg_match-letters_numbers__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_preg_match-letters_numbers__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__func_preg_replace__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__ternary_white_list__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__SESSION__whitelist_using_array__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__CAST-cast_int_sort_of2__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__CAST-func_settype_float__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__func_intval__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__func_mysql_real_escape_string__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__func_preg_replace__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__whitelist_using_array__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__array-GET__whitelist_using_array__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__CAST-func_settype_int__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__func_FILTER-CLEANING-magic_quotes_filter__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "51", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__func_htmlspecialchars__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__func_htmlspecialchars__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__func_preg_match-only_numbers__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__func_preg_replace2__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__func_preg_replace__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__ternary_white_list__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__ternary_white_list__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__whitelist_using_array__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__exec__CAST-cast_int__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__exec__func_addslashes__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__exec__func_htmlspecialchars__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__exec__whitelist_using_array__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__exec__whitelist_using_array__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__CAST-cast_int__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__CAST-cast_int_sort_of2__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_FILTER-CLEANING-magic_quotes_filter__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_addslashes__cat-concatenation_simple_quote.php", []
                ],

                
                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_floatval__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_htmlentities__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_preg_match-letters_numbers__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_preg_replace2__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__ternary_white_list__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__whitelist_using_array__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__CAST-func_settype_float__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__func_FILTER-CLEANING-number_int_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__func_escapeshellarg__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__func_htmlentities__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__func_preg_match-only_letters__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__func_preg_match-only_letters__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__func_preg_match-only_numbers__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__func_preg_replace__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "67", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__ternary_white_list__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__whitelist_using_array__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-Array__whitelist_using_array__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_FILTER-VALIDATION-number_int_filter__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_htmlentities__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_htmlentities__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "64", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_htmlspecialchars__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_htmlspecialchars__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "64", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_preg_match-only_letters__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_preg_replace__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "64", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__ternary_white_list__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__ternary_white_list__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__whitelist_using_array__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__CAST-cast_int__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_FILTER-CLEANING-number_int_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_addslashes__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_addslashes__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_intval__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_preg_match-letters_numbers__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_preg_replace__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__ternary_white_list__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__ternary_white_list__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__whitelist_using_array__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__whitelist_using_array__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__whitelist_using_array__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__CAST-cast_int__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__CAST-func_settype_int__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "69", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_FILTER-VALIDATION-number_float_filter__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_addslashes__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_escapeshellarg__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "69", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_floatval__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_htmlspecialchars__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_htmlspecialchars__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_htmlspecialchars__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "67", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_intval__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_preg_replace2__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "67", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__ternary_white_list__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__ternary_white_list__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__whitelist_using_array__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__whitelist_using_array__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__whitelist_using_array__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__CAST-cast_int_sort_of__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_FILTER-CLEANING-magic_quotes_filter__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_FILTER-CLEANING-number_float_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_FILTER-CLEANING-number_float_filter__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_escapeshellarg__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_floatval__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_intval__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_intval__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_preg_match-only_letters__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_preg_replace2__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "51", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__ternary_white_list__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__whitelist_using_array__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__CAST-cast_int__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__CAST-func_settype_float__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_FILTER-CLEANING-number_float_filter__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_FILTER-CLEANING-number_int_filter__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_FILTER-VALIDATION-number_int_filter__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_escapeshellarg__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "63", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_escapeshellarg__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "63", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_mysql_real_escape_string__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_preg_match-letters_numbers__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_preg_replace__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_preg_replace__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "61", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__whitelist_using_array__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_FILTER-VALIDATION-number_int_filter__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_FILTER-VALIDATION-number_int_filter__find_size-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "51", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_htmlentities__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_htmlentities__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_htmlspecialchars__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_preg_replace2__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__ternary_white_list__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__ternary_white_list__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__whitelist_using_array__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__whitelist_using_array__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__whitelist_using_array__ls-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__CAST-func_settype_float__find_size-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__CAST-func_settype_int__find_size-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "51", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_addslashes__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_escapeshellarg__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_htmlentities__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_mysql_real_escape_string__find_size-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_preg_match-only_letters__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_preg_match-only_letters__cat-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_preg_match-only_letters__ls-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_preg_replace2__cat-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_preg_replace2__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_preg_replace__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_preg_replace__ls-concatenation_simple_quote.php", []
                ],

                [
                    "./tests/vulntestsuite/CWE_78__system__whitelist_using_array__cat-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_78__GET__no_sanitizing__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__POST__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "54", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php",
                        [["\$query", "54", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__backticks__no_sanitizing__find_size-concatenation_simple_quote.php",
                        [["\$query", "49", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php",
                        [["\$query", "57", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "63", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_preg_match-no_filtering__cat-interpretation_simple_quote.php",
                        [["\$query", "63", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php",
                        [["\$query", "63", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "63", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__fopen__no_sanitizing__find_size-concatenation_simple_quote.php",
                        [["\$query", "58", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-classicGet__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "69", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-directGet__func_preg_match-no_filtering__cat-concatenation_simple_quote.php",
                        [["\$query", "63", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "72", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__object-indexArray__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "72", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php",
                        [["\$query", "56", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "56", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_preg_match-no_filtering__ls-interpretation_simple_quote.php",
                        [["\$query", "56", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "56", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__popen__no_sanitizing__cat-interpretation_simple_quote.php",
                        [["\$query", "51", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php",
                        [["\$query", "66", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_preg_match-no_filtering__cat-concatenation_simple_quote.php",
                        [["\$query", "66", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_preg_match-no_filtering__ls-concatenation_simple_quote.php",
                        [["\$query", "66", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "66", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__proc_open__no_sanitizing__ls-concatenation_simple_quote.php",
                        [["\$query", "61", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "54", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__shell_exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php",
                        [["\$query", "54", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__system__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php",
                        [["\$query", "54", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__unserialize__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "53", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__unserialize__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php",
                        [["\$string", "45", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__unserialize__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "55", "command_injection"]]

                ],
                [
                    "./tests/vulntestsuite/CWE_78__unserialize__no_sanitizing__cat-sprintf_%s_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__unserialize__no_sanitizing__find_size-concatenation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "command_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_78__unserialize__no_sanitizing__find_size-sprintf_%s_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "command_injection"]]

                ],
                [
                    "./tests/vulntestsuite/CWE_89__GET__CAST-cast_float_sort_of__multiple_select-sprintf_%u_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__CAST-cast_int__multiple_AS-sprintf_%u_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__CAST-cast_int__multiple_select-sprintf_%u_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__CAST-cast_int_sort_of2__multiple_select-interpretation_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__CAST-func_settype_float__multiple_select-sprintf_%d.php", 
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__CAST-func_settype_float__select_from_where-sprintf_%s_simple_quote.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__func_intval__multiple_AS-sprintf_%d_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__func_intval__select_from_where-sprintf_%d.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__ternary_white_list__select_from_where-sprintf_%u.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__CAST-cast_float_sort_of__multiple_select-interpretation_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__CAST-cast_int__multiple_AS-concatenation.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__CAST-cast_int__multiple_AS-sprintf_%d.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__CAST-cast_int__multiple_select-concatenation.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__CAST-cast_int_sort_of__multiple_select-interpretation.php",  
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__CAST-func_settype_float__select_from_where-sprintf_%s_simple_quote.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%s_simple_quote.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__func_floatval__select_from_where-sprintf_%s_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__POST__func_preg_match-only_numbers__select_from_where-concatenation.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__CAST-cast_int_sort_of2__multiple_select-sprintf_%u_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__CAST-cast_int_sort_of__multiple_AS-concatenation_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__CAST-cast_int_sort_of__select_from_where-sprintf_%u.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php", 
                    [["\$data", "62", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__SESSION__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__func_floatval__multiple_select-concatenation_simple_quote.php",
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__func_floatval__select_from_where-sprintf_%d.php",
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__SESSION__ternary_white_list__multiple_select-concatenation.php", 
                    [["\$data", "57", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__SESSION__whitelist_using_array_from__select_from-sprintf_%s_simple_quote.php",
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__CAST-cast_float_sort_of__multiple_select-interpretation.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__CAST-cast_float_sort_of__select_from_where-concatenation_simple_quote.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__CAST-cast_int__multiple_AS-concatenation.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__CAST-cast_int_sort_of2__multiple_AS-sprintf_%u_simple_quote.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__CAST-cast_int_sort_of__multiple_AS-sprintf_%u_simple_quote.php",
                    [["\$data", "61", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__array-GET__CAST-func_settype_float__multiple_AS-sprintf_%s_simple_quote.php",
                    [["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%s_simple_quote.php",
                    [["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__func_floatval__multiple_select-interpretation_simple_quote.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__func_htmlentities__join-concatenation_simple_quote.php", 
                    [["\$data", "61", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__array-GET__func_intval__multiple_select-sprintf_%u.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__array-GET__func_intval__select_from_where-concatenation.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__backticks__CAST-cast_int_sort_of__multiple_AS-concatenation.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__backticks__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation_simple_quote.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__backticks__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d.php", 
                    [["\$data", "62", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__backticks__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__backticks__func_floatval__multiple_select-sprintf_%u_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__backticks__func_htmlspecialchars__join-concatenation_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__backticks__func_mysql_real_escape_string__multiple_AS-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "sql_injection"],
                        ["\$data", "57", "xss"]]
                ],
                
                [
                    "./tests/vulntestsuite/CWE_89__backticks__func_preg_match-only_numbers__select_from_where-sprintf_%u_simple_quote.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__backticks__whitelist_using_array__join-interpretation_simple_quote.php",
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u.php", 
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__exec__CAST-func_settype_int__multiple_select-sprintf_%u_simple_quote.php", 
                    [["\$data", "64", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u_simple_quote.php", 
                    [["\$data", "65", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__exec__func_floatval__multiple_select-sprintf_%u.php", 
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__exec__func_intval__select_from_where-concatenation.php",
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__exec__func_mysql_real_escape_string__multiple_select-sprintf_%d.php",
                        [["\$query", "52", "sql_injection"],
                        ["\$data", "60", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__exec__whitelist_using_array__multiple_AS-sprintf_%u_simple_quote.php", 
                    [["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__fopen__CAST-cast_float__multiple_select-concatenation.php",
                    [["\$data", "66", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__fopen__CAST-cast_int_sort_of2__select_from_where-sprintf_%u_simple_quote.php",
                    [["\$data", "66", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__fopen__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation.php",
                    [["\$data", "70", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__fopen__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%s_simple_quote.php",
                    [["\$data", "70", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__fopen__func_preg_replace__select_from-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "sql_injection"],
                        ["\$data", "66", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__fopen__ternary_white_list__multiple_AS-sprintf_%u.php",                     
                    [["\$data", "66", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__fopen__ternary_white_list__select_from_where-concatenation.php",                    
                    [["\$data", "66", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__fopen__whitelist_using_array__multiple_select-sprintf_%u_simple_quote.php",                    
                    [["\$data", "71", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__CAST-cast_int__multiple_select-concatenation_simple_quote.php",                    
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__CAST-cast_int__multiple_select-sprintf_%d.php",                    
                    [["\$data", "75", "xss"]]
                ],
                
                [
                    "./tests/vulntestsuite/CWE_89__object-Array__CAST-cast_int_sort_of__multiple_AS-sprintf_%d.php",                    
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__CAST-cast_int_sort_of__select_from_where-sprintf_%s_simple_quote.php",                    
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__CAST-func_settype_float__multiple_AS-sprintf_%u.php",                   
                    [["\$data", "79", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__CAST-func_settype_float__select_from_where-sprintf_%u_simple_quote.php",                    
                    [["\$data", "79", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php",
                        [["\$query", "69", "sql_injection"],
                        ["\$data", "77", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-Array__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u.php",            
                    [["\$data", "80", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__func_floatval__multiple_AS-sprintf_%d_simple_quote.php",            
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__func_floatval__multiple_select-concatenation_simple_quote.php",           
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__func_floatval__multiple_select-sprintf_%d.php",           
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__func_floatval__select_from_where-interpretation.php",            
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-Array__func_intval__multiple_AS-sprintf_%u_simple_quote.php",           
                    [["\$data", "75", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__CAST-cast_float__multiple_AS-interpretation.php",           
                    [["\$data", "72", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__CAST-cast_int__select_from_where-sprintf_%u.php",            
                    [["\$data", "72", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__CAST-func_settype_float__multiple_AS-interpretation.php",           
                    [["\$data", "76", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__CAST-func_settype_int__multiple_AS-sprintf_%u_simple_quote.php",           
                    [["\$data", "76", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__CAST-func_settype_int__multiple_select-concatenation.php",           
                    [["\$data", "76", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__CAST-func_settype_int__select_from_where-sprintf_%d.php",            
                    [["\$data", "76", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation.php",           
                    [["\$data", "77", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation_simple_quote.php",           
                    [["\$data", "76", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation.php",           
                    [["\$data", "76", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__func_floatval__multiple_select-sprintf_%d.php",           
                    [["\$data", "72", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__func_htmlentities__join-sprintf_%s_simple_quote.php",
                        [["\$query", "64", "sql_injection"],
                        ["\$data", "72", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__func_preg_match-only_numbers__multiple_AS-interpretation.php", 
                    [["\$data", "77", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__func_preg_match-only_numbers__multiple_select-interpretation.php", 
                    [["\$data", "77", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__ternary_white_list__join-sprintf_%s_simple_quote.php", 
                    [["\$data", "72", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-classicGet__ternary_white_list__select_from-interpretation_simple_quote.php",
                    [["\$data", "72", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__CAST-cast_float_sort_of__select_from_where-concatenation.php",
                    [["\$data", "66", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__CAST-cast_int__multiple_select-sprintf_%u_simple_quote.php", 
                    [["\$data", "66", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__CAST-cast_int_sort_of2__multiple_select-sprintf_%u_simple_quote.php", 
                    [["\$data", "66", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__CAST-cast_int_sort_of__multiple_select-sprintf_%u.php", 
                    [["\$data", "66", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation.php", 
                    [["\$data", "71", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation_simple_quote.php",
                    [["\$data", "70", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__func_mysql_real_escape_string__multiple_select-sprintf_%u_simple_quote.php",
                        [["\$query", "58", "sql_injection"],
                        ["\$data", "66", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__func_mysql_real_escape_string__select_from_where-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "sql_injection"],
                        ["\$data", "66", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__CAST-cast_float_sort_of__multiple_select-interpretation_simple_quote.php",
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__CAST-cast_int__multiple_select-sprintf_%d_simple_quote.php",
                    [["\$data", "75", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__CAST-cast_int_sort_of__multiple_select-sprintf_%s_simple_quote.php", 
                    [["\$data", "75", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__CAST-func_settype_float__multiple_AS-interpretation_simple_quote.php", 
                    [["\$data", "79", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%s_simple_quote.php",
                    [["\$data", "79", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__func_preg_match-only_numbers__multiple_select-sprintf_%d_simple_quote.php", 
                    [["\$data", "80", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__whitelist_using_array__join-interpretation_simple_quote.php", 
                    [["\$data", "80", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__whitelist_using_array__select_from-interpretation_simple_quote.php", 
                    [["\$data", "80", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__popen__CAST-cast_float__multiple_select-sprintf_%d_simple_quote.php", 
                    [["\$data", "59", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__CAST-cast_float__select_from_where-sprintf_%d_simple_quote.php",
                    [["\$data", "59", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__CAST-func_settype_int__multiple_select-concatenation_simple_quote.php", 
                    [["\$data", "63", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation.php", 
                    [["\$data", "64", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__func_floatval__multiple_select-concatenation.php", 
                    [["\$data", "59", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__func_intval__select_from_where-concatenation.php", 
                    [["\$data", "59", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__func_mysql_real_escape_string__multiple_AS-sprintf_%d.php",
                        [["\$query", "51", "sql_injection"],
                        ["\$data", "59", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__ternary_white_list__multiple_AS-concatenation_simple_quote.php", 
                    [["\$data", "59", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__ternary_white_list__multiple_select-sprintf_%u.php", 
                    [["\$data", "59", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__CAST-cast_float__multiple_select-concatenation.php", 
                    [["\$data", "69", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__CAST-cast_float_sort_of__multiple_select-sprintf_%s_simple_quote.php",
                    [["\$data", "69", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__CAST-cast_int__select_from_where-interpretation.php", 
                    [["\$data", "69", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__CAST-cast_int_sort_of2__multiple_select-sprintf_%d.php", 
                    [["\$data", "69", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__CAST-cast_int_sort_of__multiple_AS-sprintf_%s_simple_quote.php",
                    [["\$data", "69", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation.php", 
                    [["\$data", "73", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__func_intval__select_from_where-concatenation.php",
                    [["\$data", "69", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__func_intval__select_from_where-sprintf_%d_simple_quote.php",
                    [["\$data", "69", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__func_preg_match-only_numbers__select_from_where-concatenation.php", 
                    [["\$data", "74", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__whitelist_using_array__multiple_AS-sprintf_%d_simple_quote.php", 
                    [["\$data", "74", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__proc_open__whitelist_using_array__select_from_where-sprintf_%d.php", 
                    [["\$data", "74", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d.php",
                    [["\$data", "57", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__CAST-cast_int_sort_of2__multiple_AS-sprintf_%u.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__CAST-cast_int_sort_of__select_from_where-interpretation_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d.php",
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u.php",
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__func_intval__multiple_AS-sprintf_%d_simple_quote.php",
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__ternary_white_list__select_from_where-sprintf_%d_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__whitelist_using_array__multiple_select-sprintf_%d.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__CAST-cast_float__multiple_AS-interpretation_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__system__CAST-func_settype_float__multiple_select-sprintf_%u_simple_quote.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__CAST-func_settype_float__select_from_where-interpretation_simple_quote.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__func_FILTER-CLEANING-magic_quotes_filter__select_from-concatenation_simple_quote.php", 
                    [["\$data", "59", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__system__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d.php", 
                    [["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__func_preg_match-only_numbers__select_from_where-sprintf_%u_simple_quote.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__func_preg_replace2__join-concatenation_simple_quote.php", 
                     [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__ternary_white_list__multiple_select-sprintf_%d_simple_quote.php", 
                    [["\$data", "57", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__ternary_white_list__multiple_select-sprintf_%u.php", 
                    [["\$data", "57", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__system__whitelist_using_array__multiple_AS-sprintf_%s_simple_quote.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__whitelist_using_array__multiple_select-sprintf_%d_simple_quote.php", 
                    [["\$data", "62", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__CAST-cast_float_sort_of__multiple_AS-sprintf_%u.php",
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__CAST-cast_int__multiple_AS-interpretation.php", 
                    [["\$data", "60", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__unserialize__CAST-cast_int__multiple_AS-sprintf_%u_simple_quote.php", 
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__CAST-func_settype_float__multiple_select-concatenation.php", 
                    [["\$data", "64", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d.php", 
                    [["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php", 
                    [["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation_simple_quote.php",
                    [["\$data", "65", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation.php",
                    [["\$data", "64", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_floatval__multiple_AS-sprintf_%s_simple_quote.php", 
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_intval__multiple_select-sprintf_%u.php", 
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_intval__select_from_where-sprintf_%u.php", 
                    [["\$data", "60", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_preg_match-only_letters__select_from-interpretation_simple_quote.php",
                    [["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_preg_match-only_numbers__multiple_select-concatenation.php", 
                    [["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__ternary_white_list__select_from_where-sprintf_%u.php", 
                    [["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__whitelist_using_array__multiple_select-sprintf_%s_simple_quote.php", 
                    [["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__no_sanitizing__join-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "xss"],
                        ["\$query", "49", "sql_injection"],
                        ["\$data", "58", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__GET__no_sanitizing__multiple_AS-interpretation.php",
                        [["\$query", "49", "xss"],
                        ["\$query", "49", "sql_injection"],
                        ["\$data", "58", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__backticks__func_preg_match-no_filtering__join-concatenation_simple_quote.php",
                        [["\$query", "54", "xss"],
                        ["\$query", "54", "sql_injection"],
                        ["\$data", "63", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php",
                        [["\$query", "57", "xss"],
                        ["\$query", "57", "sql_injection"],
                        ["\$data", "66", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php",
                        [["\$query", "52", "xss"],
                        ["\$query", "52", "sql_injection"],
                        ["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__exec__no_sanitizing__multiple_select-interpretation_simple_quote.php",
                        [["\$query", "52", "xss"],
                        ["\$query", "52", "sql_injection"],
                        ["\$data", "61", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php",
                        [["\$query", "63", "xss"],
                        ["\$query", "63", "sql_injection"],
                        ["\$data", "72", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-directGet__no_sanitizing__select_from-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "xss"],
                        ["\$query", "58", "sql_injection"],
                        ["\$data", "67", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php",
                        [["\$query", "72", "xss"],
                        ["\$query", "72", "sql_injection"],
                        ["\$data", "81", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__object-indexArray__func_preg_match-no_filtering__join-concatenation_simple_quote.php",
                        [["\$query", "72", "xss"],
                        ["\$query", "72", "sql_injection"],
                        ["\$data", "81", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php",
                        [["\$query", "56", "xss"],
                        ["\$query", "56", "sql_injection"],
                        ["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__popen__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php",
                        [["\$query", "56", "xss"],
                        ["\$query", "56", "sql_injection"],
                        ["\$data", "65", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__func_mysql_real_escape_string__multiple_select-interpretation.php",
                        [["\$query", "49", "xss"],
                        ["\$query", "49", "sql_injection"],
                        ["\$data", "58", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__no_sanitizing__multiple_AS-concatenation_simple_quote.php",
                        [["\$query", "49", "xss"],
                        ["\$query", "49", "sql_injection"],
                        ["\$data", "58", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__shell_exec__no_sanitizing__multiple_AS-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "xss"],
                        ["\$query", "49", "sql_injection"],
                        ["\$data", "58", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php",
                        [["\$query", "54", "xss"],
                        ["\$query", "54", "sql_injection"],
                        ["\$data", "63", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__func_preg_match-no_filtering__join-interpretation_simple_quote.php",
                        [["\$query", "54", "xss"],
                        ["\$query", "54", "sql_injection"],
                        ["\$data", "63", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__system__no_sanitizing__multiple_AS-concatenation.php",
                        [["\$query", "49", "xss"],
                        ["\$query", "49", "sql_injection"],
                        ["\$data", "58", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_mysql_real_escape_string__multiple_AS-concatenation.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "xss"],
                        ["\$query", "51","sql_injection"],
                        ["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__func_mysql_real_escape_string__multiple_select-concatenation.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "xss"],
                        ["\$query", "51", "sql_injection"],
                        ["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__no_sanitizing__select_from_where-concatenation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "xss"],
                        ["\$query", "51", "sql_injection"],
                        ["\$data", "60", "xss"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_89__unserialize__no_sanitizing__select_from_where-interpretation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "xss"],
                        ["\$query", "51", "sql_injection"],
                        ["\$data", "60", "xss"]]
                ],

                [
                    "./tests/vulntestsuite/CWE_90__GET__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_pg_escape_literal__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_preg_match-letters_numbers__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_preg_match-letters_numbers__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_preg_match-only_letters__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_preg_replace_ldap_char_white_list__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__whitelist_using_array__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__whitelist_using_array__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__whitelist_using_array__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_FILTER-CLEANING-full_special_chars_filter__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_FILTER-CLEANING-full_special_chars_filter__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_FILTER-CLEANING-full_special_chars_filter__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_FILTER-CLEANING-special_chars_filter__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_preg_match-only_letters__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_preg_match-only_letters__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_preg_match-only_letters__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__ternary_white_list__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__whitelist_using_array__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_pg_escape_literal__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_preg_match-only_letters__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_preg_replace_ldap_char_white_list__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_preg_replace_ldap_char_white_list__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__func_str_replace_ldap_char_black_list__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__ternary_white_list__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__ternary_white_list__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__whitelist_using_array__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__SESSION__whitelist_using_array__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__array-GET__func_FILTER-CLEANING-full_special_chars_filter__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__array-GET__func_FILTER-CLEANING-special_chars_filter__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__array-GET__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__array-GET__func_str_replace_ldap_char_black_list__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__array-GET__ternary_white_list__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__array-GET__ternary_white_list__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__array-GET__ternary_white_list__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__array-GET__ternary_white_list__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__backticks__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__backticks__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__backticks__ternary_white_list__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__backticks__ternary_white_list__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__backticks__ternary_white_list__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__backticks__ternary_white_list__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_pg_escape_literal__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_pg_escape_literal__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_preg_match-letters_numbers__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_preg_match-letters_numbers__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_preg_match-letters_numbers__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_preg_match-only_letters__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__ternary_white_list__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__exec__whitelist_using_array__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_FILTER-CLEANING-special_chars_filter__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_pg_escape_literal__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_preg_match-only_letters__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_preg_match-only_letters__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_preg_replace_ldap_char_white_list__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_pg_escape_literal__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_preg_match-only_letters__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_preg_match-only_letters__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_preg_match-only_letters__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_preg_match-only_letters__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__whitelist_using_array__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_preg_match-letters_numbers__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_preg_match-letters_numbers__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_preg_replace_ldap_char_white_list__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__ternary_white_list__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__ternary_white_list__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__whitelist_using_array__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__whitelist_using_array__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_pg_escape_literal__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_pg_escape_literal__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__ternary_white_list__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__ternary_white_list__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_FILTER-CLEANING-special_chars_filter__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_pg_escape_literal__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_preg_match-letters_numbers__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__ternary_white_list__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_FILTER-CLEANING-full_special_chars_filter__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_preg_match-letters_numbers__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_preg_match-letters_numbers__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_preg_match-letters_numbers__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_preg_match-letters_numbers__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_preg_match-only_letters__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_preg_match-only_letters__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__whitelist_using_array__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__whitelist_using_array__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__whitelist_using_array__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__whitelist_using_array__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_FILTER-CLEANING-full_special_chars_filter__name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_FILTER-CLEANING-special_chars_filter__userByCN-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_pg_escape_literal__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_preg_match-letters_numbers__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_preg_replace_ldap_char_white_list__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__ternary_white_list__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_FILTER-CLEANING-special_chars_filter__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_preg_match-letters_numbers__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_preg_match-letters_numbers__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_preg_match-only_letters__not_name-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_preg_match-only_letters__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_preg_replace_ldap_char_white_list__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__ternary_white_list__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__ternary_white_list__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__ternary_white_list__userByMail-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__whitelist_using_array__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_FILTER-CLEANING-full_special_chars_filter__name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_FILTER-CLEANING-full_special_chars_filter__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_FILTER-CLEANING-full_special_chars_filter__userByMail-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_pg_escape_literal__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_pg_escape_literal__userByCN-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__ternary_white_list__name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__ternary_white_list__not_name-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__ternary_white_list__userByMail-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php",
                        [["\$query", "54", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php",
                        [["\$query", "54", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_addslashes__name-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_addslashes__name-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_addslashes__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_htmlentities__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_htmlentities__userByMail-concatenation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_htmlentities__userByMail-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_htmlentities__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__func_htmlspecialchars__not_name-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__GET__no_sanitizing__not_name-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_addslashes__name-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_addslashes__userByMail-concatenation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__func_htmlentities__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__no_sanitizing__name-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__no_sanitizing__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__no_sanitizing__userByCN-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__POST__no_sanitizing__userByMail-concatenation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_addslashes__name-interpretation_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_addslashes__userByCN-interpretation_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_addslashes__userByCN-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_addslashes__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_htmlentities__name-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__fopen__no_sanitizing__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php",
                        [["\$query", "72", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "72", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php",
                        [["\$query", "72", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_addslashes__userByCN-interpretation_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_htmlentities__not_name-concatenation_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-Array__func_htmlentities__userByMail-concatenation_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php",
                        [["\$query", "69", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_addslashes__name-concatenation_simple_quote.php",
                        [["\$query", "64", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_addslashes__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "64", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_preg_match-no_filtering__name-concatenation_simple_quote.php",
                        [["\$query", "69", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-classicGet__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php",
                        [["\$query", "69", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php",
                        [["\$query", "63", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php",
                        [["\$query", "63", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_addslashes__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_htmlspecialchars__name-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_htmlspecialchars__not_name-interpretation_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_htmlspecialchars__userByCN-interpretation_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_htmlspecialchars__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php",
                        [["\$query", "63", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php",
                        [["\$query", "63", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "63", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__no_sanitizing__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-directGet__no_sanitizing__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "58", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_htmlentities__not_name-concatenation_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_htmlentities__userByCN-interpretation_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_htmlentities__userByCN-sprintf_%s_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_htmlentities__userByMail-interpretation_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_htmlspecialchars__not_name-interpretation_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__func_htmlspecialchars__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__object-indexArray__no_sanitizing__name-concatenation_simple_quote.php",
                        [["\$query", "67", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php",
                        [["\$query", "56", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "56", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_htmlspecialchars__not_name-interpretation_simple_quote.php",
                        [["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_htmlspecialchars__userByCN-sprintf_%s_simple_quote.php",
                        [["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_htmlspecialchars__userByMail-interpretation_simple_quote.php",
                        [["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php",
                        [["\$query", "56", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__no_sanitizing__name-interpretation_simple_quote.php",
                        [["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__no_sanitizing__userByCN-interpretation_simple_quote.php",
                        [["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__popen__no_sanitizing__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php",
                        [["\$query", "66", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_addslashes__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "61", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_htmlentities__not_name-concatenation_simple_quote.php",
                        [["\$query", "61", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_htmlentities__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "61", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php",
                        [["\$query", "66", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__no_sanitizing__name-sprintf_%s_simple_quote.php",
                        [["\$query", "61", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__proc_open__no_sanitizing__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "61", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_addslashes__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_addslashes__userByMail-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_htmlentities__name-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_htmlentities__userByCN-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php",
                        [["\$query", "54", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__shell_exec__no_sanitizing__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_addslashes__not_name-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_htmlentities__userByCN-sprintf_%s_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_htmlspecialchars__userByCN-concatenation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_htmlspecialchars__userByMail-interpretation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php",
                        [["\$query", "54", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__system__no_sanitizing__not_name-concatenation_simple_quote.php",
                        [["\$query", "49", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "56", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php",
                        [["\$string", "45", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_addslashes__userByCN-concatenation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_htmlspecialchars__name-interpretation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_htmlspecialchars__not_name-interpretation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_htmlspecialchars__userByCN-interpretation_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "51", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_pg_escape_string__not_name-interpretation_simple_quote.php",
                        [["\$string", "45", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php",
                        [["\$string", "45", "code_injection"],
                        ["\$query", "56", "ldap_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_preg_replace2__not_name-concatenation_simple_quote.php",
                        [["\$string", "45", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_preg_replace2__userByMail-interpretation_simple_quote.php",
                        [["\$string", "45", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_90__unserialize__func_preg_replace__userByMail-concatenation_simple_quote.php",
                        [["\$string", "45", "code_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__CAST-cast_float__ID_test-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__CAST-cast_int_sort_of2__ID_test-interpretation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__func_intval__ID_test-concatenation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__func_preg_match-letters_numbers__username-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__GET__ternary_white_list__ID_test-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__CAST-cast_float__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__CAST-cast_float_sort_of__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__func_floatval__ID_test-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__func_preg_match-only_letters__username_text-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__func_preg_match-only_numbers__ID_test-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__func_preg_match-only_numbers__ID_test-interpretation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__ternary_white_list__username_at-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__POST__whitelist_using_array__ID_test-concatenation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__CAST-cast_int_sort_of2__ID_test-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__CAST-func_settype_int__ID_test-interpretation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__func_floatval__ID_test-sprintf_%d_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__func_preg_replace2__username_text-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__func_preg_replace__data-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__func_preg_replace__username-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__func_preg_replace__username-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__func_preg_replace__username-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__object-func_mysql_real_escape_string__username_at-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__SESSION__whitelist_using_array__username-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__CAST-cast_int_sort_of2__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__func_floatval__ID_test-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__func_mysql_real_escape_string__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__func_preg_match-only_letters__data-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__array-GET__object-func_mysql_real_escape_string__username_text-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__backticks__CAST-func_settype_int__ID_test-sprintf_%d.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__backticks__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__backticks__ternary_white_list__username-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__exec__func_htmlspecialchars__username-concatenation_simple_quote.php", 
                        [["\$query", "52" , "xml_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_91__fopen__CAST-cast_float_sort_of__ID_test-sprintf_%d.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__fopen__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__fopen__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__fopen__func_floatval__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__fopen__ternary_white_list__ID_test-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__fopen__ternary_white_list__username-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__fopen__ternary_white_list__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__fopen__whitelist_using_array__ID_test-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-Array__CAST-cast_int__ID_test-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-Array__CAST-cast_int__ID_test-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-Array__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-Array__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-Array__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-Array__func_intval__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-Array__func_preg_match-letters_numbers__data-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-classicGet__CAST-cast_float__ID_test-interpretation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-classicGet__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-classicGet__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-directGet__CAST-cast_int_sort_of__ID_test-concatenation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-directGet__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-directGet__func_preg_match-only_letters__username_text-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-directGet__whitelist_using_array__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-indexArray__CAST-func_settype_float__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-indexArray__CAST-func_settype_float__ID_test-sprintf_%d.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-indexArray__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-indexArray__func_preg_match-only_letters__username_text-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-indexArray__func_preg_match-only_numbers__ID_test-concatenation.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-indexArray__ternary_white_list__data-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__object-indexArray__ternary_white_list__username_text-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__popen__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__popen__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__popen__whitelist_using_array__username_text-concatenation_simple_quote.php", []
                ],

                [
                    "./tests/vulntestsuite/CWE_91__proc_open__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__proc_open__func_htmlspecialchars__username_text-interpretation_simple_quote.php", 
                    [["\$query", "61", "xml_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_91__proc_open__func_intval__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__proc_open__func_preg_match-only_letters__username_at-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__proc_open__whitelist_using_array__data-concatenation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__shell_exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__shell_exec__func_preg_match-only_letters__username_text-interpretation_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__system__CAST-cast_int_sort_of2__ID_test-interpretation_simple_quote.php", []
                ],

            
                [
                    "./tests/vulntestsuite/CWE_91__system__CAST-cast_int_sort_of__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__system__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__system__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__system__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__system__func_htmlentities__username_at-sprintf_%s_simple_quote.php", 
                    [["\$query", "49", "xml_injection"]]
                ],


                [
                    "./tests/vulntestsuite/CWE_91__system__func_preg_match-letters_numbers__username_text-sprintf_%s_simple_quote.php", []
                ],


                [
                    "./tests/vulntestsuite/CWE_91__system__func_preg_match-only_letters__username-sprintf_%s_simple_quote.php", []
                ]
                
            ];
