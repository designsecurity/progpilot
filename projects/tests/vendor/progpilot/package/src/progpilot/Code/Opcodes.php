<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Code;

class Opcodes
{
	const LEAVE_BLOCK = "leave_block";
	const ENTER_BLOCK = "enter_block";
	const ENTER_FUNCTION = "enter_func";
	const LEAVE_FUNCTION = "leave_func";
	const DEFINITION = "definition";
	const START_ASSIGN = "start_assign";
	const END_ASSIGN = "end_assign";
	const START_EXPRESSION = "start_expression";
	const END_EXPRESSION = "end_expression";
	const TEMPORARY = "temporary_simple";
	const CONCAT_LEFT = "concat_left";
	const CONCAT_RIGHT = "concat_right";
	const CONCAT_LIST = "concat_list";
	const FUNC_CALL = "funccall";
	const RETURN_FUNCTION = "return";
	const CLASSE = "class";
	const ASSERTION = "assertion";
	const START_INCLUDE = "start_include";
	const END_INCLUDE = "end_include";
}

?>
