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

use progpilot\objects\MyFile;
use progpilot\objects\MyDefinition;
use progpilot\Code\MyCode;
use progpilot\Analyzer;

class TwigAnalysis
{
    public static function funccall($context, $myfunc_call, $instruction)
    {
        $nb_params = $myfunc_call->getNbParams();
        $path = $context->getPath();

        // !!! Ca peut être 1 aussi quand on passe pas de variables
        if ($nb_params === 2) {
            $template = $instruction->getProperty("argdef0");
            $variable = $instruction->getProperty("argdef1");

            $file = $path."/".$template->getLastKnownValues()[0];
            $myjavascript_file = new MyFile($file, $myfunc_call->getLine(), $myfunc_call->getColumn());

            if (file_exists($file)) {
                $thedefs = [];
                $thearrays = $variable->getCopyArrays();

                foreach ($thearrays as $array) {
                    $def = $array[1];
                    $arr = $array[0];

                    $arr_index = "{{".key($arr)."}}";

                    $mydef = new MyDefinition($def->getLine(), $def->getColumn(), $arr_index);
                    $mydef->setSourceMyFile($myjavascript_file->getSourceMyFile());

                    if ($def->isTainted()) {
                        $mydef->setTainted(true);
                    }

                    $thedefs[] = $mydef;
                }

                $exec = "node ./vendor/progpilot/package/src/progpilot/Transformations/Js/Transform.js";
                $exec .= " $file > tmpjscode.txt";
                shell_exec($exec);

                $newcontext = new \progpilot\Context;

                MyCode::readCode($newcontext, "tmpjscode.txt", $thedefs, $myjavascript_file);

                $newcontext->setInputs($context->getInputs());
                $newcontext->outputs->setResults($context->outputs->getResults());
                $newcontext->set_first_file($file);

                $analyzer = new Analyzer;
                $analyzer->run($newcontext, false);

                unlink("tmpjscode.txt");
            }
        }
    }
}
