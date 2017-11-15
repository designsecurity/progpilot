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

class VisitorAnalysis
{
    private $exprs_visited;
    private $context;
    private $current_storagemyblocks;
    private $call_stack;

    private $defs;
    private $blocks;

    private $current_myfunc;
    private $current_context_call;
    private $current_myblock;
    private $old_myblock;

    public function __construct()
    {
        $this->current_storagemyblocks = null;
        $this->call_stack = [];
        $this->myblock_stack = [];

        $this->current_myfunc = null;
        $this->current_context_call = null;
        $this->current_myblock = null;
        $this->old_myblock = null;

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
                    $myblock = $instruction->get_property("myblock");

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
                    $myfunc = $instruction->get_property("myfunc");

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

                    $this->current_myfunc = $instruction->get_property("myfunc");

                    $val = [$this->current_myfunc, $this->blocks, $this->defs, $this->current_storagemyblocks, $this->current_context_call];
                    array_push($this->call_stack, $val);

                    $this->current_storagemyblocks = new \SplObjectStorage;
                    $this->defs = $this->current_myfunc->get_defs();
                    $this->blocks = $this->current_myfunc->get_blocks();

                    break;
                }

                case Opcodes::DEFINITION:
                {
                    $mydef = $instruction->get_property("def");

                    break;
                }


                case Opcodes::END_EXPRESSION:
                {
                    $expr = $instruction->get_property("expr");

                    if ($expr->is_assign())
                    {
                        $defassign = $expr->get_assign_def();

                        // TYPE SANITIZED
                        // we retrieve all sanitize types
                        $concat_types_sanitize = [];
                        foreach ($expr->get_defs() as $def)
                        {
                            if ($def->is_sanitized())
                            {
                                foreach ($def->get_type_sanitized() as $type_sanitized)
                                    $concat_types_sanitize["$type_sanitized"] = true;
                            }
                        }

                        // foreach sanitize types
                        foreach($concat_types_sanitize as $type_sanitized => $boolean_true)
                        {
                            $type_ok = true;
                            foreach ($expr->get_defs() as $def)
                            {
                                // if we find a tainted value that is not sanitized the defassign is not sanitized
                                if (!$def->is_type_sanitized($type_sanitized) && $def->is_tainted())
                                    $type_ok = false;
                            }

                            if ($type_ok)
                            {
                                $defassign->set_sanitized(true);
                                $defassign->add_type_sanitized($type_sanitized);
                            }
                        }


                        // EMBEDDED CHARS
                        // we retrieve all embedded chars types
                        $concat_embedded_chars = [];
                        foreach ($expr->get_defs() as $def)
                        {
                            foreach($def->get_is_embeddedbychars() as $embedded_char => $boolean)
                            $concat_embedded_chars[] = $embedded_char;
                        }

                        foreach ($concat_embedded_chars as $embedded_char)
                        {
                            $embedded_value = false;

                            foreach ($expr->get_defs() as $def)
                            {
                                $boolean = $def->get_is_embeddedbychar($embedded_char);

                                if ($boolean && $embedded_value)
                                    $embedded_value = false;

                                if ($boolean && !$embedded_value)
                                    $embedded_value = true;

                                if (!$boolean && $embedded_value)
                                    $embedded_value = true;

                                if (!$boolean && !$embedded_value)
                                    $embedded_value = false;
                            }

                            $defassign->set_is_embeddedbychar($embedded_char, $embedded_value);
                        }
                        /*
                        echo "CASSSST ======================\n";
                        // CAST
                        $nb_cast_safe = 0;
                        foreach($expr->get_defs() as $def)
                        {
                          $def->print_stdout();
                          if($def->get_cast() === MyDefinition::CAST_SAFE)
                            $nb_cast_safe ++;
                        }

                        if($nb_cast_safe == count($expr->get_defs()))
                          $defassign->set_cast(MyDefinition::CAST_SAFE);
                        else
                          $defassign->set_cast(MyDefinition::CAST_NOT_SAFE);

                        echo "========> '$nb_cast_safe' '".count($expr->get_defs())."'\n";
                        $defassign->print_stdout();
                        */
                    }

                    break;
                }


                case Opcodes::TEMPORARY:
                {
                    $tempdefa = $instruction->get_property("temporary");
                    $tempdefa_myexpr = $tempdefa->get_expr();
                    $defassign_myexpr = $tempdefa_myexpr->get_assign_def();

                    if ($tempdefa_myexpr->is_assign() && !$tempdefa_myexpr->is_assign_iterator())
                        ArrayAnalysis::copy_array($this->context, $this->defs->getoutminuskill($tempdefa->get_block_id()), $tempdefa, $tempdefa->get_array_value(), $defassign_myexpr, $defassign_myexpr->get_array_value());

                    $tainted = false;
                    if (!is_null($this->context->inputs->get_source_byname(null, $tempdefa, false, false, $tempdefa->get_array_value())))
                        $tainted = true;
                    $tempdefa->set_tainted($tainted);

                    $defs = ResolveDefs::temporary_simple($this->context, $this->defs, $tempdefa, $tempdefa_myexpr->is_assign_iterator(), $tempdefa_myexpr->is_assign(), $this->call_stack);

                    $concat_tables = new \stdClass;
                    $concat_tables->defs_assign = [];
                    $concat_tables->values = [];

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
                            $defassign_myexpr->set_cast($tempdefa->get_cast());
                            /*
                            if ($tempdefa->get_cast() === MyDefinition::CAST_NOT_SAFE)
                            $defassign_myexpr->set_cast($def->get_cast());
                            else
                            $defassign_myexpr->set_cast($tempdefa->get_cast());
                            */
                            ValueAnalysis::copy_values($tempdefa, $def);
                            ValueAnalysis::calculate_values($tempdefa, $defassign_myexpr, $tempdefa_myexpr, $def, $concat_tables);
                        }

                        if ($visibility && !$safe)
                            TaintAnalysis::set_tainted($def, $defassign_myexpr, $tempdefa_myexpr);

                        // vérifier s'il y a pas de concat
                        // mis a jour de l'object
                        if ($def->is_type(MyDefinition::TYPE_INSTANCE))
                        {
                            $defassign_myexpr->add_type(MyDefinition::TYPE_INSTANCE);
                            $defassign_myexpr->set_object_id($def->get_object_id());

                            $tmp_myclasses = $this->context->get_objects()->get_all_myclasses($def->get_object_id());

                            foreach ($tmp_myclasses as $tmp_myclass)
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

                                        if ($def_found->is_tainted())
                                            $property->set_tainted(true);

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

                    ValueAnalysis::update_for_concat_values($concat_tables);

                    break;
                }

                case Opcodes::FUNC_CALL:
                {
                    $funcname = $instruction->get_property("funcname");
                    $arr_funccall = $instruction->get_property("arr");
                    $myfunc_call = $instruction->get_property("myfunc_call");

                    $list_myfunc = [];

                    IncludeAnalysis::funccall($this->context, $this->defs, $this->blocks, $instruction, $code, $index);

                    if ($myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD))
                    {
                        $stack_class = ResolveDefs::funccall_class(
                                           $this->context,
                                           $this->defs->getoutminuskill($myfunc_call->get_block_id()),
                                           $myfunc_call);

                        $class_of_funccall_arr = $stack_class[count($stack_class) - 1];

                        foreach ($class_of_funccall_arr as $class_of_funccall)
                        {
                            $method = $class_of_funccall->get_method($funcname);

                            if (!ResolveDefs::get_visibility_method($myfunc_call->get_name_instance(), $method))
                                $method = null;

                            $list_myfunc[] = $method;

                            TaintAnalysis::funccall_specify_analysis($method, $stack_class, $this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $class_of_funccall, $myfunc_call, $arr_funccall, $instruction, $mycode, $index);
                        }

                        // we didn't resolve any class so the class of method is unknown (undefined)
                        // but we authorize to specify method of unknown class during the configuration of sinks ...
                        if (count($class_of_funccall_arr) == 0)
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

                            $list_myfunc[] = $method;

                            $stack_class[0][0] = $myclass_static;

                            TaintAnalysis::funccall_specify_analysis($method, $stack_class, $this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myclass_static, $myfunc_call, $arr_funccall, $instruction, $mycode, $index);
                        }
                    }
                    else
                    {
                        $myfunc = $this->context->get_functions()->get_function($funcname);
                        TaintAnalysis::funccall_specify_analysis($myfunc, null, $this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), null, $myfunc_call, $arr_funccall, $instruction, $mycode, $index);

                        $list_myfunc[] = $myfunc;
                    }


                    foreach ($list_myfunc as $myfunc)
                    {
                        ResolveDefs::instance_build_this($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myfunc, $myfunc_call);

                        if (!is_null($myfunc) && !$this->in_call_stack($myfunc))
                        {
                            // the called function is a method and this method exists in the class
                            if (($myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD) || $myfunc_call->is_type(MyFunction::TYPE_FUNC_STATIC)) && $myfunc->is_type(MyFunction::TYPE_FUNC_METHOD) || ((!$myfunc_call->is_type(MyFunction::TYPE_FUNC_METHOD) && !$myfunc_call->is_type(MyFunction::TYPE_FUNC_STATIC)) && !$myfunc->is_type(MyFunction::TYPE_FUNC_METHOD)))
                            {
                                ArrayAnalysis::funccall_before($this->context, $this->defs, $myfunc, $myfunc_call, $instruction);
                                TaintAnalysis::funccall_before($this->context, $this->defs, $myfunc, $instruction, $this->context->get_classes());

                                $mycodefunction = new MyCode;
                                $mycodefunction->set_codes($myfunc->get_mycode()->get_codes());
                                $mycodefunction->set_start(0);
                                $mycodefunction->set_end(count($myfunc->get_mycode()->get_codes()));

                                $this->analyze($mycodefunction, $myfunc_call);

                                ArrayAnalysis::funccall_after($this->context, $myfunc, $myfunc_call, $arr_funccall, $code[$index + 3]);
                                TaintAnalysis::funccall_after($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myfunc, $arr_funccall, $instruction);

                                // il faut cleaner les variables (myexpr of temporary par exemple a chaque appel de function)

                            }
                        }

                        if (is_null($myfunc))
                        {
                            ResolveDefs::copy_instance($this->context, $this->defs, $myfunc_call);
                            ResolveDefs::funccall_return_values($this->context, $myfunc_call, $instruction, $mycode, $index);
                        }

                        ResolveDefs::instance_build_back($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myfunc, $myfunc_call);

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
