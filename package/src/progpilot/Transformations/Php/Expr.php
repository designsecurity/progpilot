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

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyOp;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;

class Expr
{

        public static function set_chars($myexpr, $mytemp, $string, $array_chars)
        {
            $nb_chars = [];
            foreach ($array_chars as $char)
                $nb_chars[$char] = 0;

            for ($i = 0; $i < strlen($string); $i++)
            {
                foreach ($array_chars as $char)
                {
                    if ($string[$i] === $char)
                        $nb_chars[$char] ++;
                }
            }

            foreach ($array_chars as $char)
            {
                $myexpr->set_nb_chars($char, $myexpr->get_nb_chars($char) + $nb_chars[$char]);
                $mytemp->set_is_embeddedbychar($char, $myexpr->get_nb_chars($char));
            }
        }

        public static function set_chars_defsofmyexpr(&$defs_ofexpr, $myexpr,
                $array_chars)
        {
            $nb_chars = [];

            foreach ($defs_ofexpr as $one_def)
            {
                if ($one_def->get_is_embeddedbychar("<") >
                        $one_def->get_is_embeddedbychar(">"))
                    $one_def->set_is_embeddedbychar("<", true);
                else
                    $one_def->set_is_embeddedbychar("<", false);

                if ((($one_def->get_is_embeddedbychar("'") % 2) === 1)
                        && $myexpr->get_nb_chars("'") > $one_def->get_is_embeddedbychar("'"))
                    $one_def->set_is_embeddedbychar("'", true);
                else
                    $one_def->set_is_embeddedbychar("'", false);
            }
        }

        public static function instruction($op, $context, $myexpr, $cast = MyDefinition::CAST_NOT_SAFE)
        {
            $defs_ofexpr = [];
            $ret = Expr::instruction_internal($defs_ofexpr, $op, $context, $myexpr, $cast);
            Expr::set_chars_defsofmyexpr($defs_ofexpr, $myexpr, ["'", "<", ">"]);

            return $ret;
        }

        public static function instruction_internal(&$defs_ofexpr, $op, $context, $myexpr, $cast = MyDefinition::CAST_NOT_SAFE)
        {
            $mytemp_def = null;
            $arr_funccall = false;
            $name = Common::get_name_definition($op);
            $type = Common::get_type_definition($op);
            $type_array = Common::get_type_is_array($op);

            // end of expression
            if (!is_null($type) && $type !== MyOp::TYPE_FUNCCALL_ARRAY)
            {
                if (is_null($name))
                    $name = mt_rand();

                $arr = BuildArrays::build_array_from_ops($op, false);

                $column = $context->get_current_column();
                if ($op instanceof Op\Expr\Assign)
                    $column = $op->getAttribute("startFilePos", -1);

                $mytemp = new MyDefinition($context->get_current_line(), $column, $name);
                $mytemp->add_last_known_value($name);
                $mytemp->set_cast($cast);
                //$mytemp->set_type($type);

                Expr::set_chars($myexpr, $mytemp, $name, ["'", "<", ">"]);

                if ($arr != false)
                {
                    $mytemp->add_type(MyDefinition::TYPE_ARRAY);
                    $mytemp->set_array_value($arr);
                }

                $mytemp->set_expr($myexpr);
                $defs_ofexpr[] = $mytemp;

                if ($type === MyOp::TYPE_CONST)
                    $mytemp->add_type(MyDefinition::TYPE_CONSTANTE);

                if ($type === MyOp::TYPE_PROPERTY)
                {
                    $property_name = "";
                    if (isset($op->ops[0]))
                        $property_name = Common::get_name_property($op->ops[0]);

                    $mytemp->add_type(MyDefinition::TYPE_PROPERTY);
                    $mytemp->property->set_properties($property_name);
                }

                $inst_temporary_simple = new MyInstruction(Opcodes::TEMPORARY);
                $inst_temporary_simple->add_property(MyInstruction::TEMPORARY, $mytemp);
                $context->get_current_mycode()->add_code($inst_temporary_simple);

                return $mytemp;
            }

            // func()[0][1]
            else if ($type === MyOp::TYPE_FUNCCALL_ARRAY)
            {
                $arr_funccall = BuildArrays::build_array_from_ops($op, false);
                $start_ops = BuildArrays::function_start_ops($op);
                $op = $start_ops;
            }

            if (isset($op->ops))
            {
                foreach ($op->ops as $ops)
                {
                    if ($ops instanceof Op\Expr\Cast\Int_
                            || $ops instanceof Op\Expr\Cast\Array_
                            || $ops instanceof Op\Expr\Cast\Bool_
                            || $ops instanceof Op\Expr\Cast\Double_
                            || $ops instanceof Op\Expr\Cast\Object_
                            || $ops instanceof Op\Expr\Cast\Array_)

                        Expr::instruction_internal($defs_ofexpr, $ops->expr, $context, $myexpr, MyDefinition::CAST_SAFE);

                    else if ($ops instanceof Op\Expr\Cast\String_)
                        Expr::instruction_internal($defs_ofexpr, $ops->expr, $context, $myexpr, MyDefinition::CAST_NOT_SAFE);

                    else if ($ops instanceof Op\Expr\BinaryOp\Concat)
                    {
                        $myexpr->set_is_concat(true);

                        $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::CONCAT_LEFT));
                        Expr::instruction_internal($defs_ofexpr, $ops->left, $context, $myexpr);

                        $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::CONCAT_RIGHT));
                        Expr::instruction_internal($defs_ofexpr, $ops->right, $context, $myexpr);
                    }
                    else if ($ops instanceof Op\Expr\ConcatList)
                    {
                        $myexpr->set_is_concat(true);

                        $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::CONCAT_LIST));

                        foreach ($ops->list as $opsbis)
                        {
                            Expr::instruction_internal($defs_ofexpr, $opsbis, $context, $myexpr);
                        }
                    }
                    else if ($ops instanceof Op\Expr\Include_)
                    {
                        $old_op = $context->get_current_op();
                        $context->set_current_op($ops);
                        FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                        $context->set_current_op($old_op);
                    }
                    else if ($ops instanceof Op\Expr\Print_)
                    {
                        $old_op = $context->get_current_op();
                        $context->set_current_op($ops);
                        FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                        $context->set_current_op($old_op);
                    }
                    else if ($ops instanceof Op\Terminal\Echo_)
                    {
                        $old_op = $context->get_current_op();
                        $context->set_current_op($ops);
                        FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                        $context->set_current_op($old_op);
                    }
                    else if ($ops instanceof Op\Expr\Eval_)
                    {
                        $old_op = $context->get_current_op();
                        $context->set_current_op($ops);
                        FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                        $context->set_current_op($old_op);
                    }
                    else if ($ops instanceof Op\Expr\FuncCall)
                    {
                        $old_op = $context->get_current_op();
                        $context->set_current_op($ops);
                        $mytemp_def = FuncCall::instruction($context, $myexpr, $arr_funccall, false);
                        $context->set_current_op($old_op);
                    }
                    else if ($ops instanceof Op\Expr\MethodCall)
                    {
                        $old_op = $context->get_current_op();
                        $context->set_current_op($ops);
                        $mytemp_def = FuncCall::instruction($context, $myexpr, $arr_funccall, true);
                        $context->set_current_op($old_op);
                    }
                    else if ($ops instanceof Op\Expr\StaticCall)
                    {
                        $old_op = $context->get_current_op();
                        $context->set_current_op($ops);
                        $mytemp_def = FuncCall::instruction($context, $myexpr, $arr_funccall, false, true);
                        $context->set_current_op($old_op);
                    }

                    else if ($ops instanceof Op\Expr\New_)
                    {
                        // funccall for the constructor
                        $old_op = $context->get_current_op();
                        $context->set_current_op($ops);
                        $mytemp_def = FuncCall::instruction($context, $myexpr, $arr_funccall);
                        $context->set_current_op($old_op);
                    }
                    else
                    {
                        $mytemp_def = Expr::instruction_internal($defs_ofexpr, $ops, $context, $myexpr);
                    }
                }
            }

            return $mytemp_def;
        }
}

?>
