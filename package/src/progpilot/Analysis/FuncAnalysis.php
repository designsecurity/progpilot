<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;

use progpilot\Helpers\Analysis as HelpersAnalysis;

class FuncAnalysis
{
    public static function funccallAfter(
        $context,
        $data,
        $myFuncCall,
        $myFunc,
        $arrFuncCall,
        $instruction,
        $code,
        $index
    ) {
        $exprReturn = $instruction->getProperty(MyInstruction::EXPR);
        $varid = $instruction->getProperty(MyInstruction::VARID);
        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

        $i = 0;

        if (!is_null($myFunc)) {
            if ($myFuncCall->getName() !== "__construct" && !empty($myFunc->getReturnDefs())) {
                $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);
                $opInformation["chained_results"] = $myFunc->getReturnDefs();
                $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
            }
        }
    }

    public static function funccallBefore($context, $data, $myFunc, $myFuncCall, $instruction)
    {
        $nbParams = 0;
        $params = $myFunc->getParams();

        foreach ($params as $param) {
            if ($instruction->isPropertyExist("argdef$nbParams")) {
                $defArg = $instruction->getProperty("argdef$nbParams");
                $exprArg = $instruction->getProperty("argexpr$nbParams");

                $param->setParamToArg($defArg);
                $defArg->setArgToParam($param);
                
                $state = $defArg->createState();
                $defArg->assignStateToBlockId($state->getId(), $param->getBlockId());
                //$defArg->setState($defArg->getCurrentState(), $param->getBlockId());

                $nbParams ++;
            }
        }
    }
}
