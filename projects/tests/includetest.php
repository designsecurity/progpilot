<?php

        return [
                [
                    "./tests/includes/simple1.php",
                        [["\$var1", '3', "xss"]]
                ],

                [
                    "./tests/includes/simple2.php",
                        [["\$var1", "3", "xss"]]
                ],

                [
                    "./tests/includes/simple3.php",
                        [["\$var1", "3", "xss"]]
                ],

                [
                    "./tests/includes/simple4.php",
                        [["\$var1", "3", "xss"]]
                ],

                [
                    "./tests/includes/simple5.php",
                        [["\$var1", "3",  "xss"]]
                ],

                [
                    "./tests/includes/simple6.php",
                        [["\$var1", "10", "xss"]]
                ],

                [
                    "./tests/includes/simple7.php",
                        [["\$var1", "9", "xss"]]
                ],

                [
                    "./tests/includes/simple8.php",
                        [["\$_GET[\"p\"]", "3",  "xss"]]
                ],
                [
                    "./tests/includes/simple9.php",
                        [["158", "3599", "security misconfiguration"],
                        ["158", "3599", "security misconfiguration"],
                        ["159", "3679", "security misconfiguration"],
                        ["159", "3679", "security misconfiguration"],
                        ["\$pPage[\"body\"]", "329", "xss"]]
                ],
                [
                    "./tests/includes/simple10.php",
                        [["\$var1", "3", "xss"]]
                ],

                [
                    "./tests/includes/simple11.php",
                        [["\$var1", "4", "xss"]]
                ],

                [
                    "./tests/includes/simple12.php",
                        [["\$ret[\"cb36d7468e442c354c5037bbb4d59b1c\"]", "5", "xss"]]
                ],

                [
                    "./tests/includes/simple13.php",
                        [["\$var1", "4", "xss"]]
                ],

                [
                    "./tests/includes/simple14.php",
                        [["\$var1", "4", "xss"]]
                ],

                [
                    "./tests/includes/simple15_circular.php",
                        [["\$_GET[\"p\"]", "5", "xss"]]
                ],

                [
                    "./tests/includes/simple16.php",
                        [["\$var", "3", "xss"]]
                ],

                [
                    "./tests/includes/simple17.php",
                        [["\$var", "3", "xss"]]
                ],

                [
                    "./tests/includes/simple18.php",
                        [["\$_GET[\"p\"]", "3", "xss"]]
                ],

                [
                    "./tests/includes/simple19.php",
                        [["\$_GET[\"p\"]", "3", "xss"]]
                ],

                [
                    "./tests/includes/simple20.php",
                        [["\$comments->post", "6", "xss"]]
                ]
            ];
