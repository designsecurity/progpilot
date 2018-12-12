<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

use PHPCfg\Op;
use progpilot\Objects\MyOp;
use progpilot\Utils;
use progpilot\Transformations\Php\Common;

class MyDefinition extends MyOp
{
    const CAST_SAFE = "cast_int";
    const CAST_NOT_SAFE = "cast_string";

    const TYPE_PROPERTY = 0x0001;
    const TYPE_ARRAY = 0x0002;
    const TYPE_CONSTANTE = 0x0004;
    const TYPE_REFERENCE = 0x0008;
    const TYPE_ARRAY_REFERENCE = 0x0010;
    const TYPE_COPY_ARRAY = 0x0020;
    const TYPE_INSTANCE = 0x0040;
    const TYPE_GLOBAL = 0x0080;
    const TYPE_STATIC_PROPERTY = 0x0100;

    const SECURITY_HIGH = 1;
    const SECURITY_LOW = 2;
    
    private $isCopyArray;
    private $objectId;
    private $blockId;
    private $isTainted;
    private $isConst;
    private $isRef;
    private $refName;
    private $isRefArr;
    private $refArrValue;
    private $theArrays;
    private $theExpr;
    private $theExprs;
    private $taintedByExpr;
    private $instance;
    private $className;
    private $isSanitized;
    private $typeSanitized;
    private $valueFromDef;
    private $cast;
    private $isProperty;
    private $isInstance;
    private $isEmbeddedByChar;
    private $label;

    public $property;

    public function __construct($varLine, $varColumn, $varName)
    {
        parent::__construct($varName, $varLine, $varColumn);

        $this->isEmbeddedByChar = [];

        $this->isCopyArray = false;
        $this->valueFromDef = null;

        $this->objectId = -1;
        $this->blockId = -1;
        $this->isTainted = false;
        $this->isConst = false;
        $this->isRef = false;
        $this->isRefArr = false;
        $this->refArrValue = null;
        $this->instance = false;
        $this->theArrays = [];
        $this->theExpr = null;
        $this->taintedByExpr = null;
        $this->className = "";
        $this->label = MyDefinition::SECURITY_LOW;

        $this->isSanitized = false;
        $this->typeSanitized = [];

        $this->lastKnownValue = [];

        $this->property = new MyProperty;
        $this->cast = MyDefinition::CAST_NOT_SAFE;

        $this->isProperty = false;
        $this->isInstance = false;
    }

    public function __clone()
    {
        $this->property = clone $this->property;
    }

    public function printStdout($context = null)
    {
        echo "def id ".$this->varId." :: \
        name = ".htmlentities($this->getName(), ENT_QUOTES, 'UTF-8')." :: \
        line = ".$this->getLine()." :: column = ".$this->getColumn()." :: \
        tainted = ".$this->isTainted()." :: \
        label = ".$this->getLabel()." :: \
        ref = ".$this->isType(MyDefinition::TYPE_REFERENCE)." :: \
        is_property = ".$this->isType(MyDefinition::TYPE_PROPERTY)." :: \
        is_static_property = ".$this->isType(MyDefinition::TYPE_STATIC_PROPERTY)." :: \
        isInstance = ".$this->isType(MyDefinition::TYPE_INSTANCE)." :: \
        is_const = ".$this->isType(MyDefinition::TYPE_CONSTANTE)." :: \
        blockid = ".$this->getBlockId()." :: \
        cast = ".$this->getCast()."\n";

        echo "last_known_value :\n";
        var_dump($this->lastKnownValue);

        echo "is_embeddedbychar :\n";
        var_dump($this->isEmbeddedByChar);
        echo "type_sanitized :\n";
        var_dump($this->typeSanitized);

        if ($this->isType(MyDefinition::TYPE_ARRAY)) {
            echo "array index value :\n";
            var_dump($this->getArrayValue());
        }
        
        if ($this->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED") {
            echo "array index value : PROGPILOT_ALL_INDEX_TAINTED\n";
        }
        
        if ($this->property->hasProperty("PROGPILOT_ALL_PROPERTIES_TAINTED")) {
            echo "property value : PROGPILOT_ALL_PROPERTIES_TAINTED\n";
        }

        if ($this->isType(MyDefinition::TYPE_PROPERTY) || $this->isType(MyDefinition::TYPE_STATIC_PROPERTY)) {
            echo "property : ".Utils::printProperties("php", $this->property->getProperties())."\n";
            echo "class_name : ".htmlentities($this->getClassName(), ENT_QUOTES, 'UTF-8')."\n";
            echo "visibility : ".htmlentities($this->property->getVisibility(), ENT_QUOTES, 'UTF-8')."\n";
        }

        if ($this->isType(MyDefinition::TYPE_INSTANCE)) {
            echo "instance : ".htmlentities($this->getClassName(), ENT_QUOTES, 'UTF-8')."\n";
            echo "object id : ".$this->getObjectId()."\n";
            
            if (!is_null($context)) {
                $tmpMyClass = $context->getObjects()->getMyClassFromObject($this->getObjectId());
                if (!is_null($tmpMyClass)) {
                    echo "class of object : ".htmlentities($tmpMyClass->getName(), ENT_QUOTES, 'UTF-8')."\n";
                }
            }
        }

        if ($this->isType(MyDefinition::TYPE_COPY_ARRAY)) {
            echo "copyarray start ================= count = ".count($this->getCopyArrays())."\n";
            foreach ($this->getCopyArrays() as $copyArray) {
                var_dump($copyArray[0]);
            }
            echo "copyarray end =================\n";
        }
        echo "__________________________________________\n\n\n";
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

    public function getClassName()
    {
        return $this->className;
    }

    public function setClassName($className)
    {
        $this->className = $className;
    }

    public function getRefName()
    {
        return $this->refName;
    }

    public function setRefName($refname)
    {
        $this->refName = $refname;
    }

    public function isTainted()
    {
        return $this->isTainted;
    }

    public function setTainted($tainted)
    {
        $this->isTainted = $tainted;
    }

    public function setTaintedByExpr($expr)
    {
        $this->taintedByExpr = $expr;
    }

    public function getTaintedByExpr()
    {
        return $this->taintedByExpr;
    }

    public function getRefArrValue()
    {
        return $this->refArrValue;
    }

    public function setRefArrValue($arr)
    {
        $this->refArrValue = $arr;
    }

    public function getObjectId()
    {
        return $this->objectId;
    }

    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }

    public function getBlockId()
    {
        return $this->blockId;
    }

    public function setBlockId($blockId)
    {
        $this->blockId = $blockId;
    }

    public function addCopyArray($arr, $def)
    {
        $val = [$arr, $def];
        if (!in_array($val, $this->theArrays, true)) {
            $this->theArrays[] = $val;
        }
    }

    public function setCopyArrays($theArrays)
    {
        $this->theArrays = $theArrays;
    }

    public function getCopyArrays()
    {
        return $this->theArrays;
    }

    public function setExpr($myExpr)
    {
        $this->theExpr = $myExpr;
    }

    public function getExpr()
    {
        return $this->theExpr;
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
}
