<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

use progpilot\Transformations\Php\Common;

class MyDefState extends MyOp
{
    private $isTainted;
    private $isSanitized;
    private $typeSanitized;
    private $lastKnownValue;
    private $valueFromDef;
    private $cast;
    private $isEmbeddedByChar;
    private $label;
    private $objectId;
    private $arrayIndexes;

    public function __construct()
    {
        $this->isEmbeddedByChar = [];
        $this->valueFromDef = null;
        $this->isTainted = false;
        $this->refArrValue = null;
        $this->taintedByDefs = [];
        $this->label = MyDefinition::SECURITY_LOW;
        $this->isSanitized = false;
        $this->typeSanitized = [];
        $this->lastKnownValue = [];
        $this->cast = MyDefinition::CAST_NOT_SAFE;
        $this->objectId = -1;
        $this->arrayIndexes = [];
    }

    public function printStdout()
    {
        echo "cast = ".$this->getCast()."\n";

        if ($this->isTainted()) {
            echo "tainted = 1\n";

            foreach ($this->taintedByDefs as $taintedByDef) {
                echo "taintedByDef = '".$taintedByDef[0]->getId()."'\n";
            }
        }

        echo "last_known_value :\n";
        var_dump($this->lastKnownValue);
        echo "is_embeddedbychar :\n";
        var_dump($this->isEmbeddedByChar);
        echo "isSanitized :\n";
        var_dump($this->isSanitized);
        echo "type_sanitized :\n";
        var_dump($this->typeSanitized);
        echo "objectid :\n";
        var_dump($this->objectId);
        echo "istypeinstance : '".$this->isType(MyDefinition::TYPE_INSTANCE)."'\n";
        echo "allpropertiestainted : '".$this->isType(MyDefinition::ALL_PROPERTIES_TAINTED)."'\n";
        echo "istypearray : '".$this->isType(MyDefinition::TYPE_ARRAY)."'\n";
        foreach ($this->arrayIndexes as $arrayIndex) {
            echo "index :\n";
            var_dump($arrayIndex->index);
            echo "def :\n";
            $arrayIndex->def->printStdout();
        }
    }

    public function addTaintedByDef($taintedByDef)
    {
        if (!in_array($taintedByDef, $this->taintedByDefs, true)) {
            $this->taintedByDefs[] = $taintedByDef;
        }
    }

    public function getTaintedByDefs()
    {
        return $this->taintedByDefs;
    }

    public function setTaintedByDefs($defs)
    {
        $this->taintedByDefs = $defs;
    }

    public function setIsEmbeddedByChars($chars)
    {
        /*
        foreach ($chars as $char => $value) {
            if (!isset($this->isEmbeddedByChar[$char])) {
                $this->isEmbeddedByChar[$char] = $value;
            } else {
                if (!$value && !$control) {
                    $this->isEmbeddedByChar[$char] = false;
                } elseif ($value) {
                    $this->isEmbeddedByChar[$char] = true;
                }
            }
        }
        */

        foreach ($chars as $char => $value) {
            $this->isEmbeddedByChar[$char] = $value % 2;
        }
    }

    public function getIsEmbeddedByChars()
    {
        return $this->isEmbeddedByChar;
    }

    public function setEmbeddedByChar($value)
    {
        $this->isEmbeddedByChar = $value;
    }

    public function setIsEmbeddedByChar($char, $bool)
    {
        $this->isEmbeddedByChar[$char] = $bool;
    }

    public function getIsEmbeddedByChar($char)
    {
        if (isset($this->isEmbeddedByChar[$char])) {
            return $this->isEmbeddedByChar[$char];
        }

        return false;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setCast($cast)
    {
        $this->cast = $cast;
    }

    public function getCast()
    {
        return $this->cast;
    }

    public function setValueFromDef($def)
    {
        $this->valueFromDef = $def;
    }

    public function getValueFromDef()
    {
        return $this->valueFromDef;
    }

    public function resetLastKnownValues()
    {
        $this->lastKnownValue = [];
    }

    public function setLastKnownValues($values)
    {
        $this->lastKnownValue = $values;
    }

    public function setLastKnownValue($id, $value)
    {
        $this->lastKnownValue[$id] = $value;
    }

    public function addLastKnownValue($value)
    {
        $value = rtrim(ltrim($value));

        if (Common::validLastKnownValue($value) && !in_array($value, $this->lastKnownValue, true)) {
            $this->lastKnownValue[] = $value;
        }
    }

    public function getLastKnownValues()
    {
        return $this->lastKnownValue;
    }

    public function setSanitized($isSanitized)
    {
        $this->isSanitized = $isSanitized;
    }

    public function isSanitized()
    {
        return $this->isSanitized;
    }

    public function setTypeSanitized($typeSanitized)
    {
        $this->typeSanitized = $typeSanitized;
    }

    public function getTypeSanitized()
    {
        return $this->typeSanitized;
    }

    public function addTypeSanitized($typeSanitized)
    {
        if (!in_array($typeSanitized, $this->typeSanitized, true)) {
            $this->typeSanitized[] = $typeSanitized;
        }
    }

    public function isTypeSanitized($typeSanitized)
    {
        if (in_array($typeSanitized, $this->typeSanitized, true)) {
            return true;
        }

        return false;
    }

    public function isTainted()
    {
        return $this->isTainted;
    }

    public function setTainted($tainted)
    {
        $this->isTainted = $tainted;
    }

    public function createDefArrayIndex($blockId, $myArrayDef, $arrayIndex)
    {
        $myDef = new MyDefinition(
            $blockId,
            $myArrayDef->getSourceMyFile(),
            $myArrayDef->getLine(),
            $myArrayDef->getColumn(),
            "built-in-index-array"
        );
            
        $myDef->addType(MyDefinition::TYPE_ARRAY_ELEMENT);
        $this->addArrayIndex($arrayIndex, $myDef);
        $this->addType(MyDefinition::TYPE_ARRAY);
        $ret[] = $myDef;

        return [true, $ret];
    }

    public function getOrCreateDefArrayIndex($blockId, $myArrayDef, $arrayIndex)
    {
        $ret = [];
        $found = false;
        for ($i = 0; $i < count($this->arrayIndexes); $i ++) {
            if ($this->arrayIndexes[$i]->index === $arrayIndex) {
                $found = true;
                $ret[] = $this->arrayIndexes[$i]->def;
            }
        }

        if ($found) {
            return [false, $ret];
        }

        return $this->createDefArrayIndex($blockId, $myArrayDef, $arrayIndex);
    }

    public function getDefArrayIndex($arrayIndex)
    {
        $ret = [];
        for ($i = 0; $i < count($this->arrayIndexes); $i ++) {
            if ($this->arrayIndexes[$i]->index === $arrayIndex) {
                $ret[] = $this->arrayIndexes[$i]->def;
            }
        }

        return $ret;
    }

    public function isArrayIndexExists($arrayIndex)
    {
        for ($i = 0; $i < count($this->arrayIndexes); $i ++) {
            if ($this->arrayIndexes[$i]->index === $arrayIndex) {
                return true;
            }
        }
        
        return false;
    }

    public function addArrayIndex($arrayIndex, $def)
    {
        $ele = new \stdClass;
        $ele->index = $arrayIndex;
        $ele->def = $def;
        $this->arrayIndexes[] = $ele;
    }

    public function addSubArrayIndex($arrayIndex, $def)
    {
        if (!empty($this->arrayIndexes)) {
            for ($i = 0; $i < count($this->arrayIndexes); $i ++) {
                $currentEle = $this->arrayIndexes[$i];

                $ele = new \stdClass;
                $ele->index = array(key($arrayIndex) => $currentEle->index);
                $ele->def = $currentEle->def;

                $this->arrayIndexes[$i] = $ele;
            }
        } else {
            $ele = new \stdClass;
            $ele->index = $arrayIndex;
            $ele->def = $def;
            $this->arrayIndexes[] = $ele;
        }
    }

    public function setArrayIndexes($arrayIndexes)
    {
        $this->arrayIndexes = $arrayIndexes;
    }

    public function getArrayIndexes()
    {
        return $this->arrayIndexes;
    }

    public function getObjectId()
    {
        return $this->objectId;
    }

    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }
}
