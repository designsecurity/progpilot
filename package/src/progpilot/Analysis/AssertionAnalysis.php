<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyDefinition;

class AssertionAnalysis
{
    public static function checkDefIsAssert($myBlock, $def)
    {
        $assertions = $myBlock->getAssertions();

        $equality = false;
        $safe = false;

        // for each assertions, we could have definitions with same name (from different block for example)
        foreach ($assertions as $assertion) {
            $myDefAssertion = $assertion->getDef();
            $typeAssertion = $assertion->getType();

            if ($myDefAssertion->getName() === $def->getName()) {
                $equality = true;
                break;
            }
        }

        if ($equality && $typeAssertion !== "string") {
            $safe = true;
        }

        return $safe;
    }
}
