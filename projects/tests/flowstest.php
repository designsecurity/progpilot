<?php

        return [
                [
                    "./tests/flows/flow1.php",
                        [["\$var", '5'],
                        ["\$param", '3'],
                        ["\$var4", '10'],
                        ["\$var7", '9'],
                        ["\$_GET[\"p\"]", '9']]
                ],
                [
                    "./tests/flows/flow2.php",
                        [["\$this->object1", "15"],
                        ["\$val", "8"],
                        ["\$_GET[\"p\"]", "21"]]
                ],
                [
                    "./tests/flows/flow3.php",
                        [["\$var1", "3"],
                        ["\$_GET[\"p1\"]", "3"]]
                ],
                [
                    "./tests/flows/flow4.php",
                        [["\$plugin_basename_return", "6"],
                        ["\$file", "5"],
                        ["\$preg_replace_return", "5"],
                        ["\$preg_replace_param2_line5_column101_progpilot", "5"],
                        ["\$file", "4"],
                        ["\$preg_replace_return", "4"],
                        ["\$preg_replace_param2_line4_column51_progpilot", "4"],
                        ["\$file", "3"],
                        ["\$plugin_page", "20"],
                        ["\$stripslashes_return", "20"],
                        ["\$stripslashes_param0_line20_column417_progpilot", "20"],
                        ["\$_GET[\"page\"]", "20"]]
                ]
            ];
