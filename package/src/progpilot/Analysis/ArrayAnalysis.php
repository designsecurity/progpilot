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

    public static function temporarySimple($context, $data, $defsearch, $def, $is_iterator = false, $isAssign = false)
    {
        $good_defs = [];

        if (($def->isType(MyDefinition::TYPE_COPY_ARRAY)
            && ($defsearch->isType(MyDefinition::TYPE_ARRAY) || $is_iterator))) {
            foreach ($def->getCopyArrays() as $def_copyarray) {
                $mydef_arr = $def_copyarray[0];
                $mydef_tmp = $def_copyarray[1];

                if (($mydef_arr === $defsearch->getArrayValue()) || $is_iterator) {
                    $good_defs[] = $mydef_tmp;
                }
            }
        } // I'm looking for def[arr], I want to find def[arr], but I can have def (must be eliminated)
        elseif ($defsearch->isType(MyDefinition::TYPE_ARRAY)) {
            if (($def->isType(MyDefinition::TYPE_ARRAY)
                        && ($defsearch->getArrayValue() === $def->getArrayValue()) || $is_iterator)
                            || $def->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED") {
                if ($def->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED") {
                    $defsearch->setTainted(true);
                    //TaintAnalysis::setTainted($context, $data, $defsearch, $def, $def->getExpr(), false);

                    if (ResolveDefs::getVisibilityFromInstances($context, $data, $def)) {
                        ValueAnalysis::copyValues($defsearch, $def);
                        TaintAnalysis::setTainted($defsearch, $def, $def->getExpr());
                    }
                }

                $good_defs[] = $def;
            }
        } // I'm looking for def, I want to find def, but I can have def[arr] (must be eliminated)
        elseif (!$defsearch->isType(MyDefinition::TYPE_ARRAY)) {
            if (!$def->isType(MyDefinition::TYPE_ARRAY) || $is_iterator) {
                $good_defs[] = $def;
            }
        }

        return $good_defs;
    }

    public static function copyArray($context, $data, $originaltab, $originalarr, $copytab, $copyarr)
    {
        if (!is_null($originaltab) && !is_null($copytab)) {
            if ($originaltab->isType(MyDefinition::TYPE_PROPERTY)) {
                $defs = ResolveDefs::selectProperties(
                    $context,
                    $data,
                    $originaltab,
                    true
                );
            } else {
                $defs = ResolveDefs::selectDefinitions(
                    $context,
                    $data,
                    $originaltab,
                    true
                );
            }

            foreach ($defs as $defa) {
                ArrayAnalysis::copyArrayFromDef($defa, $originalarr, $copytab, $copyarr);
            }
        }
    }

    public static function copyArrayFromDef($defa, $originalarr, $copytab, $copyarr)
    {
        if ($defa->isType(MyDefinition::TYPE_COPY_ARRAY)) {
            $copyarrays = $defa->getCopyArrays();

            foreach ($copyarrays as $value) {
                $arrvalue = $value[0];
                $defarr = $value[1];

                $extract = BuildArrays::extractArrayFromArr($arrvalue, $originalarr);
                if ($extract !== false) {
                    $extractbis = BuildArrays::buildArrayFromArr($copyarr, $extract);

                    $copytab->addCopyArray($extractbis, $defarr);
                    $copytab->addType(MyDefinition::TYPE_COPY_ARRAY);
                    if ($copytab->isType(MyDefinition::TYPE_ARRAY)) {
                        $copytab->removeType(MyDefinition::TYPE_ARRAY);
                    }
                    $copytab->setArrayValue(false);

                    unset($defarr);
                }
            }
        } else {
            $extract = BuildArrays::extractArrayFromArr($defa->getArrayValue(), $originalarr);

            // si on cherchait $copy = $array[11] ici il y a des arrays de type $array[11][quelquechose]
            // ou deuxieme cas
            // si on cherchait $copy = $arrays ici il y a des arrays de type $arrays[quelquechose]
            if ($extract !== false) {
                // si on a $copy[11] = $array[12] on veut $copy[11][12]
                if ($copyarr !== false) {
                    $extract = BuildArrays::buildArrayFromArr($copyarr, $extract);
                }

                $copytab->addCopyArray($extract, $defa);
                $copytab->addType(MyDefinition::TYPE_COPY_ARRAY);

                if ($copytab->isType(MyDefinition::TYPE_ARRAY)) {
                    $copytab->removeType(MyDefinition::TYPE_ARRAY);
                }

                $copytab->setArrayValue(false);
            }
        }
    }
}
