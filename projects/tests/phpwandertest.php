<?php

        return [
                [
                    "./tests/phpwander/test0.php",
                        [["\$id_return", "4", "file_disclosure"],
                        ["\$return_basename", "9", "file_disclosure"],
                        ["\$_GET[\"f\"]", "11", "file_disclosure"],
                        ["\$b", "9", "xss"],
                        ["\$c", "11", "xss"]]
                ],
                [
                    "./tests/phpwander/test1.php",
                        [["\$s", "19", "xss"],
                        ["\$a", "26", "xss"]]
                ],
                [
                    "./tests/phpwander/test2.php",
                        [["\$path", "7", "xss"],
                        ["\$path", "7", "command_injection"],
                        ["\$shell_exec_return", "9", "xss"]]
                ],
                [
                    "./tests/phpwander/test3.php",
                        [["\$getSource_return", "15", "xss"]]
                ],
                [
                    "./tests/phpwander/test4.php",
                        [[["\$_GET[\"user\"]", "\$_GET[\"password\"]"], ["4", "4"], "sql_injection"],
                        ["\$_GET[\"file\"]", "8", "file_inclusion"],
                        ["\$user[\"email\"]", "12", "xss"]]
                ],
                [
                    "./tests/phpwander/test5.php",
                        [["\$_GET[\"file\"]", "9", "file_inclusion"]]
                ],
                [
                    "./tests/phpwander/test6.php",
                        [["\$b", "3", "file_inclusion"],
                        ["\$b", "3", "xss"]]
                ],
                [
                    "./tests/phpwander/test7.php",
                        [["\$param", "9", "xss"]]
                ],// handle with report confidence to check
                [
                    "./tests/phpwander/test8.php",
                        []
                ],// handle with report confidence to check
                [
                    "./tests/phpwander/test9.php",
                        []
                ],
                [
                    "./tests/phpwander/test10.php",
                        [["\$getSource_return", "18", "xss"]]
                ],
                // patch php-cfg
                /*
                [
                    "./tests/phpwander/test11.php",
                        [["\$a", "2", "xss"]]
                ],*/
                [
                    "./tests/phpwander/test12.php",
                        [["D::\$vars", "8", "xss"],
                        ["\$danger_return", "12", "xss"]]
                ],// a corriger
                [
                    "./tests/phpwander/test13.php",
                        []
                ],
                [
                    "./tests/phpwander/test14.php",
                        [["\$_GET[\"id\"]", "6", "sql_injection"],
                        ["\$arg", "7", "xss"]]
                ],
                [
                    "./tests/phpwander/test15.php",
                        [["\$_GET[\"a\"]", "5", "xss"]]
                ]
        ];
