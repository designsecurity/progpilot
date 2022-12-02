<?php

        return [
                [
                    "./tests/generic/alias1.php",
                        [["\$var1", "6", "xss"]]
                ],
                [
                    "./tests/generic/alias2.php",
                        [["\$var6", "4", "xss"]]
                ],
                [
                    "./tests/generic/alias3.php",
                        [[array("\$var5", "\$var6"), array("3", "4") , "xss"]]
                ],
                [
                    "./tests/generic/alias4.php",
                        [["\$var5", "3", "xss"]]
                ],
                [
                    "./tests/generic/alias5.php",
                        [["\$var5[\"t\"]", "6", "xss"]]
                ],
                [
                    "./tests/generic/mix1.php",
                        [["\$var1[0]", "9", "xss"]]
                ],
                [
                    "./tests/generic/mix2.php",
                        [["\$var1", "6", "xss"]]
                ],
                [
                    "./tests/generic/mix3.php",
                        [["\$var2", "9", "xss"]]
                ],
                [
                    "./tests/generic/simple1.php",
                        [["\$myvar4", "9", "xss"]]
                ],
                [
                    "./tests/generic/simple2.php",
                        [["\$myvar2", "3", "xss"]]
                ],
                [
                    "./tests/generic/simple3.php",
                        [["\$var7", "4", "xss"]]
                ],
                [
                    "./tests/generic/simple4.php",
                        [["\$var4", "5", "xss"]]
                ],
                [
                    "./tests/generic/simple5.php",
                        [["\$myvar1[11]", "5", "xss"]]
                ],
                [
                    "./tests/generic/simple6.php",
                        [["\$var4", "5", "xss"]]
                ],
                [
                    "./tests/generic/simple7.php",
                        [["\$myvar1", "3", "xss"]]
                ],
                [
                    "./tests/generic/simple8.php",
                        [["\$var_gauche[0]", "5", "xss"],
                        ["\$ret[0]", "10", "xss"]]
                ],
                [
                    "./tests/generic/simple9.php",
                        [["\$_GET[\"p1\"]", "3", "create_function code_injection"],
                        ["\$_GET[\"t1\"]", "3", "create_function code_injection"],
                        ["\$_GET[\"t1\"]", "4", "create_function code_injection"],
                        ["\$_GET[\"p1\"]", "5", "create_function code_injection"]]
                ],
                [
                    "./tests/generic/simple10.php",
                        [["\$_GET[\"p\"]", "3", "xss"]]
                ],
                [
                    "./tests/generic/concat1.php",
                        [["\$myvar7", "7", "xss"]]
                ],
                [
                    "./tests/generic/concat2.php",
                        [["\$query", "12", "sql_injection"]]
                ],

                [
                    "./tests/generic/concat3.php",
                        [["\$aaa", "3", "xss"],
                        ["\$bbb", "5", "xss"]]
                ],

                [
                    "./tests/generic/arrays1.php",
                        [["\$newmyarr[11][9865]", "7", "xss"]]
                ],

                [
                    "./tests/generic/arrays2.php",
                        [["\$newmyarr[11][9865]", "4", "xss"]]
                ],
                [
                    "./tests/generic/arrays3.php",
                        [["\$newmyarr[11]", "7", "xss"]]
                ],
                [
                    "./tests/generic/arrays4.php",
                        [["\$copy[11]", "8", "xss"]]
                ],
                [
                    "./tests/generic/arrays5.php",
                        [["\$newmyarr[11][9865]", "6", "xss"]]
                ],
                [
                    "./tests/generic/arrays6.php",
                        [["\$_GET[\"t\"]", "6", "xss"]]
                ],
                [
                    "./tests/generic/arrays7.php",
                        [["\$testarr[11][9865]", "7", "xss"]]
                ],
                [
                    "./tests/generic/arrays8.php",
                        [["\$arr[1113]", "9", "xss"]]
                ],
                [
                    "./tests/generic/arrays9.php",
                        [["\$testarr[6661]", "8", "xss"]]
                ],
                [
                    "./tests/generic/arrays10.php",
                        [["\$arr[0]", "5", "xss"]]
                ],
                [
                    "./tests/generic/arrays11.php",
                        [["\$arr[0][1]", "7", "xss"]]
                ],
                [
                    "./tests/generic/arrays12.php",
                        [["\$var2[1]", "13", "xss"]]
                ],
                [
                    "./tests/generic/arrays13.php",
                        [["\$_GET[\"t\"]", "5", "xss"]]
                ],
                [
                    "./tests/generic/arrays14.php",
                        [["\$var2[11][1]", "12", "xss"]]
                ],
                [
                    "./tests/generic/arrays15.php",
                        [["\$var1", "8", "xss"]]
                ],
                [
                    "./tests/generic/arrays16.php",
                        [["\$var[\"t\"]", "5", "xss"]]
                ],
                [
                    "./tests/generic/arrays17.php",
                        [["\$values[0]", "7", "xss"]]
                ],
                [
                    "./tests/generic/arrays18.php",
                        [["\$var5[\"t\"]", "5", "xss"]]
                ],
                [
                    "./tests/generic/arrays19.php",
                        [["\$var5[\"t\"]", "6", "xss"],
                        ["\$var5[\"t\"]", "14", "xss"]]
                ],
                [
                    "./tests/generic/arrays20.php",
                        [["\$a", "3", "xss"]]
                ],
                [
                    "./tests/generic/arraysrec1.php",
                        [["\$var1[1]", "10", "xss"]]
                ],
                [
                    "./tests/generic/arraysexpr1.php",
                        [["\$newmyarr[2]", "7", "xss"]]
                ],
                [
                    "./tests/generic/arraysexpr2.php",
                        [["\$newmyarr[2][1][2]", "6", "xss"]]
                ],
                [
                    "./tests/generic/arraysexpr3.php",
                        [["\$newmyarr[2][2][11][6661]", "10", "xss"]]
                ],
                [
                    "./tests/generic/arraysexpr4.php",
                        [["\$var_main[\"TEST1\"]", "10", "xss"]]
                ],
                [
                    "./tests/generic/functions1.php",
                        [["\$parama", "3", "xss"]]
                ],
                [
                    "./tests/generic/functions2.php",
                        [["\$safea[0]", "10", "xss"]]
                ],
                [
                    "./tests/generic/functions3.php",
                        [["\$arraysafe[0]", "14", "xss"]]
                ],
                [
                    "./tests/generic/functions4.php",
                        [["\$testf_return", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions5.php",
                        [["\$testf_return[0]", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions6.php",
                        [["\$_GET[\"p\"]", "5", "xss"],
                        ["\$_GET[\"p\"]", "10", "xss"],
                        ["\$_GET[\"p\"]", "15", "xss"]]
                ],
                [
                    "./tests/generic/functions7.php",
                        [["\$var1", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions8.php",
                        [["\$var1", "6", "xss"]]
                ],
                [
                    "./tests/generic/functions9.php",
                        [["\$ret[0][8989][1]", "12", "xss"]]
                ],
                [
                    "./tests/generic/functions10.php",
                        [["\$ret[0][1][989]", "12", "xss"]]
                ],
                [
                    "./tests/generic/functions11.php",
                        [["\$ret[0]", "10", "xss"]]
                ],
                [
                    "./tests/generic/functions12.php",
                        [["\$ret_gauche[0][8989][1][989]", "12", "xss"]]
                ],
                [
                    "./tests/generic/functions13.php",
                        [["\$ret[0][0]", "10", "xss"]]
                ],
                [
                    "./tests/generic/functions14.php",
                        [["\$param", "3", "xss"]]
                ],
                [
                    "./tests/generic/functions15.php",
                        [["\$var_param[1][12]", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions16.php",
                        [["\$var_param[1][12]", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions17.php",
                        [["\$param2", "3", "xss"]]
                ],
                [
                    "./tests/generic/functions18.php",
                        [["\$param2", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions19.php",
                        [["\$param2[\"test\"]", "6", "xss"]]
                ],
                [
                    "./tests/generic/functions20.php",
                        [["\$thisfunctionexistandreturn_return", "23", "xss"]]
                ],
                [
                    "./tests/generic/functions21.php",
                        [["\$ret", "16", "xss"]]
                ],
                [
                    "./tests/generic/functions22.php",
                        [["\$ret1", "10", "xss"],
                        ["\$ret2", "14", "xss"]]
                ],
                [
                    "./tests/generic/functions23.php",
                        [["\$b", "19", "xss"]]
                ],
                [
                    "./tests/generic/functionsrec1.php",
                        [["\$var", "15", "xss"]]
                ],
                [
                    "./tests/generic/strings1.php",
                        [["\$vuln2", "7", "command_injection"],
                        ["\$vuln3", "11", "command_injection"],
                        ["\$vuln4", "15", "command_injection"],
                        ["\$id1", "19", "sql_injection"],
                        ["\$id2", "22", "sql_injection"],
                        ["\$id3", "25", "sql_injection"],
                        ["\$tainted1", "48", "xss"],
                        ["\$tainted2", "51", "xss"],
                        ["\$tainted3", "54", "xss"],
                        ["\$tainted21", "64", "xss"],
                        ["\$tainted31", "70", "xss"],
                        ["\$tainted32", "73", "xss"]]
                ],
                [
                    "./tests/generic/foreach1.php",
                        [["\$array_value", "12", "xss"]]
                ],

                [
                    "./tests/generic/global1.php",
                        [["\$myvar1", "4", "xss"]]
                ],

                [
                    "./tests/generic/global2.php",
                        [["\$myvar1", "4", "xss"]]
                ],
/* // removed because optimizations
                [
                    "./tests/generic/global3.php",
                        [["\$myvar1", "3", "xss"]]
                ],
*/
                [
                    "./tests/generic/namespace1.php",
                        [["\$_GET[\"p\"]", "9", "xss"]]
                ],
                [
                    "./tests/generic/namespace2.php",
                        [["\$_GET[\"p\"]", "7", "xss"]]
                ],
                [
                    "./tests/generic/calluserfunc1.php",
                        [["\$a", "3", "xss"]]
                ],
                [
                    "./tests/generic/calluserfunc2.php",
                        [["\$a", "3", "xss"]]
                ],
                [
                    "./tests/generic/calluserfunc3.php",
                        [["\$a", "3", "xss"]]
                ],
                [
                    "./tests/generic/calluserfunc4.php",
                        [["\$a", "3", "xss"]]
                ],
                [
                    "./tests/generic/loop1.php",
                        [["\$file", "10", "xss"]]
                ],
                [
                    "./tests/generic/loop2.php",
                        [["\$row->title", "7", "xss"]]
                ],
                [
                    "./tests/generic/loop3.php",
                        [["\$row->title", "5", "xss"]]
                ],
                [
                    "./tests/generic/loop4.php",
                        [["\$this->last_query", "6", "xss"]]
                ]
                
        ];
