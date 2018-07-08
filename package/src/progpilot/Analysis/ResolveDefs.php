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

use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;

use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyInstance;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyFunction;

use progpilot\Dataflow\Definitions;

class ResolveDefs
{
    public static function funccallReturnValues($context, $myfunc_call, $instruction, $mycode, $index)
    {
        if ($myfunc_call->getName() === "dirname") {
            $codes = $mycode->getCodes();
            if (isset($codes[$index + 2]) && $codes[$index + 2]->getOpcode() === Opcodes::END_ASSIGN) {
                $instruction_def = $codes[$index + 3];
                $mydef_return = $instruction_def->getProperty(MyInstruction::DEF);

                if ($instruction->isPropertyExist("argdef0")) {
                    $defarg = $instruction->getProperty("argdef0");
                    foreach ($defarg->getLastKnownValues() as $known_value) {
                        $mydef_return->addLastKnownValue(dirname($known_value));
                    }
                }
            }
        }
    }


    public static function funccallClass($context, $data, $myfunc_call)
    {
        $i = 0;
        $class_stack_name = [];

        if ($myfunc_call->getName() === "__construct") {
            $class_stack_name[$i][] = $myfunc_call->getBackDef();
        } elseif ($myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $properties = $myfunc_call->getBackDef()->property->getProperties();

            $tmp_properties = [];

            while (true) {
                $prop_value = [];

                $mydef_tmp = new MyDefinition(
                    $myfunc_call->getLine(),
                    $myfunc_call->getColumn(),
                    $myfunc_call->getNameInstance()
                );
                $mydef_tmp->setBlockId($myfunc_call->getBlockId());
                $mydef_tmp->setSourceMyFile($myfunc_call->getSourceMyFile());
                $mydef_tmp->property->setProperties($tmp_properties);
                $mydef_tmp->addType(MyDefinition::TYPE_PROPERTY);
                $mydef_tmp->setId($myfunc_call->getBackDef()->getId() - 1);
                // we don't want the backdef but the original instance

                $class_stack_name[$i] = [];
                if ($i === 0) {
                    $instances = ResolveDefs::selectInstances(
                        $context,
                        $data,
                        $mydef_tmp
                    );
                } else {
                    $instances = ResolveDefs::selectProperties($context, $data, $mydef_tmp);
                }

                foreach ($instances as $instance) {
                    if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                        $class_stack_name[$i][] = $instance;
                    }
                }

                if (!isset($properties[$i])) {
                    break;
                }

                $tmp_properties[] = $properties[$i];

                $i ++;
            }
        }

        return $class_stack_name;
    }

    public static function instanceBuildBack($context, $data, $myfunc, $myfunc_call)
    {
        if (!is_null($myfunc) && $myfunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
            if ($myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD)) {
                $mybackdef = $myfunc_call->getBackDef();
                $myclass = $myfunc->getMyClass();
                $new_myback_myclass = $context->getObjects()->getMyClassFromObject($mybackdef->getObjectId());

                if (is_null($new_myback_myclass)) {
                    $new_myback_myclass = new MyClass(
                        $myclass->getLine(),
                        $myclass->getColumn(),
                        $myclass->getName()
                    );

                    $context->getObjects()->addMyclassToObject($mybackdef->getObjectId(), $new_myback_myclass);
                }

                $copy_myclass = clone $myclass;

                foreach ($copy_myclass->getProperties() as $property) {
                    $mydef = new MyDefinition($myfunc->getLastLine() + 1, $myfunc->getLastColumn(), "this");

                    $mydef->addType(MyDefinition::TYPE_PROPERTY);
                    $mydef->property->setProperties($property->property->getProperties());
                    $mydef->setBlockId($myfunc->getLastBlockId());
                    $mydef->setSourceMyFile($mybackdef->getSourceMyFile());

                    $new_property = $new_myback_myclass->getProperty($property->property->getProperties()[0]);
                    if (is_null($new_property)) {
                        $new_myback_myclass->addProperty($property);
                        $new_property = $property;
                    }

                    $properties_inside = ResolveDefs::selectProperties(
                        $context,
                        $myfunc->getDefs()->getOutMinusKill($mydef->getBlockId()),
                        $mydef
                    );

                    foreach ($properties_inside as $property_inside) {
                        TaintAnalysis::setTainted(
                            $property_inside->isTainted(),
                            $new_property,
                            $property_inside->getTaintedByExpr()
                        );

                        if ($property_inside->isSanitized()) {
                            $new_property->setSanitized(true);
                            foreach ($property_inside->getTypeSanitized() as $type_sanitized) {
                                $new_property->addTypeSanitized($type_sanitized);
                            }
                        }

                        if ($property_inside->isType(MyDefinition::TYPE_INSTANCE)
                            && !$new_property->isType(MyDefinition::TYPE_INSTANCE)) {
                            $new_property->addType(MyDefinition::TYPE_INSTANCE);
                            $new_property->setObjectId($property_inside->getObjectId());
                            $new_property->setClassName($property_inside->getClassName());

                            $myclass = $context->getObjects()->getMyClassFromObject($property_inside->getObjectId());
                        }
                    }

                    $new_property->setName($mybackdef->getName());

                    ArrayAnalysis::copyArray(
                        $context,
                        $myfunc->getDefs()->getOutMinusKill($mydef->getBlockId()),
                        $mydef,
                        $mydef->getArrayValue(),
                        $new_property,
                        $new_property->getArrayValue()
                    );
                }

                foreach ($copy_myclass->getMethods() as $method) {
                    $new_method = clone $method;
                    $new_myback_myclass->addMethod($new_method);
                }
            }
        }
    }

    public static function instanceBuildThis($context, $data, $object_id, $myclass, $myfunc, $myfunc_call)
    {
        if (!is_null($myfunc) && $myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD)) {
            //$copy_myclass = clone $myclass;
            //<= It was good ? clone for backdef and thisdef or only one of these two ?
            $copy_myclass = $myclass;
            
            foreach ($copy_myclass->getProperties() as $property) {
                $mydef = new MyDefinition(
                    $myfunc_call->getLine(),
                    $myfunc_call->getColumn(),
                    $myfunc_call->getNameInstance()
                );
                $mydef->addType(MyDefinition::TYPE_PROPERTY);
                $mydef->property->setProperties($property->property->getProperties());
                $mydef->setBlockId($myfunc_call->getBlockId());
                $mydef->setSourceMyFile($myfunc_call->getSourceMyFile());
                $mydef->setId($myfunc_call->getId());

                $defs_found = ResolveDefs::selectProperties($context, $data, $mydef, true);
                foreach ($defs_found as $def_found) {
                    if ($def_found->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                        $property->setCopyArrays($def_found->getCopyArrays());
                        $property->addType(MyDefinition::TYPE_COPY_ARRAY);
                    }

                    TaintAnalysis::setTainted($def_found->isTainted(), $property, $def_found->getTaintedByExpr());

                    if ($def_found->isSanitized()) {
                        $property->setSanitized(true);
                        foreach ($def_found->getTypeSanitized() as $type_sanitized) {
                            $property->addTypeSanitized($type_sanitized);
                        }
                    }
                }

                $property->setName("this");
            }

            $context->getObjects()->addMyclassToObject($object_id, $copy_myclass);
        }
    }

    // def1 and def2 defined in different files
    // return true if def1 is deeper by def2
    public static function isNearestIncludes($def1, $def2)
    {
        $def1_includedby_def2 = false;

        $myfile = $def1->getSourceMyFile();
        while (!is_null($myfile)) {
            $myfile_from = $myfile->getIncludedFromMyfile();
            if (!is_null($myfile_from) && ($myfile_from->getName() === $def2->getSourceMyFile()->getName())) {
                $def1_includedby_def2 = true;
                break;
            }

            $myfile = $myfile_from;
        }

        if (!$def1_includedby_def2) {
            $def2_includedby_def1 = false;
            $myfile = $def2->getSourceMyFile();
            while (!is_null($myfile)) {
                $myfile_from = $myfile->getIncludedFromMyfile();
                if (!is_null($myfile_from) && ($myfile_from->getName() === $def1->getSourceMyFile()->getName())) {
                    $def2_includedby_def1 = true;
                    break;
                }

                $myfile = $myfile_from;
            }
        }

        // the two defs are defined in different included file
        if (!$def1_includedby_def2 && !$def2_includedby_def1) {
            $myfile_def1 = $def1->getSourceMyFile();
            while (!is_null($myfile_def1)) {
                $myfile_def2 = $def2->getSourceMyFile();
                while (!is_null($myfile_def2)) {
                    // we found the file from where the include chain start
                    if ($myfile_def1->getName() === $myfile_def2->getName()) {
                        // if the file of def1 is included later so def1 is deeper
                        if (($myfile_def1->getLine() > $myfile_def2->getLine())
                            || ($myfile_def1->getLine() === $myfile_def2->getLine()
                                && $myfile_def1->getColumn() >= $myfile_def2->getColumn())) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    $myfile_def2 = $myfile_def2->getIncludedFromMyfile();
                }

                $myfile_def1 = $myfile_def1->getIncludedFromMyfile();
            }
        }

        // def1 is included by file from def2
        // but def2 defined before or after the include ?
        if ($def1_includedby_def2) {
            // def2 defined after the include so def2 is deeper
            if (($def2->getLine() > $myfile->getLine())
                || ($def2->getLine() === $myfile->getLine()
                    && $def2->getColumn() >= $myfile->getColumn())) {
                return false;
            }

            return true;
        }

        // def2 is included by file from def1
        // but def1 defined before or after the include ?
        if ($def2_includedby_def1) {
            // def1 defined after the include so def1 is deeper

            if (($def1->getLine() > $myfile->getLine())
                || ($def1->getLine() === $myfile->getLine()
                    &&  $def1->getColumn() >= $myfile->getColumn())) {
                return true;
            }

            return false;
        }

        return false;
    }

    // return true if op is deeper in code than def
    public static function isNearest($context, $def1, $def2)
    {
        if ($def1->getSourceMyFile()->getName() === $def2->getSourceMyFile()->getName()) {
            // def1 is deeper in the code

            if ($def1->getLine() > $def2->getLine()) {
                return true;
            }

            // the two defs are on the same line
            if ($def1->getLine() === $def2->getLine()) {
                if ($def1->getId() >= $def2->getId()) {
                    return true;
                }
            }
        } else {
            return ResolveDefs::isNearestIncludes($def1, $def2);
        }

        return false;
    }

    public static function getVisibilityMethod($def_name, $method)
    {
        if ($def_name === "this") {
            return true;
        }

        if (!is_null($method)
                    && $method->isType(MyFunction::TYPE_FUNC_METHOD)
                    && $method->getVisibility() === "public") {
            return true;
        }

        return false;
    }

    public static function getVisibility($def, $property)
    {
        if (!is_null($def) && $def->getName() === "this") {
            return true;
        }

        if (!is_null($property)
                    && $property->isType(MyDefinition::TYPE_PROPERTY)
                    && $property->property->getVisibility() === "public") {
            return true;
        }

        return false;
    }

    public static function getVisibilityFromInstances($context, $data, $defassign)
    {
        $visibility_final = true;

        if ($defassign->isType(MyDefinition::TYPE_PROPERTY)) {
            $copy_defassign = clone $defassign;
            $prop = $copy_defassign->property->popProperty();
            $visibility_final = false;

            $instances = ResolveDefs::selectInstances($context, $data, $copy_defassign);

            foreach ($instances as $instance) {
                if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                    $id_object = $instance->getObjectId();
                    $tmp_myclass = $context->getObjects()->getMyClassFromObject($id_object);

                    if (!is_null($tmp_myclass)) {
                        $property = $tmp_myclass->getProperty($prop);

                        if (!is_null($property) && (ResolveDefs::getVisibility($copy_defassign, $property))) {
                            $visibility_final = true;
                            break;
                        }
                    }
                }
            }

            if (count($instances) === 0) {
                $visibility_final = true;
            }
        }

        return $visibility_final;
    }

    public static function selectDefinitions($context, $data, $defsearch, $bypass_isnearest = false)
    {
        $defsfound = [];
        if (is_null($data)) {
            return $defsfound;
        }

        foreach ($data as $def) {
            if (Definitions::defEquality($def, $defsearch, $bypass_isnearest)
                        && ResolveDefs::isNearest($context, $defsearch, $def)) {
                // CA SERT A QUOI ICI REDONDANT AVEC LE DERNIER ?
                if ($def->isType(MyDefinition::TYPE_INSTANCE)
                    && $defsearch->isType(MyDefinition::TYPE_INSTANCE)) {
                    $defsfound[$def->getBlockId()][] = $def;
                } elseif (($def->isType(MyDefinition::TYPE_PROPERTY) ===
                $defsearch->isType(MyDefinition::TYPE_PROPERTY))
                    || ($def->isType(MyDefinition::TYPE_INSTANCE) ===
                    $defsearch->isType(MyDefinition::TYPE_INSTANCE))) {
                    if ($def->isType(MyDefinition::TYPE_PROPERTY)
                        && $defsearch->isType(MyDefinition::TYPE_PROPERTY)) {
                        $defsfound[$def->getBlockId()][] = $def;
                    } elseif (!$def->isType(MyDefinition::TYPE_PROPERTY)
                        && !$defsearch->isType(MyDefinition::TYPE_PROPERTY)) {
                        $defsfound[$def->getBlockId()][] = $def;
                    }
                } // we are looking for the nearest not instance of a property
                elseif (!$def->isType(MyDefinition::TYPE_INSTANCE)
                    && $defsearch->isType(MyDefinition::TYPE_PROPERTY)) {
                    $defsfound[$def->getBlockId()][] = $def;
                }
            }
        }

        // si on a trouvé des defs dans le même bloc que la ou on cherche elles killent les autres
        if (isset($defsfound[$defsearch->getBlockId()])
                    && count($defsfound[$defsearch->getBlockId()]) > 0) {
            $defsfound_good[$defsearch->getBlockId()] = $defsfound[$defsearch->getBlockId()];
        } else {
            $defsfound_good = $defsfound;
        }

        $truedefsfound = [];

        foreach ($defsfound_good as $blockdefs) {
            $nearestdef = null;

            foreach ($blockdefs as $block_id => $deflast) {
                if (!$bypass_isnearest) {
                    if (ResolveDefs::isNearest($context, $defsearch, $deflast)) {
                        if (is_null($nearestdef) || ResolveDefs::isNearest($context, $deflast, $nearestdef)) {
                            $nearestdef = $deflast;
                        }
                    }
                } else {
                    $truedefsfound[] = $deflast;
                }
            }

            if (!is_null($nearestdef) && !$bypass_isnearest) {
                $truedefsfound[] = $nearestdef;
            }
        }

        return $truedefsfound;
    }

    public static function selectInstances($context, $data, $tempdefa, $bypass_isnearest = false)
    {
        $instances_defs = [];

        // we can have multiple instances with the same property assigned
        // we are looking for and instance, not a property
        $copy_tempdefa = clone $tempdefa;

        if (!$copy_tempdefa->isType(MyDefinition::TYPE_INSTANCE)) {
            $copy_tempdefa->addType(MyDefinition::TYPE_INSTANCE);
        }

        if ($copy_tempdefa->isType(MyDefinition::TYPE_ARRAY)) {
            $copy_tempdefa->removeType(MyDefinition::TYPE_ARRAY);
        }

        $copy_tempdefa->setArrayValue(false);

        $instances_defs = ResolveDefs::selectDefinitions(
            $context,
            $data,
            $copy_tempdefa,
            $bypass_isnearest
        );

        return $instances_defs;
    }

    public static function selectProperties($context, $data, $tempdefa, $bypass_visibility = false)
    {
        $properties_defs = [];

        if ($tempdefa->isType(MyDefinition::TYPE_PROPERTY)) {
            $prop_line = $tempdefa->getLine();
            $prop_column = $tempdefa->getColumn();

            $tempdefa_prop = clone $tempdefa;
            $first_properties = [];
            $is_first_property = true;
            $property_exist = false;

            if (is_array($tempdefa->property->getProperties())) {
                $myproperties = $tempdefa->property->getProperties();
                for ($index_property = count($myproperties) - 1; $index_property !== -1; $index_property --) {
                    $tempdefa_prop->setLine($prop_line);
                    $tempdefa_prop->setColumn($prop_column);

                    $defs = ResolveDefs::selectDefinitions(
                        $context,
                        $data,
                        $tempdefa_prop,
                        $bypass_visibility
                    );

                    $tempdefa_prop->property->popProperty();
                    $prop = $myproperties[$index_property];

                    if (count($defs) > 0) {
                        foreach ($defs as $defa) {
                            if ($defa->isType(MyDefinition::TYPE_PROPERTY)) {
                                // if we found a property, we are looking for the nearest instance or not instance
                                // and we are looking for an instance that contains this visible property
                                $instances = ResolveDefs::selectInstances($context, $data, $tempdefa_prop);

                                foreach ($instances as $instance) {
                                    $id_object = $instance->getObjectId();
                                    $tmp_myclass = $context->getObjects()->getMyClassFromObject($id_object);


                                    if (!is_null($tmp_myclass)) {
                                        $property = $tmp_myclass->getProperty($prop);

                                        if (!is_null($property)
                                            && (ResolveDefs::getVisibility($defa, $property) || $bypass_visibility)) {
                                            $property_exist = true;

                                            if ($is_first_property || $bypass_visibility) {
                                                $is_first_property = false;

                                                // if the instance is nearest (deeper) than the property,
                                                // it has the priority
                                                if (ResolveDefs::isNearest($context, $instance, $defa)) {
                                                    $first_properties[] = $property;
                                                } // else property exist in the nearest instance
                                                //but property has the priority
                                                else {
                                                    $first_properties[] = $defa;
                                                }
                                            }
                                        }
                                    }
                                }

                                if (count($instances) === 0 && $first_properties) {
                                    $property_exist = true;
                                    $first_properties[] = $defa;
                                }
                            }
                        }
                    } else {
                        // we didn't find a property, we are looking for the nearest instance
                        // or not instance
                        $instances = ResolveDefs::selectInstances($context, $data, $tempdefa_prop);

                        foreach ($instances as $instance) {
                            if ($instance->isType(MyDefinition::TYPE_INSTANCE)) {
                                for ($i = $index_property; $i < count($myproperties); $i++) {
                                    $id_object = $instance->getObjectId();
                                    $tmp_myclass = $context->getObjects()->getMyClassFromObject($id_object);

                                    if (!is_null($tmp_myclass)) {
                                        $prop = $myproperties[$i];
                                        $property = $tmp_myclass->getProperty($prop);

                                        if (!is_null($property)
                                            && (ResolveDefs::getVisibility($tempdefa_prop, $property)
                                                || $bypass_visibility)) {
                                            $limit = count($myproperties) - 1;

                                            if ($property->isType(MyDefinition::TYPE_INSTANCE)
                                                && $i < (count($myproperties) - 1)) {
                                                $instance = $property;
                                            } elseif ($i === (count($myproperties) - 1)) {
                                                $properties_defs[] = $property;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($property_exist) {
                foreach ($first_properties as $first_property) {
                    $properties_defs[] = $first_property;
                }
            }
        }

        return $properties_defs;
    }

    public static function selectGlobals($name_global, $context, $data, $tempdefa, $is_iterator, $isAssign, $call_stack)
    {
        if (is_array($call_stack)) {
            for ($call_number = count($call_stack) - 1; $call_number !== 0; $call_number --) {
                $current_context_call = $call_stack[$call_number][4];

                // ca peut arriver si on est dans le main() est qu'on appelle une globale
                if (!is_null($current_context_call->func_called) && !is_null($current_context_call->func_callee)) {
                    // we can't looking for an element of a global array in PHP
                    $tempdefa->removeType(MyDefinition::TYPE_ARRAY);
                    $tempdefa->setArrayValue(false);

                    $tempdefa->setName($name_global);
                    $tempdefa->setLine($current_context_call->func_called->getLine());
                    $tempdefa->setColumn($current_context_call->func_called->getColumn());
                    $tempdefa->setBlockId($current_context_call->func_callee->getLastBlockId());

                    $res_global = ResolveDefs::temporarySimple(
                        $context,
                        $current_context_call->func_callee->getDefs(),
                        $tempdefa,
                        $is_iterator,
                        $isAssign,
                        $current_context_call
                    );
                    if (!(count($res_global) === 1 && $res_global[0] === $tempdefa)) {
                        return $res_global;
                    }
                }
            }
        }

        return array();
    }

    public static function temporarySimple($context, $data, $tempdefa, $is_iterator, $isAssign, $call_stack)
    {
        if ($tempdefa->isType(MyDefinition::TYPE_ARRAY) && $tempdefa->getName() === "GLOBALS") {
            return ResolveDefs::selectGlobals(
                key($tempdefa->getArrayValue()),
                $context,
                $data,
                $tempdefa,
                $is_iterator,
                $isAssign,
                $call_stack
            );
        } else {
            $myexpr = $tempdefa->getExpr();

            if ($tempdefa->isType(MyDefinition::TYPE_PROPERTY)) {
                $defs = ResolveDefs::selectProperties(
                    $context,
                    $data->getOutMinusKill($tempdefa->getBlockId()),
                    $tempdefa
                );
            } else {
                $defs = ResolveDefs::selectDefinitions(
                    $context,
                    $data->getOutMinusKill($tempdefa->getBlockId()),
                    $tempdefa,
                    $is_iterator
                );
            }

            $gooddefs = [];
            if (count($defs) > 0) {
                foreach ($defs as $defz) {
                    if ($defz->isType(MyDefinition::TYPE_GLOBAL)) {
                        return ResolveDefs::selectGlobals(
                            $defz->getName(),
                            $context,
                            $data,
                            $tempdefa,
                            $is_iterator,
                            $isAssign,
                            $call_stack
                        );
                    } else {
                        $defaa = ArrayAnalysis::temporarySimple(
                            $context,
                            $data->getOutMinusKill($tempdefa->getBlockId()),
                            $tempdefa,
                            $defz,
                            $is_iterator,
                            $isAssign
                        );

                        foreach ($defaa as $defa) {
                            if ($defa->isType(MyDefinition::TYPE_REFERENCE)) {
                                $refdef = new MyDefinition(
                                    $tempdefa->getLine(),
                                    $tempdefa->getColumn(),
                                    $defa->getRefName()
                                );
                                $refdef->setBlockId($tempdefa->getBlockId());
                                $refdef->setSourceMyFile($tempdefa->getSourceMyFile());

                                if ($defa->isType(MyDefinition::TYPE_ARRAY_REFERENCE)) {
                                    $refdef->addType(MyDefinition::TYPE_ARRAY);
                                    $refdef->setArrayValue($defa->getRefArrValue());
                                }

                                $truerefs = ResolveDefs::selectDefinitions(
                                    $context,
                                    $data->getOutMinusKill($refdef->getBlockId()),
                                    $refdef
                                );

                                foreach ($truerefs as $ref) {
                                    $myexpr->addDef($ref);
                                    $gooddefs[] = $ref;
                                }

                                unset($truerefs);
                            } else {
                                $myexpr->addDef($defa);
                                $gooddefs[] = $defa;
                            }
                        }
                    }
                }
            } else {
                $myexpr->addDef($tempdefa);
                $gooddefs[] = $tempdefa;
            }

            return $gooddefs;
        }
    }
}
