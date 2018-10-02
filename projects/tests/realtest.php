<?php

        return [
                [
                    "./tests/real/ClassLoader.php", []
                ],
                [
                    "./tests/real/mutliplecall_memory.php",
                        [["\$var", "6", "xss"]]
                ],
                [
                    "./tests/real/composer/index.php",
                        [["\$_GET[\"p\"]", "7", "xss"],
                        ["\$_GET[\"p\"]", "14", "xss"]]
                ],
                [
                    "./tests/real/object1.php", []
                ]
                
        ];
