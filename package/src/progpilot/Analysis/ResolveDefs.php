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
use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyInstance;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;
use progpilot\Objects\MyFunction;

class ResolveDefs
{
    public static function funccall_return_values($context, $myfunc_call, $instruction, $mycode, $index)
    {
        if ($myfunc_call->get_name() == "dirname")
        {
            $codes = $mycode->get_codes();
            if (isset($codes[$index + 2]) && $codes[$index + 2]->get_opcode() == Opcodes::END_ASSIGN)
            {
                $instruction_def = $codes[$index + 3];
                $mydef_return = $instruction_def->get_property("def");

                if ($instruction->is_property_exist("argdef0"))
                {
                    $defarg = $instruction->get_property("argdef0");
                    foreach ($defarg->get_last_known_values() as $known_value)
                        $mydef_return->add_last_known_value(dirname($known_value));
                }
            }
        }
    }


    public static function funccall_class($context, $data, $myfunc_call)
    {
        $i = 0;
        $class_stack_name = [];

        if ($myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD))
        {
            $properties = $myfunc_call->get_back_def()->property->get_properties();

            $tmp_properties = [];

            while (true)
            {
                $prop_value = [];

                $mydef_tmp = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name_instance());
                $mydef_tmp->set_block_id($myfunc_call->get_block_id());
                $mydef_tmp->set_source_myfile($myfunc_call->get_source_myfile());
                $mydef_tmp->property->set_properties($tmp_properties);
                $mydef_tmp->add_type(MyDefinition::TYPE_PROPERTY);
                $mydef_tmp->set_id($myfunc_call->get_back_def()->get_id() - 1);
                // we don't want the backdef but the original instance

                $instances = ResolveDefs::select_instances(
                                 $context,
                                 $data,
                                 $mydef_tmp);

                foreach ($instances as $instance)
                {
                    if ($instance->is_type(MyDefinition::TYPE_INSTANCE))
                    {
                        $id_object = $instance->get_object_id();
                        $myclasses = $context->get_objects()->get_all_myclasses($id_object);

                        foreach ($myclasses as $myclass)
                        {
                            $class_exist = false;
                            foreach ($prop_value as $value_class)
                            {
                                if ($value_class->get_name() === $myclass->get_name())
                                {
                                    $class_exist = true;
                                    break;
                                }
                            }

                            if (!$class_exist)
                                $prop_value[] = $myclass;
                        }
                    }
                }

                $class_stack_name[] = $prop_value;

                if (!isset($properties[$i]))
                    break;

                $tmp_properties[] = $properties[$i];

                $i ++;
            }
        }

        return $class_stack_name;
    }

    // copy_instance et instance_build_back ont les même fonctionnalités
    public static function copy_instance($context, $data, $myfunc_call)
    {
        if ($myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD))
        {
            $backdef = $myfunc_call->get_back_def();

            $mydef = new MyDefinition(
                $myfunc_call->getLine(),
                $myfunc_call->getColumn(),
                $myfunc_call->get_name_instance());

            $mydef->set_id($backdef->get_id() - 1);
            $mydef->set_block_id($myfunc_call->get_block_id());
            $mydef->set_source_myfile($backdef->get_source_myfile());

            if ($backdef->is_type(MyDefinition::TYPE_PROPERTY))
                $mydef->add_type(MyDefinition::TYPE_PROPERTY);

            $mydef->property->set_properties($backdef->property->get_properties());

            $instances = ResolveDefs::select_instances(
                             $context,
                             $data->getoutminuskill($mydef->get_block_id()),
                             $mydef);

            foreach ($instances as $instance)
            {
                $id_object = $instance->get_object_id();
                $myclasses = $context->get_objects()->get_all_myclasses($id_object);

                foreach ($myclasses as $myclass)
                {
                    $new_myclass = new MyClass($instance->getLine(),
                                               $instance->getColumn(),
                                               $myclass->get_name());

                    foreach ($myclass->get_properties() as $property)
                    {
                        $new_property = clone $property;
                        $new_myclass->add_property($new_property);
                    }

                    foreach ($myclass->get_methods() as $method)
                    {
                        $new_method = clone $method;
                        $new_myclass->add_method($new_method);
                    }

                    $id_object = $backdef->get_object_id();
                    $context->get_objects()->add_myclass_to_object($id_object, $new_myclass);
                }
            }
        }
    }

    public static function instance_build_back($context, $data, $myfunc, $myfunc_call)
    {
        if (!is_null($myfunc) && $myfunc->is_type(MyFunction::TYPE_FUNC_METHOD))
        {
            if ($myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD))
            {
                $mybackdef = $myfunc_call->get_back_def();
                $myclass = $myfunc->get_myclass();

                $new_myback_myclass = $context->get_objects()->get_myclass($mybackdef->get_object_id(), $myclass);

                if (is_null($new_myback_myclass))
                {
                    $new_myback_myclass = new MyClass(
                        $myclass->getLine(),
                        $myclass->getColumn(),
                        $myclass->get_name());

                    $context->get_objects()->add_myclass_to_object($mybackdef->get_object_id(), $new_myback_myclass);
                }

                $copy_myclass = clone $myclass;

                foreach ($copy_myclass->get_properties() as $property)
                {
                    $mydef = new MyDefinition($myfunc->get_last_line() + 1, $myfunc->get_last_column(), "this");

                    $mydef->add_type(MyDefinition::TYPE_PROPERTY);
                    $mydef->property->set_properties($property->property->get_properties());
                    $mydef->set_block_id($myfunc->get_last_block_id());
                    $mydef->set_source_myfile($mybackdef->get_source_myfile());

                    $new_property = $new_myback_myclass->get_property($property->property->get_properties()[0]);
                    if (is_null($new_property))
                    {
                        $new_myback_myclass->add_property($property);
                        $new_property = $property;
                    }
                    $defs = ResolveDefs::select_definitions($context,
                                                            $myfunc->get_defs()->getoutminuskill($mydef->get_block_id()),
                                                            $mydef);

                    foreach ($defs as $def_found)
                    {
                        if ($def_found->is_tainted())
                            $new_property->set_tainted(true);

                        if ($def_found->is_sanitized())
                        {
                            $new_property->set_sanitized(true);
                            foreach ($def_found->get_type_sanitized() as $type_sanitized)
                                $new_property->add_type_sanitized($type_sanitized);
                        }
                    }

                    $new_property->set_name($mybackdef->get_name());

                    ArrayAnalysis::copy_array($context, $myfunc->get_defs()->getoutminuskill($mydef->get_block_id()), $mydef, $mydef->get_array_value(), $property, $property->get_array_value());
                }

                foreach ($copy_myclass->get_methods() as $method)
                {
                    $new_method = clone $method;
                    $new_myback_myclass->add_method($new_method);
                }
            }
        }
    }

    public static function instance_build_this($context, $data, $myfunc, $myfunc_call)
    {
        if (!is_null($myfunc) && $myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD))
        {
            $myclass = $myfunc->get_myclass();
            $copy_myclass = clone $myclass;

            foreach ($copy_myclass->get_properties() as $property)
            {
                $mydef = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name_instance());
                $mydef->add_type(MyDefinition::TYPE_PROPERTY);
                $mydef->property->set_properties($property->property->get_properties());
                $mydef->set_block_id($myfunc_call->get_block_id());
                $mydef->set_source_myfile($myfunc_call->get_source_myfile());
                $mydef->set_id($myfunc_call->get_id());

                $defs_found = ResolveDefs::select_properties($context, $data, $mydef, true);

                foreach ($defs_found as $def_found)
                {
                    if ($def_found->is_type(MyDefinition::TYPE_COPY_ARRAY))
                    {
                        $property->set_copyarrays($def_found->get_copyarrays());
                        $property->add_type(MyDefinition::TYPE_COPY_ARRAY);
                    }

                    if ($def_found->is_tainted())
                        $property->set_tainted(true);

                    if ($def_found->is_sanitized())
                    {
                        $property->set_sanitized(true);
                        foreach ($def_found->get_type_sanitized() as $type_sanitized)
                            $property->add_type_sanitized($type_sanitized);
                    }
                }

                $property->set_name("this");
            }

            $mythisdef = $myfunc->get_this_def();
            $mythisdef->set_class_name($copy_myclass->get_name());

            $id_object = $mythisdef->get_object_id();
            $context->get_objects()->add_myclass_to_object($id_object, $copy_myclass);
        }
    }

    // def1 and def2 defined in different files
    // return true if def1 is deeper by def2
    public static function is_nearest_includes($def1, $def2)
    {
        $def1_includedby_def2 = false;

        $myfile = $def1->get_source_myfile();
        while (!is_null($myfile))
        {
            $myfile_from = $myfile->get_included_from_myfile();
            if (!is_null($myfile_from) && ($myfile_from->get_name() === $def2->get_source_myfile()->get_name()))
            {
                $def1_includedby_def2 = true;
                break;
            }

            $myfile = $myfile_from;
        }

        if (!$def1_includedby_def2)
        {
            $def2_includedby_def1 = false;
            $myfile = $def2->get_source_myfile();
            while (!is_null($myfile))
            {
                $myfile_from = $myfile->get_included_from_myfile();
                if (!is_null($myfile_from) && ($myfile_from->get_name() === $def1->get_source_myfile()->get_name()))
                {
                    $def2_includedby_def1 = true;
                    break;
                }

                $myfile = $myfile_from;
            }
        }

        // the two defs are defined in different included file
        if (!$def1_includedby_def2 && !$def2_includedby_def1)
        {
            $myfile_def1 = $def1->get_source_myfile();
            while (!is_null($myfile_def1))
            {
                $myfile_def2 = $def2->get_source_myfile();
                while (!is_null($myfile_def2))
                {
                    // we found the file from where the include chain start
                    if ($myfile_def1->get_name() === $myfile_def2->get_name())
                    {
                        // if the file of def1 is included later so def1 is deeper
                        if (($myfile_def1->getLine() > $myfile_def2->getLine())
                                || ($myfile_def1->getLine() == $myfile_def2->getLine() &&  $myfile_def1->getColumn() >= $myfile_def2->getColumn()))
                            return true;
                        else
                            return false;
                    }

                    $myfile_def2 = $myfile_def2->get_included_from_myfile();
                }

                $myfile_def1 = $myfile_def1->get_included_from_myfile();
            }
        }

        // def1 is included by file from def2
        // but def2 defined before or after the include ?
        if ($def1_includedby_def2)
        {
            // def2 defined after the include so def2 is deeper
            if (($def2->getLine() > $myfile->getLine())
                    || ($def2->getLine() == $myfile->getLine() &&  $def2->getColumn() >= $myfile->getColumn()))
                return false;

            return true;
        }

        // def2 is included by file from def1
        // but def1 defined before or after the include ?
        if ($def2_includedby_def1)
        {
            // def1 defined after the include so def1 is deeper

            if (($def1->getLine() > $myfile->getLine())
                    || ($def1->getLine() == $myfile->getLine() &&  $def1->getColumn() >= $myfile->getColumn()))
                return true;

            return false;
        }

        return false;
    }

    // return true if op is deeper in code than def
    public static function is_nearest($context, $def1, $def2)
    {
        if ($def1->get_source_myfile()->get_name() === $def2->get_source_myfile()->get_name())
        {
            // def1 is deeper in the code

            if ($def1->getLine() > $def2->getLine())
                return true;

            // the two defs are on the same line
            if ($def1->getLine() == $def2->getLine())
            {
                if ($def1->get_id() >= $def2->get_id())
                    return true;
            }
        }
        else
            return ResolveDefs::is_nearest_includes($def1, $def2);

        return false;
    }

    public static function get_visibility_method($def_name, $method)
    {
        if ($def_name === "this")
            return true;

        if (!is_null($method)
                && $method->is_type(MyFunction::TYPE_FUNC_METHOD)
                && $method->get_visibility() === "public")
            return true;

        return false;
    }

    public static function get_visibility($def, $property)
    {
        if (!is_null($def) && $def->get_name() === "this")
            return true;

        if (!is_null($property)
                && $property->is_type(MyDefinition::TYPE_PROPERTY)
                && $property->property->get_visibility() === "public")
            return true;

        return false;
    }

    public static function get_visibility_from_instances($context, $data, $defassign)
    {
        $visibility_final = true;

        if ($defassign->is_type(MyDefinition::TYPE_PROPERTY))
        {
            $copy_defassign = clone $defassign;
            $prop = $copy_defassign->property->pop_property();
            $visibility_final = false;

            $instances = ResolveDefs::select_instances($context, $data, $copy_defassign);

            foreach ($instances as $instance)
            {
                if ($instance->is_type(MyDefinition::TYPE_INSTANCE))
                {
                    $id_object = $instance->get_object_id();
                    $tmp_myclasses = $context->get_objects()->get_all_myclasses($id_object);

                    foreach ($tmp_myclasses as $tmp_myclass)
                    {
                        $property = $tmp_myclass->get_property($prop);

                        if (!is_null($property) && (ResolveDefs::get_visibility($copy_defassign, $property)))
                        {
                            $visibility_final = true;
                            break 2;
                        }
                    }
                }
            }

            if (count($instances) == 0)
                $visibility_final = true;
        }

        return $visibility_final;
    }

    public static function select_definitions($context, $data, $defsearch, $bypass_isnearest = false)
    {
        $defsfound = [];
        if (is_null($data))
            return $defsfound;

        foreach ($data as $def)
        {
            if (Definitions::def_equality($def, $defsearch, $bypass_isnearest)
                    && ResolveDefs::is_nearest($context, $defsearch, $def))
            {
                // CA SERT A QUOI ICI REDONDANT AVEC LE DERNIER ?
                if ($def->is_type(MyDefinition::TYPE_INSTANCE) && $defsearch->is_type(MyDefinition::TYPE_INSTANCE))
                {
                    $defsfound[$def->get_block_id()][] = $def;
                }

                else if (($def->is_type(MyDefinition::TYPE_PROPERTY) == $defsearch->is_type(MyDefinition::TYPE_PROPERTY))
                         || ($def->is_type(MyDefinition::TYPE_INSTANCE) == $defsearch->is_type(MyDefinition::TYPE_INSTANCE)))
                {
                    if ($def->is_type(MyDefinition::TYPE_PROPERTY) && $defsearch->is_type(MyDefinition::TYPE_PROPERTY))
                        $defsfound[$def->get_block_id()][] = $def;

                    else if (!$def->is_type(MyDefinition::TYPE_PROPERTY) && !$defsearch->is_type(MyDefinition::TYPE_PROPERTY))
                        $defsfound[$def->get_block_id()][] = $def;

                }
                // we are looking for the nearest not instance of a property
                else if (!$def->is_type(MyDefinition::TYPE_INSTANCE) && $defsearch->is_type(MyDefinition::TYPE_PROPERTY))
                {
                    $defsfound[$def->get_block_id()][] = $def;
                }
            }
        }

        // si on a trouvé des defs dans le même bloc que la ou on cherche elles killent les autres
        if (isset($defsfound[$defsearch->get_block_id()])
                && count($defsfound[$defsearch->get_block_id()]) > 0)
            $defsfound_good[$defsearch->get_block_id()] = $defsfound[$defsearch->get_block_id()];
        else
            $defsfound_good = $defsfound;

        $truedefsfound = [];

        foreach ($defsfound_good as $blockdefs)
        {
            $nearestdef = null;

            foreach($blockdefs as $block_id => $deflast)
            {
                if (!$bypass_isnearest)
                {
                    if (ResolveDefs::is_nearest($context, $defsearch, $deflast))
                    {
                        if (is_null($nearestdef) || ResolveDefs::is_nearest($context, $deflast, $nearestdef))
                            $nearestdef = $deflast;
                    }
                }
                else
                    $truedefsfound[] = $deflast;
            }

            if (!is_null($nearestdef) && !$bypass_isnearest)
                $truedefsfound[] = $nearestdef;
        }

        return $truedefsfound;
    }

    public static function select_instances($context, $data, $tempdefa, $bypass_isnearest = false)
    {
        $instances_defs = [];

        // we can have multiple instances with the same property assigned
        // we are looking for and instance, not a property
        $copy_tempdefa = clone $tempdefa;

        $copy_tempdefa->remove_type(MyDefinition::TYPE_PROPERTY);
        $copy_tempdefa->add_type(MyDefinition::TYPE_INSTANCE);
        $copy_tempdefa->remove_type(MyDefinition::TYPE_ARRAY);

        $copy_tempdefa->set_array_value(false);

        $instances_defs = ResolveDefs::select_definitions(
                              $context,
                              $data,
                              $copy_tempdefa,
                              $bypass_isnearest);


        return $instances_defs;
    }

    public static function select_properties($context, $data, $tempdefa, $bypass_visibility = false)
    {
        $properties_defs = [];

        if ($tempdefa->is_type(MyDefinition::TYPE_PROPERTY))
        {
            $prop_line = $tempdefa->getLine();
            $prop_column = $tempdefa->getColumn();

            $tempdefa_prop = clone $tempdefa;
            $first_properties = [];
            $is_first_property = true;
            $property_exist = false;

            if (is_array($tempdefa->property->get_properties()))
            {
                foreach ($tempdefa->property->get_properties() as $prop)
                {
                    $tempdefa_prop->setLine($prop_line);
                    $tempdefa_prop->setColumn($prop_column);

                    $defs = ResolveDefs::select_definitions(
                                $context,
                                $data,
                                $tempdefa_prop,
                                $bypass_visibility);

                    $prop = $tempdefa_prop->property->pop_property();

                    if (count($defs) > 0)
                    {
                        foreach ($defs as $defa)
                        {
                            if ($defa->is_type(MyDefinition::TYPE_PROPERTY))
                            {
                                // if we found a property, we are looking for the nearest instance or not instance
                                // and we are looking for an instance that contains this visible property
                                $instances = ResolveDefs::select_instances($context, $data, $tempdefa_prop);

                                foreach ($instances as $instance)
                                {
                                    $id_object = $instance->get_object_id();
                                    $tmp_myclasses = $context->get_objects()->get_all_myclasses($id_object);

                                    foreach ($tmp_myclasses as $tmp_myclass)
                                    {
                                        $property = $tmp_myclass->get_property($prop);

                                        if (!is_null($property) && (ResolveDefs::get_visibility($defa, $property) || $bypass_visibility))
                                        {
                                            $property_exist = true;

                                            if ($is_first_property || $bypass_visibility)
                                            {
                                                $is_first_property = false;

                                                // if the instance is nearest (deeper) than the property, it has the priority
                                                if (ResolveDefs::is_nearest($context, $instance, $defa))
                                                    $first_properties[] = $property;

                                                // else property exist in the nearest instance but property has the priority
                                                else
                                                    $first_properties[] = $defa;
                                            }
                                        }
                                    }
                                }

                                if (count($instances) == 0 && $first_properties)
                                {
                                    $property_exist = true;
                                    $first_properties[] = $defa;
                                }
                            }
                        }
                    }
                    else
                    {
                        // we didn't find a property, we are looking for the nearest instance or not instance
                        $instances = ResolveDefs::select_instances($context, $data, $tempdefa_prop);

                        foreach ($instances as $instance)
                        {
                            if ($instance->is_type(MyDefinition::TYPE_INSTANCE))
                            {
                                $id_object = $instance->get_object_id();
                                $tmp_myclasses = $context->get_objects()->get_all_myclasses($id_object);

                                foreach ($tmp_myclasses as $tmp_myclass)
                                {
                                    $property = $tmp_myclass->get_property($prop);

                                    if (!is_null($property) && (ResolveDefs::get_visibility($tempdefa_prop, $property) || $bypass_visibility))
                                        $properties_defs[] = $property;
                                }
                            }
                        }
                    }

                    if (!$property_exist)
                        break;
                }
            }

            if ($property_exist)
            {
                foreach ($first_properties as $first_property)
                {
                    $properties_defs[] = $first_property;
                }
            }

        }

        return $properties_defs;
    }

    public static function select_globals($name_global, $context, $data, $tempdefa, $is_iterator, $is_assign, $call_stack)
    {
        for ($call_number = count($call_stack) - 1; $call_number != 0; $call_number --)
        {
            $current_context_call = $call_stack[$call_number][4];

            // ca peut arriver si on est dans le main() est qu'on appelle une globale
            if (!is_null($current_context_call->func_called) && !is_null($current_context_call->func_callee))
            {
                // we can't looking for an element of a global array in PHP
                $tempdefa->remove_type(MyDefinition::TYPE_ARRAY);
                $tempdefa->set_array_value(false);

                $tempdefa->set_name($name_global);
                $tempdefa->setLine($current_context_call->func_called->getLine());
                $tempdefa->setColumn($current_context_call->func_called->getColumn());
                $tempdefa->set_block_id($current_context_call->func_callee->get_last_block_id());

                $res_global = ResolveDefs::temporary_simple($context, $current_context_call->func_callee->get_defs(), $tempdefa, $is_iterator, $is_assign, $current_context_call);
                if (!(count($res_global) == 1 && $res_global[0] === $tempdefa))
                    return $res_global;
            }
        }

        return array();
    }

    public static function temporary_simple($context, $data, $tempdefa, $is_iterator, $is_assign, $call_stack)
    {
        if ($tempdefa->is_type(MyDefinition::TYPE_ARRAY) && $tempdefa->get_name() === "GLOBALS")
            return ResolveDefs::select_globals(key($tempdefa->get_array_value()), $context, $data, $tempdefa, $is_iterator, $is_assign, $call_stack);

        else
        {
            $myexpr = $tempdefa->get_expr();

            if ($tempdefa->is_type(MyDefinition::TYPE_PROPERTY))
                $defs = ResolveDefs::select_properties(
                            $context,
                            $data->getoutminuskill($tempdefa->get_block_id()),
                            $tempdefa);

            else
                $defs = ResolveDefs::select_definitions(
                            $context,
                            $data->getoutminuskill($tempdefa->get_block_id()),
                            $tempdefa, $is_iterator);


            $gooddefs = [];
            if (count($defs) > 0)
            {
                foreach ($defs as $defz)
                {
                    if ($defz->is_type(MyDefinition::TYPE_GLOBAL))
                        return ResolveDefs::select_globals($defz->get_name(), $context, $data, $tempdefa, $is_iterator, $is_assign, $call_stack);

                    else
                    {
                        $defaa = ArrayAnalysis::temporary_simple($context, $data->getoutminuskill($tempdefa->get_block_id()), $tempdefa, $defz, $is_iterator, $is_assign);

                        foreach ($defaa as $defa)
                        {
                            if ($defa->is_type(MyDefinition::TYPE_REFERENCE))
                            {
                                $refdef = new MyDefinition($tempdefa->getLine(), $tempdefa->getColumn(), $defa->get_ref_name());
                                $refdef->set_block_id($tempdefa->get_block_id());
                                $refdef->set_source_myfile($tempdefa->get_source_myfile());

                                if ($defa->is_type(MyDefinition::TYPE_ARRAY_REFERENCE))
                                {
                                    $refdef->add_type(MyDefinition::TYPE_ARRAY);
                                    $refdef->set_array_value($defa->get_ref_arr_value());
                                }

                                $truerefs = ResolveDefs::select_definitions($context,
                                            $data->getoutminuskill($refdef->get_block_id()),
                                            $refdef);

                                foreach ($truerefs as $ref)
                                {
                                    $myexpr->add_def($ref);
                                    $gooddefs[] = $ref;
                                }

                                unset($truerefs);
                            }
                            else
                            {
                                $myexpr->add_def($defa);
                                $gooddefs[] = $defa;
                            }
                        }
                    }
                }
            }
            else
            {
                $myexpr->add_def($tempdefa);
                $gooddefs[] = $tempdefa;
            }

            return $gooddefs;
        }
    }
}
