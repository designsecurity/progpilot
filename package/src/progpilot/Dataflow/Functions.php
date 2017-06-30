<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

class Functions {

	private $functions;

	public function get_function($funcname, $class_name = null)
	{
		if(isset($this->functions[$funcname]))
		{
			$list_funcs = $this->functions[$funcname];
			foreach($list_funcs as $myfunc)
			{
				if(!$myfunc->is_method() && is_null($class_name))
					return $myfunc;

				if($myfunc->is_method())
				{
					$myclass = $myfunc->get_myclass();
					if($class_name == $myclass->get_name())
						return $myfunc;
				}
			}
		}

		return null;
	}

	public function get_functions()
	{
		return $this->functions;
	}

	public function add_function($funcname, $func)
	{
		// we can have many functions/methods with the same name
		$this->functions[$funcname][] = $func;
	}
}

?>
