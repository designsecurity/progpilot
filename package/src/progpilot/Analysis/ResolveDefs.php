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

	public static function temporary_simple($data, $tempdefa, $inside_class)
	{
		$myexpr = $tempdefa->get_exprs()[0];

		if($tempdefa->is_property())
			$tempdefa->set_instance(true);
				
       // echo "ResolveDefs::temporary_simple\n";
       // $tempdefa->print_stdout();

		$defs = Definitions::search_nearest(
				$tempdefa->getLine(), 
				$tempdefa->getColumn(), 
				$data->getin($tempdefa->get_block_id()), 
				$tempdefa, 
				$inside_class);

		$gooddefs = [];
		if(count($defs) > 0)
		{
			foreach($defs as $defa)
			{
                //echo "ResolveDefs::temporary_simple foreach defa\n";
                //$defa->print_stdout();
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
							$data->getin($refdef->get_block_id()), 
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
