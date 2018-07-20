<?php

        return [
                [
                    "./tests/custom/custom1.php",
                        [["13", "154", "bypass access control"],
                        ["13", "154", "bypass access control"]]
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
                ]
            ];
