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

    public static function select_properties($data, $tempdefa, $inside_class)
	{
        $good_defs = [];
        
        if($tempdefa->is_property())
        {
            $copy_tempdefa = clone $tempdefa;
            $copy_tempdefa->set_assign_id(-1);
            $copy_tempdefa->set_instance(true);
            $copy_tempdefa->set_property(false);
            $copy_tempdefa->set_method(false);
            
            $properties = Definitions::search_nearest(
                    $copy_tempdefa->getLine(), 
                    $copy_tempdefa->getColumn(), 
                    $data->getout($copy_tempdefa->get_block_id()), 
                    $copy_tempdefa, 
                    $inside_class);

            if(count($properties) > 0)
            {
                foreach($properties as $property)
                {           
                    if($property->is_property())
                    {
                        $myinstances = $property->property->get_myinstances();
                        
                        foreach($myinstances as $myinstance)
                        {
                            $myclass = $myinstance->get_myclass();
                            $visibility = ResolveDefs::get_visibility($myclass, $property, $inside_class);
                            $good_defs[] = [$property, $visibility];
                        }
                    }
                }
            }
        }
        
        return $good_defs;
    }
    
    public static function select_instances($data, $tempdefa, $inside_class)
	{
        $good_defs = [];
        
        if($tempdefa->is_property() || $tempdefa->is_method())
        {
            // we can have multiple instances with the same property assigned
            // we are looking for and instance, not a property	
            
            $copy_tempdefa = clone $tempdefa;
            $copy_tempdefa->set_instance(true);
            $copy_tempdefa->set_property(false);
            $copy_tempdefa->set_method(false);
                    
            echo "!!!!!! select_instances\n";
            $copy_tempdefa->print_stdout();

            $instances_defs = Definitions::search_nearest(
                    $copy_tempdefa->getLine(), 
                    $copy_tempdefa->getColumn(), 
                    $data->getout($copy_tempdefa->get_block_id()), 
                    $copy_tempdefa, 
                    $inside_class);

            if(count($instances_defs) > 0)
            {
                foreach($instances_defs as $defb)
                {            
                    $myclasses = [];
                    
                    echo "!!!!!! select_instances foreach\n";
                    $defb->print_stdout();
                    
                    if($defb->is_instance())
                        $myclasses[] = $defb->get_myclass();
                    
                    else if($defb->is_property())
                    {
                        $myinstances = $defb->property->get_myinstances();
                        foreach($myinstances as $myinstance)
                            $myclasses[] = $myinstance->get_myclass();
                    }
                    else if($defb->is_method())
                    {
                        $myinstances = $defb->method->get_myinstances();
                        foreach($myinstances as $myinstance)
                            $myclasses[] = $myinstance->get_myclass();
                    }
                    
                    foreach($myclasses as $myclass)
                    {
                        if($tempdefa->is_property())
                        {
                            $property = $myclass->get_property($tempdefa->property->get_name());

                            if(!is_null($property))
                            {
                                $visibility = ResolveDefs::get_visibility($myclass, $property, $inside_class);
                                $good_defs[] = [$myclass, $property, $visibility];
                            }
                        }
                        
                        else if($tempdefa->is_method())
                        {
                            $method = $myclass->get_method($tempdefa->method->get_name());
                            
                            echo "!!!!!! select_instances foreach foreach\n";
                            $tempdefa->print_stdout();

                            if(!is_null($method))
                            {
                                //$visibility = ResolveDefs::get_visibility($myclass, $property, $inside_class);
                                $good_defs[] = [$myclass, $method, 1];
                            }
                        }
                    }
                }
            }
        }
        
        return $good_defs;
    }
    
	public static function get_visibility($myclass, $property, $inside_class)
	{
        if(!is_null($property) && !is_null($myclass) && $property->is_property())
        {
            if((is_null($inside_class) && $property->property->get_visibility() == "public")
                || (!is_null($inside_class) && $myclass->get_name() != $inside_class->get_name()))
            {
                return true;
            }
        }
        
        return false;
	}
    
	public static function definition_myinstance_and_visibility($data, $tempdefa, $inside_class)
	{
        if($tempdefa->is_property() || $tempdefa->is_method())
        {
            $visibility_final = false;
            $instances = ResolveDefs::select_instances($data, $tempdefa, $inside_class);
            
            foreach($instances as $instance)
            {
                $instance_def = $instance[0];
                $property_def = $instance[1];
                $visibility_def = $instance[2];
                            
                if($visibility_def)
                {
                    $copy_myclass = clone $instance_def;
                    $inside_class = new MyInstance("this");
                    $inside_class->set_myclass($copy_myclass);
                    
                    if($tempdefa->is_property())
                        $tempdefa->property->add_myinstance($inside_class);
                    else
                        $tempdefa->method->add_myinstance($inside_class);
                        
                    
                    $visibility_final = true;
                }
            }    
            
            if($visibility_final)
                $tempdefa->property->set_visibility($visibility_final);
        }
	}

	public static function temporary_simple($data, $tempdefa, $inside_class)
	{
        $defs = [];
        if($tempdefa->is_property() || $tempdefa->is_method())
        {
            $instances = ResolveDefs::select_instances($data, $tempdefa, $inside_class);
            foreach($instances as $instance)
            {
                $instance_def = $instance[0];
                $property_def = $instance[1];
                $visibility_def = $instance[2];
            
                $defs[] = $property_def;
            }
        }
        else
        {
            $defs = Definitions::search_nearest(
                    $tempdefa->getLine(), 
                    $tempdefa->getColumn(), 
                    $data->getout($tempdefa->get_block_id()), 
                    $tempdefa, 
                    $inside_class);
        }
				
        
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

					$truerefs = Definitions::search_nearest(
							$refdef->getLine(), $refdef->getColumn(), 
							$data->getout($refdef->get_block_id()), 
							$refdef, 
							$inside_class); 

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
			$tempdefa->add_expr($myexpr); // nécessaire pas déjà fait dans transform ?
			$myexpr->add_def($tempdefa);
			$gooddefs[] = $tempdefa;
		}

		unset($defs);

		return $gooddefs;
	}
}
