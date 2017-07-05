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

use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;

class ResolveDefs {

	public static function select_instances($data, $tempdefa, $inside_class)
	{
        $good_defs = [];
        
        if($tempdefa->is_property())
        {
            // we can have multiple instances with the same property assigned
            // we are looking for and instance, not a property	
            $tempdefa->set_instance(true);
            $tempdefa->set_property(false);

            $instances_defs = Definitions::search_nearest(
                    $tempdefa->getLine(), 
                    $tempdefa->getColumn(), 
                    $data->getout($tempdefa->get_block_id()), 
                    $tempdefa, 
                    $inside_class);

            $tempdefa->set_instance(false);
            $tempdefa->set_property(true);

            if(count($instances_defs) > 0)
            {
                foreach($instances_defs as $defb)
                {            
                    if($defb->is_instance())
                    {
                        $myclass = $defb->get_myinstance()->get_myclass();
                        $property = $myclass->get_property($tempdefa->get_property_name());

                        if(!is_null($property))
                        {
                            $visibility = ResolveDefs::get_visibility($myclass, $property, $inside_class);
                            $good_defs[] = [$defb, $visibility];
                        }
                    }
                }
            }
        }
        
        return $good_defs;
    }
    
	public static function get_visibility($myclass, $property, $inside_class)
	{
        if(!is_null($property) && !is_null($myclass))
        {
            if((is_null($inside_class) && $property->get_visibility() == "public")
                || (!is_null($inside_class) && $myclass->get_name() != $inside_class->get_name()))
            {
                return true;
            }
        }
        
        return false;
	}
    
	public static function create_instance($instances, $tempdefa)
	{
        $final_visibility = false;
        
        if($tempdefa->is_property())
        {
            foreach($instances as $instance)
            {
                $instance_def = $instance[0];
                $visibility_def = $instance[1];
                
                if($visibility_def)
                {
                    $myclass = $instance->get_myinstance()->get_myclass();
                    $copy_myclass = clone $myclass;
                    $inside_class = new MyInstance("this");
                    $inside_class->set_myclass($copy_myclass);

                    $tempdefa->set_myinstance($inside_class);
                }
            }    
        }
	}
    
	public static function definition($data, $tempdefa, $inside_class)
	{
        if($tempdefa->is_property())
        {
            $instances = ResolveDefs::select_instances($data, $tempdefa, $inside_class);
            ResolveDefs::create_instance($instances, $tempdefa);
            
            // ???
            $tempdefa->set_visibility($visibility); 
            
            // IL PEUT Y EN AVOIR PLUSIEURS D'INSTANCES
            if($visibility)
            {
            
            }
        }
	}
    
	public static function instance($data, $tempdefa, $inside_class)
	{
        if($tempdefa->is_property())
        {
            // we can have multiple instances with the same property assigned
            // we are looking for and instance, not a property	
            $tempdefa->set_instance(true);
            $tempdefa->set_property(false);

            $instances_defs = Definitions::search_nearest(
                    $tempdefa->getLine(), 
                    $tempdefa->getColumn(), 
                    $data->getout($tempdefa->get_block_id()), 
                    $tempdefa, 
                    $inside_class);

            $tempdefa->set_instance(false);
            $tempdefa->set_property(true);

            if(count($instances_defs) > 0)
            {
                foreach($instances_defs as $defb)
                {            
                    if($defb->is_instance())
                    {
                        $myclass = $defb->get_myinstance()->get_myclass();
                        $property = $myclass->get_property($tempdefa->get_property_name());

                        if(!is_null($property))
                        {
                            // on vérifie pour éviter de créer mais est-ce que ca fausse l'analyse ????!!!!
                            if((is_null($inside_class) && $property->get_visibility() == "public")
                                    || (!is_null($inside_class) && $myclass->get_name() != $inside_class->get_name()))
                            {
                                $copy_myclass = clone $myclass;
                                $inside_class = new MyInstance("this");
                                $inside_class->set_myclass($copy_myclass);

                                $tempdefa->set_myinstance($inside_class);
                                    
                                $good_defs[] = $copy_myclass->get_property($tempdefa->get_property_name());
                            }
                        }
                    }
                }
            }
        }
    }
				
				
	public static function visibility($data, $tempdefa, $inside_class)
	{
        if($tempdefa->is_property())
        {    
            $tempdefa->set_instance(true);
            $tempdefa->set_property(false);

            $instances_defs = Definitions::search_nearest(
                $tempdefa->getLine(), 
                    $tempdefa->getColumn(), 
                        $data->getout($tempdefa->get_block_id()), 
                            $tempdefa, 
                                $inside_class);

            $tempdefa->set_instance(false);
            $tempdefa->set_property(true);
                        
            $final_visibility = false;

            if(count($instances_defs) > 0)
            {
                foreach($instances_defs as $defb)
                {      
                    if($defb->is_instance())
                    {
                        $myclass = $defb->get_myinstance()->get_myclass();
                        $property = $myclass->get_property($tempdefa->get_property_name());

                        if(!is_null($property))
                        {
                            if((is_null($inside_class) && $property->get_visibility() == "public")
                                || (!is_null($inside_class) && $myclass->get_name() != $inside_class->get_name()))
                            {
                                $final_visibility = true;
                                break;
                            }
                        }
                    }
                }
            }  
                        
            $tempdefa->set_visibility($final_visibility);  
        }
    }

	public static function temporary_simple($data, $tempdefa, $inside_class)
	{
		$myexpr = $tempdefa->get_exprs()[0];  
		$defs = Definitions::search_nearest(
				$tempdefa->getLine(), 
				$tempdefa->getColumn(), 
				$data->getout($tempdefa->get_block_id()), 
				$tempdefa, 
				$inside_class);
				
        //echo "ResolveDefs 0\n";
        //$tempdefa->print_stdout();

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
                    // function resolve_visibility , resolve_exprs
                    if($tempdefa->is_property())
                        $defa->set_visibility($tempdefa->get_visibility());
                    
                    
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
