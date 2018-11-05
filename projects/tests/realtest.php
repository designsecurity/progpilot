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
                ],
                [
                    "./tests/real/wordpress1/wp-commentsrss2.php",
                        [["\$title", "38", "xss"],
                        [array("\$apply_filters_return", "\$apply_filters_return"), array("65", "88"), "xss"]]
                ]
                
        ];
