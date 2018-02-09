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

        public static function for_all_objects($context, $func, $myclass)
        {
            foreach($context->get_objects()->get_objects() as $id => $object_class)
            {
                $params = array($context, $id, $object_class, $myclass);
                call_user_func_array(__NAMESPACE__ ."\\$func", $params);
            }
        }

        public static function for_defs_in_functions($context, $func, $myclass)
        {
            foreach ($context->get_functions()->get_functions() as $functions_blocks)
            {
                foreach ($functions_blocks as $function_block)
                {
                    foreach ($function_block->get_defs()->get_defs() as $defs_blocks)
                    {
                        foreach ($defs_blocks as $def_block)
                        {
                            $params = array($context, $def_block, $myclass);
                            call_user_func_array(__NAMESPACE__ ."\\$func", $params);
                        }
                    }
                }
            }
        }
}

?>
