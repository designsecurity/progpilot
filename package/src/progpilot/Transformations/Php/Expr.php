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

class Expr {

	public static function instruction($op, $context, $myexpr, $assign_id, $cast = MyDefinition::CAST_NOT_SAFE)
	{
		$mytemp_def = null;
		$arr_funccall = false;
		$name = Common::get_name_definition($op);
		$type = Common::get_type_definition($op);
		$type_array = Common::get_type_is_array($op);

		// end of expression
		if(!is_null($type) && $type != MyOp::TYPE_FUNCCALL_ARRAY)
		{
			if(is_null($name))
				$name = mt_rand();

			$arr = BuildArrays::build_array_from_ops($op, false);

			$mytemp = new MyDefinition($context->get_current_line(), $context->get_current_column(), $name);
			$mytemp->last_known_value($name);
			$mytemp->set_assign_id($assign_id);
			$mytemp->set_cast($cast);
			$mytemp->set_type($type);


			if($arr != false)
			{
				$mytemp->set_is_array(true);
				$mytemp->set_array_value($arr);
			}

			$mytemp->add_expr($myexpr);

			if($type == MyOp::TYPE_PROPERTY)
			{
                $property_name = "";
                if(isset($op->ops[0]))
                    $property_name = Common::get_name_property($op->ops[0]);

				$mytemp->set_is_property(true);
				$mytemp->property->set_properties($property_name);
			}

			$inst_temporary_simple = new MyInstruction(Opcodes::TEMPORARY);
			$inst_temporary_simple->add_property("temporary", $mytemp);
			$context->get_mycode()->add_code($inst_temporary_simple);

			return $mytemp;
		}

		// func()[0][1]
		else if($type == MyOp::TYPE_FUNCCALL_ARRAY)
		{
			$arr_funccall = BuildArrays::build_array_from_ops($op, false);
			$start_ops = BuildArrays::function_start_ops($op);
			$op = $start_ops;
		}

		if(isset($op->ops))
		{
			foreach($op->ops as $ops)
			{
				if($ops instanceof Op\Expr\Cast\Int_
						|| $ops instanceof Op\Expr\Cast\Array_
						|| $ops instanceof Op\Expr\Cast\Bool_
						|| $ops instanceof Op\Expr\Cast\Double_
						|| $ops instanceof Op\Expr\Cast\Object_
						|| $ops instanceof Op\Expr\Cast\Array_)

					Expr::instruction($ops->expr, $context, $myexpr, $assign_id, MyDefinition::CAST_SAFE);

				else if($ops instanceof Op\Expr\Cast\String_)
					Expr::instruction($ops->expr, $context, $myexpr, $assign_id, MyDefinition::CAST_NOT_SAFE);

				else if($ops instanceof Op\Expr\BinaryOp\Concat)
				{
					$context->get_mycode()->add_code(new MyInstruction(Opcodes::CONCAT_LEFT));
					Expr::instruction($ops->left, $context, $myexpr, $assign_id);

					$context->get_mycode()->add_code(new MyInstruction(Opcodes::CONCAT_RIGHT));
					Expr::instruction($ops->right, $context, $myexpr, $assign_id);
				}
				else if($ops instanceof Op\Expr\ConcatList)
				{
					$context->get_mycode()->add_code(new MyInstruction(Opcodes::CONCAT_LIST));

					foreach($ops->list as $opsbis)
					{
						Expr::instruction($opsbis, $context, $myexpr, $assign_id);
					}
				}
				else if($ops instanceof Op\Expr\FuncCall)
				{
					$old_op = $context->get_current_op();
					$context->set_current_op($ops);
					FuncCall::instruction($context, $myexpr, $assign_id, $arr_funccall);
					$context->set_current_op($old_op);
				}
				else if($ops instanceof Op\Expr\MethodCall)
				{
					$old_op = $context->get_current_op();
					$context->set_current_op($ops);
					FuncCall::instruction($context, $myexpr, $assign_id, $arr_funccall, true);
					$context->set_current_op($old_op);
				}

				else if($ops instanceof Op\Expr\New_)
				{
					// funccall for the constructor
					$old_op = $context->get_current_op();
					$context->set_current_op($ops);
					FuncCall::instruction($context, $myexpr, $assign_id, $arr_funccall);
					$context->set_current_op($old_op);
				}
				else
				{
					$mytemp_def = Expr::instruction($ops, $context, $myexpr, $assign_id);
				}
			}
		}

		return $mytemp_def;
	}
}

?>
