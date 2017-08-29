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

use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyInstance;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;

class ResolveDefs {

	public static function funccall_class($context, $data, $myfunc_call)
	{
		$i = 0;
		$class_stack_name = [];

		if($myfunc_call->get_is_method())
		{
			$properties = $myfunc_call->get_back_def()->property->get_properties();
			$tmp_properties = [];

			while(true)
			{
				$prop_value = [];

				$mydef_tmp = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name_instance());
				$mydef_tmp->set_block_id($myfunc_call->get_block_id());
				$mydef_tmp->set_assign_id($myfunc_call->get_back_def()->get_assign_id());
				$mydef_tmp->set_source_myfile($myfunc_call->get_source_myfile());
				$mydef_tmp->property->set_properties($tmp_properties);
				$mydef_tmp->set_is_property(true);

				$instances = ResolveDefs::select_instances(
						$context, 
						$data, 
						$mydef_tmp);

				foreach($instances as $instance)
				{
                    if($instance->get_is_instance())
					{
						$myclasses = $instance->get_all_myclass();

						foreach($myclasses as $myclass)
						{
                            $class_exist = false;
                            foreach($prop_value as $value_class)
                            {
                                if($value_class->get_name() === $myclass->get_name())
                                {
                                    $class_exist = true;
                                    break;
                                }
                            }
                            
                            if(!$class_exist)
                                $prop_value[] = $myclass;
						}
					}
				}

				$class_stack_name[] = $prop_value;

				if(!isset($properties[$i]))
					break;

				$tmp_properties[] = $properties[$i];

				$i ++;
			}
		}

		return $class_stack_name;
	}

	public static function copy_instance($context, $data, $myfunc_call)
	{
		if($myfunc_call->get_is_method())
		{
			$backdef = $myfunc_call->get_back_def();

			$mydef = new MyDefinition(
					$myfunc_call->getLine(), 
					$myfunc_call->getColumn(), 
					$myfunc_call->get_name_instance());

			$mydef->set_block_id($myfunc_call->get_block_id());
			$mydef->set_source_myfile($myfunc_call->get_source_myfile());

			$mydef->set_is_property($backdef->get_is_property());
			$mydef->property->set_properties($backdef->property->get_properties());

			$instances = ResolveDefs::select_instances(
					$context, 
					$data->getoutminuskill($mydef->get_block_id()), 
					$mydef);

			foreach($instances as $instance)
			{
				$myclasses = $instance->get_all_myclass();

				foreach($myclasses as $myclass)
				{
					$new_myclass = new MyClass($instance->getLine(), 
							$instance->getColumn(),
							$myclass->get_name());

					foreach($myclass->get_properties() as $property)
					{
						$new_property = clone $property;
						$new_myclass->add_property($new_property);
					}

					foreach($myclass->get_methods() as $method)
					{
						$new_method = clone $method;
						$new_myclass->add_method($new_method);
					}

					$backdef->add_myclass($new_myclass);
				}
			}
		}
	}

	public static function instance_build_back($context, $data, $myfunc, $myfunc_call)
	{

		if(!is_null($myfunc) && $myfunc->get_is_method())
		{
			if($myfunc_call->get_is_method())
			{
				$mybackdef = $myfunc_call->get_back_def();
				$myclass = $myfunc->get_myclass();

				$new_myback_myclass = new MyClass(
						$myclass->getLine(), 
						$myclass->getColumn(),
						$myclass->get_name());
				$mybackdef->add_myclass($new_myback_myclass);

				$copy_myclass = clone $myclass;

				foreach($copy_myclass->get_properties() as $property)
				{
					$mydef = new MyDefinition($myfunc->get_last_line(), $myfunc->get_last_column(), "this");
					$mydef->set_is_property(true);
					$mydef->property->set_properties($property->property->get_properties());
					$mydef->set_block_id($myfunc->get_last_block_id());
					$mydef->set_source_myfile($mybackdef->get_source_myfile());


					$defs = ResolveDefs::select_definitions($context, 
							$myfunc->get_defs()->getoutminuskill($mydef->get_block_id()), 
							$mydef);

					foreach($defs as $def_found)
					{
						if($def_found->is_tainted())
							$property->set_tainted(true);

						if($def_found->is_sanitized())
						{
							$property->set_sanitized(true);
							foreach($def_found->get_type_sanitized() as $type_sanitized)
								$property->add_type_sanitized($type_sanitized);
						}
					}

					$new_myback_myclass->add_property($property);
					$property->set_name($mybackdef->get_name());

					ArrayAnalysis::copy_array($context, $myfunc->get_defs()->getoutminuskill($mydef->get_block_id()), $mydef, $mydef->get_array_value(), $property, $property->get_array_value());

				}

				foreach($copy_myclass->get_methods() as $method)
				{
					$new_method = clone $method;
					$new_myback_myclass->add_method($new_method);
				}
			}
		}
	}

	public static function instance_build_this($context, $data, $myfunc, $myfunc_call)
	{
		if(!is_null($myfunc) && $myfunc_call->get_is_method())
		{
			$myclass = $myfunc->get_myclass();
			$copy_myclass = clone $myclass;

			foreach($copy_myclass->get_properties() as $property)
			{
				$mydef = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name_instance());
				$mydef->set_is_property(true);
				$mydef->property->set_properties($property->property->get_properties());
				$mydef->set_block_id($myfunc_call->get_block_id());
				$mydef->set_source_myfile($myfunc_call->get_source_myfile());

				$defs_found = ResolveDefs::select_properties($context, $data, $mydef, true);

				foreach($defs_found as $def_found)
				{
					if($def_found->get_is_copy_array())
					{
						$property->set_copyarrays($def_found->get_copyarrays());
						$property->set_is_copy_array(true);
					}

					if($def_found->is_tainted())
						$property->set_tainted(true);

					if($def_found->is_sanitized())
					{
						$property->set_sanitized(true);
						foreach($def_found->get_type_sanitized() as $type_sanitized)
							$property->add_type_sanitized($type_sanitized);
					}
				}

				$property->set_name("this");
			}



			$mythisdef = $myfunc->get_this_def();
			$mythisdef->set_class_name($copy_myclass->get_name());
			$mythisdef->add_myclass($copy_myclass);
		}
	}

	// def1 and def2 defined in different files
	// return true if def1 is deeper by def2
	public static function is_nearest_includes($def1, $def2)
	{
		$def1_includedby_def2 = false;

		$myfile = $def1->get_source_myfile();
		while(!is_null($myfile))
		{
			$myfile_from = $myfile->get_included_from_myfile();
			if(!is_null($myfile_from) && ($myfile_from->get_name() === $def2->get_source_myfile()->get_name()))
			{
				$def1_includedby_def2 = true;
				break;
			}

			$myfile = $myfile_from;
		}

		if(!$def1_includedby_def2)
		{
			$def2_includedby_def1 = false;
			$myfile = $def2->get_source_myfile();
			while(!is_null($myfile))
			{
				$myfile_from = $myfile->get_included_from_myfile();
				if(!is_null($myfile_from) && ($myfile_from->get_name() === $def1->get_source_myfile()->get_name()))
				{
					$def2_includedby_def1 = true;
					break;
				}

				$myfile = $myfile_from;
			}
		}

		// def1 is included by file from def2
		// but def2 defined before or after the include ?
		if($def1_includedby_def2)
		{
			// def2 defined after the include so def2 is deeper
			if(($def2->getLine() > $myfile->getLine()) 
					|| ($def2->getLine() == $myfile->getLine() &&  $def2->getColumn() >= $myfile->getColumn()))
				return false;

			return true;
		}

		// def2 is included by file from def1
		// but def1 defined before or after the include ?
		if($def2_includedby_def1)
		{
			// def1 defined after the include so def1 is deeper
			if(($def1->getLine() > $myfile->getLine()) 
					|| ($def1->getLine() == $myfile->getLine() &&  $def1->getColumn() >= $myfile->getColumn()))
				return true;

			return false;
		}

		return false;
	}

	// return true if op is deeper in code than def
	public static function is_nearest($context, $def1, $def1_line, $def1_column, $def2, $def2_line, $def2_column)
	{
		if($def1->get_source_myfile()->get_name() === $def2->get_source_myfile()->get_name())
		{
			if(($def1_line > $def2_line) || ($def1_line == $def2_line &&  $def1_column >= $def2_column))
				return true;
		}
		else
			return ResolveDefs::is_nearest_includes($def1, $def2);

		return false;
	}

	public static function get_visibility_method($def_name, $method)
	{
		if($def_name === "this")
			return true;

		if(!is_null($method) 
				&& $method->get_is_method() 
				&& $method->get_visibility() === "public")
			return true;

		return false;
	}

	public static function get_visibility($def, $property)
	{
		if(!is_null($def) && $def->get_name() === "this")
			return true;

		if(!is_null($property) 
				&& $property->get_is_property() 
				&& $property->property->get_visibility() === "public")
			return true;

		return false;
	}

	public static function select_definitions($context, $data, $defsearch, $bypass_isnearest = false)
	{
		$defsfound = [];
		if(is_null($data))
			return $defsfound;

		foreach($data as $def)
		{
			if($def->get_name() === $defsearch->get_name() 
					&& $def->get_assign_id() != $defsearch->get_assign_id()
					&& $def->property->get_properties() === $defsearch->property->get_properties() 
					&& ResolveDefs::is_nearest($context, $defsearch, $defsearch->getLine(), $defsearch->getColumn(), $def, $def->getLine(), $def->getColumn())
					&& (($def->get_array_value() === $defsearch->get_array_value()) || ($def->get_is_copy_array() && $defsearch->get_is_array()) || $bypass_isnearest))
			{
				// CA SERT A QUOI ICI REDONDANT AVEC LE DERNIER ?
				if($def->get_is_instance() && $defsearch->get_is_instance())
				{		
					$defsfound[$def->get_block_id()][] = $def;
				}

				else if(($def->get_is_property() == $defsearch->get_is_property())
						|| ($def->get_is_instance() == $defsearch->get_is_instance()))
				{	
					if($def->get_is_property() && $defsearch->get_is_property())
						$defsfound[$def->get_block_id()][] = $def;

					else if(!$def->get_is_property() && !$defsearch->get_is_property())
						$defsfound[$def->get_block_id()][] = $def;

				}
				// we are looking for the nearest not instance of a property
				else if(!$def->get_is_instance() && $defsearch->get_is_property())
				{
					$defsfound[$def->get_block_id()][] = $def;
				}

			}
		}

		// si on a trouvé des defs dans le même bloc que la ou on cherche elles killent les autres	
		if(isset($defsfound[$defsearch->get_block_id()]) 
				&& count($defsfound[$defsearch->get_block_id()]) > 0)
			$defsfound_good[$defsearch->get_block_id()] = $defsfound[$defsearch->get_block_id()];
		else 
			$defsfound_good = $defsfound;

		$truedefsfound = [];

		foreach($defsfound_good as $blockdefs)
		{
			$nearestdef = null;

			foreach($blockdefs as $block_id => $deflast)
			{
				if(!$bypass_isnearest)
				{
					if(ResolveDefs::is_nearest($context, $defsearch, $defsearch->getLine(), $defsearch->getColumn(), $deflast, $deflast->getLine(), $deflast->getColumn()))
					{
						if(is_null($nearestdef) || ResolveDefs::is_nearest($context, $deflast, $deflast->getLine(), $deflast->getColumn(), $nearestdef, $nearestdef->getLine(), $nearestdef->getColumn()))
						{
							$nearestdef = $deflast;
						}
					}
				}
				else
					$truedefsfound[] = $deflast;
			}

			if(!is_null($nearestdef) && !$bypass_isnearest)
				$truedefsfound[] = $nearestdef;
		}

		return $truedefsfound;
	}

	public static function select_instances($context, $data, $tempdefa, $bypass_isnearest = false)
	{
		$instances_defs = [];

		// we can have multiple instances with the same property assigned
		// we are looking for and instance, not a property	
		$copy_tempdefa = clone $tempdefa;

		if(count($tempdefa->property->get_properties()) == 0)
			$copy_tempdefa->set_is_property(false);

		$copy_tempdefa->set_is_instance(true);
		$copy_tempdefa->set_is_array(false);
		$copy_tempdefa->set_array_value(false);

		$instances_defs = ResolveDefs::select_definitions(
				$context, 
				$data, 
				$copy_tempdefa, 
				$bypass_isnearest);


		return $instances_defs;
	}

	public static function select_properties($context, $data, $tempdefa, $bypass_visibility = false)
	{
		$properties_defs = [];

		if($tempdefa->get_is_property())
		{
			$prop_line = $tempdefa->getLine();
			$prop_column = $tempdefa->getColumn();
			$tempdefa_prop = clone $tempdefa;
			$first_properties = [];
			$is_first_property = true;
			$property_exist = false;

			if(is_array($tempdefa->property->get_properties()))
			{
				foreach($tempdefa->property->get_properties() as $prop)
				{
					$tempdefa_prop->setLine($prop_line);
					$tempdefa_prop->setColumn($prop_column);

					$defs = ResolveDefs::select_definitions(
							$context, 
							$data, 
							$tempdefa_prop,
							$bypass_visibility);

					$prop = $tempdefa_prop->property->pop_property();

					if(count($defs) > 0)
					{
						foreach($defs as $defa)
						{	
							if($defa->get_is_property())
							{
								// if we found a property, we are looking for the nearest instance or not instance
								// and we are looking for an instance that contains this visible property
								$instances = ResolveDefs::select_instances($context, $data, $tempdefa_prop);

								foreach($instances as $instance)
								{
									$tmp_myclasses = $instance->get_all_myclass();

									foreach($tmp_myclasses as $tmp_myclass)
									{
										$property = $tmp_myclass->get_property($prop);

										if(!is_null($property) && (ResolveDefs::get_visibility($defa, $property) || $bypass_visibility))
										{
											$property_exist = true;

											if($is_first_property || $bypass_visibility)
											{
												$is_first_property = false;

												// if the instance is nearest (deeper) than the property, it has the priority
												if(ResolveDefs::is_nearest($context, $instance, $instance->getLine(), $instance->getColumn(), $defa, $defa->getLine(), $defa->getColumn()))
													$first_properties[] = $property;
												// else property exist in the nearest instance but property has the priority
												else
													$first_properties[] = $defa; 

											}
										}
									}
								}

								if(count($instances) == 0 && $first_properties)
								{
									$property_exist = true;
									$first_properties[] = $defa;  
								}
							}
						}
					}
					else
					{
						// we didn't find a property, we are looking for the nearest instance or not instance
						$instances = ResolveDefs::select_instances($context, $data, $tempdefa_prop);


						foreach($instances as $instance)
						{
							if($instance->get_is_instance())
							{
								$tmp_myclasses = $instance->get_all_myclass();

								foreach($tmp_myclasses as $tmp_myclass)
								{
									$property = $tmp_myclass->get_property($prop);

									if(!is_null($property) && (ResolveDefs::get_visibility($tempdefa_prop, $property) || $bypass_visibility))
									{
										$properties_defs[] = $property;    
									}
								}
							}
						}
					}

					if(!$property_exist)
						break;
				}
			}

			if($property_exist)
			{
				foreach($first_properties as $first_property)
				{
					$properties_defs[] = $first_property;  
				}
			}

		}

		return $properties_defs;
	}

	public static function temporary_simple($context, $data, $tempdefa)
	{
		if($tempdefa->get_is_property())
			$defs = ResolveDefs::select_properties(
					$context, 
					$data->getoutminuskill($tempdefa->get_block_id()), 
					$tempdefa);

		else
			$defs = ResolveDefs::select_definitions(
					$context, 
					$data->getoutminuskill($tempdefa->get_block_id()), 
					$tempdefa);

		$myexpr = $tempdefa->get_exprs()[0]; 

		$gooddefs = [];
		if(count($defs) > 0)
		{
			foreach($defs as $defz)
			{	
				$defaa = ArrayAnalysis::temporary_simple($context, $tempdefa, $defz);

				foreach($defaa as $defa)
				{
					if($defa->is_ref())
					{
						$refdef = new MyDefinition($tempdefa->getLine(), $tempdefa->getColumn(), $defa->get_ref_name());
						$refdef->set_block_id($tempdefa->get_block_id());
						$refdef->set_source_myfile($tempdefa->get_source_myfile());

						if($defa->is_ref_arr())
						{  
							$refdef->set_is_array(true);
							$refdef->set_array_value($defa->get_ref_arr_value());
						}

						$truerefs = ResolveDefs::select_definitions($context, 
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
		}
		else
		{
			$myexpr->add_def($tempdefa);
			$gooddefs[] = $tempdefa;
		}

		return $gooddefs;
	}
}
