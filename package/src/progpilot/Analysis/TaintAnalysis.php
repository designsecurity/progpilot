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
			
            $resolve_defs_assign = TaintAnalysis::set_tainted($data, $mydef_return, false, $myinstance); 
                    
			if($params_tainted)
			{
                for($j = 0; $j < count($defs_tainted); $j ++)
                {          
                    //if param is tainted
                    if(count($resolve_defs_assign) > 0)
                    {
                        foreach($resolve_defs_assign as $resolve_def)
                        {
                            if($defs_tainted[$j]->is_tainted())
                            {
                                $resolve_def->set_tainted(true);
                                $resolve_def->set_taintedbyexpr($exprs_tainted[$j]);
                            }
                            else
                            {
                                $resolve_def->set_tainted(false);
                                $resolve_def->set_taintedbyexpr(null);
                            }
                                        
                            if($defs_tainted[$j]->is_sanitized())
                            {
                                $resolve_def->set_type_sanitized($defs_tainted[$j]->get_type_sanitized());
                                $resolve_def->set_sanitized(true);
                            }
                        }
                    }
                    else
                    {
                        if($defs_tainted[$j]->is_tainted())
                        {
                            $mydef_return->set_tainted(true);
                            $mydef_return->set_taintedbyexpr($exprs_tainted[$j]);
                        }
                                        
                        if($defs_tainted[$j]->is_sanitized())
                        {
                            $mydef_return->set_type_sanitized($defs_tainted[$j]->get_type_sanitized());
                            $mydef_return->set_sanitized(true);
                        }
                    }
                }
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
                //TaintAnalysis::set_tainted($data, $mydef, $defassign, $exprreturn, false, null); 
                
                $resolve_defs_assign = TaintAnalysis::set_tainted($data, $defassign, false, null); 
							
                //if param is tainted
                if(count($resolve_defs_assign) > 0)
                {
                    foreach($resolve_defs_assign as $resolve_def)
                    {
                        if($mydef->is_tainted())
                        {
                            $resolve_def->set_tainted(true);
                            $resolve_def->set_taintedbyexpr($exprreturn);
                        }
                        else
                        {
                            $resolve_def->set_tainted(false);
                            $resolve_def->set_taintedbyexpr(null);
                        }
                                    
                        if($mydef->is_sanitized())
                        {
                            $resolve_def->set_type_sanitized($mydef->get_type_sanitized());
                            $resolve_def->set_sanitized(true);
                        }
                    }
                }
                else
                {
                    if($mydef->is_tainted())
                    {
                        $defassign->set_tainted(true);
                        $defassign->set_taintedbyexpr($exprreturn);
                    }
                                    
                    if($mydef->is_sanitized())
                    {
                        $defassign->set_type_sanitized($mydef->get_type_sanitized());
                        $defassign->set_sanitized(true);
                    }
                }
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
                        //TaintAnalysis::set_tainted($data, $copydefreturn, $defassign, $expr, false, null); 
                        
                        $resolve_defs_assign = TaintAnalysis::set_tainted($data, $defassign, false, null); 
							
                        //if param is tainted
                        if(count($resolve_defs_assign) > 0)
                        {
                            foreach($resolve_defs_assign as $resolve_def)
                            {
                                if($copydefreturn->is_tainted())
                                {
                                    $resolve_def->set_tainted(true);
                                    $resolve_def->set_taintedbyexpr($expr);
                                }
                                else
                                {
                                    $resolve_def->set_tainted(false);
                                    $resolve_def->set_taintedbyexpr(null);
                                }
                                    
                                if($copydefreturn->is_sanitized())
                                {
                                    $resolve_def->set_type_sanitized($copydefreturn->get_type_sanitized());
                                    $resolve_def->set_sanitized(true);
                                }
                            }
                        }
                        else
                        {
                            if($copydefreturn->is_tainted())
                            {
                                $defassign->set_tainted(true);
                                $defassign->set_taintedbyexpr($expr);
                            }
                                    
                            if($copydefreturn->is_sanitized())
                            {
                                $defassign->set_type_sanitized($copydefreturn->get_type_sanitized());
                                   $defassign->set_sanitized(true);
                            }
                        }
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
							$resolve_defs_assign = TaintAnalysis::set_tainted($data, $defassign, false, null); 
							
							//if param is tainted
							if(count($resolve_defs_assign) > 0)
							{
                                foreach($resolve_defs_assign as $resolve_def)
                                {
                                    if($param->is_tainted())
                                    {
                                        $resolve_def->set_tainted(true);
                                        $resolve_def->set_taintedbyexpr($expr);
                                    }
                                    else
                                    {
                                        $resolve_def->set_tainted(false);
                                        $resolve_def->set_taintedbyexpr(null);
                                    }
                                    
                                    if($param->is_sanitized())
                                    {
                                        $resolve_def->set_type_sanitized($param->get_type_sanitized());
                                        $resolve_def->set_sanitized(true);
                                    }
                                }
                            }
                            else
                            {
                                if($param->is_tainted())
                                {
                                    $defassign->set_tainted(true);
                                    $defassign->set_taintedbyexpr($expr);
                                }
                                    
                                if($param->is_sanitized())
                                {
                                    $defassign->set_type_sanitized($param->get_type_sanitized());
                                    $defassign->set_sanitized(true);
                                }
                            }
						}
					}
				}

				$nbparams ++;
				unset($defarg);
			}
		}

		unset($params);
	}
	
	public static function set_tainted($data, $defassign, $safe, $myinstance)
	{	
        $good_defs = [];
        
        // assertions
		if(!$safe)
		{
			// we are going to taint defassign's definitions		
			// we are inside a class
			if($defassign->get_name() == "this" && !is_null($myinstance))
			{
				$myclass = $myinstance->get_myclass();
				$property = $myclass->get_property($defassign->get_property_name());

				if(!is_null($property))
				{
                    $good_defs[] = $property;
					// with this visibility of property is ok, check is not needed
				}
			}

			else if($defassign->is_property())
			{
				// we can have multiple instances with the same property assigned
				// we are looking for and instance, not a property	
				$defassign->set_instance(true);
				$defassign->set_property(false);

				$instances_defs = Definitions::search_nearest(
						$defassign->getLine(), 
						$defassign->getColumn(), 
						$data->getout($defassign->get_block_id()), 
						$defassign, 
						$myinstance);

				$defassign->set_instance(false);
				$defassign->set_property(true);

				if(count($instances_defs) > 0)
				{
					foreach($instances_defs as $defb)
					{            
						if($defb->is_instance())
						{
							$myclass = $defb->get_myinstance()->get_myclass();
							$property = $myclass->get_property($defassign->get_property_name());

							if(!is_null($property))
							{
                                if((is_null($myinstance) && $property->get_visibility() == "public")
										|| (!is_null($myinstance) && $myclass->get_name() != $myinstance->get_name()))
								{
                                    $copy_myclass = clone $myclass;
                                    $myinstance = new MyInstance("this");
                                    $myinstance->set_myclass($copy_myclass);

                                    $defassign->set_myinstance($myinstance);
                                    
                                    $good_defs[] = $copy_myclass->get_property($defassign->get_property_name());
                                }
                            }
						}
					}
				}
			}
		}
	}
}
