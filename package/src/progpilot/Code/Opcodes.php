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
    const TEMPORARY = "temporarySimple";
    const CONCAT_LEFT = "concat_left";
    const CONCAT_RIGHT = "concat_right";
    const CONCAT_LIST = "concat_list";
    const FUNC_CALL = "funccall";
    const RETURN_FUNCTION = "return";
    const CLASSE = "class";
    const ASSERTION = "assertion";
    const COND_START_IF = "condition_start_if";
    const COND_BOOLEAN_NOT = "condition_boolean_not";
    const NEW_INCLUDE = "new_include";

    /*
            const LEAVE_BLOCK = 0;
            const ENTER_BLOCK = 1;
            const ENTER_FUNCTION = 2;
            const LEAVE_FUNCTION = 3;
            const DEFINITION = 4;
            const START_ASSIGN = 5;
            const END_ASSIGN = 6;
            const START_EXPRESSION = 7;
            const END_EXPRESSION = 8;
            const TEMPORARY = 9;
            const CONCAT_LEFT = 10;
            const CONCAT_RIGHT = 11;
            const CONCAT_LIST = 12;
            const FUNC_CALL = 13;
            const RETURN_FUNCTION = 14;
            const CLASSE = 15;
            const ASSERTION = 16;
            const COND_START_IF = 17;
            const COND_BOOLEAN_NOT = 18;
            const NEW_INCLUDE = 19;
            */
}
