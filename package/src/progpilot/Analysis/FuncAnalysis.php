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

        echo "funccallAfter 1 '".$myFuncCall->getName()."'\n";
        if (!is_null($myFunc)) {
            echo "myblock callee id '".$myFuncCall->getBlockId()."'\n";
            echo "funccallAfter 2 '".$myFuncCall->getName()."'\n";
            $defsReturn = $myFunc->getReturnDefs();
            foreach ($defsReturn as $defReturn) {
                echo "funccallAfter 3 '".$myFuncCall->getName()."' one def return\n";
                echo "funccallAfter 3 myblock caller currentstate'".$defReturn->getBlockId()."'of def return\n";

                if ($defReturn->getCurrentState()->isType(MyDefinition::TYPE_INSTANCE)) {
                    echo "updateBlocksOfProperties force\n";
                    //HelpersAnalysis::updateBlocksOfProperties($context, $defReturn);
                }
                /*
                if (($arrFuncCall !== false
                    && $defReturn->isType(MyDefinition::TYPE_ARRAY)
                        && $defReturn->getArrayValue() === $arrFuncCall)
                            || ($arrFuncCall === false && !$defReturn->isType(MyDefinition::TYPE_ARRAY))) {
                    $copyDefReturn = $defReturn;

                    $copyDefReturn->setExpr($exprReturn);
                    $defReturn->setCast($myFuncCall->getCastReturn());
                    $exprReturn->addDef($copyDefReturn);

                    $expr = $copyDefReturn->getExpr();
                    if ($expr->isAssign()) {
                        $defAssign = $expr->getAssignDef();
                        //TaintAnalysis::setTainted($copyDefReturn, $defAssign);

                        if (ResolveDefs::getVisibilityFromInstances($context, $data, $defAssign)) {
                            ValueAnalysis::copyValues($copyDefReturn, $defAssign);
                            TaintAnalysis::setTainted($copyDefReturn, $defAssign);
                        }

                        ArrayAnalysis::copyArrayFromDef(
                            $defReturn,
                            $arrFuncCall,
                            $defAssign,
                            $defAssign->getArrayValue()
                        );
                    }
                }*/
            }
/*
            $previousOpInformation = $context->getCurrentFunc()->getOpInformation($varid);
            if (!is_null($previousOpInformation)) {
                $opInformation["def_assign"] = $previousOpInformation["def_assign"];
            }*/
            




            if ($myFuncCall->getName() !== "__construct" && !empty($myFunc->getReturnDefs())) {
                echo "funccallAfter 2 '$resultid'\n";

                $opInformation["chained_results"] = $myFunc->getReturnDefs();
                echo "storeopinformation here returndef '$resultid'\n";
                $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
            }
        }
    }

    public static function funccallBefore($context, $data, $myFunc, $myFuncCall, $instruction)
    {
        echo "funccallBefore 1_____\n";
        $nbParams = 0;
        $params = $myFunc->getParams();

        foreach ($params as $param) {
            echo "funccallBefore 2____\n";
            if ($instruction->isPropertyExist("argdef$nbParams")) {
                $defArg = $instruction->getProperty("argdef$nbParams");
                $exprArg = $instruction->getProperty("argexpr$nbParams");

                $param->setParamToArg($defArg);
                $defArg->setArgToParam($param);
                
                $defArg->setState($defArg->getCurrentState(), $param->getBlockId());

                $nbParams ++;
                echo "funccallBefore 3_____\n";
                echo "funccallBefore 3 param_____\n";
                $param->printStdout();
                echo "funccallBefore 3 defarg\n";
                $defArg->printStdout();
            }
        }
    }
}
