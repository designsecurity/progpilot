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
                        [["\$var1[0]", "4", "xss"]]
                ]
            ];
