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

    public static function temporarySimple($context, $data, $searchedDef, $def, $isIterator = false, $isAssign = false)
    {
        $goodDefs = [];
        
        if (($def->isType(MyDefinition::TYPE_COPY_ARRAY)
            && ($searchedDef->isType(MyDefinition::TYPE_ARRAY) || $isIterator))) {
            foreach ($def->getCopyArrays() as $defCopyArray) {
                $myDef_arr = $defCopyArray[0];
                $myDef_tmp = $defCopyArray[1];

                if (($myDef_arr === $searchedDef->getArrayValue()) || $isIterator) {
                    $goodDefs[] = $myDef_tmp;
                }
            }
        } elseif ($searchedDef->isType(MyDefinition::TYPE_ARRAY)) {
            // I'm looking for def[arr], I want to find def[arr], but I can have def (must be eliminated)
            if (($def->isType(MyDefinition::TYPE_ARRAY)
                        && ($searchedDef->getArrayValue() === $def->getArrayValue()) || $isIterator)
                            || $def->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED") {
                if ($def->getArrayValue() === "PROGPILOT_ALL_INDEX_TAINTED") {
                    $searchedDef->setTainted(true);
                    //TaintAnalysis::setTainted($context, $data, $searchedDef, $def, $def->getExpr(), false);

                    if (ResolveDefs::getVisibilityFromInstances($context, $data, $def)) {
                        ValueAnalysis::copyValues($searchedDef, $def);
                        TaintAnalysis::setTainted($searchedDef, $def, $def->getExpr());
                    }
                    
                    $goodDefs[] = $searchedDef;
                } else {
                    $goodDefs[] = $def;
                }
            }
        } elseif (!$searchedDef->isType(MyDefinition::TYPE_ARRAY)) {
            // I'm looking for def, I want to find def, but I can have def[arr] (must be eliminated)
            if (!$def->isType(MyDefinition::TYPE_ARRAY) || $isIterator) {
                $goodDefs[] = $def;
            }
        }

        return $goodDefs;
    }

    public static function copyArray($context, $data, $originalTab, $originalArr, $copyTab, $copyArr)
    {
        if (!is_null($originalTab) && !is_null($copyTab)) {
            if ($originalTab->isType(MyDefinition::TYPE_PROPERTY)) {
                $defs = ResolveDefs::selectProperties(
                    $context,
                    $data,
                    $originalTab,
                    true
                );
            } else {
                $defs = ResolveDefs::selectDefinitions(
                    $context,
                    $data,
                    $originalTab,
                    true
                );
            }

            foreach ($defs as $defa) {
                ArrayAnalysis::copyArrayFromDef($defa, $originalArr, $copyTab, $copyArr);
            }
        }
    }

    public static function copyArrayFromDef($originalTab, $originalArr, $copyTab, $copyArr)
    {
        if ($originalTab->isType(MyDefinition::TYPE_COPY_ARRAY)) {
            $copyArrays = $originalTab->getCopyArrays();

            foreach ($copyArrays as $value) {
                $arrValue = $value[0];
                $defArr = $value[1];

                $extract = BuildArrays::extractArrayFromArr($arrValue, $originalArr);
                if ($extract !== false) {
                    $extractBis = BuildArrays::buildArrayFromArr($copyArr, $extract);

                    $copyTab->addCopyArray($extractBis, $defArr);
                    $copyTab->addType(MyDefinition::TYPE_COPY_ARRAY);
                    if ($copyTab->isType(MyDefinition::TYPE_ARRAY)) {
                        $copyTab->removeType(MyDefinition::TYPE_ARRAY);
                    }
                    $copyTab->setArrayValue(false);

                    unset($defArr);
                }
            }
        } elseif ($originalTab->getArrayValue() !== "PROGPILOT_ALL_INDEX_TAINTED") {
            $extract = BuildArrays::extractArrayFromArr($originalTab->getArrayValue(), $originalArr);

            // si on cherchait $copy = $array[11] ici il y a des arrays de type $array[11][quelquechose]
            // ou deuxieme cas
            // si on cherchait $copy = $arrays ici il y a des arrays de type $arrays[quelquechose]
            if ($extract !== false) {
                // si on a $copy[11] = $array[12] on veut $copy[11][12]
                if ($copyArr !== false) {
                    $extract = BuildArrays::buildArrayFromArr($copyArr, $extract);
                }

                $copyTab->addCopyArray($extract, $originalTab);
                $copyTab->addType(MyDefinition::TYPE_COPY_ARRAY);

                if ($copyTab->isType(MyDefinition::TYPE_ARRAY)) {
                    $copyTab->removeType(MyDefinition::TYPE_ARRAY);
                }

                $copyTab->setArrayValue(false);
            }
        }
    }
}
