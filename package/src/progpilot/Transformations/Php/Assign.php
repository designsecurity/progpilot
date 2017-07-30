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
use progpilot\Objects\MyOp;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;
use progpilot\Transformations\Php\OpTr;

class Assign {

	public static function instruction($context, $is_returndef = false)
	{
		$assign_id = rand();

		$name = Common::get_name_definition($context->get_current_op());
		$type = Common::get_type_definition($context->get_current_op());
		$type_array = Common::get_type_is_array($context->get_current_op());
		

		// name of function return
		if($is_returndef)
			$name = $context->get_current_func()->get_name()."_return";

		$mydef = new MyDefinition($context->get_current_line(), $context->get_current_column(), $name);
		$mydef->set_assign_id($assign_id);
		
		$isref = false;
		if($context->get_current_op() instanceof Op\Expr\AssignRef)
		{
			$isref = true;
			$mydef->set_is_ref(true);
        }
        
		if($is_returndef)
			$context->get_current_func()->add_return_def($mydef);

		$context->get_mycode()->add_code(new MyInstruction(Opcodes::START_ASSIGN));

		// it's an expression which will define a definition
		$myexpr = new MyExpr($context->get_current_line(), $context->get_current_column());
		$myexpr->set_assign(true);
		$myexpr->set_assign_def($mydef);

		$context->get_mycode()->add_code(new MyInstruction(Opcodes::START_EXPRESSION));

		Expr::instruction($context->get_current_op()->expr, $context, $myexpr, $assign_id);

		$inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
		$inst_end_expr->add_property("expr", $myexpr);
		$context->get_mycode()->add_code($inst_end_expr);

		$context->get_mycode()->add_code(new MyInstruction(Opcodes::END_ASSIGN));

		$inst_def = new MyInstruction(Opcodes::DEFINITION);
		$inst_def->add_property("def", $mydef);
		$context->get_mycode()->add_code($inst_def);

		// $array[09][098] = expr;
		if($type_array == MyOp::TYPE_ARRAY)
		{	
			$arr = BuildArrays::build_array_from_ops($context->get_current_op()->var, false);
			$mydef->set_is_array(true);
			$mydef->set_array_value($arr);
		}

		// $array = [expr, expr, expr]
        if($type_array == MyOp::TYPE_ARRAY_EXPR)
		{
			$arr = false;
			if(isset($context->get_current_op()->var))
				$arr = BuildArrays::build_array_from_ops($context->get_current_op()->var, false);

			ArrayExpr::instruction($context->get_current_op()->expr, $context, $arr, $name, $is_returndef);
		}
		// a variable, property
        if($type == MyOp::TYPE_PROPERTY)
		{
            $property_name = Common::get_name_definition($context->get_current_op(), true);
			$mydef->set_type(MyOp::TYPE_PROPERTY);
			$mydef->property->set_name($property_name);
			
		}
		// an object (created by new)
		else if($type == MyOp::TYPE_INSTANCE)
		{
			// it's the class name not instance name
			$name_class = $context->get_current_op()->expr->ops[0]->class->value;

			$mydef->set_type(MyOp::TYPE_INSTANCE);
			$mydef->set_class_name($name_class);
		}

		if($isref)
		{
			$ref_name = Common::get_name_definition($context->get_current_op()->expr);
			$ref_type = Common::get_type_definition($context->get_current_op()->expr);
            $ref_type_array = Common::get_type_is_array($context->get_current_op()->expr);
			$mydef->set_ref_name($ref_name);

			if($ref_type_array == MyOp::TYPE_ARRAY)
			{
				$arr = BuildArrays::build_array_from_ops($context->get_current_op()->expr, false);
				$mydef->set_ref_arr(true);
				$mydef->set_ref_arr_value($arr);
			}
		}
	}
}

?>
