<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Abstract;

class Analysis
{
    public static function for_defs_in_definitions($definitions, $func, $params)
    {
        foreach($definitions->get_defs() as $defs_blockid)
        {
            foreach($defs_blockid as $def)
            {
                call_user_func_array($func, $params);
            }
        }
    }
    
}

?>

