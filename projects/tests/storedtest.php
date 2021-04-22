<?php

        return [
                [
                    "./tests/stored/test2.php",
                        [["\$path", "7", "xss"],
                        ["\$path", "7", "command_injection"],
                        ["\$shell_exec_return", "9", "xss"]]
                ]
                [
                    "./tests/phpwander/test4.php",
                        [[["\$_GET[\"user\"]", "\$_GET[\"password\"]"], ["4", "4"], "sql_injection"],
                        ["\$user[\"email\"]", "5", "xss"],
                        ["\$_GET[\"file\"]", "11", "file_inclusion"]]
                ]
        ];
