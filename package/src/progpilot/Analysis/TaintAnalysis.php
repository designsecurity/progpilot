<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyOp;
use progpilot\Objects\MyCode;
use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyInstance;
use progpilot\Objects\MyAssertion;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyFunction;

use progpilot\Dataflow\Definitions;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;
use progpilot\Inputs\MySource;

class TaintAnalysis
{
    public static function funccallSpecifyAnalysis(
        $myfunc,
        $stack_class,
        $context,
        $data,
        $myclass,
        $myfunc_call,
        $arr_funccall,
        $instruction,
        $mycode,
        $index
    ) {
        $stack_class = ResolveDefs::funccallClass($context, $data, $myfunc_call);

        TaintAnalysis::funccallValidator($stack_class, $context, $data, $myclass, $instruction, $mycode, $index);
        TaintAnalysis::funccallSanitizer(
            $myfunc,
            $stack_class,
            $context,
            $data,
            $myclass,
            $instruction,
            $mycode,
            $index
        );
        TaintAnalysis::funccallSource($stack_class, $context, $data, $myclass, $instruction);


        SecurityAnalysis::funccall($stack_class, $context, $instruction, $myclass);
    }

    public static function funccallValidator($stack_class, $context, $data, $myclass, $instruction, $mycode, $index)
    {
        $funcname = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arr_funccall = $instruction->getProperty(MyInstruction::ARR);
        $myfunc_call = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $nbparams = 0;
        $defs_valid = [];
        $condition_respected = true;

        $myvalidator = $context->inputs->getValidatorByName($stack_class, $myfunc_call, $myclass);
        if (!is_null($myvalidator)) {
            while (true) {
                if (!$instruction->isPropertyExist("argdef$nbparams")) {
                    break;
                }

                $defarg = $instruction->getProperty("argdef$nbparams");
                $exprarg = $instruction->getProperty("argexpr$nbparams");

                $condition = $myvalidator->getParameterCondition($nbparams + 1);
                if ($condition === "valid" && !$exprarg->getIsConcat()) {
                    $thedefsargs = $exprarg->getDefs();

                    foreach ($thedefsargs as $thedefsarg) {
                        $defs_valid[] = $thedefsarg;
                    }
                } elseif ($condition === "array_not_tainted") {
                    if ($defarg->isType(MyDefinition::TYPE_ARRAY) && $defarg->isTainted()) {
                        $condition_respected = false;
                    } elseif ($defarg->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                        $copyarrays = $defarg->getCopyArrays();
                        foreach ($copyarrays as $copyarray) {
                            $arrvalue = $copyarray[0];
                            $defarr = $copyarray[1];

                            if ($defarr->isTainted()) {
                                $condition_respected = false;
                            }
                        }
                    }
                } elseif ($condition === "not_tainted") {
                    if ($defarg->isTainted()) {
                        $condition_respected = false;
                    }
                } elseif ($condition === "equals") {
                    $condition_respected_equals = false;
                    $values = $myvalidator->getParameterValues($nbparams + 1);

                    if (!is_null($values)) {
                        $thedefsargs = $exprarg->getDefs();
                        if (count($thedefsargs) > 0) {
                            foreach ($values as $value) {
                                foreach ($thedefsargs[0]->getLastKnownValues() as $last_known_value) {
                                    if ($value->value === $last_known_value) {
                                        $condition_respected_equals = true;
                                    }
                                }
                            }
                        }
                    }

                    if (!$condition_respected_equals) {
                        $condition_respected = false;
                    }
                }

                $nbparams ++;
            }
        }

        if (count($defs_valid) > 0) {
            if ($condition_respected) {
                $codes = $mycode->getCodes();

                if (isset($codes[$index + 2])) {
                    $instruction_if = $codes[$index + 2];
                    if ($instruction_if->getOpcode() === Opcodes::COND_START_IF) {
                        $myblock_if = $instruction_if->getProperty(MyInstruction::MYBLOCK_IF);
                        $myblock_else = $instruction_if->getProperty(MyInstruction::MYBLOCK_ELSE);

                        foreach ($defs_valid as $def_valid) {
                            $type = "valid";
                            $myassertion = new MyAssertion($def_valid, $type);

                            if ($instruction_if->isPropertyExist(MyInstruction::NOT_BOOLEAN)) {
                                $myblock_else->addAssertion($myassertion);
                            } else {
                                $myblock_if->addAssertion($myassertion);
                            }
                        }
                    }
                }
            }
        }
    }

    public static function funccallSanitizer(
        $myfunc,
        $stack_class,
        $context,
        $data,
        $myclass,
        $instruction,
        $mycode,
        $index
    ) {
        $funcname = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arr_funccall = $instruction->getProperty(MyInstruction::ARR);
        $myfunc_call = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $condition_sanitize = false;
        $condition_taint = false;
        $params_tainted_condition_taint = false;

        $params_tainted = false;
        $params_sanitized = false;
        $params_type_sanitized = [];

        $nbparams = 0;
        $condition_respected_final = true;

        $mytemp_return = new MyDefinition(
            $myfunc_call->getLine(),
            $myfunc_call->getColumn(),
            "return_".$myfunc_call->getName()
        );
        $mytemp_return->setSourceMyFile($context->getCurrentMyfile());

        $myexpr_return1 = new MyExpr($myfunc_call->getLine(), $myfunc_call->getColumn());
        $myexpr_return1->setAssign(true);
        $myexpr_return1->setAssignDef($mytemp_return);
        $myexpr_return1->addDef($mytemp_return);

        $myexpr_return2 = new MyExpr($myfunc_call->getLine(), $myfunc_call->getColumn());
        $myexpr_return2->setAssign(true);
        $myexpr_return2->setAssignDef($mytemp_return);

        $mysanitizer = $context->inputs->getSanitizerByName($stack_class, $myfunc_call, $myclass);

        if (!is_null($mysanitizer)) {
            $prevent_final = $mysanitizer->getPrevent();
        }

        while (true) {
            if (!$instruction->isPropertyExist("argdef$nbparams")) {
                break;
            }

            $defarg = $instruction->getProperty("argdef$nbparams");
            $exprarg = $instruction->getProperty("argexpr$nbparams");

            if (is_null($myfunc) || !is_null($mysanitizer)) {
                if ($defarg->isTainted()) {
                    $params_tainted = true;
                    $myexpr_return2->addDef($defarg);
                }

                if ($defarg->isSanitized()) {
                    $params_sanitized = true;
                    $tmps = $defarg->getTypeSanitized();

                    foreach ($tmps as $tmp) {
                        if (!in_array($tmp, $params_type_sanitized, true)) {
                            $params_type_sanitized[] = $tmp;
                        }
                    }
                }
            }

            if (!is_null($mysanitizer)) {
                $condition = $mysanitizer->getParameterCondition($nbparams + 1);

                if ($condition === "equals") {
                    $condition_respected = false;
                    $values = $mysanitizer->getParameterValues($nbparams + 1);

                    if (!is_null($values)) {
                        $thedefsargs = $exprarg->getDefs();
                        if (count($thedefsargs) > 0) {
                            foreach ($values as $value) {
                                foreach ($thedefsargs[0]->getLastKnownValues() as $last_known_value) {
                                    if ($value->value === $last_known_value) {
                                        $condition_respected = true;

                                        if (isset($value->prevent)) {
                                            $prevent_final = array_merge($prevent_final, $value->prevent);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    if (!$condition_respected) {
                        $condition_respected_final = false;
                    }
                } elseif ($condition === "taint") {
                    $condition_taint = true;
                    if ($defarg->isTainted()) {
                        $params_tainted_condition_taint = true;
                        $myexpr_return2->addDef($defarg);
                    }
                } elseif ($condition === "sanitize") {
                    $condition_sanitize = true;
                    $exprs_tainted_condition_sanitize[] = $exprarg;
                }
            }

            $nbparams ++;
        }

        $return_sanitizer = false;

        $codes = $mycode->getCodes();
        if (isset($codes[$index + 2]) && $codes[$index + 2]->getOpcode() === Opcodes::END_ASSIGN) {
            $instruction_def = $codes[$index + 3];
            $mydef_return = $instruction_def->getProperty(MyInstruction::DEF);
            $return_sanitizer = true;
        }

        // the return of func will be tainted if one of arg is tainted
        if ($return_sanitizer) {
            TaintAnalysis::setTainted($params_tainted, $mytemp_return, $myexpr_return2);
        }

        if ($return_sanitizer || $condition_sanitize) {
            if (!is_null($mysanitizer) && $condition_respected_final) {
                if ($condition_sanitize) {
                    foreach ($exprs_tainted_condition_sanitize as $exprsanitize) {
                        foreach ($exprsanitize->getDefs() as $one_def) {
                            $one_def->setSanitized(true);
                            if (is_array($prevent_final)) {
                                foreach ($prevent_final as $prevent_final_value) {
                                    $one_def->addTypeSanitized($prevent_final_value);
                                }
                            }
                        }
                    }
                } else {
                    $mytemp_return->setSanitized(true);
                    $mydef_return->setSanitized(true);
                    if (is_array($prevent_final)) {
                        foreach ($prevent_final as $prevent_final_value) {
                            $mytemp_return->addTypeSanitized($prevent_final_value);
                            $mydef_return->addTypeSanitized($prevent_final_value);
                        }
                    }
                }
            }
        }

        if ($return_sanitizer && $params_sanitized) {
            $mytemp_return->setSanitized(true);
            $mydef_return->setSanitized(true);
            foreach ($params_type_sanitized as $tmp) {
                $mytemp_return->addTypeSanitized($tmp);
                $mydef_return->addTypeSanitized($tmp);
            }
        }

        if ($return_sanitizer) {
            if (ResolveDefs::getVisibilityFromInstances($context, $data, $mydef_return)) {
                ValueAnalysis::copyValues($mytemp_return, $mydef_return);
                TaintAnalysis::setTainted($mytemp_return->isTainted(), $mydef_return, $myexpr_return1);
            }
        }
    }

    public static function funccallSource($stack_class, $context, $data, $myclass, $instruction)
    {
        $funcname = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arr_funccall = $instruction->getProperty(MyInstruction::ARR);
        $myfunc_call = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $class_name = false;
        if ($myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD) && !is_null($myclass)) {
            $class_name = $myclass->getName();
        }

        $mysource = $context->inputs->getSourceByName($stack_class, $myfunc_call, true, $class_name, false);
        if (!is_null($mysource)) {
            if ($mysource->hasParameters()) {
                $nbparams = 0;
                while (true) {
                    if (!$instruction->isPropertyExist("argdef$nbparams")) {
                        break;
                    }

                    $defarg = $instruction->getProperty("argdef$nbparams");

                    if ($mysource->isParameter($nbparams + 1)) {
                        $deffrom = $defarg->getValueFromDef();
                        $array_index = $mysource->getConditionParameter($nbparams + 1, MySource::CONDITION_ARRAY);
                        if (!is_null($array_index)) {
                            $true_array_index = array($array_index => false);
                            $deffrom->addType(MyDefinition::TYPE_ARRAY);
                            $deffrom->setArrayValue($true_array_index);
                        }

                        // no expression needed it's a source
                        $deffrom->setTainted(true);
                    }

                    $nbparams ++;
                }
            }

            $exprreturn = $instruction->getProperty(MyInstruction::EXPR);

            if ($exprreturn->isAssign()) {
                $defassign = $exprreturn->getAssignDef();

                $mydef = new MyDefinition(
                    $myfunc_call->getLine(),
                    $myfunc_call->getColumn(),
                    $myfunc_call->getName()."_return"
                );
                $mydef->setSourceMyFile($defassign->getSourceMyFile());
                $mydef->setTainted(true);
                // no need to taintedbyexpr because it's source like _GET

                if ($mysource->getIsArray()) {
                    $defassign->setArrayValue("PROGPILOT_ALL_INDEX_TAINTED");
                    // we don't add type of TYPE_ARRAY because is a virtual array
                    // $row = mysqli_fetch_row
                    // echo $row[0]
                    // we don't want row as an array because it's value is constance PROGPILOT_ALL_INDEX_TAINTED
                    // which doesn't mean anything for the user
                    //$defassign->addType(MyDefinition::TYPE_ARRAY);

                    $exprreturn->addDef($mydef);
                    $mydef->setExpr($exprreturn);
                } elseif ($mysource->getIsReturnArray() && $arr_funccall === false) {
                    $value_array = array($mysource->getReturnArrayValue() => false);

                    $defassign->addCopyArray($value_array, $mydef);
                    $defassign->addType(MyDefinition::TYPE_COPY_ARRAY);

                    $exprreturn->addDef($mydef);
                    $mydef->setExpr($exprreturn);
                } elseif ($mysource->getIsReturnArray()) {
                    $value_array = array($mysource->getReturnArrayValue() => false);

                    if ($arr_funccall === $value_array) {
                        $exprreturn->addDef($mydef);
                        $mydef->setExpr($exprreturn);

                        if ($exprreturn->isAssign()) {
                            if (ResolveDefs::getVisibilityFromInstances($context, $data, $defassign)) {
                                ValueAnalysis::copyValues($mydef, $defassign);
                                TaintAnalysis::setTainted($mydef->isTainted(), $defassign, $exprreturn);
                            }
                        }
                    }
                } elseif (!$mysource->getIsReturnArray()) {
                    $exprreturn->addDef($mydef);
                    if ($exprreturn->isAssign()) {
                        if (ResolveDefs::getVisibilityFromInstances($context, $data, $defassign)) {
                            ValueAnalysis::copyValues($mydef, $defassign);
                            TaintAnalysis::setTainted($mydef->isTainted(), $defassign, $exprreturn);
                        }
                    }
                }
            }
        }
    }

    public static function setTainted($tainted, $defassign, $expr)
    {
        if ($tainted) {
            $defassign->setTainted(true);
            $defassign->setTaintedByExpr($expr);
        }
    }
}
