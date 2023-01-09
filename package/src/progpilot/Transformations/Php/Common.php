<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php;

use PHPCfg\Block;
use PHPCfg\Op;
use PHPCfg\Operand;

use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyOp;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;

class Common
{
    public static function validLastKnownValue($value)
    {
        if($value === null) {
            return true;
        }
        
        if (strpos($value, '\n') === false && strpos($value, '\r') === false && strlen($value) < 200) {
            return true;
        }

        return false;
    }

    public static function isChainedKnownType($op)
    {
        if ($op instanceof Op\Expr\PropertyFetch
            || $op instanceof Op\Expr\StaticPropertyFetch
                || $op instanceof Op\Expr\ArrayDimFetch) {
            return true;
        }

        return false;
    }

    public static function getTypeDef($op)
    {
        // the order is important (current it breaks array14.php)
        // first we look for the left side
        // this->foo

        if (isset($op->var->ops[0])) {
            if (isset($op->var->ops[0]->var->ops[0])
                && Common::isChainedKnownType($op->var->ops[0]->var->ops[0])
                 && $op->var->ops[0]->var->ops[0] !== $op->var->ops[0]) {
                return Common::getTypeDef($op->var->ops[0]);
            } else {
                if ($op->var->ops[0] instanceof Op\Expr\PropertyFetch) {
                    return MyOp::TYPE_PROPERTY;
                }

                if ($op->var->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                    return MyOp::TYPE_STATIC_PROPERTY;
                }

                if ($op->var->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                    return MyOp::TYPE_ARRAY;
                }

                if ($op->var->ops[0] instanceof Op\Expr\Array_) {
                    return MyOp::TYPE_ARRAY_EXPR;
                }

                if (isset($op->var->original->name->value)) {
                    return MyOp::TYPE_VARIABLE;
                }
            }
        }
 
        // then for the right
        // foo = array()
        // foo = define("FOO")
        if (isset($op) && isset($op->name)) {
            if ($op instanceof Op\Expr\FuncCall
                && $op->name instanceof Operand\Literal
                    && $op->name->value === "define") {
                return MyOp::TYPE_CONST;
            }
        }
        
        if (isset($op->expr->ops[0])) {
            if ($op->expr->ops[0] instanceof Op\Expr\Array_) {
                return MyOp::TYPE_ARRAY_EXPR;
            }
        }

        return null;
    }

    public static function getNameDefinition($ops, $lookingForProperty = false)
    {
        //  $this->property = property
        if ($lookingForProperty
            && ($ops instanceof Op\Expr\PropertyFetch || $ops instanceof Op\Expr\StaticPropertyFetch)
                && isset($ops->name->value)) {
            return $ops->name->value;
        }

        //  $this->property = this
        if (isset($ops->var) && $ops->var instanceof Operand\BoundVariable && isset($ops->var->name->value)) {
            return $ops->var->name->value;
        }

        if (isset($ops->ops[0])) {
            if ($ops->ops[0] instanceof Op\Expr\ConstFetch) {
                return Common::getNameDefinition($ops->ops[0], $lookingForProperty);
            }

            if ($ops->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                return Common::getNameDefinition($ops->ops[0], $lookingForProperty);
            }

            if ($ops->ops[0] instanceof Op\Expr\PropertyFetch) {
                return Common::getNameDefinition($ops->ops[0], $lookingForProperty);
            }

            if ($ops->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                return Common::getNameDefinition($ops->ops[0], $lookingForProperty);
            }
        }

        if (isset($ops->var->ops)) {
            foreach ($ops->var->ops as $op) {
                if ($op instanceof Op\Expr\ConstFetch) {
                    return Common::getNameDefinition($op, $lookingForProperty);
                }

                if ($op instanceof Op\Expr\ArrayDimFetch) {
                    return Common::getNameDefinition($op, $lookingForProperty);
                }

                if ($op instanceof Op\Expr\PropertyFetch) {
                    return Common::getNameDefinition($op, $lookingForProperty);
                }

                if ($op instanceof Op\Expr\StaticPropertyFetch) {
                    return Common::getNameDefinition($op, $lookingForProperty);
                }
            }
        }
        
        if ($ops instanceof Op\Iterator\Value) {
            return Common::getNameDefinition($ops->var, $lookingForProperty);
        }

        // use variable
        if (isset($ops->original->name->value)) {
            return $ops->original->name->value;
        }

        // def variable
        if (isset($ops->var->original->name->value)) {
            return $ops->var->original->name->value;
        }

        // static property
        if (isset($ops->class->value)) {
            return $ops->class->value;
        }

        // class name
        if (isset($ops->name->value)) {
            return $ops->name->value;
        }
        
        // arrayexpr
        if (isset($ops->value)) {
            return $ops->value;
        }

        return "";
    }

    /*
         const FLAG_PUBLIC      = 0x01;
         const FLAG_PROTECTED   = 0x02;
         const FLAG_PRIVATE     = 0x04;
         const FLAG_STATIC      = 0x08;
         const FLAG_ABSTRACT    = 0x10;
         const FLAG_FINAL       = 0x20;
         const FLAG_RETURNS_REF = 0x40;
         const FLAG_CLOSURE     = 0x80;
     */

    public static function getTypeVisibility($visibility)
    {
        switch ($visibility) {
            case 1:
                return "public";
            case 2:
                return "protected";
            case 4:
                return "private";
            default:
                return "public";
        }
    }
}
