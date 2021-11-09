<?php

        return [
                [
                    "./tests/oop/simple1.php",
                        [["\$instance1->boum2", "15", "xss"]]
                ],
                [
                    "./tests/oop/simple2.php",
                        [["\$instance1->boum2", "13", "xss"]]
                ],
                [
                    "./tests/oop/simple3.php",
                        [["\$_GET[\"p\"]", "9", "xss"]]
                ],
                [
                    "./tests/oop/simple4.php",
                        [["\$_GET[\"p\"]", "10", "xss"]]
                ],
                [
                    "./tests/oop/simple5.php",
                        [["\$get_boum1_return", "14", "xss"]]
                ],
                [
                    "./tests/oop/simple6.php",
                        [["\$instance->boum1", "26", "xss"]]
                ],
                [
                    "./tests/oop/simple7.php",
                        [["\$instance->boum1", "17", "xss"]]
                ],
                [
                    "./tests/oop/simple8.php",
                        [["\$instance1->boum2", "18", "xss"]]
                ],
                [
                    "./tests/oop/simple9.php",
                        [["\$boum1", "7", "xss"]]
                ],
                [
                    "./tests/oop/simple10.php",
                        [["\$instance1->boum1", "15", "xss"]]
                ],
                [
                    "./tests/oop/simple11.php",
                        [["\$instance1->boum1", "20", "xss"]]
                ],
                [
                    "./tests/oop/simple12.php",
                        [["\$instance1->boum1", "15", "xss"]]
                ],
                [
                    "./tests/oop/simple13.php",
                        [["\$instance1->boum1", "32", "xss"],
                        ["\$instance1->boum1", "36", "xss"]]
                ],
                [
                    "./tests/oop/simple14.php",
                        [["\$instance1->boum2", "16", "xss"]]
                ],
                [
                    "./tests/oop/simple15.php",
                        [["\$this->boum1", "10", "xss"]]
                ],
                [
                    "./tests/oop/simple16.php",
                        [["\$instance1->boum1", "31", "xss"]]
                ],
                [
                    "./tests/oop/simple17.php",
                        [["\$copy[0]", "33", "xss"]]
                ],
                [
                    "./tests/oop/simple18.php",
                        [["\$instance1->boum1", "34", "xss"]]
                ],
                [
                    "./tests/oop/simple19.php",
                        [["\$toto", "30", "xss"],
                        ["\$newtestc1->object1", "40", "xss"],
                        ["\$newsettestc1->object1", "47", "xss"],
                        ["\$testc1_encore2->member1", "67", "xss"],
                        ["\$val", "65", "xss"]]
                ],
                [
                    "./tests/oop/simple20.php",
                        [["\$this->member2", "12", "xss"]]
                ],
                [
                    "./tests/oop/simple21.php",
                        [["\$query", "23", "xml_injection"],
                        ["\$res", "28", "xss"]]
                ],
                [
                    "./tests/oop/simple22.php",
                        [["\$a->data", "15", "xss"],
                        ["\$b->data", "18", "xss"]]
                ],
                [
                    "./tests/oop/simple23/a.php",
                        [["\$sql", "10", "sql_injection"]]
                ],
                [
                    "./tests/oop/simple24.php",
                        [["\$a->data", "22", "xss"],
                        ["\$b->data", "31", "xss"]]
                ],
                [
                    "./tests/oop/simple25.php",
                        [["\$query", "7", "sql_injection"]]
                ],
                [
                    "./tests/oop/simple26.php",
                        [["\$taint2", "15", "xss"],
                        ["\$taint1", "6", "xss"]]
                ],
                [
                    "./tests/oop/simple27.php",
                        [["\$_GET[\"p\"]", "8", "xss"],
                        ["\$_GET[\"t\"]", "17", "xss"]]
                ],
                [
                    "./tests/oop/simple28.php",
                        [["\$_GET[\"p\"]", "14", "sql_injection"]]
                ],
                [
                    "./tests/oop/simple29.php",
                        [["\$_GET[\"p\"]", "4", "sql_injection"]]
                ],
                [
                    "./tests/oop/simple30.php",
                        [["testa::\$stavar", "16", "xss"]]
                ],
                [
                    "./tests/oop/simple31.php",
                        [["\$a->stavar", "14", "xss"]]
                ],
                [
                    "./tests/oop/simple32.php",
                        [["testa::\$stavar", "11", "xss"]]
                ],
                [
                    "./tests/oop/simple33.php",
                        [["\$tainted", "35", "xss"]]
                ],
                [
                    "./tests/oop/simple34.php",
                        [["\$tainted", "16", "xss"]]
                ],
                [
                    "./tests/oop/simple35.php",
                        [["\$get_boum1_return", "14", "xss"],
                        ["\$get_boum1_return", "14", "xss"]]
                ],
                [
                    "./tests/oop/simple36.php",
                        [["\$aaas->title", "33", "xss"]]
                ],
                [
                    "./tests/oop/chained1.php",
                        [["\$tainted", "33", "xss"]]
                ],
                [
                    "./tests/oop/chained2.php",
                        [["\$aaa->title", "22", "xss"]]
                ]
                
        ];
