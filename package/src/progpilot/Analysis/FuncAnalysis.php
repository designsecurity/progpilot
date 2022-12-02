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
        $myFunc,
        $context,
        $myClass,
        $myFuncCall,
        $instruction
    ) {
        $resultid = $instruction->getProperty(MyInstruction::RESULTID);
        $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);

        $myFuncReturn = new MyDefinition(
            $context->getCurrentBlock()->getId(),
            $context->getCurrentMyFile(),
            $myFuncCall->getLine(),
            $myFuncCall->getColumn(),
            $myFuncCall->getName()."_return"
        );

        $opInformation["chained_results"][] = $myFuncReturn;

        \progpilot\Analysis\CustomAnalysis::defineObject(
            $context,
            $instruction,
            $myFuncCall,
            $myClass,
            $myFuncReturn
        );

        \progpilot\Analysis\CustomAnalysis::returnObject(
            $context,
            $myFuncCall,
            $myClass,
            $instruction,
            $myFuncReturn
        );

        $opInformationValid = TaintAnalysis::funccallValidator(
            $context,
            $myFunc,
            $myClass,
            $instruction
        );

        TaintAnalysis::funccallSanitizer(
            $myFunc,
            $context,
            $myClass,
            $instruction,
            $myFuncReturn
        );

        TaintAnalysis::funccallSource($context, $myClass, $instruction, $myFuncReturn);

        if (is_null($myFunc)) {
            ResolveDefs::funccallReturnValues($myFuncCall, $instruction, $myFuncReturn);
        }
        SecurityAnalysis::funccall($context, $instruction, $myClass);

        if (!is_null($opInformationValid)) {
            $opInformation["condition_defs"] = $opInformationValid["condition_defs"];
            $opInformation["valid_when_returning"] = $opInformationValid["valid_when_returning"];
        }

        // could be merged with funccallclass (new instance)
        if (!is_null($myFunc)) {
            if ($myFuncCall->getName() !== "__construct" && !empty($myFunc->getReturnDefs())) {
                foreach ($myFunc->getReturnDefs() as $returnDef) {
                    $opInformation["chained_results"][] = $returnDef;
                }
            }
        }
        
        $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
    }

    public static function funccallBefore($myFunc, $instruction)
    {
        $nbParams = 0;
        $params = $myFunc->getParams();

        foreach ($params as $param) {
            if ($instruction->isPropertyExist("argdef$nbParams")) {
                $defArg = $instruction->getProperty("argdef$nbParams");

                $param->setParamToArg($defArg);
                $defArg->setArgToParam($param);
                
                $state = $defArg->createState();
                $defArg->assignStateToBlockId($state->getId(), $param->getBlockId());

                $nbParams ++;
            }
        }
    }
}
