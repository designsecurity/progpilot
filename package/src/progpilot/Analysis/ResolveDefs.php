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
                
            $instances = ResolveDefs::select_instances($data, $mydef, true);
              
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
                    
                    $defs = ResolveDefs::select_definitions( 
                        $myfunc->get_defs()->getoutminuskill($mybackdef->get_block_id()), 
                            $mydef);
                    
                    $property_is_tainted = false;
                    $property_is_sanitized = false;
                    $set_sanitizers = [];
                    
                    foreach($defs as $def_found)
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
    

	// op is nearest than def
	public static function is_nearest($lineop, $columnop, $linedef, $columdef)
	{
		if(($lineop > $linedef) || ($lineop == $linedef &&  $columnop >= $columdef))
			return true;

		return false;
	}
	
	public static function get_visibility($def, $property)
	{
        $myclass = $def->get_myclass();
        
        if(!is_null($property) && !is_null($myclass) && $property->is_property())
        {
            if($property->property->get_visibility() == "public" || $def->get_name() == "this")
            {
                return true;
            }
        }
        
        return false;
	}
	
	public static function select_definitions_force($data, $defsearch)
	{
		$defsfound = [];

		if(count($data) > 0)
		{
			foreach($data as $def)
			{	    
				if($def->get_name() == $defsearch->get_name())
				{
					if(ResolveDefs::is_nearest($defsearch->getLine(), $defsearch->getColumn(), $def->getLine(), $def->getColumn()))
					{
						$defsfound[] = $def;
					}
				}
			}
		}

		return $defsfound;
	}
	
	public static function select_definitions($data, $defsearch)
	{
		$defsfound = [];
		if(is_null($data))
			return $defsfound;
        
		foreach($data as $def)
		{
			if($def->get_name() == $defsearch->get_name() && $def->get_assign_id() != $defsearch->get_assign_id())
			{
				if($def->is_instance() && !$def->is_property() && !$def->is_method() && $defsearch->is_instance() && !$defsearch->is_property() && !$defsearch->is_method())
				{		
                    $defsfound[$def->get_block_id()][] = [$def, $def->getLine(), $def->getColumn()];
				}
				
				else if($def->is_instance() && !$def->is_property() && !$def->is_method() && $defsearch->is_instance() && $defsearch->is_property() && !$defsearch->is_method())
				{		
                    $myclass = $def->get_myclass();
                    $property = $myclass->get_property($defsearch->property->get_name());

                    if(!is_null($property) && ResolveDefs::get_visibility($def, $property))
                        $defsfound[$def->get_block_id()][] = [$def, $def->getLine(), $def->getColumn()];
				}
				
				else if($def->is_instance() && !$def->is_property() && !$def->is_method() && $defsearch->is_instance() && !$defsearch->is_property() && $defsearch->is_method())
				{		
                    $myclass = $def->get_myclass();
                    $method = $myclass->get_method($defsearch->method->get_name());

                    if(!is_null($method))
                    {
                        $defsfound[$def->get_block_id()][] = [$def, $def->getLine(), $def->getColumn()];   
                    }
				}
				
				else if(!$def->is_instance() && $def->is_property() && !$defsearch->is_instance() && $defsearch->is_property())
				{	
                    if($def->property->get_name() == $defsearch->property->get_name())
                        $defsfound[$def->get_block_id()][] = [$def, $def->getLine(), $def->getColumn()];
				}

				else if(!$def->is_arr() && !$def->is_instance() && !$def->is_property() && !$def->is_method() && !$defsearch->is_arr())
				{
					$defsfound[$def->get_block_id()][] = [$def, $def->getLine(), $def->getColumn()];
				}

				else if($def->get_arr_value() == $defsearch->get_arr_value() && $def->is_arr() && $defsearch->is_arr())
				{
					$defsfound[$def->get_block_id()][] = [$def, $def->getLine(), $def->getColumn()];
				}

				else if($def->is_copyarray() && $defsearch->is_arr())
				{
					$copyarrays = $def->get_copyarrays();

					foreach($copyarrays as $value)
					{
						$arrvalue = $value[0];
						$defarr = $value[1];

						if($arrvalue == $defsearch->get_arr_value())
						{
							$defsfound[$def->get_block_id()][] = [$defarr, $def->getLine(), $def->getColumn()];
						}

						unset($defarr);
					}
				}
			}
		}
		
		
		$truedefsfound = [];
			
		// si on a trouvé des defs dans le même bloc que la ou on cherche elles killent les autres	
		if(isset($defsfound[$defsearch->get_block_id()]) 
            && count($defsfound[$defsearch->get_block_id()]) > 0)
            $defsfound_good[$defsearch->get_block_id()] = $defsfound[$defsearch->get_block_id()];
		else 
            $defsfound_good = $defsfound;
		
		// pour gérer le cas de deux ou plus de définitions qui arrivent de deux ou plus blocs différents
		foreach($defsfound_good as $blockdefs)
		{
			$nearestdef = null;
			$nearestline = 0;
			$nearestcolumn = 0;
                
			foreach($blockdefs as $block_id => $deflast)
			{
				$bisdef = $deflast[0];
				$bisline = $deflast[1];
				$biscolumn = $deflast[2];

				if(ResolveDefs::is_nearest($defsearch->getLine(), $defsearch->getColumn(), $bisline, $biscolumn))
				{
					if(is_null($nearestdef) || ResolveDefs::is_nearest($bisline, $biscolumn, $nearestline, $nearestcolumn))
					{
						$nearestdef = $bisdef;
						$nearestline = $bisline;
						$nearestcolumn = $biscolumn;
					}
				}

				//unset($bisdef);
			}

            if(!is_null($nearestdef))
                $truedefsfound[] = $nearestdef;
		}

		return $truedefsfound;
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
            
            $instances_defs = ResolveDefs::select_definitions(
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
            $defs = ResolveDefs::select_definitions(
                $data->getoutminuskill($tempdefa->get_block_id()), 
                    $tempdefa);
                
            if(count($defs) > 0)
            {
                foreach($defs as $defa)
                {	
                    if($defa->is_property())
                    {
                        // if we found a property, we are looking for a nearest instance
                        $instances = ResolveDefs::select_instances($data, $tempdefa);
                        
                        $instance_nearest = false;
                        foreach($instances as $instance)
                        {
                            if($instance->is_instance() && ResolveDefs::is_nearest($instance->getLine(), $instance->getColumn(), $defa->getLine(), $defa->getColumn()))
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
                
                $instances = ResolveDefs::select_instances($data, $copy_tempdefa, true);
                
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
        if($tempdefa->is_property())
            $defs = ResolveDefs::select_properties($data, $tempdefa);
        
        else
            $defs = ResolveDefs::select_definitions(
                $data->getoutminuskill($tempdefa->get_block_id()), 
                    $tempdefa);
        
		$myexpr = $tempdefa->get_exprs()[0]; 

		$gooddefs = [];
		if(count($defs) > 0)
		{
			foreach($defs as $defa)
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
					
					$truerefs = ResolveDefs::select_definitions(
                        $data->getoutminuskill($refdef->get_block_id()), 
							$refdef); 
							
					foreach($truerefs as $ref)
					{
						$ref->add_expr($myexpr);
						$myexpr->add_def($ref);

						$gooddefs[] = $ref;
					}

					unset($truerefs);
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
            $tempdefa->add_expr($myexpr);
            $myexpr->add_def($tempdefa);
            $gooddefs[] = $tempdefa;
		}

		return $gooddefs;
	}
}
