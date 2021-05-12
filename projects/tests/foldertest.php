<?php

        return [
                [
                    "./tests/folders/folder1",
                        [["\$var1[0]", '4', "xss"],
                        ["\$var1", '6', "xss"],
                        ["\$var2", '9', "xss"]]
                ],
                [
                    "./tests/folders/folder2",
                        [["\$var2", "9", "xss"],
                        ["\$var1[0]", "4", "xss"],
                        ["\$var1", "6", "xss"]]
                ],
                [
                    "./tests/real/wordpress2",
                        [["\$query", "131", "sql_injection"],
                        ["\$this->last_query", "20", "xss"]]
                ],
                [
                    "./tests/real/wordpress3",
                        [["\$query", "131", "sql_injection"],
                        ["\$this->last_query", "20", "xss"],
                        ["\$this->last_query", "20", "xss"],
                        ["\$title", "60", "xss"],
                        ["\$query", "131", "sql_injection"]]
                ],
                [
                    "./tests/real/namespaces1",
                        [["\$tainted", "7", "xss"],
                        ["\$tainted", "7", "xss"]]
                ],
                [
                    "./tests/real/incallstack/",
                        [["\$message", "226", "xss"],
                        ["\$localfile", "610", "path_traversal"],
                        ["\$cmd", "93", "xss"]]
                ]
            ];
