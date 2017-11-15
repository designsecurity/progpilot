<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyFile;
use progpilot\Objects\MyOp;
use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;
use progpilot\Objects\MyClass;
use progpilot\Objects\MyFunction;

use progpilot\Code\MyCode;
use progpilot\Code\Opcodes;

use progpilot\Utils;

class ValueAnalysis
{
    public function __construct()
    {

    }

    public static function copy_values($def, $defassign)
    {
        $defassign->set_is_embeddedbychars($def->get_is_embeddedbychars(), true);
        //$defassign->set_cast($def->get_cast());
    }

    public static function calculate_security_values($tempdefa, $defassign_myexpr, $tempdefa_myexpr, $def)
    {
        if (!$tempdefa_myexpr->get_is_concat())
        {
            if ($tempdefa->get_cast() === MyDefinition::CAST_NOT_SAFE)
                $defassign_myexpr->set_cast($def->get_cast());
            else
                $defassign_myexpr->set_cast($tempdefa->get_cast());
        }
    }

    public static function calculate_values($tempdefa, $defassign_myexpr, $tempdefa_myexpr, $def, $concat_tables)
    {
        if (!$tempdefa_myexpr->get_is_concat())
        {
            $def_values = $def->get_last_known_values();
            foreach ($def_values as $def_value)
                $defassign_myexpr->add_last_known_value($def_value);
        }
        else
        {
            if (!in_array($defassign_myexpr, $concat_tables->defs_assign, true))
                $concat_tables->defs_assign[] = $defassign_myexpr;

            $def_values = $def->get_last_known_values();
            foreach ($def_values as $def_value)
                $concat_tables->values[] = $def_value;
        }
    }


    public static function update_for_concat_values($concat_tables)
    {
        $embedded_by_chars = false;
        $new_def_values = [];
        foreach ($concat_tables->defs_assign as $def_to_concat)
        {
            // last_known_values
            $def_to_concat_values = $def_to_concat->get_last_known_values();

            if (count($def_to_concat_values) == 0)
                $def_to_concat_values[] = "";

            foreach ($def_to_concat_values as $def_to_concat_value)
            {
                foreach ($concat_tables->values as $concat_value)
                    $new_def_values[] = $def_to_concat_value.$concat_value;
            }
        }



        foreach ($concat_tables->defs_assign as $def_to_concat)
        {
            $def_to_concat->reset_last_known_values();

            foreach ($new_def_values as $new_def_value)
                $def_to_concat->add_last_known_value($new_def_value);
        }
    }
}
