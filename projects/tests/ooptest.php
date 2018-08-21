<?php

        return [
                [
                    "./tests/oop/simple1.php",
                        [["\$instance1->boum2", "12", "xss"]]
                ],
                [
                    "./tests/oop/simple2.php",
                        [["\$instance1->boum2", "11", "xss"]]
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
                        [["\$instance->boum1", "25", "xss"]]
                ],
                [
                    "./tests/oop/simple6.php",
                        [["\$instance->boum1", "24", "xss"]]
                ],
                [
                    "./tests/oop/simple7.php",
                        [["\$instance->boum1", "15", "xss"]]
                ],
                [
                    "./tests/oop/simple8.php",
                        [["\$instance1->boum2", "16", "xss"]]
                ],
                [
                    "./tests/oop/simple9.php",
                        [["\$boum1", "7", "xss"]]
                ],
                [
                    "./tests/oop/simple10.php",
                        [["\$instance1->boum1", "5", "xss"]]
                ],
                [
                    "./tests/oop/simple11.php",
                        [["\$instance1->boum1", "18", "xss"]]
                ],
                [
                    "./tests/oop/simple12.php",
                        [["\$instance1->boum1", "9", "xss"]]
                ],
                [
                    "./tests/oop/simple13.php",
                        [["\$instance1->boum1", "14", "xss"]]
                ],
                [
                    "./tests/oop/simple14.php",
                        [["\$instance1->boum2", "11", "xss"]]
                ],
                [
                    "./tests/oop/simple15.php",
                        [["\$this->boum1", "5", "xss"]]
                ],
                [
                    "./tests/oop/simple16.php",
                        [["\$instance1->boum1", "5", "xss"]]
                ],
                [
                    "./tests/oop/simple17.php",
                        [["\$this->boum1[0]", "9", "xss"]]
                ],
                [
                    "./tests/oop/simple18.php",
                        [["\$instance1->boum1", "15", "xss"]]
                ],
                [
                    "./tests/oop/simple19.php",
                        [["\$testc1->object1->object2", "29", "xss"],
                        ["\$newtestc1->object1", "37", "xss"],
                        ["\$newsettestc1->object1", "7", "xss"]]
                ],
                [
                    "./tests/oop/simple20.php",
                        [["\$this->member2", "7", "xss"]]
                ],
                [
                    "./tests/oop/simple21.php",
                        [["\$query", "23", "xml_injection"],
                        ["\$res", "28", "xss"]]
                ],
                [
                    "./tests/oop/simple22.php",
                        [["\$a->data", "11", "xss"],
                        ["\$this->data", "6", "xss"],
                        ["\$a->data", "11", "xss"]]
                ],
                [
                    "./tests/oop/simple23/a.php",
                        [["\$sql", "10", "sql_injection"]]
                ],
                [
                    "./tests/oop/simple24.php",
                        [["\$a->data", "6", "xss"],
                        ["\$b->data", "6", "xss"]]
                ],
                [
                    "./tests/oop/simple25.php",
                        [["\$query", "6", "sql_injection"]]
                ],
                [
                    "./tests/oop/simple26.php",
                        [["\$_GET[\"t\"]", "17", "xss"],
                        ["\$_GET[\"p\"]", "8", "xss"]]
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
                        [["testa::\$stavar", "12", "xss"]]
                ],
                [
                    "./tests/oop/simple31.php",
                        [["\$a->stavar", "11", "xss"]]
                ],
                [
                    "./tests/oop/simple32.php",
                        [["testa::\$stavar", "9", "xss"]]
                ]
                
        ];
