<?php
        return [
                [
                    "./tests/data/sink1.php",
                        [["\$var7", "3", "xss"]]
                ],
                [
                    "./tests/data/sink2.php",
                        [["\$var7", "3", "xss"]]
                ],
                [
                    "./tests/data/sink3.php",
                        [["\$var7", "3", "xss"]]
                ],
                [
                    "./tests/data/sink4.php",
                        [["\$var7", "3", "xss"]]
                ],
                [
                    "./tests/data/sink5.php",
                        [["\$_GET[\"p\"]", "32", "xss"],
                        ["\$_GET[\"p\"]", "37", "xss"],
                        ["\$_GET[\"p\"]", "45", "xss"],
                        ["\$_GET[\"p\"]", "51", "xss"],
                        ["\$_GET[\"p\"]", "58", "xss"],
                        ["\$_GET[\"p\"]", "64", "xss"],
                        ["\$_GET[\"p\"]", "72", "xss"]]
                ],
                [
                    "./tests/data/sink6.php",
                        [["\$_GET[\"p1\"]", "3", "redos"],
                        ["\$_GET[\"p2\"]", "5", "redos"]]
                ],
                [
                    "./tests/data/sink7.php",
                        [["\$data->boum", "5", "xss"],
                        ["\$data", "3", "xss"],
                        ["\$data->boum", "13", "xss"],
                        ["\$data->boum", "17", "xss"],
                        ["\$data", "15", "xss"],
                        ["\$data->boum", "25", "xss"]]
                ],
                [
                    "./tests/data/sink8.php",
                        [["\$query", "3", "xml_injection"]]
                ],
                [
                    "./tests/data/sink9.php",
                        [["\$sql", "8", "sql_injection"],
                        ["\$sql", "18", "sql_injection"],]
                ],
                [
                    "./tests/data/source1.php",
                        [["\$var7", "3", "xss"]]
                ],
                [
                    "./tests/data/source2.php",
                        [["\$var7", "3", "xss"]]
                ],
                [
                    "./tests/data/source3.php",
                        [["\$var", "3", "xss"]]
                ],
                [
                    "./tests/data/source4.php",
                        [["\$var2", "5", "xss"]]
                ],
                [
                    "./tests/data/source5.php",
                        [["\$var2", "13", "xss"]]
                ],
                [
                    "./tests/data/source6.php",
                        [["\$var", "23", "xss"]]
                ],
                [
                    "./tests/data/source7.php",
                        [["\$var2[\"tainted\"]", "16", "xss"]]
                ],
                [
                    "./tests/data/source8.php",
                        [["\$var2[\"tainted\"]", "9", "xss"]]
                ],
                [
                    "./tests/data/source9.php",
                        [["\$func1arr_return[\"tainted\"]", "7", "xss"]]
                ],
                [
                    "./tests/data/source10.php",
                        [["\$func1arr_return[\"tainted\"]", "8", "xss"]]
                ],
                [
                    "./tests/data/source11.php",
                        [["\$inst->member1", "10", "xss"]]
                ],
                [
                    "./tests/data/source12.php",
                        [["\$var2", "5", "xss"]]
                ],
                [
                    "./tests/data/source13.php",
                        [["\$var1", "3", "xss"]]
                ],
                [
                    "./tests/data/source14.php",
                        [["\$tainted", "7", "xss"]]
                ],
                [
                    "./tests/data/source15.php",
                        [["\$member1", "10", "xss"],
                        ["\$member1", "36", "xss"]]
                ],
                [
                    "./tests/data/source16.php",
                        [["\$row->fullname", "4", "xss"]]
                ],
                [
                    "./tests/data/source17.php",
                        [["\$data", "11", "xss"],
                        ["\$data[\"trou\"]", "17", "xss"]]
                ],
                [
                    "./tests/data/source18.php",
                        [["\$row[1]", "11", "xss"]]
                ],
                [
                    "./tests/data/source19.php",
                        [["\$var1", "10", "xss"]]
                ],
                [
                    "./tests/data/source20.php",
                        [["\$b", "4", "xss"]]
                ],
                [
                    "./tests/data/source21.php",
                        [["\$title", "0", "xss"]]
                ],
                [
                    "./tests/data/sanitizer1.php",
                        [["\$var7safe", "5", "xss"]]
                ],
                [
                    "./tests/data/sanitizer2.php",
                        [["\$var7safe3", "5", "xss"]]
                ],
                [
                    "./tests/data/sanitizer3.php",
                        [["\$var7", "3", "xss"]]
                ],
                [
                    "./tests/data/sanitizer4.php",
                        [["\$var7safe3", "5", "xss"]]
                ],
                [
                    "./tests/data/sanitizer5.php",
                        [["\$ret", "7", "sql_injection"]]
                ],
                [
                    "./tests/data/sanitizer6.php",
                        [["\$ret", "12", "sql_injection"]]
                ],
                [
                    "./tests/data/sanitizer7.php",
                        [["\$ret", "19", "sql_injection"],
                        ["\$ret1", "42", "sql_injection"]]
                ],
                [
                    "./tests/data/sanitizer8.php",
                        [["\$safe", "13", "xss"],
                        ["\$safe", "53", "xss"]]
                ],
                [
                    "./tests/data/sanitizer9.php",
                        [["\$tainted3", "19", "xss"]]
                ],
                [
                    "./tests/data/sanitizer10.php",
                        []
                ],
                [
                    "./tests/data/sanitizer11.php",
                        []
                ]
                /*,
                // need support of proper validator propagation
                [
                    "./tests/data/validator1.php",
                        [["\$tainted3", "19", "xss"]]
                ]
                */,
                [
                    "./tests/data/validator2.php",
                        [["\$tainted", "3", "xss"],
                        ["\$tainted", "3", "xss"]]
                ],
                [
                    "./tests/data/validator3.php",
                        [["\$tainted", "3", "xss"],
                        ["\$tainted", "3", "xss"]]
                ],
                [
                    "./tests/data/validator4.php",
                        [["\$tainted", "3", "xss"]]
                ],
                [
                    "./tests/data/validator5.php",
                        [["\$tainted", "3", "xss"]]
                ],
                [
                    "./tests/data/validator6.php",
                        [["\$show_updated", "3", "xss"]]
                ],
                [
                    "./tests/data/customvalidator1.php",
                        [["\$a", "25", "file_inclusion"]]
                ],
                [
                    "./tests/data/customvalidator2.php",
                        [["\$a", "14", "file_inclusion"]]
                ],
                [
                    "./tests/data/customvalidator3.php",
                        [["\$a", "16", "file_inclusion"]]
                ],
                [
                    "./tests/data/customvalidator4.php",
                        [["\$a", "16", "file_inclusion"]]
                ],
                [
                    "./tests/data/customvalidator5.php",
                        [["\$a", "16", "file_inclusion"]]
                ]
            ]; 
