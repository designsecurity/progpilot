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

use progpilot\Objects\MyOp;
use progpilot\Objects\MyFunction;
use progpilot\Code\MyInstruction;

class SecurityAnalysis
{
    public static function inArraySource($temp, $name, $line, $column, $file)
    {
        for ($i = 0; $i < count($temp["source_name"]); $i ++) {
            if ($temp["source_name"][$i] === $name
                                                  && $temp["source_line"][$i] === $line
                                                          && $temp["source_column"][$i] === $column
                                                                  && $temp["source_file"][$i] === $file) {
                return true;
            }
        }

        return false;
    }

    public static function isSafe($index_parameter, $mydef, $mysink)
    {
        $condition = $mysink->getParameterCondition($index_parameter);

        if ($mydef->isTainted()) {
            if ($mydef->isSanitized()) {
                if ($mydef->isTypeSanitized($mysink->getAttack())
                            || $mydef->isTypeSanitized("ALL")) {
                    // 1° the argument of sink must be quoted
                    if ($condition === "QUOTES" && !$mydef->isTypeSanitized("ALL")) {
                        // the def is embedded into quotes but quotes are not sanitized
                        if (!$mydef->isTypeSanitized("QUOTES") && $mydef->getIsEmbeddedByChar("'")) {
                            return false;
                        }

                        // the def is not embedded into quotes
                        if (!$mydef->getIsEmbeddedByChar("'")) {
                            return false;
                        }
                    }

                    if ($mysink->isGlobalCondition("QUOTES_HTML")
                                && !$mydef->isTypeSanitized("ALL")) {
                        if (!$mydef->isTypeSanitized("QUOTES") && $mydef->getIsEmbeddedByChar("<")
                                    && $mydef->getIsEmbeddedByChar("'")) {
                            return false;
                        }

                        if ($mydef->getIsEmbeddedByChar("<") && !$mydef->getIsEmbeddedByChar("'")) {
                            return false;
                        }
                    }

                    return true;
                }
            }

            return false;
        }

        return true;
    }

    public static function funccall($stack_class, $context, $instruction, $myclass = null)
    {
        $myfunc_call = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        $name_instance = null;
        if ($myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $name_instance = $myfunc_call->getNameInstance();
        }

        $mysink = $context->inputs->getSinkByName($context, $stack_class, $myfunc_call, $myclass);

        if (!is_null($mysink)) {
            $nb_params = $myfunc_call->getNbParams();
            $condition_respected = true;

            if ($mysink->hasParameters()) {
                for ($i = 0; $i < $nb_params; $i ++) {
                    if ($mysink->isParameter($i + 1)) {
                        $condition_respected = false;

                        $mydef_arg = $instruction->getProperty("argdef$i");
                        $tainted_expr = $mydef_arg->getTaintedByExpr();

                        if (!is_null($tainted_expr)) {
                            $defs_expr = $tainted_expr->getDefs();
                            foreach ($defs_expr as $def_expr) {
                                if (!SecurityAnalysis::isSafe($i + 1, $def_expr, $mysink)) {
                                    $condition_respected = true;
                                }
                            }
                        }

                        if (!$condition_respected) {
                            break;
                        }
                    }
                }
            }

            if ($condition_respected) {
                for ($i = 0; $i < $nb_params; $i ++) {
                    $mydef_arg = $instruction->getProperty("argdef$i");
                    $mydef_expr = $instruction->getProperty("argexpr$i");

                    if (!$mysink->hasParameters() || ($mysink->hasParameters() && $mysink->isParameter($i + 1))) {
                        SecurityAnalysis::call($i + 1, $myfunc_call, $context, $mysink, $mydef_arg, $mydef_expr);
                    }
                }
            }
        }
    }

    public static function taintedFlow($index_parameter, $context, $def_expr_flow, $mysink)
    {
        $result_taintedFlow = [];

        $id_flow = \progpilot\Utils::printDefinition($def_expr_flow);

        while ($def_expr_flow->getTaintedByExpr() !== null) {
            $taintedFlow_expr = $def_expr_flow->getTaintedByExpr();
            $defs_expr_tainted = $taintedFlow_expr->getDefs();

            foreach ($defs_expr_tainted as $def_expr_flow_from) {
                if (!SecurityAnalysis::isSafe($index_parameter, $def_expr_flow_from, $mysink)) {
                    $one_tainted["flow_name"] = \progpilot\Utils::printDefinition($def_expr_flow_from);
                    $one_tainted["flow_line"] = $def_expr_flow_from->getLine();
                    $one_tainted["flow_column"] = $def_expr_flow_from->getColumn();
                    $one_tainted["flow_file"] = \progpilot\Utils::encodeCharacters(
                        $def_expr_flow_from->getSourceMyFile()->getName()
                    );
                    $result_taintedFlow[] = $one_tainted;

                    $id_flow .= \progpilot\Utils::printDefinition($def_expr_flow_from);
                    $id_flow .= "-".$def_expr_flow_from->getSourceMyFile()->getName();
                    $def_expr_flow = $def_expr_flow_from;
                    break;
                }
            }

            if ($def_expr_flow->getTaintedByExpr() === $taintedFlow_expr) {
                break;
            }
        }

        return [$result_taintedFlow, $id_flow];
    }

    public static function call($index_parameter, $myfunc_call, $context, $mysink, $mydef, $myexpr)
    {
        //$results = &$context->outputs->getResults();

        $hash_id_vuln = "";

        $temp["source_name"] = [];
        $temp["source_line"] = [];
        $temp["source_column"] = [];
        $temp["source_file"] = [];

        if ($context->outputs->getTaintedFlow()) {
            $temp["taintedFlow"] = [];
        }

        $nbtainted = 0;

        $tainted_expr = $mydef->getTaintedByExpr();
        if (!is_null($tainted_expr)) {
            $defs_expr = $tainted_expr->getDefs();

            foreach ($defs_expr as $def_expr) {
                if (!SecurityAnalysis::isSafe($index_parameter, $def_expr, $mysink)) {
                    $source_name = \progpilot\Utils::printDefinition($def_expr);
                    $source_line = $def_expr->getLine();
                    $source_column = $def_expr->getColumn();
                    $source_file = \progpilot\Utils::encodeCharacters($def_expr->getSourceMyFile()->getName());

                    if (!SecurityAnalysis::inArraySource(
                        $temp,
                        $source_name,
                        $source_line,
                        $source_column,
                        $source_file
                    )) {
                        $results_flow = SecurityAnalysis::taintedFlow($index_parameter, $context, $def_expr, $mysink);
                        $result_taintedFlow = $results_flow[0];
                        $hash_id_vuln .= $results_flow[1];

                        $temp["source_name"][] = $source_name;

                        if ($context->outputs->getTaintedFlow()) {
                            $temp["taintedFlow"][] = $result_taintedFlow;
                        }

                        $temp["source_line"][] = $source_line;
                        $temp["source_column"][] = $source_column;
                        $temp["source_file"][] = $source_file;

                        $nbtainted ++;
                    }
                }
            }
        }

        $hashed_value = $hash_id_vuln."-".$mysink->getName()."-".$myfunc_call->getSourceMyFile()->getName();
        $hash_id_vuln = hash("sha256", $hashed_value);

        if ($nbtainted && is_null($context->inputs->getFalsePositiveById($hash_id_vuln))) {
            $temp["sink_name"] = \progpilot\Utils::encodeCharacters($mysink->getName());
            $temp["sink_line"] = $myfunc_call->getLine();
            $temp["sink_column"] = $myfunc_call->getColumn();
            $temp["sink_file"] = \progpilot\Utils::encodeCharacters($myfunc_call->getSourceMyFile()->getName());
            $temp["vuln_name"] = \progpilot\Utils::encodeCharacters($mysink->getAttack());
            $temp["vuln_cwe"] = \progpilot\Utils::encodeCharacters($mysink->getCwe());
            $temp["vuln_id"] = $hash_id_vuln;
            $temp["vuln_type"] = "taint-style";

            $context->outputs->addResult($temp);
            //if (!in_array($temp, $results, true))
                // $results[] = $temp;
        }
    }
}
