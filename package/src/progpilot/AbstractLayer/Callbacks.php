<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\AbstractLayer;

class Callbacks
{
    public static function modify_myclass_of_object($context, $id_object, $current_myclass, $new_myclass)
    {
        if (!is_null($current_myclass) && $current_myclass->get_name() === $new_myclass->get_name()) {
            $context->get_objects()->add_myclass_to_object($id_object, $new_myclass);
        }
    }

    public static function modify_myclass_of_object_fromdef($context, $def, $myclass)
    {
        if ($def->get_class_name() === $myclass->get_name()) {
            $id_object = $def->get_object_id();
            $context->get_objects()->add_myclass_to_object($id_object, $myclass);
        }
    }
}
