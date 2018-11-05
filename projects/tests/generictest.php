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
                        [["\$var5[\"t\"]", "3", "xss"]]
                ],
                [
                    "./tests/generic/mix1.php",
                        [["\$var1[0]", "4", "xss"]]
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
                        [["\$myvar1[11]", "3", "xss"]]
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
                        [["\$var_gauche[0]", "3", "xss"],
                        ["\$ret[0]", "8", "xss"]]
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
                        [["\$newmyarr[11][9865]", "4", "xss"]]
                ],

                [
                    "./tests/generic/arrays2.php",
                        [["\$newmyarr[11][9865]", "3", "xss"]]
                ],
                [
                    "./tests/generic/arrays3.php",
                        [["\$newmyarr[11]", "4", "xss"]]
                ],
                [
                    "./tests/generic/arrays4.php",
                        [["\$newmyarr[11]", "4", "xss"]]
                ],
                [
                    "./tests/generic/arrays5.php",
                        [["\$var1", "3", "xss"]]
                ],
                [
                    "./tests/generic/arrays6.php",
                        [["\$_GET[\"t\"]", "6", "xss"]]
                ],
                [
                    "./tests/generic/arrays7.php",
                        [["\$onearr[9865]", "3", "xss"]]
                ],
                [
                    "./tests/generic/arrays8.php",
                        [["\$arr[1113]", "6", "xss"]]
                ],
                [
                    "./tests/generic/arrays9.php",
                        [["\$onearr[11][6661]", "4", "xss"]]
                ],
                [
                    "./tests/generic/arrays10.php",
                        [["\$arr[0]", "3", "xss"]]
                ],
                [
                    "./tests/generic/arrays11.php",
                        [["\$arr[0][2]", "3", "xss"]]
                ],
                [
                    "./tests/generic/arrays12.php",
                        [["\$var1[1]", "6", "xss"]]
                ],
                [
                    "./tests/generic/arrays13.php",
                        [["\$_GET[\"t\"]", "5", "xss"]]
                ],
                [
                    "./tests/generic/arrays14.php",
                        [["\$var1[11][1]", "6", "xss"]]
                ],
                [
                    "./tests/generic/arrays15.php",
                        [["\$var", "8", "xss"]]
                ],
                [
                    "./tests/generic/arrays16.php",
                        [["\$var[\"t\"]", "3", "xss"]]
                ],
                [
                    "./tests/generic/arraysrec1.php",
                        [["\$var1[1]", "8", "xss"]]
                ],
                [
                    "./tests/generic/arraysexpr1.php",
                        [["\$newmyarr[2]", "3", "xss"]]
                ],
                [
                    "./tests/generic/arraysexpr2.php",
                        [["\$newmyarr[2][1][2]", "3", "xss"]]
                ],
                [
                    "./tests/generic/arraysexpr3.php",
                        [["\$onearr[11][6661]", "3", "xss"]]
                ],
                [
                    "./tests/generic/arraysexpr4.php",
                        [["\$var_main[\"TEST1\"]", "4", "xss"]]
                ],
                [
                    "./tests/generic/functions1.php",
                        [["\$parama", "3", "xss"]]
                ],
                [
                    "./tests/generic/functions2.php",
                        [["\$safea", "8", "xss"]]
                ],
                [
                    "./tests/generic/functions3.php",
                        [["\$testf_return[0]", "7", "xss"]]
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
                        [["\$_GET[\"p\"]", "15", "xss"]]
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
                        [["\$arr[8989][1]", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions10.php",
                        [["\$arr[8989][1][989]", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions11.php",
                        [["\$ret[0]", "8", "xss"]]
                ],
                [
                    "./tests/generic/functions12.php",
                        [["\$arr[8989][1][989]", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions13.php",
                        [["\$testf1_return[0]", "5", "xss"]]
                ],
                [
                    "./tests/generic/functions14.php",
                        [["\$param", "3", "xss"]]
                ],
                [
                    "./tests/generic/functions15.php",
                        [["\$var[1][12]", "9", "xss"]]
                ],
                [
                    "./tests/generic/functions16.php",
                        [["\$var[1][12]", "9", "xss"]]
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
                        [["\$testf1_param0_line10_column65_progpilot[\"test\"]", "10", "xss"]]
                ],
                [
                    "./tests/generic/functionsrec1.php",
                        [["\$var", "10", "xss"]]
                ],
                [
                    "./tests/generic/strings1.php",
                        [["\$vuln2", "7", "command_injection"],
                        ["\$vuln3", "11", "command_injection"],
                        ["\$vuln4", "15", "command_injection"],
                        ["\$id1", "19", "sql_injection"],
                        ["\$id2", "22", "sql_injection"],
                        ["\$id3", "25", "sql_injection"],
                        ["\$id5", "31", "sql_injection"],
                        ["\$id7", "35", "sql_injection"],
                        ["\$tainted1", "48", "xss"],
                        ["\$tainted2", "51", "xss"],
                        ["\$tainted3", "54", "xss"],
                        ["\$tainted21", "64", "xss"],
                        ["\$tainted31", "70", "xss"],
                        ["\$tainted32", "73", "xss"]]
                ],
                [
                    "./tests/generic/foreach1.php",
                        [["\$array_value", "6", "xss"]]
                ],

                [
                    "./tests/generic/global1.php",
                        [["\$myvar1", "4", "xss"]]
                ],

                [
                    "./tests/generic/global2.php",
                        [["\$myvar1", "4", "xss"]]
                ],

                [
                    "./tests/generic/global3.php",
                        [["\$myvar1", "3", "xss"]]
                ],

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
                ]
                
        ];
