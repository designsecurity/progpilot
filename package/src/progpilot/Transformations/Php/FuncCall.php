<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php;

use PHPCfg\Block;
use PHPCfg\Op;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyExpr;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;
use progpilot\Transformations\Php\Expr;

class FuncCall {

	public static function argument($context, $assign_id, $arg, $inst_funcall_main, $funccall_name, $num_param)
	{
		// each argument will be a definition defined by an expression
		$def_name = $funccall_name."_param".$num_param."_".mt_rand();
		$mydef = new MyDefinition($context->get_current_line(), $context->get_current_column(), $def_name, false, false);
		$mydef->set_assign_id($assign_id);

		$context->get_mycode()->add_code(new MyInstruction(Opcodes::START_ASSIGN));
		$context->get_mycode()->add_code(new MyInstruction(Opcodes::START_EXPRESSION));

		$myexprparam = new MyExpr($context->get_current_line(), $context->get_current_column());
		$myexprparam->set_assign(true);
		$myexprparam->set_assign_def($mydef);

		$inst_funcall_main->add_property("argdef$num_param", $mydef);
		$inst_funcall_main->add_property("argexpr$num_param", $myexprparam);

		Expr::instruction($arg, $context, $myexprparam, $assign_id);

		$inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
		$inst_end_expr->add_property("expr", $myexprparam);
		$context->get_mycode()->add_code($inst_end_expr);

		$context->get_mycode()->add_code(new MyInstruction(Opcodes::END_ASSIGN));

		$inst_def = new MyInstruction(Opcodes::DEFINITION);
		$inst_def->add_property("def", $mydef);
		$context->get_mycode()->add_code($inst_def);

		unset($myexprparam);
		unset($mydef);
	}

	/* 
arg2 : expr for the return
arg3 : arr for the return : function_call()[0] (arr = [0])
	 */
	public static function instruction($context, $myexpr, $assign_id, $funccall_arr, $is_method = false)
	{
		$nbparams = 0;	

		// instance_name = new obj; instance_name->method_name()
		if($is_method)
		{
			$instance_name = Common::get_name_definition($context->get_current_op()->var);
		}

		$funccall_name = "";
		if($context->get_current_op() instanceof Op\Expr\New_)
		{
			$funccall_name = "__construct";
			// we have the class name
			$class_name = $context->get_current_op()->class->value;
			$is_method = true;

			$instance_name = Common::get_name_definition($context->get_current_op()->result->usages[0]);
		}
		else if(isset($context->get_current_op()->name->value))
			$funccall_name = $context->get_current_op()->name->value;

		$inst_funcall_main = new MyInstruction(Opcodes::FUNC_CALL);
		$inst_funcall_main->add_property("funcname", $funccall_name);

		$myfunction_call = new MyFunction($funccall_name);
		$myfunction_call->setLine($context->get_current_line());
		$myfunction_call->setColumn($context->get_current_column());

		if($is_method)
		{
			// when we define a method in a class (is_method = true) but when we use a method (is_instance = true)
			$myfunction_call->set_is_instance(true);
			$myfunction_call->set_name_instance($instance_name);

			$mybackdef = new MyDefinition($context->get_current_line(), $context->get_current_column()+1, $instance_name, false, false);
			$mybackdef->set_instance(true);
			$mybackdef->set_assign_id(rand());
			$myfunction_call->set_back_def($mybackdef);
		}

		foreach($context->get_current_op()->args as $arg)
		{
			FuncCall::argument($context, $assign_id, $arg, $inst_funcall_main, $funccall_name, $nbparams);
			$nbparams ++;
		}

		$myfunction_call->set_nb_params($nbparams);
		$inst_funcall_main->add_property("myfunc_call", $myfunction_call);
		$inst_funcall_main->add_property("expr", $myexpr);
		$inst_funcall_main->add_property("arr", $funccall_arr);
		$context->get_mycode()->add_code($inst_funcall_main);
	}
}

?>
