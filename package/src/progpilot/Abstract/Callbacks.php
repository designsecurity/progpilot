<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Abstract;

class Callbacks
{
    public static function modify_objectid_of_this($def, $new_objectid)
    {
        if($def->get_name() == "this")
        {
            $def->set_object_id($new_objectid);
        }
    }
    
}

?>

