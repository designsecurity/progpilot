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

    private $is_copyArray;
    private $object_id;
    private $block_id;
    private $isTainted;
    private $is_const;
    private $is_ref;
    private $ref_name;
    private $is_ref_arr;
    private $ref_arr_value;
    private $thearrays;
    private $theexpr;
    private $taintedbyexpr;
    private $instance;
    private $class_name;
    private $isSanitized;
    private $type_sanitized;
    private $value_from_def;
    private $cast;
    private $is_property;
    private $isInstance;
    private $is_embeddedbychar;

    public $property;

    public function __construct($var_line, $var_column, $var_name)
    {
        parent::__construct($var_name, $var_line, $var_column);

        $this->is_embeddedbychar = [];

        $this->is_copyArray = false;
        $this->value_from_def = null;

        $this->object_id = -1;
        $this->block_id = -1;
        $this->isTainted = false;
        $this->is_const = false;
        $this->is_ref = false;
        $this->is_ref_arr = false;
        $this->ref_arr_value = null;
        $this->instance = false;
        $this->thearrays = [];
        $this->theexpr = null;
        $this->taintedbyexpr = null;
        $this->class_name = "";

        $this->isSanitized = false;
        $this->type_sanitized = [];

        $this->last_known_value = [];

        $this->property = new MyProperty;
        $this->cast = MyDefinition::CAST_NOT_SAFE;

        $this->is_property = false;
        $this->isInstance = false;
    }

    public function __clone()
    {
        $this->property = clone $this->property;
    }

    public function printStdout()
    {
        echo "def id ".$this->var_id." :: \
        name = ".htmlentities($this->getName(), ENT_QUOTES, 'UTF-8')." :: \
        line = ".$this->getLine()." :: column = ".$this->getColumn()." :: \
        tainted = ".$this->isTainted()." :: \
        ref = ".$this->isType(MyDefinition::TYPE_REFERENCE)." :: \
        is_property = ".$this->isType(MyDefinition::TYPE_PROPERTY)." :: \
        isInstance = ".$this->isType(MyDefinition::TYPE_INSTANCE)." :: \
        is_const = ".$this->isType(MyDefinition::TYPE_CONSTANTE)." :: \
        blockid = ".$this->getBlockId()." :: \
        cast = ".$this->getCast()."\n";

        echo "last_known_value :\n";
        var_dump($this->last_known_value);

        echo "is_embeddedbychar :\n";
        var_dump($this->is_embeddedbychar);
        echo "type_sanitized :\n";
        var_dump($this->type_sanitized);

        if ($this->isType(MyDefinition::TYPE_ARRAY)) {
            echo "array index value :\n";
            var_dump($this->getArrayValue());
        }

        if ($this->isType(MyDefinition::TYPE_PROPERTY)) {
            echo "property : ".Utils::printProperties($this->property->getProperties())."\n";
            echo "class_name : ".htmlentities($this->getClassName(), ENT_QUOTES, 'UTF-8')."\n";
            echo "visibility : ".htmlentities($this->property->getVisibility(), ENT_QUOTES, 'UTF-8')."\n";
        }

        if ($this->isType(MyDefinition::TYPE_INSTANCE)) {
            echo "instance : ".htmlentities($this->getClassName(), ENT_QUOTES, 'UTF-8')."\n";
            echo "object id : ".$this->getObjectId()."\n";
        }

        if ($this->isType(MyDefinition::TYPE_COPY_ARRAY)) {
            echo "copyarray start ================= count = ".count($this->getCopyArrays())."\n";
            foreach ($this->getCopyArrays() as $copyArray) {
                var_dump($copyArray[0]);
            }
            echo "copyarray end =================\n";
        }
    }

    public function setIsEmbeddedByChars($chars, $control)
    {
        foreach ($chars as $char => $value) {
            if (!isset($this->is_embeddedbychar[$char])) {
                $this->is_embeddedbychar[$char] = $value;
            } else {
                if (!$value && !$control) {
                    $this->is_embeddedbychar[$char] = false;
                } elseif ($value) {
                    $this->is_embeddedbychar[$char] = true;
                }
            }
        }
    }

    public function getIsEmbeddedByChars()
    {
        return $this->is_embeddedbychar;
    }

    public function setIsEmbeddedByChar($char, $bool)
    {
        $this->is_embeddedbychar[$char] = $bool;
    }

    public function getIsEmbeddedByChar($char)
    {
        if (isset($this->is_embeddedbychar[$char])) {
            return $this->is_embeddedbychar[$char];
        }

        return false;
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
        $this->value_from_def = $def;
    }

    public function getValueFromDef()
    {
        return $this->value_from_def;
    }

    public function resetLastKnownValues()
    {
        $this->last_known_value = [];
    }

    public function setLastKnownValues($values)
    {
        $this->last_known_value = $values;
    }

    public function setLastKnownValue($id, $value)
    {
        $this->last_known_value[$id] = $value;
    }

    public function addLastKnownValue($value)
    {
        $value = rtrim(ltrim($value));

        if (Common::validLastKnownValue($value) && !in_array($value, $this->last_known_value, true)) {
            $this->last_known_value[] = $value;
        }
    }

    public function getLastKnownValues()
    {
        return $this->last_known_value;
    }

    public function getClassName()
    {
        return $this->class_name;
    }

    public function setClassName($class_name)
    {
        $this->class_name = $class_name;
    }

    public function getRefName()
    {
        return $this->ref_name;
    }

    public function setRefName($refname)
    {
        $this->ref_name = $refname;
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
        $this->taintedbyexpr = $expr;
    }

    public function getTaintedByExpr()
    {
        return $this->taintedbyexpr;
    }

    public function getRefArrValue()
    {
        return $this->ref_arr_value;
    }

    public function setRefArrValue($arr)
    {
        $this->ref_arr_value = $arr;
    }

    public function getObjectId()
    {
        return $this->object_id;
    }

    public function setObjectId($object_id)
    {
        $this->object_id = $object_id;
    }

    public function getBlockId()
    {
        return $this->block_id;
    }

    public function setBlockId($block_id)
    {
        $this->block_id = $block_id;
    }

    public function addCopyArray($arr, $def)
    {
        $val = [$arr, $def];
        if (!in_array($val, $this->thearrays, true)) {
            $this->thearrays[] = $val;
        }
    }

    public function setCopyArrays($thearrays)
    {
        $this->thearrays = $thearrays;
    }

    public function getCopyArrays()
    {
        return $this->thearrays;
    }

    public function setExprs($exprs)
    {
        $this->theexprs = $exprs;
    }

    public function setExpr($myexpr)
    {
        $this->theexpr = $myexpr;
    }

    public function getExpr()
    {
        return $this->theexpr;
    }

    public function setSanitized($isSanitized)
    {
        $this->isSanitized = $isSanitized;
    }

    public function isSanitized()
    {
        return $this->isSanitized;
    }

    public function setTypeSanitized($type_sanitized)
    {
        $this->type_sanitized = $type_sanitized;
    }

    public function getTypeSanitized()
    {
        return $this->type_sanitized;
    }

    public function addTypeSanitized($type_sanitized)
    {
        if (!in_array($type_sanitized, $this->type_sanitized, true)) {
            $this->type_sanitized[] = $type_sanitized;
        }
    }

    public function isTypeSanitized($type_sanitized)
    {
        if (in_array($type_sanitized, $this->type_sanitized, true)) {
            return true;
        }

        return false;
    }
}
