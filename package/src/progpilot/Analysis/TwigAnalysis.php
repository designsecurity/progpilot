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
    public static function funccall($context, $myFuncCall, $instruction)
    {
        $nbParams = $myFuncCall->getNbParams();
        $path = $context->getPath();

        // !!! Ca peut être 1 aussi quand on passe pas de variables
        if ($nbParams === 2) {
            $template = $instruction->getProperty("argdef0");
            $variable = $instruction->getProperty("argdef1");

            $file = $path."/".$template->getLastKnownValues()[0];
            $myJavascriptFile = new MyFile($file, $myFuncCall->getLine(), $myFuncCall->getColumn());

            if (file_exists($file)) {
                $theDefs = [];
                $theArrays = $variable->getCopyArrays();
                
                foreach ($theArrays as $array) {
                    $def = $array[1];
                    $arr = $array[0];

                    $arrIndex = "{{".key($arr)."}}";

                    $myDef = new MyDefinition($def->getLine(), $def->getColumn(), $arrIndex);
                    $myDef->setSourceMyFile($myJavascriptFile);

                    if ($def->isTainted()) {
                        $myDef->setTainted(true);
                    }
                    
                    $theDefs[] = $myDef;
                }

                $newContext = new \progpilot\Context;
                $newContext->setInputs(clone $context->getInputs());
                $newContext->inputs->setFile($file);
                $newContext->outputs->setResults($context->outputs->getResults());
                $newContext->setCurrentMyfile(new MyFile($file, 0, 0));

                $analyzer = new Analyzer;
                $analyzer->runInternalJs($newContext, $theDefs, true);
            }
        }
    }
}
