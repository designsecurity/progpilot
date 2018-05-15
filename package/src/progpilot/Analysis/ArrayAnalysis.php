<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use PHPCfg\Block;
use PHPCfg\Func;
use PHPCfg\Op;
use PHPCfg\Script;
use PHPCfg\Visitor;
use PHPCfg\Operand;

use progpilot\Objects\MyOp;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;
use progpilot\Transformations\Php\BuildArrays;
use progpilot\Code\Opcodes;

class ArrayAnalysis
{
    public function __construct()
    {
    }

    public static function temporary_simple($context, $data, $defsearch, $def, $is_iterator = false, $is_assign = false)
    {
        $good_defs = [];

        if (($def->is_type(MyDefinition::TYPE_COPY_ARRAY) && ($defsearch->is_type(MyDefinition::TYPE_ARRAY) || $is_iterator))) {
            foreach ($def->get_copyarrays() as $def_copyarray) {
                $mydef_arr = $def_copyarray[0];
                $mydef_tmp = $def_copyarray[1];

                if (($mydef_arr === $defsearch->get_array_value()) || $is_iterator) {
                    $good_defs[] = $mydef_tmp;
                }
            }
        }

        // I'm looking for def[arr], I want to find def[arr], but I can have def (must be eliminated)
        elseif ($defsearch->is_type(MyDefinition::TYPE_ARRAY)) {
            if (($def->is_type(MyDefinition::TYPE_ARRAY)
                        && ($defsearch->get_array_value() === $def->get_array_value()) || $is_iterator) || $def->get_array_value() === "PROGPILOT_ALL_INDEX_TAINTED") {
                if ($def->get_array_value() === "PROGPILOT_ALL_INDEX_TAINTED") {
                    $defsearch->set_tainted(true);
                    //TaintAnalysis::set_tainted($context, $data, $defsearch, $def, $def->get_expr(), false);

                    if (ResolveDefs::get_visibility_from_instances($context, $data, $def)) {
                        ValueAnalysis::copy_values($defsearch, $def);
                        TaintAnalysis::set_tainted($defsearch, $def, $def->get_expr());
                    }
                }

                $good_defs[] = $def;
            }
        }

        // I'm looking for def, I want to find def, but I can have def[arr] (must be eliminated)
        elseif (!$defsearch->is_type(MyDefinition::TYPE_ARRAY)) {
            if (!$def->is_type(MyDefinition::TYPE_ARRAY) || $is_iterator) {
                $good_defs[] = $def;
            }
        }

        return $good_defs;
    }

    public static function copy_array($context, $data, $originaltab, $originalarr, $copytab, $copyarr)
    {
        if (!is_null($originaltab) && !is_null($copytab)) {
            if ($originaltab->is_type(MyDefinition::TYPE_PROPERTY)) {
                $defs = ResolveDefs::select_properties(
                                $context,
                                $data,
                                $originaltab,
                                true
                    );
            } else {
                $defs = ResolveDefs::select_definitions(
                                $context,
                                $data,
                                $originaltab,
                                true
                    );
            }

            foreach ($defs as $defa) {
                ArrayAnalysis::copy_array_from_def($defa, $originalarr, $copytab, $copyarr);
            }
        }
    }

    public static function copy_array_from_def($defa, $originalarr, $copytab, $copyarr)
    {
        if ($defa->is_type(MyDefinition::TYPE_COPY_ARRAY)) {
            $copyarrays = $defa->get_copyarrays();

            foreach ($copyarrays as $value) {
                $arrvalue = $value[0];
                $defarr = $value[1];

                $extract = BuildArrays::extract_array_from_arr($arrvalue, $originalarr);
                if ($extract !== false) {
                    $extractbis = BuildArrays::build_array_from_arr($copyarr, $extract);

                    $copytab->add_copyarray($extractbis, $defarr);
                    $copytab->add_type(MyDefinition::TYPE_COPY_ARRAY);
                    if ($copytab->is_type(MyDefinition::TYPE_ARRAY)) {
                        $copytab->remove_type(MyDefinition::TYPE_ARRAY);
                    }
                    $copytab->set_array_value(false);

                    unset($defarr);
                }
            }
        } else {
            $extract = BuildArrays::extract_array_from_arr($defa->get_array_value(), $originalarr);

            // si on cherchait $copy = $array[11] ici il y a des arrays de type $array[11][quelquechose]
            // ou deuxieme cas
            // si on cherchait $copy = $arrays ici il y a des arrays de type $arrays[quelquechose]
            if ($extract !== false) {
                // si on a $copy[11] = $array[12] on veut $copy[11][12]
                if ($copyarr !== false) {
                    $extract = BuildArrays::build_array_from_arr($copyarr, $extract);
                }

                $copytab->add_copyarray($extract, $defa);
                $copytab->add_type(MyDefinition::TYPE_COPY_ARRAY);

                if ($copytab->is_type(MyDefinition::TYPE_ARRAY)) {
                    $copytab->remove_type(MyDefinition::TYPE_ARRAY);
                }

                $copytab->set_array_value(false);
            }
        }
    }
}
