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
                    echo "TwigAnalysis:: arr_index = $arr_index\n";
                    
                    $mydef = new MyDefinition(0, 0, $arr_index, false, false);
                    
                    if($def->is_tainted())
                    {
                        echo "C'EST TAINTé!\n";
                        $mydef->set_tainted(true);
                    }
                    
                    $thedefs[] = $mydef;
                }
                
                shell_exec("node ./vendor/progpilot/package/src/progpilot/Transformations/Js/Transform.js $file > tmpjscode.txt");
                
                $mycode = new MyCode;
                $mycode->read_code("tmpjscode.txt", $thedefs);
                $mycode->set_start(0);
                $mycode->set_end(count($mycode->get_codes()));
                
                $newcontext = clone $context;
                $newcontext->set_mycode($mycode);
                
                $analyzer = new Analyzer;
                $analyzer->run($newcontext);
                
                unlink("tmpjscode.txt");
            }
        }
	}
}
