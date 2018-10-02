<?php

        return [
                [
                    "./tests/folders/folder1",
                        [["\$var1[0]", '5', "xss"],
                        ["\$var1", '9', "xss"],
                        ["\$var2", '12', "xss"]]
                ],
                [
                    "./tests/folders/folder2",
                        [["\$var1[0]", "5", "xss"],
                        ["\$var1", "9", "xss"]]
                ]
            ];
