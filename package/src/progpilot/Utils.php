<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot;

use progpilot\Objects\MyOp;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyFunction;

class Utils
{
    public static function toColumn($code, $pos)
    {
        if ($pos > strlen($code)) {
            return 1;
        }

        $lineStartPos = strrpos($code, "\n", $pos - strlen($code));
        if (false === $lineStartPos) {
            $lineStartPos = -1;
        }
        return $pos - $lineStartPos;
    }

    public static function encodeCharacters($string)
    {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }

    public static function printWarning($context, $message)
    {
        if ($context->isDebugMode()) {
            fwrite(STDERR, "progpilot warning: $message\n");
            fwrite(STDERR, "file: '".$context->getCurrentMyFile()->getName()."'\n");

            // sometimes it's called outside of function context
            if (!is_null($context->getCurrentFunc())) {
                fwrite(STDERR, "function: '".$context->getCurrentFunc()->getName()."'\n");
            }
        }
    }

    public static function printError($message)
    {
        throw new \Exception($message);
    }

    public static function printDefinition($def, $original = null)
    {

        $prefix = "\$";
        if ($def->isType(MyDefinition::TYPE_STATIC_PROPERTY)) {
            // oop/simple31.php
            if (!is_null($original)
                && !empty($original)
                    && $original[0]->isType(MyDefinition::TYPE_STATIC_PROPERTY)) {
                $prefix = "";
            }
        }

        $printableDef = "";
        if (!is_null($original) && !empty($original)) {
            for ($i = 0; $i < count($original); $i ++) {
                if ($original[$i] instanceof MyDefinition) {
                    $printableDef .= "$prefix".Utils::encodeCharacters($original[$i]->getName());
                } elseif (is_numeric($original[$i])
                    || $original[$i] === ']'
                        || $original[$i] === '['
                            || $original[$i] === '->'
                                || $original[$i] === '::') {
                    // numeric element
                    $printableDef .= $original[$i];

                    $wasArray = false;
                    if ($original[$i] === '[') {
                        $wasArray = true;
                    }

                    $wasStatic = false;
                    if ($original[$i] === '::') {
                        $wasStatic = true;
                    }
                } else {
                    // string element (array, property name)
                    if ($wasArray) {
                        $printableDef .= "\"";
                    }

                    if ($wasStatic) {
                        $printableDef .= "\$";
                    }

                    $printableDef .= Utils::encodeCharacters($original[$i]);

                    if ($wasArray) {
                        $printableDef .= "\"";
                    }
                }
            }
        } else {
            $printableDef = "$prefix".Utils::encodeCharacters($def->getName());
        }


        return $printableDef;
    }

    public static function printFunction($function)
    {
        $functionName = "\$";
        if ($function->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $functionName = Utils::encodeCharacters($function->getMyClass()->getName())."->";
        }

        $functionName .= Utils::encodeCharacters($function->getName());

        return $functionName;
    }

    public static function printArray($array, &$print)
    {
        if (is_array($array)) {
            foreach ($array as $index => $value) {
                if (isset($array[$index])) {
                    if (is_string($index)) {
                        $print .= "[\"".Utils::encodeCharacters($index)."\"]";
                    } else {
                        $print .= "[".Utils::encodeCharacters($index)."]";
                    }

                    Utils::printArray($array[$index], $print);
                }
            }
        }
    }
}
