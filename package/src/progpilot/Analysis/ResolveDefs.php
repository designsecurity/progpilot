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
        
        if($tempdefa->is_property() || $tempdefa->is_method() )
        {
            echo "ResolveDefs::::select_properties select_normal\n";
            
        
            $copy_tempdefa = clone $tempdefa;
            $copy_tempdefa->set_assign_id(-1);
            
            $copy_tempdefa->print_stdout();
            
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
                    echo "ResolveDefs::::select_properties select_normal foreach\n";
                    $property->print_stdout();
                    if($property->is_property() || $property->is_method())
                    {
                        echo "ResolveDefs::::select_properties select_normal foreach is_property is_method\n";
                        if($property->is_property())
                            $myinstances = $property->property->get_myinstances();
                        else
                            $myinstances = $property->method->get_myinstances();
                        
                        foreach($myinstances as $myinstance)
                        {
                            echo "ResolveDefs::::select_properties select_normal foreach is_property is_method foreach\n";
                            $myclass = $myinstance->get_myclass();
                            $visibility = ResolveDefs::get_visibility($myclass, $property, $inside_class);
                            
                            if($tempdefa->is_property())
                            {
                                echo "ResolveDefs::::select_properties select_normal foreach is_property is_method foreach property_name = '".$tempdefa->property->get_name()."'\n";
                            
                                $attribute = $myclass->get_property($tempdefa->property->get_name());
                            }
                            else if($tempdefa->is_method())
                            {
                                echo "ResolveDefs::::select_properties select_normal foreach is_property is_method foreach method_name = '".$tempdefa->method->get_name()."'\n";
                            
                                
                                $attribute = $myclass->get_method($tempdefa->method->get_name());
                               }
                               
                            if(!is_null($attribute))
                            {
                                echo "ResolveDefs::::select_properties select_normal foreach is_property is_method foreach !is_null(attribute)\n";
                                $good_defs[] = [$myclass, $attribute, $visibility];
                            }
                        }
                    }
                }
            }
            
            echo "ResolveDefs::::select_properties select_instances\n";
            $tempdefa->print_stdout();
            $instances = ResolveDefs::select_instances($data, $tempdefa, $inside_class);
            
            if(count($instances) > 0)
            {
                foreach($instances as $instance)
                {         
                    $instance_def = $instance[0];
                    $property_def = $instance[1];
                    $visibility_def = $instance[2];  
                                
                    $good_defs[] = [$instance_def, $property_def, $visibility_def];
                    
                }
            }
            
            // !!!!!!!!!!!!!!!! METTRE LA FIN DE LA DEFINITION SEARCHNEAREST
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
            
            echo "ResolveDefs::::select_instances\n";
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
                    echo "ResolveDefs::::select_instances foreach\n";
                    $defb->print_stdout();
                    
                    
                    $myclasses = [];
                    
                    if($defb->is_instance())
                    {
                        echo "ResolveDefs::::select_instances foreach is_instance\n";
                        $defb->print_stdout();
                        
                        $myclasses[] = $defb->get_myclass();
                        
                        $myinstances = $defb->method->get_myinstances();
                        foreach($myinstances as $myinstance)
                        {
                            $myclasses[] = $myinstance->get_myclass();
                            echo "ResolveDefs::::select_instances foreach is_instance foreach myinstance\n";
                        }
                    }
                    
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
            echo "ResolveDefs definition_myinstance_and_visibility\n";
            $instances = ResolveDefs::select_properties($data, $tempdefa, $inside_class);
            
            foreach($instances as $instance)
            {
                $instance_def = $instance[0];
                $property_def = $instance[1];
                $visibility_def = $instance[2];
            echo "ResolveDefs definition_myinstance_and_visibility foreach\n";
                            
                if($visibility_def)
                {
                    $copy_myclass = clone $instance_def;
                    $new_instance = new MyInstance("this");
                    $new_instance->set_myclass($copy_myclass);
                    
                    if($tempdefa->is_property())
                    {
                        $tempdefa->property->add_myinstance($new_instance);
            echo "ResolveDefs definition_myinstance_and_visibility foreach visibility_def property '$visibility_def' count = '".count($tempdefa->property->get_myinstances())."'\n";
                    }
                    else
                    {
                        $tempdefa->method->add_myinstance($new_instance);
            echo "ResolveDefs definition_myinstance_and_visibility foreach visibility_def method '$visibility_def' count = '".count($tempdefa->method->get_myinstances())."'\n";
                    }
                        
                    
                    $visibility_final = true;
                }
            }    
            
            if($visibility_final)
                $tempdefa->property->set_visibility($visibility_final);
        }
	}

	public static function temporary_simple($data, $tempdefa, $inside_class)
	{
        echo "ResolveDefs::::temporary_simple\n";
        $tempdefa->print_stdout();
            
        $defs = [];
        if($tempdefa->is_property() || $tempdefa->is_method())
        {
            $instances = ResolveDefs::select_properties($data, $tempdefa, $inside_class);
            foreach($instances as $instance)
            {
                $instance_def = $instance[0];
                $property_def = $instance[1];
                $visibility_def = $instance[2];
            
                $defs[] = $property_def;
                
                echo "ResolveDefs::::temporary_simple select_properties END\n";
                $property_def->print_stdout();
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
                echo "ResolveDefs::::temporary_simple foreach\n";
                $defa->print_stdout();
                
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
