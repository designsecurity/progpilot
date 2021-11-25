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
    const LEAVE_BLOCK = 1;
    const ENTER_BLOCK = 2;
    const ENTER_FUNCTION = 3;
    const LEAVE_FUNCTION = 4;
    const DEFINITION = 5;
    const START_ASSIGN = 6;
    const END_ASSIGN = 7;
    const CONCAT_LEFT = 11;
    const CONCAT_RIGHT = 12;
    const CONCAT_LIST = 13;
    const FUNC_CALL = 14;
    const RETURN_FUNCTION = 15;
    const CLASSE = 16;
    const ASSERTION = 17;
    const COND_START_IF = 18;
    const COND_BOOLEAN_NOT = 19;
    const NEW_INCLUDE = 20;
    const PROPERTY_FETCH = 21;
    const ARRAYDIM_FETCH = 22;
    const VARIABLE = 23;
    const ASSIGN = 24;
    const ARGUMENT = 25;
    const VARIABLE_FETCH = 26;
    const LITERAL_FETCH = 27;
    const STATIC_PROPERTY_FETCH = 28;
    const CAST = 29;
    const CONST_FETCH = 30;
    const ITERATOR = 31;
    const ARRAY_EXPR = 32;
    const BINARYOP = 33;
}
