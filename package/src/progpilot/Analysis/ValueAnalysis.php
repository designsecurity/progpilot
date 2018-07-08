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
    public static $exprs_cast;
    public static $exprs_knownvalues;

    public function __construct()
    {
    }

    public static function buildStorage()
    {
        ValueAnalysis::$exprs_cast = new \SplObjectStorage;
        ValueAnalysis::$exprs_knownvalues = new \SplObjectStorage;
    }

    public static function updateStorageToExpr($expr)
    {
        if (!isset(ValueAnalysis::$exprs_cast[$expr])) {
            ValueAnalysis::$exprs_cast[$expr] = [];
        }

        if (!isset(ValueAnalysis::$exprs_knownvalues[$expr])) {
            ValueAnalysis::$exprs_knownvalues[$expr] = [];
        }
    }

    public static function computeKnownValues($defassign, $expr)
    {
        if (isset(ValueAnalysis::$exprs_knownvalues[$expr])) {
            $known_values = ValueAnalysis::$exprs_knownvalues[$expr];
            $final_def_values = [];

            // we dont want to compute values with more than 3 concat :
            // $def = $val1.$val2.$val3; (too much possibilities)
            if (count($known_values) < 4) {
                // storage[id_temp][] = def->getLastKnownValues()
                    // value = "id_temp1"."id_temp2"."id_temp3";
                foreach ($known_values as $id_temp => $defs_known_values) { // 1
                    // def
                    // "id_temp1"
                    $def_values = [];
                    foreach ($defs_known_values as $def_known_values) { // 2
                        // def->getLastKnownValues()
                        // "def_id_temp1"
                        foreach ($def_known_values as $def_known_value) {
                            if (Common::validLastKnownValue($def_known_value)
                                    && !in_array($def_known_value, $def_values, true)) {
                                $def_values[] = $def_known_value;
                            }
                        }
                    }

                    if (count($final_def_values) === 0) {
                        $final_def_values = $def_values;
                    } else {
                        $new_final_def_values = [];

                        foreach ($final_def_values as $final_def_value) {
                            foreach ($def_values as $def_value) {
                                $new_value = $final_def_value.$def_value;
                                if (Common::validLastKnownValue($def_known_value)
                                        && !in_array($new_value, $new_final_def_values, true)) {
                                    $new_final_def_values[] = $new_value;
                                }
                            }
                        }

                        $final_def_values = $new_final_def_values;
                    }
                }

                foreach ($final_def_values as $final_def_value) {
                    $defassign->addLastKnownValue($final_def_value);
                }
            }
        }
    }

    public static function computeCastValues($defassign, $expr)
    {
        if (isset(ValueAnalysis::$exprs_cast[$expr])) {
            $nb_cast_safe = 0;
            $cast_values = ValueAnalysis::$exprs_cast[$expr];

            foreach ($cast_values as $cast_value) {
                if ($cast_value === MyDefinition::CAST_SAFE) {
                    $nb_cast_safe ++;
                }
            }

            if ($nb_cast_safe === count($cast_values)) {
                $defassign->setCast(MyDefinition::CAST_SAFE);
            } else {
                $defassign->setCast(MyDefinition::CAST_NOT_SAFE);
            }
        }
    }

    public static function computeEmbeddedChars($defassign, $expr)
    {
        $concat_embedded_chars = [];
        foreach ($expr->getDefs() as $def) {
            foreach ($def->getIsEmbeddedByChars() as $embedded_char => $boolean) {
                $concat_embedded_chars[] = $embedded_char;
            }
        }

        foreach ($concat_embedded_chars as $embedded_char) {
            $embedded_value = false;

            foreach ($expr->getDefs() as $def) {
                $boolean = $def->getIsEmbeddedByChar($embedded_char);

                if ($boolean && $embedded_value) {
                    $embedded_value = false;
                }

                if ($boolean && !$embedded_value) {
                    $embedded_value = true;
                }

                if (!$boolean && $embedded_value) {
                    $embedded_value = true;
                }

                if (!$boolean && !$embedded_value) {
                    $embedded_value = false;
                }
            }

            $defassign->setIsEmbeddedByChar($embedded_char, $embedded_value);
        }
    }

    public static function computeSanitizedValues($defassign, $expr)
    {
        $concat_types_sanitize = [];
        foreach ($expr->getDefs() as $def) {
            if ($def->isSanitized()) {
                foreach ($def->getTypeSanitized() as $type_sanitized) {
                    $concat_types_sanitize["$type_sanitized"] = true;
                }
            }
        }

        // foreach sanitize types
        foreach ($concat_types_sanitize as $type_sanitized => $boolean_true) {
            $type_ok = true;
            foreach ($expr->getDefs() as $def) {
                // if we find a tainted value that is not sanitized the defassign is not sanitized
                if (!$def->isTypeSanitized($type_sanitized) && $def->isTainted()) {
                    $type_ok = false;
                }
            }

            if ($type_ok) {
                $defassign->setSanitized(true);
                $defassign->addTypeSanitized($type_sanitized);
            }
        }
    }

    public static function copyValues($def, $defassign)
    {
        $defassign->setIsEmbeddedByChars($def->getIsEmbeddedByChars(), true);
    }
}
