<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

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

            foreach($this->taintedByDefs as $taintedByDef) {
                echo "taintedByDef = '".$taintedByDef->getId()."'\n";
            }
        }

        echo "last_known_value :\n";
        var_dump($this->lastKnownValue);

        echo "is_embeddedbychar :\n";
        var_dump($this->isEmbeddedByChar);
        echo "type_sanitized :\n";
        var_dump($this->typeSanitized);
        echo "objectid :\n";
        var_dump($this->objectId);
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

    public function setIsEmbeddedByChars($chars, $control)
    {
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

    public function getOrCreateDefArrayIndex($arrayIndex)
    {
        echo "getOrCreateDefArrayIndex 1\n";

        for ($i = 0; $i < count($this->arrayIndexes); $i ++) {
            echo "getOrCreateDefArrayIndex 2\n";
            var_dump($arrayIndex);
            var_dump($this->arrayIndexes[$i]->index);
            if($this->arrayIndexes[$i]->index === $arrayIndex) {
                echo "getOrCreateDefArrayIndex 3\n";
                return [false, $this->arrayIndexes[$i]->def];
            }
        }

        $myDef = new MyDefinition($this->getLine(), $this->getColumn(), "built-in-index-array");
        $myDef->setSourceMyFile($this->getSourceMyFile());
        $this->addArrayIndex($arrayIndex, $myDef);
        $this->addType(MyDefinition::TYPE_ARRAY);

        return [true, $myDef];
    }

    public function getDefArrayIndex($arrayIndex)
    {
        for ($i = 0; $i < count($this->arrayIndexes); $i ++) {
            if($this->arrayIndexes[$i]->index === $arrayIndex) {
                return $this->arrayIndexes[$i]->def;
            }
        }

        return null;
    }

    public function isArrayIndexExists($arrayIndex)
    {
        for ($i = 0; $i < count($this->arrayIndexes); $i ++) {
            if($this->arrayIndexes[$i]->index === $arrayIndex) {
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
        }
        else {
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
