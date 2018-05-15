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

    private $is_copy_array;
    private $object_id;
    private $block_id;
    private $is_tainted;
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
    private $is_sanitized;
    private $type_sanitized;
    private $value_from_def;
    private $cast;
    private $is_property;
    private $is_instance;
    private $is_embeddedbychar;

    public $property;

    public function __construct($var_line, $var_column, $var_name)
    {
        parent::__construct($var_name, $var_line, $var_column);

        $this->is_embeddedbychar = [];

        $this->is_copy_array = false;
        $this->value_from_def = null;

        $this->object_id = -1;
        $this->block_id = -1;
        $this->is_tainted = false;
        $this->is_const = false;
        $this->is_ref = false;
        $this->is_ref_arr = false;
        $this->ref_arr_value = null;
        $this->instance = false;
        $this->thearrays = [];
        $this->theexpr = null;
        $this->taintedbyexpr = null;
        $this->class_name = "";

        $this->is_sanitized = false;
        $this->type_sanitized = [];

        $this->last_known_value = [];

        $this->property = new MyProperty;
        $this->cast = MyDefinition::CAST_NOT_SAFE;

        $this->is_property = false;
        $this->is_instance = false;
    }

    public function __clone()
    {
        $this->property = clone $this->property;
    }

    public function print_stdout()
    {
        echo "def id ".$this->var_id." ::  name = ".htmlentities($this->get_name(), ENT_QUOTES, 'UTF-8')." :: line = ".$this->getLine()." :: column = ".$this->getColumn()." :: tainted = ".$this->is_tainted()." :: ref = ".$this->is_type(MyDefinition::TYPE_REFERENCE)." :: is_property = ".$this->is_type(MyDefinition::TYPE_PROPERTY)." :: is_instance = ".$this->is_type(MyDefinition::TYPE_INSTANCE)." :: is_const = ".$this->is_type(MyDefinition::TYPE_CONSTANTE)." :: blockid = ".$this->get_block_id()." :: cast = ".$this->get_cast()."\n";
        /*
                    echo "my_source_file :\n";
                    var_dump($this->get_source_myfile()->get_name());
        */
        echo "last_known_value :\n";
        var_dump($this->last_known_value);

        echo "is_embeddedbychar :\n";
        var_dump($this->is_embeddedbychar);
        echo "type_sanitized :\n";
        var_dump($this->type_sanitized);

        if ($this->is_type(MyDefinition::TYPE_ARRAY)) {
            echo "array index value :\n";
            var_dump($this->get_array_value());
        }

        if ($this->is_type(MyDefinition::TYPE_PROPERTY)) {
            echo "property : ".Utils::print_properties($this->property->get_properties())."\n";
            echo "class_name : ".htmlentities($this->get_class_name(), ENT_QUOTES, 'UTF-8')."\n";
            echo "visibility : ".htmlentities($this->property->get_visibility(), ENT_QUOTES, 'UTF-8')."\n";
        }

        if ($this->is_type(MyDefinition::TYPE_INSTANCE)) {
            echo "instance : ".htmlentities($this->get_class_name(), ENT_QUOTES, 'UTF-8')."\n";
            echo "object id : ".$this->get_object_id()."\n";
        }

        if ($this->is_type(MyDefinition::TYPE_COPY_ARRAY)) {
            echo "copyarray start ================= count = ".count($this->get_copyarrays())."\n";
            foreach ($this->get_copyarrays() as $copy_array) {
                var_dump($copy_array[0]);
            }
            echo "copyarray end =================\n";
        }
    }

    public function set_is_embeddedbychars($chars, $control)
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

    public function get_is_embeddedbychars()
    {
        return $this->is_embeddedbychar;
    }

    public function set_is_embeddedbychar($char, $bool)
    {
        $this->is_embeddedbychar[$char] = $bool;
    }

    public function get_is_embeddedbychar($char)
    {
        if (isset($this->is_embeddedbychar[$char])) {
            return $this->is_embeddedbychar[$char];
        }

        return false;
    }

    public function set_cast($cast)
    {
        $this->cast = $cast;
    }

    public function get_cast()
    {
        return $this->cast;
    }

    public function set_value_from_def($def)
    {
        $this->value_from_def = $def;
    }

    public function get_value_from_def()
    {
        return $this->value_from_def;
    }

    public function reset_last_known_values()
    {
        $this->last_known_value = [];
    }

    public function set_last_known_values($values)
    {
        $this->last_known_value = $values;
    }

    public function set_last_known_value($id, $value)
    {
        $this->last_known_value[$id] = $value;
    }

    public function add_last_known_value($value)
    {
        $value = rtrim(ltrim($value));

        if (Common::valid_last_known_value($value) && !in_array($value, $this->last_known_value, true)) {
            $this->last_known_value[] = $value;
        }
    }

    public function get_last_known_values()
    {
        return $this->last_known_value;
    }

    public function get_class_name()
    {
        return $this->class_name;
    }

    public function set_class_name($class_name)
    {
        $this->class_name = $class_name;
    }

    public function get_ref_name()
    {
        return $this->ref_name;
    }

    public function set_ref_name($refname)
    {
        $this->ref_name = $refname;
    }

    public function is_tainted()
    {
        return $this->is_tainted;
    }

    public function set_tainted($tainted)
    {
        $this->is_tainted = $tainted;
    }

    public function set_taintedbyexpr($expr)
    {
        $this->taintedbyexpr = $expr;
    }

    public function get_taintedbyexpr()
    {
        return $this->taintedbyexpr;
    }

    public function get_ref_arr_value()
    {
        return $this->ref_arr_value;
    }

    public function set_ref_arr_value($arr)
    {
        $this->ref_arr_value = $arr;
    }

    public function get_object_id()
    {
        return $this->object_id;
    }

    public function set_object_id($object_id)
    {
        $this->object_id = $object_id;
    }

    public function get_block_id()
    {
        return $this->block_id;
    }

    public function set_block_id($block_id)
    {
        $this->block_id = $block_id;
    }

    public function add_copyarray($arr, $def)
    {
        $val = [$arr, $def];
        if (!in_array($val, $this->thearrays, true)) {
            $this->thearrays[] = $val;
        }
    }

    public function set_copyarrays($thearrays)
    {
        $this->thearrays = $thearrays;
    }

    public function get_copyarrays()
    {
        return $this->thearrays;
    }

    public function set_exprs($exprs)
    {
        $this->theexprs = $exprs;
    }

    public function set_expr($myexpr)
    {
        $this->theexpr = $myexpr;
    }

    public function get_expr()
    {
        return $this->theexpr;
    }

    public function set_sanitized($is_sanitized)
    {
        $this->is_sanitized = $is_sanitized;
    }

    public function is_sanitized()
    {
        return $this->is_sanitized;
    }

    public function set_type_sanitized($type_sanitized)
    {
        $this->type_sanitized = $type_sanitized;
    }

    public function get_type_sanitized()
    {
        return $this->type_sanitized;
    }

    public function add_type_sanitized($type_sanitized)
    {
        if (!in_array($type_sanitized, $this->type_sanitized, true)) {
            $this->type_sanitized[] = $type_sanitized;
        }
    }

    public function is_type_sanitized($type_sanitized)
    {
        if (in_array($type_sanitized, $this->type_sanitized, true)) {
            return true;
        }

        return false;
    }
}
