<?php

        return [
                [
                    "./tests/folders/excludedbydefault1",
                        [["\$_GET[\"p0\"]", '3', "xss"]]
                ],
                [
                    "./tests/folders/excludedbydefault2",
                        [["\$_GET[\"p1\"]", '3', "xss"],
                        ["\$_GET[\"p0\"]", '3', "xss"]]
                ],
                [
                    "./tests/folders/folder1",
                        [["\$var1[0]", '9', "xss"],
                        ["\$var1", '6', "xss"],
                        ["\$var2", '9', "xss"]]
                ],
                [
                    "./tests/folders/folder2",
                        [["\$var2", "9", "xss"],
                        ["\$var1[0]", "9", "xss"],
                        ["\$var1", "6", "xss"]]
                ],
                [
                    "./tests/real/wordpress2",
                        [["\$query", "132", "sql_injection"],
                        ["\$this->last_query", "102", "xss"]]
                ]/*,
                [
                    "./tests/real/wordpress3",
                        [["\$query", "131", "sql_injection"],
                        ["\$this->last_query", "101", "xss"],
                        ["\$query", "131", "sql_injection"],
                        ["\$this->last_query", "101", "xss"]]
                ]*/,
                [
                    "./tests/real/namespaces1",
                        [["\$tainted", "7", "xss"],
                        ["\$tainted", "7", "xss"]]
                ],
                [
                    "./tests/real/incallstack/",
                        [["\$rtrim_return", "77", "xss"]]
                ]
            ];
