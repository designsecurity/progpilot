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

class SecurityAnalysis {

	public static function is_safe($mydef, $mysink)
	{
		if($mydef->is_tainted())
		{
			if($mydef->is_sanitized())
			{
				if($mydef->is_type_sanitized($mysink->get_attack()) || $mydef->is_type_sanitized("ALL"))
					return true;
			}

			return false;
		}

		return true;
	}

	public static function funccall($stack_class, $context, $myfunc_call, $instruction, $myclass = null)
	{
		$name_instance = null;
		if($myfunc_call->get_is_method())
			$name_instance = $myfunc_call->get_name_instance();

		$mysink = $context->inputs->get_sink_byname($stack_class, $myfunc_call, $myclass);

		if(!is_null($mysink))
		{
			$nb_params = $myfunc_call->get_nb_params();

            $condition_respected = true;
            
            if($mysink->has_parameters())
            {
                for($i = 0; $i < $nb_params; $i ++)
                {
                    if($mysink->is_parameter($i + 1))
                    {
                        $mydef_arg = $instruction->get_property("argdef$i");
                        if(SecurityAnalysis::is_safe($mydef_arg, $mysink))
                            $condition_respected = false;
                    }
                }
            }
            
            if($condition_respected)
            {
                for($i = 0; $i < $nb_params; $i ++)
                {
                    $mydef_arg = $instruction->get_property("argdef$i");

                    if(!$mysink->has_parameters() || ($mysink->has_parameters() && $mysink->is_parameter($i + 1)))
                        SecurityAnalysis::call($myfunc_call, $context, $mysink, $mydef_arg);
                }
            }
		}
	}

	public static function tainted_flow($context, $def_expr_flow, $mysink)
	{
		$result_tainted_flow = [];

		$id_flow = \progpilot\Utils::print_definition($def_expr_flow);

		while($def_expr_flow->get_taintedbyexpr() !== null)
		{
			$tainted_flow_expr = $def_expr_flow->get_taintedbyexpr();
			$defs_expr_tainted = $tainted_flow_expr->get_defs();

			foreach($defs_expr_tainted as $def_expr_flow_from)
			{
				if(!SecurityAnalysis::is_safe($def_expr_flow_from, $mysink))
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
		}

		return [$result_tainted_flow, $id_flow];
	}

	public static function call($myfunc_call, $context, $mysink, $mydef)
	{
		$results = &$context->outputs->get_results();

		$hash_id_vuln = "";

		$temp["source_name"] = [];
		$temp["source_line"] = [];
		$temp["source_column"] = [];
		$temp["source_file"] = [];

		if($context->outputs->get_tainted_flow())
			$temp["tainted_flow"] = [];

		$nbtainted = 0;

		if(!SecurityAnalysis::is_safe($mydef, $mysink))
		{
			$tainted_expr = $mydef->get_taintedbyexpr();
			$defs_expr = $tainted_expr->get_defs();

			foreach($defs_expr as $def_expr)
			{
				if(!SecurityAnalysis::is_safe($def_expr, $mysink))
				{
					$results_flow = SecurityAnalysis::tainted_flow($context, $def_expr, $mysink);
					$result_tainted_flow = $results_flow[0];
					$hash_id_vuln .= $results_flow[1];

					$temp["source_name"][] = \progpilot\Utils::print_definition($def_expr);

					if($context->outputs->get_tainted_flow())
						$temp["tainted_flow"][] = $result_tainted_flow;

					$temp["source_line"][] = $def_expr->getLine();
					$temp["source_column"][] = $def_expr->getColumn();
					$temp["source_file"][] = \progpilot\Utils::encode_characters($def_expr->get_source_myfile()->get_name());
				}
			}

			$nbtainted ++;
		}

		$hash_id_vuln = hash("sha256", $hash_id_vuln."-".$mysink->get_name()."-".$myfunc_call->get_source_myfile()->get_name());

		if($nbtainted && is_null($context->inputs->get_false_positive_byid($hash_id_vuln)))
		{
			$temp["sink_name"] = \progpilot\Utils::encode_characters($mysink->get_name());
			$temp["sink_line"] = $myfunc_call->getLine();
			$temp["sink_column"] = $myfunc_call->getColumn();
			$temp["sink_file"] = \progpilot\Utils::encode_characters($myfunc_call->get_source_myfile()->get_name());
			$temp["vuln_name"] = \progpilot\Utils::encode_characters($mysink->get_attack());
			$temp["vuln_cwe"] = \progpilot\Utils::encode_characters($mysink->get_cwe());
			$temp["vuln_id"] = $hash_id_vuln;

			$results[] = $temp;
		}
	}
}
