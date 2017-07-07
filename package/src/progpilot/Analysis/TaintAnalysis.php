<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyCode;
use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyInstance;

use progpilot\Dataflow\Definitions;

use progpilot\Code\Opcodes;

class TaintAnalysis {

	public static function funccall_sanitizer($context, $data, $myfunc_call, $arr_funccall, $instruction, $index, $myinstance)
	{     
		$params_tainted = false;
		$exprs_tainted = [];
		$defs_tainted = [];
		$params_sanitized = false;
		$params_type_sanitized = [];
		$nbparams = 0;
		
		$codes = $context->get_mycode()->get_codes();

		while(true)
		{
			if(!$instruction->is_property_exist("argdef$nbparams"))
				break;

			$defarg = $instruction->get_property("argdef$nbparams"); 
			$exprarg = $instruction->get_property("argexpr$nbparams"); 

			if($defarg->is_tainted())
			{
				$params_tainted = true;
				$exprs_tainted[] = $exprarg;
				$defs_tainted[] = $defarg;
            }

			if($defarg->is_sanitized())
			{
				$params_sanitized = true;

				$tmps = $defarg->get_type_sanitized();

				foreach($tmps as $tmp)
				{
					if(!in_array($tmp, $params_type_sanitized))
						$params_type_sanitized[] = $tmp;
				}
			}

			$nbparams ++;
		}

		if($codes[$index + 2]->get_opcode() == Opcodes::END_ASSIGN)
		{
            $instruction_def = $codes[$index + 3];
			$mydef_return = $instruction_def->get_property("def");
			
                    
			if($params_tainted)
			{
                for($j = 0; $j < count($defs_tainted); $j ++)  
                    TaintAnalysis::set_tainted($data, $defs_tainted[$j], $mydef_return, $exprs_tainted[$j], false, $myinstance); 
            }
            
			
			$mysanitizer = $context->inputs->get_sanitizer_byname($myfunc_call->get_name());
			if(!is_null($mysanitizer))
			{
				$mydef_return->set_sanitized(true);
				$mydef_return->add_type_sanitized($mysanitizer->get_prevent());
			}
			if($params_sanitized)
			{
				$mydef_return->set_sanitized(true);
				foreach($params_type_sanitized as $tmp)
					$mydef_return->add_type_sanitized($tmp);
			}
			/*         
			if(count($resolve_defs_assign) > 0)
            {
                foreach($resolve_defs_assign as $resolve_def)
                {
                    if(!is_null($mysanitizer))
                    {
                        $resolve_def->set_sanitized(true);
                        $resolve_def->add_type_sanitized($mysanitizer->get_prevent());
                    }

                    if($params_sanitized)
                    {
                        $resolve_def->set_sanitized(true);
                        foreach($params_type_sanitized as $tmp)
                            $resolve_def->add_type_sanitized($tmp);
                    }
                }
            }*/
		}
	}
	
    public static function funccall_source($context, $data, $myfunc, $arr_funccall, $instruction)
	{ 
        $exprreturn = $instruction->get_property("expr");
            
        if(!is_null($context->inputs->get_source_byname($myfunc->get_name(), true)))
        {
            $mydef = new MyDefinition($myfunc->getLine(), $myfunc->getColumn(), "return", false, false);
            $mydef->set_tainted(true);
            
            if($exprreturn->is_assign())
            {
                $defassign = $exprreturn->get_assign_def();
                TaintAnalysis::set_tainted($data, $mydef, $defassign, $exprreturn, false, null); 
            } 
        }
    }
    
	public static function funccall_after($data, $myfunc, $arr_funccall, $instruction)
	{ 
        $defsreturn = $myfunc->get_return_defs(); 
        $exprreturn = $instruction->get_property("expr");

        foreach($defsreturn as $defreturn)
        {        
            if(($arr_funccall != false && $defreturn->is_arr() && $defreturn->get_arr_value() == $arr_funccall) || $arr_funccall == false)
            {
                $copydefreturn = $defreturn;

                $copydefreturn->add_expr($exprreturn);
                $exprreturn->add_def($copydefreturn);
                $exprs = $copydefreturn->get_exprs();

                foreach($exprs as $expr)
                {
                    if($expr->is_assign())
                    {
                        $defassign = $expr->get_assign_def();
                        TaintAnalysis::set_tainted($data, $copydefreturn, $defassign, $expr, false, null); 
                    }
                }
            }
        }
	}

	public static function funccall_before($data, $myfunc, $instruction)
	{                          
		$nbparams = 0;
		$params = $myfunc->get_params();

		foreach($params as &$param)
		{
			if($instruction->is_property_exist("argdef$nbparams"))
			{
				$defarg = $instruction->get_property("argdef$nbparams"); 

				if($defarg->is_tainted())
				{
					$param->set_tainted(true);

					$exprs = $param->get_exprs();

					foreach($exprs as $expr)
					{
						if($expr->is_assign())
						{
							$defassign = $expr->get_assign_def();
							TaintAnalysis::set_tainted($data, $param, $defassign, $expr, false, null); 
						}
					}
				}

				$nbparams ++;
				unset($defarg);
			}
		}

		unset($params);
	}
	
	public static function set_tainted($data, $def, $defassign, $expr, $safe, $myinstance)
	{	          
        // assertions
		if(!$safe)
		{
			// we are going to taint defassign's definitions		
			// we are inside a class
			if($defassign->get_name() == "this" && !is_null($myinstance))
			{
				$myclass = $myinstance->get_myclass();
				$property = $myclass->get_property($defassign->property->get_name());

				if(!is_null($property))
				{
					// with this visibility of property is ok, check is not needed
                    if($property->is_tainted())
                    {
                        $property->set_tainted(true);
                        $property->set_taintedbyexpr($expr);
                    }
                    else
                    {
                        $property->set_tainted(false);
                        $property->set_taintedbyexpr(null);
                    }
                                                                
                    if($property->is_sanitized())
                    {
                        $property->set_type_sanitized($property->get_type_sanitized());
                        $property->set_sanitized(true);
                    }
				}
			}

			else if($defassign->is_property())
			{
				// we can have multiple instances with the same property assigned
				// we are looking for and instance, not a property	
				$properties = ResolveDefs::select_properties($data, $defassign, $myinstance);

				foreach($properties as $property_tab)
                {
                    $property = $property_tab[0];
                    $visibility_property = $property_tab[1];
                    
                    if($property->is_property() && $visibility_property)
                    {
                        if($def->is_tainted())
                        {
                            $property->set_tainted(true);
                            $property->set_taintedbyexpr($expr);
                        }
                        else
                        {
                            $property->set_tainted(false);
                            $property->set_taintedbyexpr(null);
                        }
                                                                
                        if($property->is_sanitized())
                        {
                            $property->set_type_sanitized($property->get_type_sanitized());
                            $property->set_sanitized(true);
                        }
                    }
                }
			}
			else
			{
                if($def->is_tainted())
                {
                    $defassign->set_tainted(true);
                    $defassign->set_taintedbyexpr($expr);
                }
                                                                
                if($def->is_sanitized())
                {
                    $defassign->set_type_sanitized($def->get_type_sanitized());
                    $defassign->set_sanitized(true);
                }
			}
		}
	}
}
