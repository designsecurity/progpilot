<?php

        return [
                [
                    "./tests/custom/custom1.php",
                        [["13", "154", "bypass access control"]]
                ],
                [
                    "./tests/custom/custom2.php",
                        [["5", "75", "security misconfiguration"],
                        ["7", "144", "security misconfiguration"],
                        ["9", "213", "security misconfiguration"]]
                ],
                [
                    "./tests/custom/custom3.php",
                        [["11", "95", "security misconfiguration"]]
                ],
                [
                    "./tests/custom/custom4.php",
                        [["3", "7", "security misconfiguration"]]
                ],
                [
                    "./tests/custom/custom5.php",
                        [["3", "7", "security misconfiguration"]]
                ],
                [
                    "./tests/custom/cert1.php",
                        [["3", "7", "security misconfiguration"],
                        ["5", "59", "security misconfiguration"],
                        ["7", "111", "security misconfiguration"]]
                ],
                [
                    "./tests/custom/cert2.php",
                        [["15", "603", "security misconfiguration"],
                        ["30", "1244", "security misconfiguration"]]
                ],
                [
                    "./tests/custom/cert3.php",
                        [["3", "7", "security misconfiguration"],
                        ["7", "111", "security misconfiguration"]]
                ],
                [
                    "./tests/custom/cert4.php",
                        [["15", "603", "security misconfiguration"],
                        ["30", "1244", "security misconfiguration"]]
                ],
                [
                    "./tests/custom/cert5.php",
                        [["16", "672", "security misconfiguration"],
                        ["16", "672", "security misconfiguration"],
                        ["32", "1346", "security misconfiguration"],
                        ["47", "2018", "security misconfiguration"]]
                ]
            ];
