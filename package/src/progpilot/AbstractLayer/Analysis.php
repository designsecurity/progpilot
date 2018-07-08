<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\AbstractLayer;

class Analysis
{
    public static function forAllobjects($context, $func, $myclass)
    {
        foreach ($context->getObjects()->getObjects() as $id => $object_class) {
            $params = array($context, $id, $object_class, $myclass);
            call_user_func_array(__NAMESPACE__ ."\\$func", $params);
        }
    }

    public static function forDefsInFunctions($context, $func, $myclass)
    {
        foreach ($context->getFunctions()->getFunctions() as $functions_blocks) {
            foreach ($functions_blocks as $function_block) {
                foreach ($function_block->getDefs()->getDefs() as $defs_blocks) {
                    foreach ($defs_blocks as $def_block) {
                        $params = array($context, $def_block, $myclass);
                        call_user_func_array(__NAMESPACE__ ."\\$func", $params);
                    }
                }
            }
        }
    }
}
