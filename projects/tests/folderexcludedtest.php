<?php

        return [
                [
                    "./tests/folders/folder1",
                        [["\$var1[0]", '9', "xss"],
                        ["\$var1", '6', "xss"],
                        ["\$var2", '9', "xss"]]
                ],
                [
                    "./tests/folders/folder2",
                        [["\$var1[0]", "9", "xss"]]
                ],
                [
                    "./tests/folders/folder3",
                        [["\$var2", "9", "xss"],
                        ["\$var1[0]", "9", "xss"],
                        ["\$var1", "6", "xss"]]
                ],
                [
                    "./tests/folders/folder4",
                        [["\$_GET[\"p2\"]", "3", "xss"],
                        ["\$_GET[\"p4\"]", "3", "xss"]]
                ]
            ];
