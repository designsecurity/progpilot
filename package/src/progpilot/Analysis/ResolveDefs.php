<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use PHPCfg\Block;
use PHPCfg\Func;
use PHPCfg\Op;
use PHPCfg\Script;
use PHPCfg\Visitor;
use PHPCfg\Operand;

use progpilot\Objects\MyInstance;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;

class ResolveDefs {

    public static function copy_instance($data, $myfunc_call)
	{
        if($myfunc_call->is_instance())
        {
            $mydef = new MyDefinition($myfunc_call->getLine(), 
                $myfunc_call->getColumn(), 
                    $myfunc_call->get_name_instance(), 
                        false, 
                            false);
                                
            $mydef->set_block_id($myfunc_call->get_block_id());
                
            $backdef = $myfunc_call->get_back_def();
            $new_myclass = $backdef->get_myclass();
                
            $instances_pre = ResolveDefs::select_instances($data, $mydef, true);
            $instances = Definitions::unique_nearest_byblock($mydef, $myfunc_call->getLine(), $myfunc_call->getColumn(), $instances_pre);
              
            foreach($instances as $instance)
            {
                $myclass = $instance->get_myclass();
                $new_myclass->set_name($myclass->get_name());
                
                foreach($myclass->get_properties() as $property)
                {
                    $new_property = clone $property;
                    $exist_property = $new_myclass->get_property($property->get_name());
                        
                    if(!is_null($exist_property))
                    {
                        if($property->is_tainted())
                            $exist_property->set_tainted(true); // FAIRE EGALEMENT LES SANITIZERS
                                
                        if($property->is_sanitized())
                        {
                            foreach($property->get_type_sanitized() as $type_sanitized)
                                $exist_property->add_type_sanitized($type_sanitized);
                                    
                            $exist_property->set_sanitized(true);
                        }
                    }
                    else if(is_null($exist_property))    
                        $new_myclass->add_property($new_property);
                }
                    
                foreach($myclass->get_methods() as $method)
                {
                    $new_method = clone $method;
                    $new_myclass->add_method($new_method);
                }
            }
        }
    }
    
	public static function instance_build_back($data, $myfunc, $myfunc_call)
	{
        if(!is_null($myfunc) && $myfunc->is_method())
        {
            if($myfunc_call->is_instance())
            {
                $mybackdef = $myfunc_call->get_back_def();
                $myback_myclass = $mybackdef->get_myclass();
                $myclass = $myfunc->get_myclass();
                
                $copy_myclass = clone $myclass;
                
                foreach($copy_myclass->get_properties() as $property)
                {
                    $mydef = new MyDefinition($mybackdef->getLine(), $mybackdef->getColumn(), "this", false, false);
                    $mydef->set_property(true);
                    $mydef->property->set_name($property->get_name());
                    $mydef->set_block_id($mybackdef->get_block_id());
                    
                    $defs = Definitions::search_nearest(
                        $mydef->getLine(), 
                            $mydef->getColumn(), 
                                $myfunc->get_defs()->getoutminuskill($mybackdef->get_block_id()), 
                                    $mydef);
                    
                    $defs_found = Definitions::unique_nearest_byblock($mydef, $mydef->getLine(), $mydef->getColumn(), $defs);
                    
                    $property_is_tainted = false;
                    $property_is_sanitized = false;
                    $set_sanitizers = [];
                    
                    foreach($defs_found as $def_found)
                    {
                        if($def_found->is_tainted())
                            $property_is_tainted = true;
                        
                        if($def_found->is_sanitized())
                        {
                            $property_is_sanitized = true;
                            foreach($def_found->get_type_sanitized() as $type_sanitized)
                                $set_sanitizers[] = $type_sanitized;
                        }
                    }
                        
                     
                    $exist_property = $myback_myclass->get_property($property->get_name());   
                    if(!is_null($exist_property))
                        $new_property = $exist_property;
                    else
                    {
                        $new_property = $property;
                        $myback_myclass->add_property($property);
                    }
                        
                    if($property_is_tainted)
                        $new_property->set_tainted(true);
                        
                    if($property_is_sanitized)
                    {
                        $new_property->set_sanitized(true);
                        foreach($set_sanitizers as $type_sanitized)
                            $new_property->add_type_sanitized($type_sanitized);
                    }
                }
                
                
                    
                foreach($copy_myclass->get_methods() as $method)
                {
                    $new_method = clone $method;
                    $myback_myclass->add_method($new_method);
                }
            }
        }
    }
    
	public static function instance_build_this($data, $myfunc, $myfunc_call)
	{
        if(!is_null($myfunc) && $myfunc_call->is_instance())
        {
            $myclass = $myfunc->get_myclass();
            $copy_myclass = clone $myclass;
            
            foreach($copy_myclass->get_properties() as $property)
            {
            
                $mydef = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name_instance(), false, false);
                $mydef->set_property(true);
                $mydef->property->set_name($property->get_name());
                $mydef->set_block_id($myfunc_call->get_block_id());
                /*
                $defs = Definitions::search_nearest(
                    $mydef->getLine(), 
                        $mydef->getColumn(), 
                            $data->getoutminuskill($mydef->get_block_id()), 
                                $mydef);
                
                $defs_found = Definitions::unique_nearest_byblock($mydef, $mydef->getLine(), $mydef->getColumn(), $defs);
                */
                
                $defs_found = ResolveDefs::select_properties($data, $mydef);
                 
                $property_is_tainted = false;
                $property_is_sanitized = false;
                $set_sanitizers = [];
                
                foreach($defs_found as $def_found)
                {
                    if($def_found->is_tainted())
                        $property_is_tainted = true;
                        
                    if($def_found->is_sanitized())
                    {
                        $property_is_sanitized = true;
                        foreach($def_found->get_type_sanitized() as $type_sanitized)
                            $set_sanitizers[] = $type_sanitized;
                    }
                }
                
                if($property_is_tainted)
                    $property->set_tainted(true);
                
                if($property_is_sanitized)
                {
                    $property->set_sanitized(true);
                    $property->set_type_sanitized($set_sanitizers);
                }
            }
                    
            $mythisdef = $myfunc->get_this_def();
            $mythisdef->set_class_name($copy_myclass->get_name());
            $mythisdef->set_myclass($copy_myclass);
        }
    }
    
    public static function select_instances($data, $tempdefa, $check = false)
	{
        $instances_defs = [];
        
        if($tempdefa->is_property() || $tempdefa->is_method() || $check)
        {
            // we can have multiple instances with the same property assigned
            // we are looking for and instance, not a property	
            $copy_tempdefa = clone $tempdefa;
            $copy_tempdefa->set_instance(true);
            
            $instances_defs = Definitions::search_nearest(
                    $copy_tempdefa->getLine(), 
                    $copy_tempdefa->getColumn(), 
                    $data->getoutminuskill($copy_tempdefa->get_block_id()), 
                    $copy_tempdefa);
        }
        
        return $instances_defs;
    }
    
    public static function select_properties($data, $tempdefa)
    {
        $properties_defs = [];
        
        if($tempdefa->is_property())
        {
            $defs = Definitions::search_nearest(
                $tempdefa->getLine(), 
                    $tempdefa->getColumn(), 
                        $data->getoutminuskill($tempdefa->get_block_id()), 
                            $tempdefa);
                
            $defs_found = Definitions::unique_nearest_byblock($tempdefa, $tempdefa->getLine(), $tempdefa->getColumn(), $defs);
                
            if(count($defs_found) > 0)
            {
                foreach($defs_found as $defa)
                {	
                    if($defa->is_property())
                    {
                        // if we found a property, we are looking for a nearest instance
                        $instances_pre = ResolveDefs::select_instances($data, $tempdefa);
                        $instances = Definitions::unique_nearest_byblock($tempdefa, $tempdefa->getLine(), $tempdefa->getColumn(), $instances_pre);
                    
                        $instance_nearest = false;
                        foreach($instances as $instance)
                        {
                            if($instance->is_instance() && Definitions::is_nearest($instance->getLine(), $instance->getColumn(), $defa->getLine(), $defa->getColumn()))
                            {
                                $tmp_myclass = $instance->get_myclass();
                                $property = $tmp_myclass->get_property($tempdefa->property->get_name());
                                    
                                if(!is_null($property))
                                {
                                    $properties_defs[] = $property;
                                    $instance_nearest = true;
                                }
                            }
                        }
                                
                        if(!$instance_nearest)
                            $properties_defs[] = $defa;
                    }
                }
            }
            else
            {
                $copy_tempdefa = clone $tempdefa;
                $copy_tempdefa->set_property(false);
                
                $instances_pre = ResolveDefs::select_instances($data, $copy_tempdefa, true);
                $instances = Definitions::unique_nearest_byblock($copy_tempdefa, $tempdefa->getLine(), $tempdefa->getColumn(), $instances_pre);
        
                $property_found = false;
                foreach($instances as $instance)
                {
                    if($instance->is_instance())
                    {
                        $tmp_myclass = $instance->get_myclass();
                        $property = $tmp_myclass->get_property($tempdefa->property->get_name());
                    
                        if(!is_null($property))
                        {
                            $properties_defs[] = $property;
                            $property_found = true;
                        }
                    }
                }
                
                if(!$property_found)
                    $properties_defs[] = $tempdefa;
            }
        }
        
        return $properties_defs;
    }
    
	public static function temporary_simple($data, $tempdefa)
	{
        $defs = Definitions::search_nearest(
            $tempdefa->getLine(), 
                $tempdefa->getColumn(), 
                    $data->getoutminuskill($tempdefa->get_block_id()), 
                        $tempdefa);
        
        $defs_found = Definitions::unique_nearest_byblock($tempdefa, $tempdefa->getLine(), $tempdefa->getColumn(), $defs);
        
		$myexpr = $tempdefa->get_exprs()[0]; 

		$gooddefs = [];
		if(count($defs_found) > 0)
		{
			foreach($defs_found as $defa)
			{	
				if($defa->is_ref())
				{
					$refdef = new MyDefinition($tempdefa->getLine(), $tempdefa->getColumn(), $defa->get_ref_name(), false, false);
					$refdef->set_block_id($tempdefa->get_block_id());

					if($defa->is_ref_arr())
					{
						$refdef->set_arr(true);
						$refdef->set_arr_value($defa->get_ref_arr_value());
					}
					
					$truerefs = Definitions::search_nearest(
							$refdef->getLine(), $refdef->getColumn(), 
							$data->getoutminuskill($refdef->get_block_id()), 
							$refdef); 
							
                    $defs_found = Definitions::unique_nearest_byblock($refdef, $refdef->getLine(), $refdef->getColumn(), $truerefs);
                

					foreach($defs_found as $ref)
					{
						$ref->add_expr($myexpr);
						$myexpr->add_def($ref);

						$gooddefs[] = $ref;
					}

					unset($truerefs);
				}
				else if($defa->is_property())
                {
                    // if we found a property, we are looking for a nearest instance
                    $instances_pre = ResolveDefs::select_instances($data, $tempdefa);
                    $instances = Definitions::unique_nearest_byblock($tempdefa, $tempdefa->getLine(), $tempdefa->getColumn(), $instances_pre);
        
                    $instance_nearest = false;
                    foreach($instances as $instance)
                    {
                        if($instance->is_instance() && Definitions::is_nearest($instance->getLine(), $instance->getColumn(), $defa->getLine(), $defa->getColumn()))
                        {
                            $tmp_myclass = $instance->get_myclass();
                            $property = $tmp_myclass->get_property($tempdefa->property->get_name());
                        
                            if(!is_null($property))
                            {
                                $property->add_expr($myexpr);
                                $myexpr->add_def($property);
                                $gooddefs[] = $property;
                                $instance_nearest = true;
                            }
                        }
                    }
                    
                    if(!$instance_nearest)
                    {
                        $defa->add_expr($myexpr);
                        $myexpr->add_def($defa);
                        $gooddefs[] = $defa;
                    }
                }
                else
                {
                    $defa->add_expr($myexpr);
                    $myexpr->add_def($defa);
                    $gooddefs[] = $defa;
				}
			}
		}
		else
		{
            // if we found zero def but we are looking for property, we are now searching instances
            if($tempdefa->is_property())
            {
                $copy_tempdefa = clone $tempdefa;
                $copy_tempdefa->set_property(false);
                
                $instances_pre = ResolveDefs::select_instances($data, $copy_tempdefa, true);
                $instances = Definitions::unique_nearest_byblock($copy_tempdefa, $tempdefa->getLine(), $tempdefa->getColumn(), $instances_pre);
        
                $property_found = false;
                foreach($instances as $instance)
                {
                    if($instance->is_instance())
                    {
                        $tmp_myclass = $instance->get_myclass();
                        $property = $tmp_myclass->get_property($tempdefa->property->get_name());
                    
                        if(!is_null($property))
                        {
                            $property->add_expr($myexpr);
                            $myexpr->add_def($property);
                            $gooddefs[] = $property;
                            $property_found = true;
                        }
                    }
                }
                
                if(!$property_found)
                {
                    $tempdefa->add_expr($myexpr);
                    $myexpr->add_def($tempdefa);
                    $gooddefs[] = $tempdefa;
                }
            }
            else
            {        
                $tempdefa->add_expr($myexpr);
                $myexpr->add_def($tempdefa);
                $gooddefs[] = $tempdefa;
            }
		}

		return $gooddefs;
	}
}
