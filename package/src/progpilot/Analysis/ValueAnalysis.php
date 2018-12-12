<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyFile;
use progpilot\Objects\MyOp;
use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;
use progpilot\Objects\MyClass;
use progpilot\Objects\MyFunction;

use progpilot\Code\MyCode;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Common;

use progpilot\Utils;

class ValueAnalysis
{
    public static $exprsCast;
    public static $exprsKnownValues;

    public function __construct()
    {
    }

    public static function buildStorage()
    {
        ValueAnalysis::$exprsCast = new \SplObjectStorage;
        ValueAnalysis::$exprsKnownValues = new \SplObjectStorage;
    }

    public static function updateStorageToExpr($expr)
    {
        if (!isset(ValueAnalysis::$exprsCast[$expr])) {
            ValueAnalysis::$exprsCast[$expr] = [];
        }

        if (!isset(ValueAnalysis::$exprsKnownValues[$expr])) {
            ValueAnalysis::$exprsKnownValues[$expr] = [];
        }
    }

    public static function computeKnownValues($defAssign, $expr)
    {
        if (isset(ValueAnalysis::$exprsKnownValues[$expr])) {
            $knownValues = ValueAnalysis::$exprsKnownValues[$expr];
            $finalDefValues = [];

            // we dont want to compute values with more than 3 concat :
            // $def = $val1.$val2.$val3; (too much possibilities)
            if (count($knownValues) < 4) {
                // storage[id_temp][] = def->getLastKnownValues()
                    // value = "id_temp1"."id_temp2"."id_temp3";
                foreach ($knownValues as $idTemp => $defsKnownValues) { // 1
                    // def
                    // "id_temp1"
                    $defValues = [];
                    foreach ($defsKnownValues as $defKnownValues) { // 2
                        // def->getLastKnownValues()
                        // "def_id_temp1"
                        foreach ($defKnownValues as $defKnownValue) {
                            if (Common::validLastKnownValue($defKnownValue)
                                    && !in_array($defKnownValue, $defValues, true)) {
                                $defValues[] = $defKnownValue;
                            }
                        }
                    }

                    if (count($finalDefValues) === 0) {
                        $finalDefValues = $defValues;
                    } else {
                        $newFinalDefValues = [];

                        foreach ($finalDefValues as $finalDefValue) {
                            foreach ($defValues as $defValue) {
                                $newValue = $finalDefValue.$defValue;
                                if (Common::validLastKnownValue($defKnownValue)
                                        && !in_array($newValue, $newFinalDefValues, true)) {
                                    $newFinalDefValues[] = $newValue;
                                }
                            }
                        }

                        $finalDefValues = $newFinalDefValues;
                    }
                }

                foreach ($finalDefValues as $finalDefValue) {
                    $defAssign->addLastKnownValue($finalDefValue);
                }
            }
        }
    }

    public static function computeCastValues($defAssign, $expr)
    {
        if (isset(ValueAnalysis::$exprsCast[$expr])) {
            $nbCastSafe = 0;
            $castValues = ValueAnalysis::$exprsCast[$expr];

            foreach ($castValues as $castValue) {
                if ($castValue === MyDefinition::CAST_SAFE) {
                    $nbCastSafe ++;
                }
            }

            if ($nbCastSafe === count($castValues)) {
                $defAssign->setCast(MyDefinition::CAST_SAFE);
            } else {
                $defAssign->setCast(MyDefinition::CAST_NOT_SAFE);
            }
        }
    }

    public static function computeEmbeddedChars($defAssign, $expr)
    {
        $concatEmbeddedChars = [];
        foreach ($expr->getDefs() as $def) {
            foreach ($def->getIsEmbeddedByChars() as $embeddedChar => $boolean) {
                $concatEmbeddedChars[] = $embeddedChar;
            }
        }

        foreach ($concatEmbeddedChars as $embeddedChar) {
            $embeddedValue = false;

            foreach ($expr->getDefs() as $def) {
                $boolean = $def->getIsEmbeddedByChar($embeddedChar);

                if ($boolean && $embeddedValue) {
                    $embeddedValue = false;
                }

                if ($boolean && !$embeddedValue) {
                    $embeddedValue = true;
                }

                if (!$boolean && $embeddedValue) {
                    $embeddedValue = true;
                }

                if (!$boolean && !$embeddedValue) {
                    $embeddedValue = false;
                }
            }

            $defAssign->setIsEmbeddedByChar($embeddedChar, $embeddedValue);
        }
    }

    public static function computeSanitizedValues($defAssign, $expr)
    {
        $concatTypesSanitize = [];
        foreach ($expr->getDefs() as $def) {
            if ($def->isSanitized()) {
                foreach ($def->getTypeSanitized() as $typeSanitized) {
                    $concatTypesSanitize["$typeSanitized"] = true;
                }
            }
        }

        // foreach sanitize types
        foreach ($concatTypesSanitize as $typeSanitized => $booleanTrue) {
            $typeOk = true;
            foreach ($expr->getDefs() as $def) {
                // if we find a tainted value that is not sanitized the defassign is not sanitized
                if (!$def->isTypeSanitized($typeSanitized) && $def->isTainted()) {
                    $typeOk = false;
                }
            }

            if ($typeOk) {
                $defAssign->setSanitized(true);
                $defAssign->addTypeSanitized($typeSanitized);
            }
        }
    }

    public static function copyValues($def, $defAssign)
    {
        $defAssign->setIsEmbeddedByChars($def->getIsEmbeddedByChars(), true);
        $defAssign->setCast($def->getCast());
        $defAssign->setLabel($def->getLabel());
        
        if ($def->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED") {
            $defAssign->setArrayValue("PROGPILOT_ALL_INDEX_TAINTED");
            $defAssign->setTaintedByExpr($def->getExpr());
        }
        
        if ($def->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")) {
            $defAssign->property->addProperty("PROGPILOT_ALL_PROPERTIES_TAINTED");
            $defAssign->addType(MyDefinition::TYPE_INSTANCE);
            $defAssign->setTaintedByExpr($def->getExpr());
        }
    }
}
