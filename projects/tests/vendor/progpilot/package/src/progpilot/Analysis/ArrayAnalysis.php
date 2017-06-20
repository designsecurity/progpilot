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

use progpilot\Dataflow\Definitions;
use progpilot\Transformations\Php\BuildArrays;

use progpilot\Code\Opcodes;

class ArrayAnalysis {


	public function __construct() {

	}

	// mettre la plus grosse boucle dans visitor analysis
	public static function temporary_simple($data, $defs, $myinstance)
	{		
		foreach($defs as $def)
		{		
			if(($def->is_property() && $def->get_visibility()) 
					|| !$def->is_property()) 
			{
				$exprs = $def->get_exprs();
				foreach($exprs as $expr)
				{
					if($expr->is_assign())
					{
						$defassign = $expr->get_assign_def();

						ArrayAnalysis::copy_array($data, $def, $def->get_arr_value(), $defassign, $defassign->get_arr_value());

					}
				}
			}
		}
	}

	public static function end_assign($data, $instruction, $instruction_arr, $instruction_ori)
	{
		$myexpr = $instruction->get_property("expr");
		if($myexpr->is_assign())
		{
			$codeapres = $instruction_arr->get_opcode();

			if($codeapres == Opcodes::DEFINITION)
				$copytab = $instruction_arr->get_property("def");

			$codeavant = $instruction_ori->get_opcode();

			if($codeavant == Opcodes::TEMPORARY)
			{
				$originaltab = $instruction_ori->get_property("temporary");

				ArrayAnalysis::copy_array($data, $originaltab, $originaltab->get_arr_value(), $copytab, $copytab->get_arr_value());
			}
		}
	}

	public static function end_expression($data, $instruction, $instruction_arr, $instruction_ori)
	{
		$myexpr = $instruction->get_property("expr");
		if($myexpr->is_assign())
		{
			$codeapres = $instruction_arr->get_opcode();

			if($codeapres == Opcodes::DEFINITION)
				$copytab = $instruction_arr->get_property("def");

			$codeavant = $instruction_ori->get_opcode();

			if($codeavant == Opcodes::TEMPORARY)
			{
				$originaltab = $instruction_ori->get_property("temporary");

				ArrayAnalysis::copy_array($data, $originaltab, $originaltab->get_arr_value(), $copytab, $copytab->get_arr_value());
			}
		}
	}

	public static function funccall_before($data, $myfunc, $myfunc_call, $instruction)
	{
		$nbparams = 0;
		$params = $myfunc->get_params();
		foreach($params as &$param)
		{
			if($instruction->is_property_exist("argdef$nbparams"))
			{
				$defarg = $instruction->get_property("argdef$nbparams"); 

				$newparam = clone $param;
				$myfunc_call->add_param($newparam);

				// original et copie (source et cible)
				ArrayAnalysis::copy_array($data, $defarg, $defarg->get_arr_value(), $newparam, false);

				$nbparams ++;
				unset($defarg);
			}
		}

		$nbparams = 0;       
		foreach($params as &$param)
		{
			$func_param = $myfunc_call->get_param($nbparams);

			if($func_param != null)
			{
				$oldcopyarray = $param->is_copyarray();
				$oldcopyarrays = $param->get_copyarrays();

				$param->set_copyarray($func_param->is_copyarray());
				$param->set_copyarrays($func_param->get_copyarrays());

				$func_param->set_copyarray($oldcopyarray);
				$func_param->set_copyarrays($oldcopyarrays);
			}

			$nbparams ++;
		}
	}

	public static function funccall_after($myfunc, $myfunc_call, $arr_funccall, $op_apr)
	{	
		if($op_apr->get_opcode() == Opcodes::DEFINITION)
		{
			$copytab = $op_apr->get_property("def");

			$originaltabs = $myfunc->get_return_defs();
			$originaltab = &$originaltabs[0];

			// on copie le tableau retourné dans la définition
			if(count($originaltabs) >= 1)
			{					
				ArrayAnalysis::copy_array($myfunc->get_defs(), $originaltab, $arr_funccall, $copytab, $copytab->get_arr_value());
			}                   
		}

		// on remet les paramètres originaux si d'autres appels
		$nbparams = 0;
		$params = $myfunc->get_params();
		foreach($params as &$param)
		{
			$func_param = $myfunc_call->get_param($nbparams);

			if($func_param != null)
			{
				$oldcopyarray = $func_param->is_copyarray();
				$oldcopyarrays = $func_param->get_copyarrays();

				$func_param->set_copyarray($param->is_copyarray());
				$func_param->set_copyarrays($param->get_copyarrays());

				$param->set_copyarray($oldcopyarray);
				$param->set_copyarrays($oldcopyarrays);
				$nbparams ++;
			}
		}
		unset($params);
	}

	public static function copy_array($data, $originaltab, $originalarr, $copytab, $copyarr) {

		if($originaltab != null && $copytab != null)
		{
			$defs = Definitions::search_force(
					$data->getin($originaltab->get_block_id()), 
					$originaltab);    

			if(count($defs) > 0)
			{
				foreach($defs as $defa)
				{
					if($defa->is_copyarray())
					{
						$copyarrays = $defa->get_copyarrays();

						foreach($copyarrays as $value)
						{
							$arrvalue = $value[0];
							$defarr = $value[1];

							$extract = BuildArrays::extract_array_from_arr($arrvalue, $originalarr); 
							$extractbis = BuildArrays::build_array_from_arr($copyarr, $extract);

							$copytab->add_copyarray($extractbis, $defarr);
							$copytab->set_copyarray(true);

							unset($defarr);
						}
					}
					else
					{
						$extract = BuildArrays::extract_array_from_arr($defa->get_arr_value(), $originalarr);         


						// si on cherchait $copy = $array[11] ici il y a des arrays de type $array[11][quelquechose]
						// ou deuxieme cas
						// si on cherchait $copy = $arrays ici il y a des arrays de type $arrays[quelquechose]
						if($extract != false)
						{
							// si on a $copy[11] = $array[12] on veut $copy[11][12]
							if($copyarr != false)
								$extract = BuildArrays::build_array_from_arr($copyarr, $extract);

							$copytab->add_copyarray($extract, $defa);
							$copytab->set_copyarray(true);
						}
					}

					unset($defa);
				}
			}

			unset($defs);
		}
	}
}
