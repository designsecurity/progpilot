<?php

        return [
                [
                    "./tests/flows/flow1.php",
                        [["\$var", '5'],
                        ["\$param", '3'],
                        ["\$var4", '10'],
                        ["\$var7", '9'],
                        ["\$_GET[\"p\"]", '9']]
                ],
                [
                    "./tests/flows/flow2.php",
                        [["\$this->object1", "6"],
                        ["\$val", "8"],
                        ["\$_GET[\"p\"]", "21"]]
                ],
                [
                    "./tests/flows/flow3.php",
                        [["\$var1", "3"],
                        ["\$_GET[\"p1\"]", "3"]]
                ]
            ];
