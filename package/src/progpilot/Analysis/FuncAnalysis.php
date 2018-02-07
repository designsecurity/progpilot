<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyDefinition;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;

class FuncAnalysis
{

    public static function funccall_after($context, $data, $myfunc_call, $myfunc, $arr_funccall, $instruction, $op_apr)
    {
        $exprreturn = $instruction->get_property(MyInstruction::EXPR);

        if(!is_null($myfunc))
        {
            $defsreturn = $myfunc->get_return_defs();
            foreach ($defsreturn as $defreturn)
            {
                if (($arr_funccall != false && $defreturn->is_type(MyDefinition::TYPE_ARRAY) && $defreturn->get_array_value() === $arr_funccall) || ($arr_funccall == false && !$defreturn->is_type(MyDefinition::TYPE_ARRAY)))
                {
                    $copydefreturn = $defreturn;

                    // copydefreturn = return $defreturn;
                    $copydefreturn->set_expr($exprreturn);
                    // exprreturn = $def = exprreturn(funccall());
                    $exprreturn->add_def($copydefreturn);


                    $expr = $copydefreturn->get_expr();
                    if ($expr->is_assign())
                    {
                        $defassign = $expr->get_assign_def();
                        //TaintAnalysis::set_tainted($copydefreturn, $defassign, $expr);

                        if (ResolveDefs::get_visibility_from_instances($context, $data, $defassign))
                        {
                            ValueAnalysis::copy_values($copydefreturn, $defassign);
                            TaintAnalysis::set_tainted($copydefreturn->is_tainted(), $defassign, $expr);
                        }
                        
                        ArrayAnalysis::copy_array_from_def($defreturn, $arr_funccall, $defassign, $defassign->get_array_value());
                    }
                }
            }
            
            if ($op_apr->get_opcode() == Opcodes::DEFINITION)
            {
                $copytab = $op_apr->get_property(MyInstruction::DEF);

                $originaltabs = $myfunc->get_return_defs();

                foreach ($originaltabs as $originaltab)
                {
                    ArrayAnalysis::copy_array_from_def($originaltab, $arr_funccall, $copytab, $copytab->get_array_value());   
                }
            }
        }
    }

    public static function funccall_before($context, $data, $myfunc, $myfunc_call, $instruction)
    {
        $nbparams = 0;
        $params = $myfunc->get_params();

        foreach ($params as $param)
        {
            if ($instruction->is_property_exist("argdef$nbparams"))
            {
                $defarg = $instruction->get_property("argdef$nbparams");
                $exprarg = $instruction->get_property("argexpr$nbparams");
                   
                $newparam = clone $param;
                $myfunc_call->add_param($newparam);
                
                $newparam->set_last_known_values($defarg->get_last_known_values());
                ArrayAnalysis::copy_array_from_def($defarg, $defarg->get_array_value(), $newparam, false);

                $param->set_copyarrays($newparam->get_copyarrays());
                $param->set_last_known_values($newparam->get_last_known_values());
                $param->set_type($newparam->get_type());

                if ($defarg->is_tainted())
                {
                    // useful just for inside the function
                    TaintAnalysis::set_tainted($defarg->is_tainted(), $param, $exprarg);

                    $expr = $param->get_expr();

                    if (!is_null($expr) && $expr->is_assign())
                    {
                        $defassign = $expr->get_assign_def();

                        if (ResolveDefs::get_visibility_from_instances($context, $data, $defassign))
                        {
                            ValueAnalysis::copy_values($defarg, $defassign);
                            TaintAnalysis::set_tainted($defarg->is_tainted(), $defassign, $expr);
                        }
                    }
                }

                $nbparams ++;
                unset($defarg);
            }
        }

        unset($params);
    }
}
