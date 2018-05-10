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
use progpilot\Code\MyInstruction;

use progpilot\Utils;

class VisitorAnalysis
{
        private $context;
        private $current_storagemyblocks;
        private $call_stack;

        private $defs;
        private $blocks;

        private $current_myfunc;
        private $current_context_call;
        private $current_myblock;

        public function __construct()
        {
            $this->current_storagemyblocks = null;
            $this->call_stack = [];
            $this->myblock_stack = [];

            $this->current_myfunc = null;
            $this->current_context_call = null;
            $this->current_myblock = null;

            $this->defs = null;
            $this->blocks = null;
        }

        public function in_call_stack($cur_func)
        {
            foreach ($this->call_stack as $call)
            {
                $call_func = $call[0];

                if ($call_func->get_name() === $cur_func->get_name() && !$call_func->is_type(MyFunction::TYPE_FUNC_METHOD) && !$cur_func->is_type(MyFunction::TYPE_FUNC_METHOD))
                    return true;

                if ($call_func->get_name() === $cur_func->get_name() && $call_func->is_type(MyFunction::TYPE_FUNC_METHOD) && $cur_func->is_type(MyFunction::TYPE_FUNC_METHOD))
                {
                    $cur_class = $cur_func->get_myclass();
                    $call_class = $call_func->get_myclass();

                    if ($cur_class->get_name() === $call_class->get_name())
                        return true;
                }
            }

            return false;
        }

        public function get_myblock($context)
        {

            $this->context = $context;
        }

        public function set_context($context)
        {

            $this->context = $context;
        }

        public function analyze($mycode, $myfunc_called = null)
        {
            $index = $mycode->get_start();
            $code = $mycode->get_codes();

            do
            {
                if (isset($code[$index]))
                {
                    $instruction = $code[$index];

                    switch ($instruction->get_opcode())
                    {
                        case Opcodes::ENTER_BLOCK:
                        {
                            $myblock = $instruction->get_property(MyInstruction::MYBLOCK);

                            if ($this->current_storagemyblocks->contains($myblock))
                            {
                                array_pop($this->myblock_stack);

                                if (count($this->myblock_stack) > 0)
                                    $this->current_myblock = $this->myblock_stack[count($this->myblock_stack) - 1];

                                $index = $myblock->get_end_address_block();
                                break;
                            }

                            $this->current_myblock = $myblock;

                            array_push($this->myblock_stack, $this->current_myblock);

                            $this->current_storagemyblocks->attach($myblock);

                            foreach ($myblock->parents as $blockparent)
                            {
                                $addr_start = $blockparent->get_start_address_block();
                                $addr_end = $blockparent->get_end_address_block();

                                if (!$this->current_storagemyblocks->contains($blockparent))
                                {
                                    $oldindex_start = $mycode->get_start();
                                    $oldindex_end = $mycode->get_end();

                                    $mycode->set_start($addr_start);
                                    $mycode->set_end($addr_end);

                                    $this->analyze($mycode);

                                    $mycode->set_start($oldindex_start);
                                    $mycode->set_end($oldindex_end);
                                }
                            }

                            break;
                        }

                        case Opcodes::LEAVE_BLOCK:
                        {
                            array_pop($this->myblock_stack);

                            if (count($this->myblock_stack) > 0)
                                $this->current_myblock = $this->myblock_stack[count($this->myblock_stack) - 1];

                            break;
                        }

                        case Opcodes::LEAVE_FUNCTION:
                        {
                            $myfunc = $instruction->get_property(MyInstruction::MYFUNC);

                            if ($myfunc->get_name() === "{main}")
                                return;

                            $val = array_pop($this->call_stack);

                            $this->current_context_call = $val[4];
                            $this->current_storagemyblocks = $val[3];
                            $this->defs = $val[2];
                            $this->blocks = $val[1];

                            break;
                        }

                        case Opcodes::ENTER_FUNCTION:
                        {
                            $this->current_context_call = new \stdClass;
                            $this->current_context_call->func_called = $myfunc_called;
                            $this->current_context_call->func_callee = $this->current_myfunc;

                            $this->current_myfunc = $instruction->get_property(MyInstruction::MYFUNC);

                            $val = [$this->current_myfunc, $this->blocks, $this->defs, $this->current_storagemyblocks, $this->current_context_call];
                            array_push($this->call_stack, $val);

                            $this->current_storagemyblocks = new \SplObjectStorage;
                            $this->defs = $this->current_myfunc->get_defs();
                            $this->blocks = $this->current_myfunc->get_blocks();

                            break;
                        }

                        case Opcodes::DEFINITION:
                        {
                            $mydef = $instruction->get_property(MyInstruction::DEF);
                            break;
                        }


                        case Opcodes::END_EXPRESSION:
                        {
                            $expr = $instruction->get_property(MyInstruction::EXPR);

                            if ($expr->is_assign())
                            {
                                $defassign = $expr->get_assign_def();

                                /*
                                 * we have all the resolved defs so maybe when we have two def for one tempdef
                                 * that could lead to abuse the compute of embedded chars for example
                                 * but it's not because all def have the same name (they have been resolved)
                                 * and so same embedded char of tempdef
                                 */

                                ValueAnalysis::compute_sanitized_values($defassign, $expr);
                                ValueAnalysis::compute_embedded_chars($defassign, $expr);
                                ValueAnalysis::compute_cast_values($defassign, $expr);
                                ValueAnalysis::compute_known_values($defassign, $expr);
                            }

                            break;
                        }


                        case Opcodes::TEMPORARY:
                        {
                            $tempdefa = $instruction->get_property(MyInstruction::TEMPORARY);
                            $tempdefa_myexpr = $tempdefa->get_expr();
                            $defassign_myexpr = $tempdefa_myexpr->get_assign_def();

                            if ($tempdefa_myexpr->is_assign() && !$tempdefa_myexpr->is_assign_iterator())
                                ArrayAnalysis::copy_array($this->context, $this->defs->getoutminuskill($tempdefa->get_block_id()), $tempdefa, $tempdefa->get_array_value(), $defassign_myexpr, $defassign_myexpr->get_array_value());

                            $tainted = false;
                            if (!is_null($this->context->inputs->get_source_byname(null, $tempdefa, false, false, $tempdefa->get_array_value())))
                                $tainted = true;
                            $tempdefa->set_tainted($tainted);

                            $defs = ResolveDefs::temporary_simple($this->context, $this->defs, $tempdefa, $tempdefa_myexpr->is_assign_iterator(), $tempdefa_myexpr->is_assign(), $this->call_stack);

                            ValueAnalysis::update_storage_to_expr($tempdefa_myexpr);
                            $storage_cast = ValueAnalysis::$exprs_cast[$tempdefa_myexpr];
                            $storage_knownvalues = ValueAnalysis::$exprs_knownvalues[$tempdefa_myexpr];

                            $new_defsassign[] = $defassign_myexpr;

                            foreach ($defs as $def)
                            {

                                $safe = AssertionAnalysis::temporary_simple($this->context, $this->defs, $this->current_myblock, $def, $tempdefa);
                                $visibility = ResolveDefs::get_visibility_from_instances($this->context, $this->defs->getoutminuskill($def->get_block_id()), $defassign_myexpr);

                                if ($def->is_type(MyDefinition::TYPE_PROPERTY))
                                {
                                    if (!is_null($this->context->inputs->get_source_byname(null, $def, false, $def->get_class_name(), false, $def)))
                                        $def->set_tainted(true);
                                }

                                if ($visibility)
                                {
                                    $storage_cast[] = $tempdefa->get_cast();
                                    $storage_knownvalues["".$tempdefa->get_id().""][] = $def->get_last_known_values();

                                    ValueAnalysis::copy_values($tempdefa, $def);
                                }

                                if ($visibility && !$safe)
                                    TaintAnalysis::set_tainted($def->is_tainted(), $defassign_myexpr, $tempdefa_myexpr);

                                // vérifier s'il y a pas de concat
                                // mis a jour de l'object
                                if ($def->is_type(MyDefinition::TYPE_INSTANCE))
                                {
                                    $defassign_myexpr->add_type(MyDefinition::TYPE_INSTANCE);
                                    $defassign_myexpr->set_object_id($def->get_object_id());

                                    $tmp_myclass = $this->context->get_objects()->get_myclass_from_object($def->get_object_id());
                                    if (!is_null($tmp_myclass))
                                    {
                                        foreach ($tmp_myclass->get_properties() as $property)
                                        {
                                            $mydeftemp = new MyDefinition($tempdefa->getLine(), $tempdefa->getColumn(), $tempdefa->get_name());
                                            $mydeftemp->add_type(MyDefinition::TYPE_PROPERTY);
                                            $mydeftemp->property->set_properties($property->property->get_properties());
                                            $mydeftemp->set_block_id($tempdefa->get_block_id());
                                            $mydeftemp->set_source_myfile($tempdefa->get_source_myfile());
                                            $mydeftemp->set_id($tempdefa->get_id());

                                            $defs_found = ResolveDefs::select_properties($this->context, $this->defs->getoutminuskill($tempdefa->get_block_id()), $mydeftemp, true);
                                            foreach ($defs_found as $def_found)
                                            {
                                                if ($def_found->is_type(MyDefinition::TYPE_COPY_ARRAY))
                                                {
                                                    $property->set_copyarrays($def_found->get_copyarrays());
                                                    $property->add_type(MyDefinition::TYPE_COPY_ARRAY);
                                                }

                                                TaintAnalysis::set_tainted($def_found->is_tainted(), $property, $def_found->get_taintedbyexpr());

                                                if ($def_found->is_sanitized())
                                                {
                                                    $property->set_sanitized(true);
                                                    foreach ($def_found->get_type_sanitized() as $type_sanitized)
                                                        $property->add_type_sanitized($type_sanitized);
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            ValueAnalysis::$exprs_cast[$tempdefa_myexpr] = $storage_cast;
                            ValueAnalysis::$exprs_knownvalues[$tempdefa_myexpr] = $storage_knownvalues;

                            break;
                        }

                        case Opcodes::FUNC_CALL:
                        {
                            $funcname = $instruction->get_property(MyInstruction::FUNCNAME);
                            $arr_funccall = $instruction->get_property(MyInstruction::ARR);
                            $myfunc_call = $instruction->get_property(MyInstruction::MYFUNC_CALL);

                            $list_myfunc = [];
                            IncludeAnalysis::funccall($this->context, $this->defs, $this->blocks, $instruction, $code, $index);

                            $stack_class = null;
                            if ($myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD))
                            {
                                $stack_class = ResolveDefs::funccall_class(
                                                   $this->context,
                                                   $this->defs->getoutminuskill($myfunc_call->get_block_id()),
                                                   $myfunc_call);

                                $class_of_funccall_arr = $stack_class[count($stack_class) - 1];
                                foreach ($class_of_funccall_arr as $class_of_funccall)
                                {
                                    $object_id = $class_of_funccall->get_object_id();

                                    $myclass = $this->context->get_objects()->get_myclass_from_object($object_id);
                                    if (!is_null($myclass))
                                    {
                                        $method = $myclass->get_method($funcname);

                                        if (!ResolveDefs::get_visibility_method($myfunc_call->get_name_instance(), $method))
                                            $method = null;

                                        if (!is_null($method))
                                            $method->get_this_def()->set_object_id($object_id);

                                        $list_myfunc[] = [$object_id, $myclass, $method];



                                        TaintAnalysis::funccall_specify_analysis($method, $stack_class, $this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myclass, $myfunc_call, $arr_funccall, $instruction, $mycode, $index);
                                    }
                                }

                                // we didn't resolve any class so the class of method is unknown (undefined)
                                // but we authorize to specify method of unknown class during the configuration of sinks ...
                                if (count($class_of_funccall_arr) === 0)
                                {
                                    TaintAnalysis::funccall_specify_analysis(null, $stack_class, $this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), null, $myfunc_call, $arr_funccall, $instruction, $mycode, $index);
                                }


                                /*

                                // twig analysis
                                if($this->context->get_analyze_js())
                                {
                                if($myclass->get_name() == "Twig_Environment")
                                {
                                if($myfunc_call->get_name() == "render")
                                {
                                TwigAnalysis::funccall($this->context, $myfunc_call, $instruction);
                                }
                                }
                                }

                                 */
                            }
                            else if ($myfunc_call->is_type(MyFunction::TYPE_FUNC_STATIC))
                            {
                                $myclass_static = $this->context->get_classes()->get_myclass($myfunc_call->get_name_instance());

                                if (!is_null($myclass_static))
                                {
                                    $method = $myclass_static->get_method($funcname);

                                    if (!ResolveDefs::get_visibility_method($myfunc_call->get_name_instance(), $method))
                                        $method = null;

                                    $list_myfunc[] = [0, $myclass_static, $method];

                                    $stack_class[0][0] = $myclass_static;

                                    TaintAnalysis::funccall_specify_analysis($method, $stack_class, $this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myclass_static, $myfunc_call, $arr_funccall, $instruction, $mycode, $index);
                                }
                            }
                            else
                            {
                                $myfunc = $this->context->get_functions()->get_function($funcname);
                                TaintAnalysis::funccall_specify_analysis($myfunc, null, $this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), null, $myfunc_call, $arr_funccall, $instruction, $mycode, $index);

                                $list_myfunc[] = [0, null, $myfunc];
                            }

                            foreach ($list_myfunc as $list)
                            {
                                $object_id = $list[0];
                                $myclass = $list[1];
                                $myfunc = $list[2];

                                \progpilot\Analysis\CustomAnalysis::must_verify_definition($this->context, $instruction, $myfunc_call, $myclass);

                                ResolveDefs::instance_build_this($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $object_id, $myclass, $myfunc, $myfunc_call);

                                if (!is_null($myfunc) && !$this->in_call_stack($myfunc))
                                {
                                    // the called function is a method and this method exists in the class
                                    if (($myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD) || $myfunc_call->is_type(MyFunction::TYPE_FUNC_STATIC)) && $myfunc->is_type(MyFunction::TYPE_FUNC_METHOD) || ((!$myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD) && !$myfunc_call->is_type(MyFunction::TYPE_FUNC_STATIC)) && !$myfunc->is_type(MyFunction::TYPE_FUNC_METHOD)))
                                    {
                                        FuncAnalysis::funccall_before($this->context, $this->defs, $myfunc, $myfunc_call, $instruction, $this->context->get_classes());

                                        $mycodefunction = new MyCode;
                                        $mycodefunction->set_codes($myfunc->get_mycode()->get_codes());
                                        $mycodefunction->set_start(0);
                                        $mycodefunction->set_end(count($myfunc->get_mycode()->get_codes()));

                                        $this->analyze($mycodefunction, $myfunc_call);
                                    }
                                }

                                FuncAnalysis::funccall_after($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myfunc_call, $myfunc, $arr_funccall, $instruction, $code[$index + 3]);

                                $class_of_funccall = null;
                                if (is_null($myfunc))
                                {
                                    ResolveDefs::funccall_return_values($this->context, $myfunc_call, $instruction, $mycode, $index);

                                    // representations start
                                    $this->context->outputs->callgraph->add_funccall($this->current_myblock, $myfunc_call);
                                    // representations end
                                }
                                else
                                {
                                    $class_of_funccall = $myfunc->get_myclass();

                                    // representations start
                                    foreach ($myfunc->get_blocks() as $myblock)
                                    {
                                        $this->context->outputs->callgraph->add_child($this->current_myblock, $myblock);
                                        break;
                                    }

                                    $this->context->outputs->callgraph->add_funccall($this->current_myblock, $myfunc_call);
                                    // representations end
                                }

                                ResolveDefs::instance_build_back($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myfunc, $myfunc_call);

                                TaintAnalysis::funccall_specify_analysis($myfunc, $stack_class, $this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $class_of_funccall, $myfunc_call, $arr_funccall, $instruction, $mycode, $index);
                            }

                            break;
                        }
                    }

                    $index = $index + 1;
                }
            }
            while (isset($code[$index]) && $index <= $mycode->get_end());
        }
}


?>
