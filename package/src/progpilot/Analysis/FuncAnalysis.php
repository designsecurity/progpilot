<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyDefinition;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;

class FuncAnalysis
{
    public static function funccallAfter($context, $data, $myfunc_call, $myfunc, $arr_funccall, $instruction, $op_apr)
    {
        $exprreturn = $instruction->getProperty(MyInstruction::EXPR);

        if (!is_null($myfunc)) {
            $defsreturn = $myfunc->getReturnDefs();
            foreach ($defsreturn as $defreturn) {
                if (($arr_funccall !== false
                    && $defreturn->isType(MyDefinition::TYPE_ARRAY)
                        && $defreturn->getArrayValue() === $arr_funccall)
                            || ($arr_funccall === false && !$defreturn->isType(MyDefinition::TYPE_ARRAY))) {
                    $copydefreturn = $defreturn;

                    // copydefreturn = return $defreturn;
                    $copydefreturn->setExpr($exprreturn);
                    // exprreturn = $def = exprreturn(funccall());
                    $exprreturn->addDef($copydefreturn);


                    $expr = $copydefreturn->getExpr();
                    if ($expr->isAssign()) {
                        $defassign = $expr->getAssignDef();
                        //TaintAnalysis::setTainted($copydefreturn, $defassign, $expr);

                        if (ResolveDefs::getVisibilityFromInstances($context, $data, $defassign)) {
                            ValueAnalysis::copyValues($copydefreturn, $defassign);
                            TaintAnalysis::setTainted($copydefreturn->isTainted(), $defassign, $expr);
                        }

                        ArrayAnalysis::copyArrayFromDef(
                            $defreturn,
                            $arr_funccall,
                            $defassign,
                            $defassign->getArrayValue()
                        );
                    }
                }
            }

            if ($op_apr->getOpcode() === Opcodes::DEFINITION) {
                $copytab = $op_apr->getProperty(MyInstruction::DEF);

                $originaltabs = $myfunc->getReturnDefs();

                foreach ($originaltabs as $originaltab) {
                    ArrayAnalysis::copyArrayFromDef($originaltab, $arr_funccall, $copytab, $copytab->getArrayValue());
                }
            }
        }
    }

    public static function funccallBefore($context, $data, $myfunc, $myfunc_call, $instruction)
    {
        $nbparams = 0;
        $params = $myfunc->getParams();

        foreach ($params as $param) {
            if ($instruction->isPropertyExist("argdef$nbparams")) {
                $defarg = $instruction->getProperty("argdef$nbparams");
                $exprarg = $instruction->getProperty("argexpr$nbparams");

                $newparam = clone $param;
                $myfunc_call->addParam($newparam);

                $newparam->setLastKnownValues($defarg->getLastKnownValues());
                ArrayAnalysis::copyArrayFromDef($defarg, $defarg->getArrayValue(), $newparam, false);

                $param->setCopyArrays($newparam->getCopyArrays());
                $param->setLastKnownValues($newparam->getLastKnownValues());
                $param->setType($newparam->getType());

                if ($defarg->isTainted()) {
                    // useful just for inside the function
                    TaintAnalysis::setTainted($defarg->isTainted(), $param, $exprarg);

                    $expr = $param->getExpr();

                    if (!is_null($expr) && $expr->isAssign()) {
                        $defassign = $expr->getAssignDef();

                        if (ResolveDefs::getVisibilityFromInstances($context, $data, $defassign)) {
                            ValueAnalysis::copyValues($defarg, $defassign);
                            TaintAnalysis::setTainted($defarg->isTainted(), $defassign, $expr);
                        }
                    }
                }

                $nbparams ++;
                unset($defarg);
            }
        }

        unset($params);
    }
}
