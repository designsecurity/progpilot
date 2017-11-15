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

class SecurityAnalysis
{
    public static function in_array_source($temp, $name, $line, $column, $file)
    {
        for ($i = 0; $i < count($temp["source_name"]); $i ++)
        {
            if ($temp["source_name"][$i] === $name
                                              && $temp["source_line"][$i] === $line
                                                      && $temp["source_column"][$i] === $column
                                                              && $temp["source_file"][$i] === $file)
                return true;
        }

        return false;
    }

    public static function is_safe($index_parameter, $mydef, $mysink)
    {
        $condition = $mysink->get_parameter_condition($index_parameter);

        if ($mydef->is_tainted())
        {
            if ($mydef->is_sanitized())
            {
                if ($mydef->is_type_sanitized($mysink->get_attack())
                        || $mydef->is_type_sanitized("ALL"))
                {
                    // 1° the argument of sink must be quoted
                    if ($condition == "QUOTES" && !$mydef->is_type_sanitized("ALL"))
                    {
                        // the def is embedded into quotes but quotes are not sanitized
                        if (!$mydef->is_type_sanitized("QUOTES") && $mydef->get_is_embeddedbychar("'"))
                            return false;

                        // the def is not embedded into quotes
                        if (!$mydef->get_is_embeddedbychar("'"))
                            return false;
                    }

                    if ($mysink->is_global_condition("QUOTES_HTML")
                            && !$mydef->is_type_sanitized("ALL"))
                    {
                        if (!$mydef->is_type_sanitized("QUOTES") && $mydef->get_is_embeddedbychar("<")
                                && $mydef->get_is_embeddedbychar("'"))
                            return false;

                        if ($mydef->get_is_embeddedbychar("<") && !$mydef->get_is_embeddedbychar("'"))
                            return false;
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
        $myfunc_call = $instruction->get_property("myfunc_call");

        $name_instance = null;
        if ($myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD))
            $name_instance = $myfunc_call->get_name_instance();

        $mysink = $context->inputs->get_sink_byname($stack_class, $myfunc_call, $myclass);

        if (!is_null($mysink))
        {
            $nb_params = $myfunc_call->get_nb_params();
            $condition_respected = true;

            if ($mysink->has_parameters())
            {
                for ($i = 0; $i < $nb_params; $i ++)
                {
                    if ($mysink->is_parameter($i + 1))
                    {
                        $condition_respected = false;

                        $mydef_arg = $instruction->get_property("argdef$i");
                        $tainted_expr = $mydef_arg->get_taintedbyexpr();

                        if (!is_null($tainted_expr))
                        {
                            $defs_expr = $tainted_expr->get_defs();
                            foreach ($defs_expr as $def_expr)
                            {
                                if (!SecurityAnalysis::is_safe($i + 1, $def_expr, $mysink))
                                    $condition_respected = true;
                            }
                        }

                        if (!$condition_respected)
                            break;
                    }
                }
            }

            if ($condition_respected)
            {
                for ($i = 0; $i < $nb_params; $i ++)
                {
                    $mydef_arg = $instruction->get_property("argdef$i");
                    $mydef_expr = $instruction->get_property("argexpr$i");

                    if (!$mysink->has_parameters() || ($mysink->has_parameters() && $mysink->is_parameter($i + 1)))
                        SecurityAnalysis::call($i + 1, $myfunc_call, $context, $mysink, $mydef_arg, $mydef_expr);
                }
            }
        }
    }

    public static function tainted_flow($index_parameter, $context, $def_expr_flow, $mysink)
    {
        $result_tainted_flow = [];

        $id_flow = \progpilot\Utils::print_definition($def_expr_flow);

        while ($def_expr_flow->get_taintedbyexpr() !== null)
        {
            $tainted_flow_expr = $def_expr_flow->get_taintedbyexpr();
            $defs_expr_tainted = $tainted_flow_expr->get_defs();

            foreach ($defs_expr_tainted as $def_expr_flow_from)
            {
                if (!SecurityAnalysis::is_safe($index_parameter, $def_expr_flow_from, $mysink))
                {
                    $one_tainted["flow_name"] = \progpilot\Utils::print_definition($def_expr_flow_from);
                    $one_tainted["flow_line"] = $def_expr_flow_from->getLine();
                    $one_tainted["flow_column"] = $def_expr_flow_from->getColumn();
                    $one_tainted["flow_file"] = \progpilot\Utils::encode_characters($def_expr_flow_from->get_source_myfile()->get_name());
                    $result_tainted_flow[] = $one_tainted;

                    $id_flow .= \progpilot\Utils::print_definition($def_expr_flow_from)."-".$def_expr_flow_from->get_source_myfile()->get_name();

                    $def_expr_flow = $def_expr_flow_from;
                    break;
                }
            }

            if ($def_expr_flow->get_taintedbyexpr() === $tainted_flow_expr)
                break;
        }

        return [$result_tainted_flow, $id_flow];
    }

    public static function call($index_parameter, $myfunc_call, $context, $mysink, $mydef, $myexpr)
    {
        $results = &$context->outputs->get_results();

        $hash_id_vuln = "";

        $temp["source_name"] = [];
        $temp["source_line"] = [];
        $temp["source_column"] = [];
        $temp["source_file"] = [];

        if ($context->outputs->get_tainted_flow())
            $temp["tainted_flow"] = [];

        $nbtainted = 0;

        $tainted_expr = $mydef->get_taintedbyexpr();
        if (!is_null($tainted_expr))
        {
            $defs_expr = $tainted_expr->get_defs();

            foreach ($defs_expr as $def_expr)
            {
                if (!SecurityAnalysis::is_safe($index_parameter, $def_expr, $mysink))
                {
                    $source_name = \progpilot\Utils::print_definition($def_expr);
                    $source_line = $def_expr->getLine();
                    $source_column = $def_expr->getColumn();
                    $source_file = \progpilot\Utils::encode_characters($def_expr->get_source_myfile()->get_name());

                    if (!SecurityAnalysis::in_array_source($temp, $source_name, $source_line, $source_column, $source_file))
                    {
                        $results_flow = SecurityAnalysis::tainted_flow($index_parameter, $context, $def_expr, $mysink);
                        $result_tainted_flow = $results_flow[0];
                        $hash_id_vuln .= $results_flow[1];

                        $temp["source_name"][] = $source_name;

                        if ($context->outputs->get_tainted_flow())
                            $temp["tainted_flow"][] = $result_tainted_flow;

                        $temp["source_line"][] = $source_line;
                        $temp["source_column"][] = $source_column;
                        $temp["source_file"][] = $source_file;

                        $nbtainted ++;
                    }
                }
            }
        }

        $hash_id_vuln = hash("sha256", $hash_id_vuln."-".$mysink->get_name()."-".$myfunc_call->get_source_myfile()->get_name());

        if ($nbtainted && is_null($context->inputs->get_false_positive_byid($hash_id_vuln)))
        {
            $temp["sink_name"] = \progpilot\Utils::encode_characters($mysink->get_name());
            $temp["sink_line"] = $myfunc_call->getLine();
            $temp["sink_column"] = $myfunc_call->getColumn();
            $temp["sink_file"] = \progpilot\Utils::encode_characters($myfunc_call->get_source_myfile()->get_name());
            $temp["vuln_name"] = \progpilot\Utils::encode_characters($mysink->get_attack());
            $temp["vuln_cwe"] = \progpilot\Utils::encode_characters($mysink->get_cwe());
            $temp["vuln_id"] = $hash_id_vuln;

            $context->outputs->add_result($temp);
            if (!in_array($temp, $results, true))
                $results[] = $temp;
        }
    }
}
