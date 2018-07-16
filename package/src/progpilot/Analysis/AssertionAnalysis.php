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
    public static function temporarySimple($context, $data, $myBlock, $resolveTemporary, $tempDef)
    {
        $assertions = $myBlock->getAssertions();

        $equality = false;
        $safe = false;

        // for each assertions, we could have definitions with same name (from different block for example)
        foreach ($assertions as $assertion) {
            $myDefAssertion = $assertion->getDef();
            $typeAssertion = $assertion->getType();

            // there was not resolution so we simply check name (or better equality values)
            if ($resolveTemporary === $tempDef) {
                if ($myDefAssertion->getName() === $tempDef->getName()) {
                    $tempDef->setTainted(false);
                }

                $equality = true;
            }

            if ($myDefAssertion === $resolveTemporary) {
                if ($myDefAssertion->getName() === $tempDef->getName()) {
                    $tempDef->setTainted(false);
                }

                $equality = true;
                break;
            }
        }


        if ($equality && $typeAssertion !== "string") {
            $safe = true;
        }

        if ($resolveTemporary->getCast() === MyDefinition::CAST_SAFE) {
            $safe = true;
        }

        return $safe;
    }
}
