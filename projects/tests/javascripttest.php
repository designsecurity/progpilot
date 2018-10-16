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
                ]
        ];
