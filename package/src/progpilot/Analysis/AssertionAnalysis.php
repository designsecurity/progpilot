<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyDefinition;

class AssertionAnalysis {

	public static function temporary_simple($context, $data, $myblock, $resolve_temporary, $tempdefa)
	{
		$assertions = $myblock->get_assertions();

		$equality = false;
		$safe = false;

		// for each assertions, we could have definitions with same name (from different block for example)
		foreach($assertions as $assertion)
		{
			$mydef_assertion = $assertion->get_def();
			$type_assertion = $assertion->get_type();

			// there was not resolution so we simply check name (or better equality values)
			if($resolve_temporary == $tempdefa)
			{
				if($mydef_assertion->get_name() == $tempdefa->get_name())
					$tempdefa->set_tainted(false);

				$equality = true;
			}

			if($mydef_assertion == $resolve_temporary)
			{
				if($mydef_assertion->get_name() == $tempdefa->get_name())
					$tempdefa->set_tainted(false);

				$equality = true;
				break;
			}
		}


		if($equality && $type_assertion != "string")
			$safe = true;

		if($resolve_temporary->get_cast() == MyDefinition::CAST_SAFE)
			$safe = true;

		return $safe;
	}
}
