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
    
	public static function instance_build_back($data, $myfunc, $myfunc_call)
	{
        if($myfunc_call->is_instance())
        {
            echo "instance_build_back\n";
            $mybackdef = $myfunc_call->get_back_def();
            $myclass = $myfunc->get_myclass();
            
            $copy_myclass = clone $myclass;
            
            foreach($copy_myclass->get_properties() as $property)
            {
            
                echo "instance_build_back foreach '".$mybackdef->getLine()."', '".$mybackdef->getColumn()."'\n";
                $mydef = new MyDefinition($mybackdef->getLine(), $mybackdef->getColumn(), "this", false, false);
                $mydef->set_property(true);
                $mydef->property->set_name($property->get_name());
                $mydef->set_block_id($mybackdef->get_block_id());
                
                $defs = Definitions::search_nearest(
                    $mydef->getLine(), 
                        $mydef->getColumn(), 
                            $myfunc->get_defs()->getout($mybackdef->get_block_id()), 
                                $mydef);
                
                $defs_found = Definitions::unique_nearest_byblock($mydef->getLine(), $mydef->getColumn(), $defs);
                
                $property_is_tainted = false;
                foreach($defs_found as $def_found)
                {
                    echo "instance_build_back foreach foreach\n";
                    $def_found->print_stdout();
                    
                    if($def_found->is_tainted())
                    {
                    echo "instance_build_back foreach foreach def_found->is_tainted\n";
                        $property->set_tainted(true);
                        break;
                    }
                }
            }
                    
            $mybackdef->set_class_name($copy_myclass->get_name());
            $mybackdef->set_myclass($copy_myclass);
            $mybackdef->set_name($myfunc_call->get_name_instance());
            $mybackdef->setLine($myfunc_call->getLine());
            $mybackdef->setColumn($myfunc_call->getColumn());
                    echo "instance_build_back end\n";
        }
    }
    
	public static function instance_build_this($data, $myfunc, $myfunc_call)
	{
        if($myfunc_call->is_instance())
        {
            echo "instance_build_this\n";
            $myclass = $myfunc->get_myclass();
            $copy_myclass = clone $myclass;
            
            foreach($copy_myclass->get_properties() as $property)
            {
                $mydef = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name_instance(), false, false);
                $mydef->set_property(true);
                $mydef->property->set_name($property->get_name());
                $mydef->set_block_id($myfunc_call->get_block_id());
                
                $defs = Definitions::search_nearest(
                    $mydef->getLine(), 
                        $mydef->getColumn(), 
                            $data->getout($mydef->get_block_id()), 
                                $mydef);
                
                $defs_found = Definitions::unique_nearest_byblock($mydef->getLine(), $mydef->getColumn(), $defs);
                
                
                echo "instance_build_this foreach\n";
                $mydef->print_stdout();
                $property_is_tainted = false;
                foreach($defs_found as $def_found)
                {
                    echo "instance_build_this foreach foreach\n";
                    $def_found->print_stdout();
                    
                    if($def_found->is_tainted())
                    {
                        $property->set_tainted(true);
                        break;
                    }
                }
            }
                    
            $mythisdef = $myfunc->get_this_def();
            $mythisdef->set_class_name($copy_myclass->get_name());
            $mythisdef->set_myclass($copy_myclass);
        }
    }
    
    public static function select_instances($data, $tempdefa)
	{
        $instances_defs = [];
        
        if($tempdefa->is_property() || $tempdefa->is_method())
        {
            // we can have multiple instances with the same property assigned
            // we are looking for and instance, not a property	
            $copy_tempdefa = clone $tempdefa;
            $copy_tempdefa->set_instance(true);
            
            $instances_defs = Definitions::search_nearest(
                    $copy_tempdefa->getLine(), 
                    $copy_tempdefa->getColumn(), 
                    $data->getout($copy_tempdefa->get_block_id()), 
                    $copy_tempdefa);
        }
        
        return $instances_defs;
    }
    
	public static function temporary_simple($data, $tempdefa)
	{
        $defs = Definitions::search_nearest(
            $tempdefa->getLine(), 
                $tempdefa->getColumn(), 
                    $data->getout($tempdefa->get_block_id()), 
                        $tempdefa);
        
        $defs_found = Definitions::unique_nearest_byblock($tempdefa->getLine(), $tempdefa->getColumn(), $defs);
        
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
							$data->getout($refdef->get_block_id()), 
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
                    if($tempdefa->is_property())
                    {
                        $instances_pre = ResolveDefs::select_instances($data, $tempdefa);
                        $instances = Definitions::unique_nearest_byblock($tempdefa->getLine(), $tempdefa->getColumn(), $instances_pre);
        
                        foreach($instances as $instance)
                        {
                            if($instance->is_instance())
                            {
                                $defa->add_expr($myexpr);
                                $myexpr->add_def($defa);
                                $gooddefs[] = $defa;
                                
                                break;
                            }
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
		}
		else
		{
            if($tempdefa->is_property())
            {
                echo "tempdefa est une propriété mais aucune correspondances, rechercher dans les instances\n";
                $instances_pre = ResolveDefs::select_instances($data, $tempdefa);
                $instances = Definitions::unique_nearest_byblock($tempdefa->getLine(), $tempdefa->getColumn(), $instances_pre);
        
                foreach($instances as $instance)
                {
                    if($instance->is_instance())
                    {
                    echo "j'ai trouvé une instance!!!\n";
                    $instance->print_stdout();
                        $tempdefa->add_expr($myexpr);
                        $myexpr->add_def($tempdefa);
                        $gooddefs[] = $tempdefa;
                        
                        break;
                    }
                }
            }
            else
            {        
                $tempdefa->add_expr($myexpr); // nécessaire pas déjà fait dans transform ?
                $myexpr->add_def($tempdefa);
                $gooddefs[] = $tempdefa;
            }
		}

		return $gooddefs;
	}
}
