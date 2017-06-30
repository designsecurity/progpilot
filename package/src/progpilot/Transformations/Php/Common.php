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
use PHPCfg\Operand;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;

class Common {

	public static function get_name_definition($ops)
	{
		//  $this->property
		if(isset($ops->var) && $ops->var instanceof Operand\BoundVariable)
			return $ops->var->name->value;

		if(isset($ops->ops[0]))
		{
			if($ops->ops[0] instanceof Op\Expr\ArrayDimFetch)
				return Common::get_name_definition($ops->ops[0]);

			if($ops->ops[0] instanceof Op\Expr\PropertyFetch)
				return Common::get_name_definition($ops->ops[0]);
		}

		if(isset($ops->var->ops))
		{
			foreach($ops->var->ops as $op)
			{
				if($op instanceof Op\Expr\ArrayDimFetch)
					return Common::get_name_definition($op);

				if($op instanceof Op\Expr\PropertyFetch)
					return Common::get_name_definition($op);
			}
		}

		// use variable 
		if(isset($ops->original->name->value)) 
		{
			return $ops->original->name->value;
		}

		// def variable
		if(isset($ops->var->original->name->value)) 
		{
			return $ops->var->original->name->value;
		}

		// class name
		if(isset($ops->name->value))
		{
			return $ops->name->value;
		}
		
		// arrayexpr
		if(isset($ops->value))
		{
            return $ops->value;
        }

		return "";
	}

	/*
	   const FLAG_PUBLIC      = 0x01;
	   const FLAG_PROTECTED   = 0x02;
	   const FLAG_PRIVATE     = 0x04;
	   const FLAG_STATIC      = 0x08;
	   const FLAG_ABSTRACT    = 0x10;
	   const FLAG_FINAL       = 0x20;
	   const FLAG_RETURNS_REF = 0x40;
	   const FLAG_CLOSURE     = 0x80;
	 */

	public static function get_type_visibility($visibility)
	{
		switch($visibility)
		{
			case 1: return "public";
			case 2: return "protected";
			case 4: return "private";
			default: return "public";
		}
	}

	public static function is_funccall_withoutreturn($op)
	{
        if(!(isset($op->result->usages[0])) || (
            // funccall()[0]
            !(isset($op->result->usages[0]) && $op->result->usages[0] instanceof Op\Expr\ArrayDimFetch) &&
            // test = funccall() // funcccall(funccall())
                !(isset($op->result->usages[0]) 
                    && (
                        $op->result->usages[0] instanceof Op\Terminal\Echo_ 
                            || $op->result->usages[0] instanceof Op\Expr\MethodCall 
                                || $op->result->usages[0] instanceof Op\Expr\FuncCall 
                                    || $op->result->usages[0] instanceof Op\Expr\Assign 
                                        || $op->result->usages[0] instanceof Op\Expr\Array_
                                            || $op->result->usages[0] instanceof Op\Expr\Include_
                                                || $op->result->usages[0] instanceof Op\Expr\Eval_))))
            return true;
            
        return false;
	}

	public static function get_type_definition($ops)
	{
		if(isset($ops->ops[0]))
		{
			if($ops->ops[0] instanceof Op\Expr\FuncCall)
			{
				return "array_funccall";
			}

			if($ops->ops[0] instanceof Op\Expr\PropertyFetch)
			{
				return "property";
			}

			if($ops->ops[0] instanceof Op\Expr\ArrayDimFetch)
			{
				$ret = Common::get_type_definition($ops->ops[0]);

				if($ret == "array_funccall")
					return "array_funccall";

				return "array";
			}

			if($ops->ops[0] instanceof Op\Expr\Array_)
			{
				return "arrayexpr";
			}
		}

		if(isset($ops->expr->ops[0]))
		{
			if($ops->expr->ops[0] instanceof Op\Expr\Array_)
				return "arrayexpr";
		}

		if(isset($ops->expr->ops[0]))
		{
			if($ops->expr->ops[0] instanceof Op\Expr\New_)
				return "instance";
		}

		if(isset($ops->var->ops[0]))
		{
			if($ops->var->ops[0] instanceof Op\Expr\ArrayDimFetch)
			{
				$ret = Common::get_type_definition($ops->var->ops[0]);

				if($ret == "array_funccall")
					return "array_funccall";

				return "array";
			}

			if($ops->var->ops[0] instanceof Op\Expr\PropertyFetch)
			{
				return "property";
			}

			if($ops->var->ops[0] instanceof Op\Expr\FuncCall)
				return "array_funccall";   
		}

		if(isset($ops->var->original->name))
		{
			if($ops->var->original->name instanceof Operand\Literal)
				return "simple";
		}

		if(isset($ops->expr->original->name)) // return
		{
			if($ops->expr->original->name instanceof Operand\Literal)
				return "simple";
		}

		if(isset($ops->original->name))
		{
			if($ops->original->name instanceof Operand\Literal)
				return "simple";
		}

		if($ops instanceof Operand\Literal)
			return "simple";

		return null;
	}
}

?>
