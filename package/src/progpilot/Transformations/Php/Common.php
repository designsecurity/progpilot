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

use progpilot\Objects\MyOp;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;

class Common
{

    public static function get_name_property($op)
    {
        $property_name_array = [];

        if (isset($op->ops[0]))
        {
            if ($op->ops[0] instanceof Op\Expr\ArrayDimFetch)
                $property_name_array = Common::get_name_property($op->ops[0]);

            if ($op instanceof Op\Expr\PropertyFetch)
                $property_name_array = Common::get_name_property($op->ops[0]);
        }

        if (isset($op->var->ops))
        {
            foreach ($op->var->ops as $opeach)
            {
                if ($opeach instanceof Op\Expr\ArrayDimFetch)
                    $property_name_array =  Common::get_name_property($opeach);

                if ($opeach instanceof Op\Expr\PropertyFetch)
                    $property_name_array = Common::get_name_property($opeach);
            }
        }

        if (isset($op->name->value))
            $property_name_array[] = $op->name->value;

        return $property_name_array;
    }

    public static function get_name_definition($ops, $looking_for_property = false)
    {
        //  $this->property = property
        if ($looking_for_property && $ops instanceof Op\Expr\PropertyFetch && isset($ops->name->value))
            return $ops->name->value;

        //  $this->property = this
        if (isset($ops->var) && $ops->var instanceof Operand\BoundVariable && isset($ops->var->name->value))
            return $ops->var->name->value;

        if (isset($ops->ops[0]))
        {
            if ($ops->ops[0] instanceof Op\Expr\ConstFetch)
                return Common::get_name_definition($ops->ops[0], $looking_for_property);

            if ($ops->ops[0] instanceof Op\Expr\ArrayDimFetch)
                return Common::get_name_definition($ops->ops[0], $looking_for_property);

            if ($ops->ops[0] instanceof Op\Expr\PropertyFetch)
                return Common::get_name_definition($ops->ops[0], $looking_for_property);
        }

        if (isset($ops->var->ops))
        {
            foreach ($ops->var->ops as $op)
            {
                if ($op instanceof Op\Expr\ConstFetch)
                    return Common::get_name_definition($op, $looking_for_property);

                if ($op instanceof Op\Expr\ArrayDimFetch)
                    return Common::get_name_definition($op, $looking_for_property);

                if ($op instanceof Op\Expr\PropertyFetch)
                    return Common::get_name_definition($op, $looking_for_property);
            }
        }

        // use variable
        if (isset($ops->original->name->value))
        {
            return $ops->original->name->value;
        }

        // def variable
        if (isset($ops->var->original->name->value))
        {
            return $ops->var->original->name->value;
        }

        // class name
        if (isset($ops->name->value))
        {
            return $ops->name->value;
        }

        // arrayexpr
        if (isset($ops->value))
        {
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

    public static function get_type_visibility($visibility)
    {
        switch ($visibility)
        {
        case 1: return "public";
        case 2: return "protected";
        case 4: return "private";
        default: return "public";
        }
    }

    public static function is_funccall_withoutreturn($op)
    {
        if (!(isset($op->result->usages[0])) || (
                    // funccall()[0]
                    !(isset($op->result->usages[0]) && $op->result->usages[0] instanceof Op\Expr\ArrayDimFetch) &&
                    // test = funccall() // funcccall(funccall())
                    !(isset($op->result->usages[0])
                      && (
                          $op->result->usages[0] instanceof Op\Terminal\Echo_
                          || $op->result->usages[0] instanceof Op\Expr\Print_
                          || $op->result->usages[0] instanceof Op\Expr\StaticCall
                          || $op->result->usages[0] instanceof Op\Expr\MethodCall
                          || $op->result->usages[0] instanceof Op\Expr\FuncCall
                          || $op->result->usages[0] instanceof Op\Expr\Assign
                          || $op->result->usages[0] instanceof Op\Expr\BinaryOp\Concat
                          || $op->result->usages[0] instanceof Op\Expr\Array_
                          || $op->result->usages[0] instanceof Op\Expr\Include_
                          || $op->result->usages[0] instanceof Op\Expr\Eval_))))
            return true;

        return false;
    }

    public static function get_type_is_array($ops)
    {
        if (isset($ops->ops[0]))
        {
            if ($ops->ops[0] instanceof Op\Expr\FuncCall)
            {
                return MyOp::TYPE_FUNCCALL_ARRAY;
            }

            if ($ops->ops[0] instanceof Op\Expr\ArrayDimFetch)
            {
                $ret = Common::get_type_definition($ops->ops[0]);

                if ($ret == MyOp::TYPE_FUNCCALL_ARRAY)
                    return MyOp::TYPE_FUNCCALL_ARRAY;

                return MyOp::TYPE_ARRAY;
            }

            if ($ops->ops[0] instanceof Op\Expr\Array_)
            {
                return MyOp::TYPE_ARRAY_EXPR;
            }
        }

        if (isset($ops->expr->ops[0]))
        {
            if ($ops->expr->ops[0] instanceof Op\Expr\Array_)
                return MyOp::TYPE_ARRAY_EXPR;
        }

        if (isset($ops->var->ops[0]))
        {
            if ($ops->var->ops[0] instanceof Op\Expr\ArrayDimFetch)
            {
                $ret = Common::get_type_definition($ops->var->ops[0]);

                if ($ret == MyOp::TYPE_FUNCCALL_ARRAY)
                    return MyOp::TYPE_FUNCCALL_ARRAY;

                return MyOp::TYPE_ARRAY;
            }

            if ($ops->var->ops[0] instanceof Op\Expr\FuncCall)
                return MyOp::TYPE_FUNCCALL_ARRAY;
        }

        if (isset($ops->var->original->name))
        {
            if ($ops->var->original->name instanceof Operand\Literal)
                return MyOp::TYPE_LITERAL;
        }

        if (isset($ops->expr->original->name))   // return
        {
            if ($ops->expr->original->name instanceof Operand\Literal)
                return MyOp::TYPE_LITERAL;
        }

        if (isset($ops->original->name))
        {
            if ($ops->original->name instanceof Operand\Literal)
                return MyOp::TYPE_LITERAL;
        }

        if ($ops instanceof Op\Expr\ArrayDimFetch)
            return MyOp::TYPE_ARRAY;

        if ($ops instanceof Operand\Literal)
            return MyOp::TYPE_LITERAL;

        return null;
    }


    public static function get_type_is_instance($ops)
    {
        if (isset($ops->expr->ops[0]))
        {
            if ($ops->expr->ops[0] instanceof Op\Expr\New_)
                return MyOp::TYPE_INSTANCE;
        }

        return null;
    }

    public static function get_type_definition($ops)
    {
        if (isset($ops->ops[0]))
        {
            if ($ops->ops[0] instanceof Op\Expr\ConstFetch)
            {
                return MyOp::TYPE_CONST;
            }

            if ($ops->ops[0] instanceof Op\Expr\FuncCall)
            {
                return MyOp::TYPE_FUNCCALL_ARRAY;
            }

            if ($ops->ops[0] instanceof Op\Expr\PropertyFetch)
            {
                return MyOp::TYPE_PROPERTY;
            }

            if ($ops->ops[0] instanceof Op\Expr\ArrayDimFetch)
            {
                return Common::get_type_definition($ops->ops[0]);
            }
        }

        if (isset($ops->var->ops[0]))
        {
            if ($ops->var->ops[0] instanceof Op\Expr\ArrayDimFetch)
            {
                return Common::get_type_definition($ops->var->ops[0]);
            }

            if ($ops->var->ops[0] instanceof Op\Expr\PropertyFetch)
            {
                return MyOp::TYPE_PROPERTY;
            }

            if ($ops->var->ops[0] instanceof Op\Expr\FuncCall)
                return MyOp::TYPE_FUNCCALL_ARRAY;
        }

        if (isset($ops->var->original->name))
        {
            if ($ops->var->original->name instanceof Operand\Literal)
                return MyOp::TYPE_LITERAL;
        }

        if (isset($ops->expr->original->name))   // return
        {
            if ($ops->expr->original->name instanceof Operand\Literal)
                return MyOp::TYPE_LITERAL;
        }

        if (isset($ops->original->name))
        {
            if ($ops->original->name instanceof Operand\Literal)
                return MyOp::TYPE_LITERAL;
        }

        if ($ops instanceof Operand\Literal)
            return MyOp::TYPE_LITERAL;

        if ($ops instanceof Op\Expr\PropertyFetch)
            return MyOp::TYPE_PROPERTY;

        return null;
    }
}

?>
