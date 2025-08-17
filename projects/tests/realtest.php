<?php

return [
    [
        "./tests/real/ClassLoader.php",
        []
    ],
    [
        "./tests/real/mutliplecall_memory.php",
        [["\$var", "6", "xss"]]
    ],
    [
        "./tests/real/feedbackgithub/test.php",
        [
            ["\$id", "3", "sql_injection"],
            ["\$id", "9", "sql_injection"],
            ["\$_POST[\"id\"]", "14", "sql_injection"]
        ]
    ],
    [
        "./tests/real/composer/index.php",
        [
            ["\$_GET[\"p\"]", "7", "xss"],
            ["\$_GET[\"p\"]", "14", "xss"]
        ]
    ],
    [
        "./tests/real/object1.php",
        []
    ],
    [
        "./tests/real/wordpress1/wp-commentsrss2.php",
        [["\$title", "40", "xss"]]
    ],
    [
        "./tests/real/wordpress2/wp-commentsrss2.php",
        [
            ["\$query", "132", "sql_injection"],
            ["\$this->last_query", "102", "xss"],
            ["\$query", "245", "sql_injection"],
            ["\$_GET[\"p\"]", "5", "sql_injection"]
        ]
    ]
];
