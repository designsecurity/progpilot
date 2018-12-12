<?php

        return [
                [
                    "./testsJS/generic/simple1.js",
                        [["variable1", "3", "xss"]]
                ],
                [
                    "./testsJS/generic/simple2.js",
                        [["variable1.url", "5", "xss"]]
                ],
                [
                    "./testsJS/generic/simple3.js",
                        [["variable1.url", "5", "xss"]]
                ],
                [
                    "./testsJS/informationflow/simple1.js",
                        [["2", "0", "Information disclosure"]]
                ]
        ];
