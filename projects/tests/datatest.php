<?php
        return [
                [
                    "./tests/includes/simple1.php",
                        [["\$var1", '3', "xss"]]
                ],
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
                        [["\$_GET[\"p1\"]", "3", "code_injection"],
                        ["\$_GET[\"t1\"]", "3", "code_injection"]]
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
                        [["\$methodc1arr_return", "12", "xss"]]
                ],
                [
                    "./tests/data/source8.php",
                        [["\$func1arr_return", "7", "xss"]]
                ],
                [
                    "./tests/data/source9.php",
                        [["\$func1arr_return", "7", "xss"]]
                ],
                [
                    "./tests/data/source10.php",
                        [["\$func1arr_return", "8", "xss"]]
                ],
                [
                    "./tests/data/source11.php",
                        [["\$inst->member1", "9", "xss"]]
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
                        [["\$inst->object->member1", "18", "xss"],
                        ["\$inst1->object->member1", "44", "xss"]]
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
                        [["\$comment->ddd", "23", "xss"]]
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
                ]
            ]; 
