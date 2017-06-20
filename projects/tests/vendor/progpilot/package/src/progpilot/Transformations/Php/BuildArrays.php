<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php;

use PHPCfg\Block;
use PHPCfg\Func;
use PHPCfg\Op;
use PHPCfg\Operand;

class BuildArrays {

	public static function function_start_ops($initops)
	{
		if(isset($initops->ops))
		{
			foreach($initops->ops as $op)
			{
				if($op instanceof Op\Expr\ArrayDimFetch)
				{
					return BuildArrays::function_start_ops($op->var);
				}
			}
		}

		return $initops;
	}

	public static function build_array_from_arr($start, $end)
	{
		if(is_array($start))
		{
			foreach($start as $ind => $value)
			{  
				$end = array($ind => $end);
				$end = BuildArrays::build_array_from_arr($value, $end);
			}
		}

		return $end;
	}

	public static function extract_array_from_arr($originalarr, $indarr)
	{
		if($originalarr == $indarr)
			return $originalarr;

		$arr = $originalarr;

		if(is_array($indarr))
		{
			foreach($indarr as $ind => $value)
			{
				if(isset($originalarr[$ind]))
				{
					$arr = $originalarr[$ind];
					$arr = BuildArrays::extract_array_from_arr($originalarr[$ind], $indarr[$ind]);
				}
			}
		}

		return $arr;
	}

	public static function build_array_from_ops($initops, $arr)
	{
		if(isset($initops->ops))
		{
			foreach($initops->ops as $op)
			{
				if($op instanceof Op\Expr\ArrayDimFetch)
				{
					$ind = $op->dim->value;   
					$arr = array($ind => $arr);
					$arr = BuildArrays::build_array_from_ops($op->var, $arr);
				}
			}
		}

		return $arr;
	}
}
