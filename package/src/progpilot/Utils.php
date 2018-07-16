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
        if ($context->getPrintWarning()) {
            fwrite(STDERR, "progpilot warning : $message\n");
        }
    }

    public static function printError($message)
    {
        throw new \Exception($message);
    }

    public static function printProperties($props)
    {
        $propertyName = "";

        if (is_array($props)) {
            foreach ($props as $prop) {
                $propertyName .= "->".Utils::encodeCharacters($prop);
            }
        }

        return $propertyName;
    }

    public static function printDefinition($def)
    {
        if ($def->isType(MyDefinition::TYPE_PROPERTY)) {
            $defName = "\$".Utils::encodeCharacters($def->getName()).
                Utils::printProperties($def->property->getProperties());
        } else {
            $defName = "\$".Utils::encodeCharacters($def->getName());
        }

        $nameArray = "";
        if ($def->isType(MyDefinition::TYPE_ARRAY)) {
            Utils::printArray($def->getArrayValue(), $nameArray);
        }

        return $defName.$nameArray;
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
