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

use progpilot\objects\MyDefinition;
use progpilot\Code\MyCode;
use progpilot\Analyzer;

class TwigAnalysis {

	public static function funccall($context, $myfunc_call, $instruction)
	{
		$nb_params = $myfunc_call->get_nb_params();
		$path = $context->get_path();
		
		// !!! Ca peut être 1 aussi quand on passe pas de variables
		if($nb_params == 2)
		{
            $template = $instruction->get_property("argdef0");
            $variable = $instruction->get_property("argdef1");
            
            $file = $path."/".$template->get_last_known_value();
            
            if(file_exists($file))
            {
                $thedefs = [];
                $thearrays = $variable->get_copyarrays();
                
                foreach($thearrays as $array)
                {
                    $def = $array[1];
                    $arr = $array[0];
                    
                    $arr_index = "{{".key($arr)."}}";
                    
                    $mydef = new MyDefinition(0, 0, $arr_index, false, false);
                    $mydef->set_assign_id(rand());
                    
                    if($def->is_tainted())
                        $mydef->set_tainted(true);
                    
                    $thedefs[] = $mydef;
                }
                
                shell_exec("node ./vendor/progpilot/package/src/progpilot/Transformations/Js/Transform.js $file > tmpjscode.txt");
                
                $newcontext = new \progpilot\Context;
                
                MyCode::read_code($newcontext, "tmpjscode.txt", $thedefs);
                
                $newcontext->set_inputs($context->get_inputs());
                $newcontext->set_results($context->get_results());
                
                $analyzer = new Analyzer;
                $analyzer->run($newcontext, false);
                
                unlink("tmpjscode.txt");
            }
        }
	}
}
