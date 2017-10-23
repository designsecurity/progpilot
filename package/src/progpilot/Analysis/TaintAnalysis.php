<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyOp;
use progpilot\Objects\MyCode;
use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyInstance;
use progpilot\Objects\MyAssertion;
use progpilot\Objects\MyExpr;

use progpilot\Dataflow\Definitions;
use progpilot\Code\Opcodes;
use progpilot\Inputs\MySource;


class TaintAnalysis
{

    public static function funccall_specify_analysis($myfunc, $stack_class, $context, $data, $myclass, $myfunc_call, $arr_funccall, $instruction, $index)
    {
        TaintAnalysis::funccall_validator($stack_class, $context, $data, $myclass, $myfunc_call, $arr_funccall, $instruction, $index);
        TaintAnalysis::funccall_sanitizer($myfunc, $stack_class, $context, $data, $myclass, $myfunc_call, $arr_funccall, $instruction, $index);
        TaintAnalysis::funccall_source($stack_class, $context, $data, $myclass, $myfunc_call, $arr_funccall, $instruction);

        SecurityAnalysis::funccall($stack_class, $context, $myfunc_call, $instruction, $myclass);
    }

    public static function funccall_validator($stack_class, $context, $data, $myclass, $myfunc_call, $arr_funccall, $instruction, $index)
    {
        $nbparams = 0;
        $defs_valid = [];
        $condition_respected = true;

        $myvalidator = $context->inputs->get_validator_byname($stack_class, $myfunc_call, $myclass);
        if (!is_null($myvalidator))
        {
            while (true)
            {
                if (!$instruction->is_property_exist("argdef$nbparams"))
                    break;

                $defarg = $instruction->get_property("argdef$nbparams");
                $exprarg = $instruction->get_property("argexpr$nbparams");

                $condition = $myvalidator->get_parameter_condition($nbparams + 1);
                if ($condition === "valid" && !$exprarg->get_is_concat())
                {
                    $thedefsargs = $exprarg->get_defs();

                    foreach ($thedefsargs as $thedefsarg)
                    {
                        $defs_valid[] = $thedefsarg;
                    }
                }

                else if ($condition === "array_not_tainted")
                {
                    if ($defarg->get_is_array() && $defarg->is_tainted())
                    {
                        $condition_respected = false;
                    }

                    else if ($defarg->get_is_copy_array())
                    {
                        $copyarrays = $defarg->get_copyarrays();
                        foreach ($copyarrays as $copyarray)
                        {
                            $arrvalue = $copyarray[0];
                            $defarr = $copyarray[1];

                            if ($defarr->is_tainted())
                            {
                                $condition_respected = false;
                            }
                        }
                    }
                }

                else if ($condition === "not_tainted")
                {
                    if ($defarg->is_tainted())
                        $condition_respected = false;
                }

                else if ($condition === "equals")
                {
                    $condition_respected_equals = false;
                    $values = $myvalidator->get_parameter_values($nbparams + 1);

                    if (!is_null($values))
                    {
                        $thedefsargs = $exprarg->get_defs();
                        if (count($thedefsargs) > 0)
                        {
                            foreach ($values as $value)
                            {
                                if ($value->value === $thedefsargs[0]->get_last_known_values()[0])
                                    $condition_respected_equals = true;
                            }
                        }
                    }

                    if (!$condition_respected_equals)
                        $condition_respected = false;
                }

                $nbparams ++;
            }
        }

        if (count($defs_valid) > 0)
        {
            if ($condition_respected)
            {
                $codes = $context->get_mycode()->get_codes();
                $instruction_if = $codes[$index + 2];
                if ($instruction_if->get_opcode() == Opcodes::COND_START_IF)
                {
                    $myblock_if = $instruction_if->get_property("myblock_if");
                    $myblock_else = $instruction_if->get_property("myblock_else");

                    foreach ($defs_valid as $def_valid)
                    {
                        $type = "valid";
                        $myassertion = new MyAssertion($def_valid, $type);

                        if ($instruction_if->is_property_exist("not_boolean"))
                            $myblock_else->add_assertion($myassertion);

                        else
                            $myblock_if->add_assertion($myassertion);

                    }
                }
            }
        }
    }

    public static function funccall_sanitizer($myfunc, $stack_class, $context, $data, $myclass, $myfunc_call, $arr_funccall, $instruction, $index)
    {
        $condition_sanitize = false;
        $condition_taint = false;
        $params_tainted_condition_taint = false;

        $params_tainted = false;
        $params_sanitized = false;
        $params_type_sanitized = [];

        $nbparams = 0;
        $condition_respected_final = true;

        $mytemp_return = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), "return_".$myfunc_call->get_name());
        $myexpr_return1 = new MyExpr($myfunc_call->getLine(), $myfunc_call->getColumn());
        $myexpr_return1->set_assign(true);
        $myexpr_return1->set_assign_def($mytemp_return);
        $myexpr_return1->add_def($mytemp_return);

        $myexpr_return2 = new MyExpr($myfunc_call->getLine(), $myfunc_call->getColumn());
        $myexpr_return2->set_assign(true);
        $myexpr_return2->set_assign_def($mytemp_return);

        $mysanitizer = $context->inputs->get_sanitizer_byname($stack_class, $myfunc_call, $myclass);

        if (!is_null($mysanitizer))
            $prevent_final = $mysanitizer->get_prevent();

        while (true)
        {
            if (!$instruction->is_property_exist("argdef$nbparams"))
                break;

            $defarg = $instruction->get_property("argdef$nbparams");
            $exprarg = $instruction->get_property("argexpr$nbparams");

            if (is_null($myfunc) || !is_null($mysanitizer))
            {
                if ($defarg->is_tainted())
                {
                    $params_tainted = true;
                    $myexpr_return2->add_def($defarg);
                }

                if ($defarg->is_sanitized())
                {
                    $params_sanitized = true;
                    $tmps = $defarg->get_type_sanitized();

                    foreach ($tmps as $tmp)
                    {
                        if (!in_array($tmp, $params_type_sanitized, true))
                            $params_type_sanitized[] = $tmp;
                    }
                }
            }

            if (!is_null($mysanitizer))
            {
                $condition = $mysanitizer->get_parameter_condition($nbparams + 1);

                if ($condition === "equals")
                {
                    $condition_respected = false;
                    $values = $mysanitizer->get_parameter_values($nbparams + 1);

                    if (!is_null($values))
                    {
                        $thedefsargs = $exprarg->get_defs();
                        if (count($thedefsargs) > 0)
                        {
                            foreach ($values as $value)
                            {
                                if ($value->value === $thedefsargs[0]->get_last_known_values()[0])
                                {
                                    $condition_respected = true;

                                    if (isset($value->prevent))
                                        $prevent_final = array_merge($prevent_final, $value->prevent);
                                }
                            }
                        }
                    }

                    if (!$condition_respected)
                        $condition_respected_final = false;
                }
                else if ($condition === "taint")
                {
                    $condition_taint = true;
                    if ($defarg->is_tainted())
                    {
                        $params_tainted_condition_taint = true;
                        $myexpr_return2->add_def($defarg);
                    }
                }
                else if ($condition === "sanitize")
                {
                    $condition_sanitize = true;
                    $exprs_tainted_condition_sanitize[] = $exprarg;
                }
            }

            $nbparams ++;
        }

        $return_sanitizer = false;
        $codes = $context->get_mycode()->get_codes();
        if ($codes[$index + 2]->get_opcode() == Opcodes::END_ASSIGN)
        {
            $instruction_def = $codes[$index + 3];
            $mydef_return = $instruction_def->get_property("def");
            $return_sanitizer = true;
        }

        // the return of func will be tainted if one of arg is tainted
        if ($return_sanitizer)
        {
            if ($params_tainted)
            {
                $mytemp_return->set_tainted(true);
                $mytemp_return->set_taintedbyexpr($myexpr_return2);
            }
        }

        if ($return_sanitizer || $condition_sanitize)
        {
            if (!is_null($mysanitizer) && $condition_respected_final)
            {
                if ($condition_sanitize)
                {
                    foreach ($exprs_tainted_condition_sanitize as $exprsanitize)
                    {
                        foreach ($exprsanitize->get_defs() as $one_def)
                        {
                            $one_def->set_sanitized(true);
                            if (is_array($prevent_final))
                            {
                                foreach ($prevent_final as $prevent_final_value)
                                    $one_def->add_type_sanitized($prevent_final_value);
                            }
                        }
                    }
                }
                else
                {
                    $mytemp_return->set_sanitized(true);
                    $mydef_return->set_sanitized(true);
                    if (is_array($prevent_final))
                    {
                        foreach ($prevent_final as $prevent_final_value)
                        {
                            $mytemp_return->add_type_sanitized($prevent_final_value);
                            $mydef_return->add_type_sanitized($prevent_final_value);
                        }
                    }
                }
            }
        }

        if ($return_sanitizer && $params_sanitized)
        {
            $mytemp_return->set_sanitized(true);
            $mydef_return->set_sanitized(true);
            foreach ($params_type_sanitized as $tmp)
            {
                $mytemp_return->add_type_sanitized($tmp);
                $mydef_return->add_type_sanitized($tmp);
            }
        }

        if ($return_sanitizer)
        {
            TaintAnalysis::set_tainted($context, $data, $mytemp_return, $mydef_return, $myexpr_return1, false);
        }
    }

    public static function funccall_source($stack_class, $context, $data, $myclass, $myfunc_call, $arr_funccall, $instruction)
    {
        $exprreturn = $instruction->get_property("expr");

        $class_name = false;
        if ($myfunc_call->get_is_method() && !is_null($myclass))
            $class_name = $myclass->get_name();

        $mysource = $context->inputs->get_source_byname($stack_class, $myfunc_call, true, $class_name, false);
        if (!is_null($mysource))
        {
            if ($mysource->has_parameters())
            {
                $nbparams = 0;
                while (true)
                {
                    if (!$instruction->is_property_exist("argdef$nbparams"))
                        break;

                    $defarg = $instruction->get_property("argdef$nbparams");

                    if ($mysource->is_parameter($nbparams + 1))
                    {
                        $deffrom = $defarg->get_value_from_def();
                        $array_index = $mysource->get_condition_parameter($nbparams + 1, MySource::CONDITION_ARRAY);
                        if (!is_null($array_index))
                        {
                            $true_array_index = array($array_index => false);
                            $deffrom->set_is_array(true);
                            $deffrom->set_array_value($true_array_index);
                        }

                        $deffrom->set_tainted(true);
                    }

                    $nbparams ++;
                }
            }

            if ($exprreturn->is_assign())
            {
                $defassign = $exprreturn->get_assign_def();

                $mydef = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name()."_return");
                $mydef->set_source_myfile($defassign->get_source_myfile());
                $mydef->set_tainted(true);
                // no need to taintedbyexpr because it's source like _GET

                if ($mysource->get_is_return_array() && $arr_funccall == false)
                {
                    $value_array = array($mysource->get_return_array_value() => false);

                    $defassign->add_copyarray($value_array, $mydef);
                    $defassign->set_is_copy_array(true);

                    $exprreturn->add_def($mydef);
                    $mydef->add_expr($exprreturn);
                }
                else if ($mysource->get_is_return_array())
                {
                    $value_array = array($mysource->get_return_array_value() => false);

                    if ($arr_funccall === $value_array)
                    {
                        $exprreturn->add_def($mydef);
                        $mydef->add_expr($exprreturn);

                        if ($exprreturn->is_assign())
                            TaintAnalysis::set_tainted($context, $data, $mydef, $defassign, $exprreturn, false);
                    }
                }
                else if (!$mysource->get_is_return_array())
                {
                    $exprreturn->add_def($mydef);

                    if ($exprreturn->is_assign())
                        TaintAnalysis::set_tainted($context, $data, $mydef, $defassign, $exprreturn, false);
                }
            }
        }
    }

    public static function funccall_after($context, $data, $myfunc, $arr_funccall, $instruction)
    {
        $defsreturn = $myfunc->get_return_defs();
        $exprreturn = $instruction->get_property("expr");

        foreach ($defsreturn as $defreturn)
        {
            if (($arr_funccall != false && $defreturn->get_is_array() && $defreturn->get_array_value() === $arr_funccall) || $arr_funccall == false)
            {
                $copydefreturn = $defreturn;

                // copydefreturn = return $defreturn;
                $copydefreturn->add_expr($exprreturn);
                // exprreturn = $def = exprreturn(funccall());
                $exprreturn->add_def($copydefreturn);


                $exprs = $copydefreturn->get_exprs();

                foreach ($exprs as $expr)
                {
                    // blabla =
                    if ($expr->is_assign())
                    {
                        $defassign = $expr->get_assign_def();

                        /*
                             if(!$copydefreturn->is_tainted() && $defassign->)
                             {
                             $defassign->set_tainted(false);
                             $defassign->set_taintedbyexpr(null);
                             $defassign->set_sanitized(false);
                             $defassign->set_type_sanitized(null);
                             $defassign->set_is_embeddedbychar("'", false);
                             $defassign->set_is_embeddedbychar(">", false);
                             $defassign->set_is_embeddedbychar("<", false);
                             }
                         */
                        TaintAnalysis::set_tainted($context, $data, $copydefreturn, $defassign, $expr, false);
                    }
                }
            }
        }
    }

    public static function funccall_before($context, $data, $myfunc, $instruction)
    {
        $nbparams = 0;
        $params = $myfunc->get_params();

        foreach ($params as $param)
        {
            if ($instruction->is_property_exist("argdef$nbparams"))
            {
                $defarg = $instruction->get_property("argdef$nbparams");

                if ($defarg->is_tainted())
                {
                    // useful just for inside the function
                    $param->set_tainted(true);
                    $exprs = $param->get_exprs();

                    foreach ($exprs as $expr)
                    {
                        if ($expr->is_assign())
                        {
                            $defassign = $expr->get_assign_def();
                            TaintAnalysis::set_tainted($context, $data, $defarg, $defassign, $expr, false);
                        }
                    }
                }

                $nbparams ++;
                unset($defarg);
            }
        }

        unset($params);
    }

    public static function set_tainted($context, $data, $def, $defassign, $expr, $safe)
    {
        // assertions
        if (!$safe)
        {
            $visibility_final = true;

            if ($defassign->get_is_property())
            {
                $copy_defassign = clone $defassign;
                $copy_defassign->set_assign_id(-1);
                $prop = $copy_defassign->property->pop_property();
                $visibility_final = false;

                $instances = ResolveDefs::select_instances($context, $data, $copy_defassign);

                foreach ($instances as $instance)
                {
                    if ($instance->get_is_instance())
                    {
                        //$tmp_myclasses = $instance->get_all_myclass();

                        $id_object = $instance->get_object_id();
                        $tmp_myclasses = $context->get_objects()->get_all_myclasses($id_object);

                        foreach ($tmp_myclasses as $tmp_myclass)
                        {
                            $property = $tmp_myclass->get_property($prop);

                            if (!is_null($property) && (ResolveDefs::get_visibility($copy_defassign, $property)))
                            {
                                $visibility_final = true;
                                /*
                                if(!$def->is_tainted())
                                {
                                  echo "n'est pas tainté\n";
                                  $property->set_tainted(false);
                                  $property->print_stdout();
                                }
                                  */
                                break 2;
                            }
                        }
                    }
                }

                if (count($instances) == 0)
                    $visibility_final = true;
            }

            if ($def->is_tainted() && $visibility_final)
            {
                $defassign->set_tainted(true);
                $defassign->set_taintedbyexpr($expr);
            }

            if ($def->is_sanitized() && $visibility_final)
            {
                $defassign->set_type_sanitized($def->get_type_sanitized());
                $defassign->set_sanitized(true);
            }

            if ($visibility_final)
            {
                $defassign->set_is_embeddedbychars($def->get_is_embeddedbychars(), true);
            }
        }
    }
}
