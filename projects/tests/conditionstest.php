<?php

        return [
                [
                    "./tests/conditions/condition1.php",
                        [["\$_GET[\"p1\"]", "7", "xss"]]
                ],
                [
                    "./tests/conditions/condition4.php",
                        [["\$blabla", "3", "xss"]]
                ],

                [
                    "./tests/conditions/condition5.php",
                        [["\$tainted", "7", "xss"]]
                ],
                [
                    "./tests/conditions/condition6.php",
                        [["\$tainted", "3", "xss"]]
                ],
                [
                    "./tests/conditions/condition7.php",
                        [["\$tainted", "3", "xss"]]
                ],
                [
                    "./tests/conditions/condition8.php",
                        [["\$tainted", "47", "xss"],
                        ["\$tainted", "53", "xss"]]
                ]
            ];
