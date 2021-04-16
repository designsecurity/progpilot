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
    public static function getWorkSpace()
    {
        return getcwd()."/.progpilot_temp_workspace";
    }

    public static function unserializeFunc($signature)
    {
        $workSpace = Utils::getWorkSpace();
        $funcWorkSpace = $workSpace."/".$signature.".ser";
        
        if (file_exists($funcWorkSpace)) {
            $content = base64_decode(file_get_contents($funcWorkSpace));
            $myFunc = unserialize($content);
            if (!is_null($myFunc)) {
                return $myFunc;
            }
        }

        return null;
    }

    public static function serializeFunc($myFunc, $signature)
    {
        $workSpace = Utils::getWorkSpace();
        $funcWorkSpace = $workSpace."/".$signature.".ser";
        
        $ser = base64_encode(serialize($myFunc));
        file_put_contents($funcWorkSpace, $ser);
    }

    public static function deleteWorkSpace()
    {
        $workSpace = Utils::getWorkSpace();
        $files = array_diff(scandir($workSpace), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$workSpace/$file")) ? delTree("$workSpace/$file") : unlink("$workSpace/$file");
        }

        return rmdir($workSpace);
    }

    public static function createWorkSpace()
    {
        $workSpace = Utils::getWorkSpace();
        if (!file_exists($workSpace)) {
            if (!mkdir($workSpace)) {
                Utils::printError(Lang::UNABLE_TO_CREATE_WORKSPACE);
            }
        }
    }

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
            fwrite(STDERR, "progpilot warning : $message (file: '".$context->getCurrentMyFile()->getName()."')\n");
        }
    }

    public static function printError($message)
    {
        throw new \Exception($message);
    }

    public static function printStaticProperties($language, $props)
    {
        $propertyName = "";

        if (is_array($props)) {
            foreach ($props as $prop) {
                $propertyName .= "::"."\$".Utils::encodeCharacters($prop);
            }
        }

        return $propertyName;
    }

    public static function printProperties($language, $props)
    {
        $separator = "->";
        if ($language === "js") {
            $separator = ".";
        }
        
        $propertyName = "";

        if (is_array($props)) {
            foreach ($props as $prop) {
                $propertyName .= "$separator".Utils::encodeCharacters($prop);
            }
        }

        return $propertyName;
    }

    public static function printDefinition($language, $def)
    {
        $prefix = "\$";
        if ($language === "js") {
            $prefix = "";
        }
            
        if ($def->isType(MyDefinition::TYPE_PROPERTY)) {
            $defName = "$prefix".Utils::encodeCharacters($def->getName()).
                Utils::printProperties($language, $def->property->getProperties());
        } elseif ($def->isType(MyDefinition::TYPE_STATIC_PROPERTY)) {
            $defName = Utils::encodeCharacters($def->getName()).
                Utils::printStaticProperties($language, $def->property->getProperties());
        } else {
            $defName = "$prefix".Utils::encodeCharacters($def->getName());
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
