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
    private $taintedByDefs;
    private $isSanitized;
    private $typeSanitized;
    private $lastKnownValue;
    private $cast;
    private $isEmbeddedByChar;
    private $label;
    private $objectId;
    private $arrayIndexes;

    public function __construct()
    {
        parent::__construct("state", 0, 0);

        $this->isEmbeddedByChar = [];
        $this->isTainted = false;
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
        echo "allarrayelementstainted : '".$this->isType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED)."'\n";
        echo "istypearray : '".$this->isType(MyDefinition::TYPE_ARRAY)."'\n";
        echo "istypearrayarray : '".$this->isType(MyDefinition::TYPE_ARRAY_ARRAY)."'\n";
        
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

    public function updateIsEmbeddedByChars($chars)
    {
        foreach ($chars as $char => $value) {
            $curChar = isset($this->isEmbeddedByChar[$char]) ? $this->isEmbeddedByChar[$char] : 0;
            $this->isEmbeddedByChar[$char] = ($value + $curChar) % 2;
        }
    }

    public function setIsEmbeddedByChars($chars)
    {
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

    public function addLastKnownValue($value)
    {
        if($value !== null) {
            $value = rtrim(ltrim($value));
        }
        
        if (Common::validLastKnownValue($value)
            && !in_array($value, $this->lastKnownValue, true)
                && count($this->lastKnownValue) < 10) {
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

        $existingState = $myArrayDef->getState($blockId);

        if (!is_null($existingState) && $existingState->isType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED)) {
            $myDef->getCurrentState()->setTainted(true);
            $myDef->getCurrentState()->addTaintedByDef([$myArrayDef, $myArrayDef->getCurrentState()]);
        } elseif ($myArrayDef->getCurrentState()->isType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED)) {
            // data/source17.php
            $myDef->getCurrentState()->setTainted(true);
            $myDef->getCurrentState()->addTaintedByDef([$myArrayDef, $myArrayDef->getCurrentState()]);
        }

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
        if (!$this->isArrayIndexExists($arrayIndex)
            && count($this->arrayIndexes) < 100) {
            $ele = new \stdClass;
            $ele->index = $arrayIndex;
            $ele->def = $def;
            $this->arrayIndexes[] = $ele;

            return true;
        }

        return false;
    }

    public function overwriteArrayIndex($arrayIndex, $def)
    {
        for ($i = 0; $i < count($this->arrayIndexes); $i ++) {
            if ($this->arrayIndexes[$i]->index === $arrayIndex) {
                $this->arrayIndexes[$i]->def = $def;
                break;
            }
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
