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

use progpilot\AbstractLayer\Analysis as AbstractAnalysis;

use progpilot\Utils;

class IncludeAnalysis
{
    public function __construct()
    {
    }

    public static function is_circular_include($myfile)
    {
        $myfile_included = $myfile->get_included_from_myfile();
        while (!is_null($myfile_included)) {
            if ($myfile_included->get_name() === $myfile->get_name()) {
                return true;
            }

            $myfile_included = $myfile_included->get_included_from_myfile();
        }

        return false;
    }

    public static function funccall($context, $defs, $blocks, $instruction, $code, $index)
    {
        $funcname = $instruction->get_property(MyInstruction::FUNCNAME);
        $arr_funccall = $instruction->get_property(MyInstruction::ARR);
        $myfunc_call = $instruction->get_property(MyInstruction::MYFUNC_CALL);

        // require, require_once ... already handled in transform Expr/include_
        if ($myfunc_call->get_name() === "include" && $context->get_analyze_includes()) {
            $type_include = $instruction->get_property(MyInstruction::TYPE_INCLUDE);
            $nb_params = $myfunc_call->get_nb_params();
            if ($nb_params > 0) {
                $at_least_one_include_resolved = false;

                $mydef_arg = $instruction->get_property("argdef0");

                if (count($mydef_arg->get_last_known_values()) !== 0) {
                    foreach ($mydef_arg->get_last_known_values() as $last_known_value) {
                        $real_file = false;

                        // else it's maybe a relative path
                        $file = $context->get_path()."/".$last_known_value;
                        $real_file = realpath($file);

                        // if $last_known_value is a absolute path to the file :
                        // /home/dev/file.php
                        if (!$real_file) {
                            $real_file = realpath($last_known_value);
                        }

                        if (!$real_file) {
                            $continue_include = false;

                            $myinclude = $context->inputs->get_include_bylocation(
                                                 $context->get_current_line(),
                                                 $context->get_current_column(),
                                                 $myfunc_call->get_source_myfile()->get_name()
                                );

                            if (!is_null($myinclude)) {
                                $name_included_file = realpath($myinclude->get_value());
                                if ($name_included_file) {
                                    $continue_include = true;
                                }
                            }
                        } else {
                            $continue_include = true;
                            $name_included_file = $real_file;
                        }

                        if ($continue_include) {
                            $at_least_one_include_resolved = true;

                            $array_includes = $context->get_array_includes();
                            $array_requires = $context->get_array_requires();

                            if ((!in_array($name_included_file, $array_includes, true) && $type_include === 2)
                                        || (!in_array($name_included_file, $array_requires, true) && $type_include === 4)
                                        || ($type_include === 1 || $type_include === 3)) {
                                $myfile = new MyFile($name_included_file, $myfunc_call->getLine(), $myfunc_call->getColumn());
                                $myfile->set_included_from_myfile($myfunc_call->get_source_myfile());

                                if (!IncludeAnalysis::is_circular_include($myfile)) {
                                    if ($type_include === 2) {
                                        $array_includes[] = $name_included_file;
                                    }

                                    if ($type_include === 4) {
                                        $array_requires[] = $name_included_file;
                                    }

                                    $context_include = clone $context;

                                    $context_include->reset_internal_values();

                                    // not need to propagate files already included to the current analyzed file
                                    // because of clone context and reset values that don't
                                    // ie : $context_include->set_array_includes($array_includes); ect
                                    $context_include->inputs->set_file($name_included_file);
                                    $context_include->inputs->set_code(null);
                                    $context_include->set_current_myfile($myfile);
                                    //$context_include->set_outputs(new \progpilot\Outputs\MyOutputs);
                                    $context_include->outputs->reset_representations();

                                    $main_function_save = $context->get_functions()->get_function("{main}");
                                    $save_main = $context_include->get_functions()->del_function("{main}");

                                    $analyzer_include = new \progpilot\Analyzer;
                                    $analyzer_include->run_internal($context_include, $defs->getoutminuskill($myfunc_call->get_block_id()));

                                    if (count($context_include->outputs->current_includes_file) > 0) {
                                        foreach ($context_include->outputs->current_includes_file as $include_file) {
                                            $context->current_includes_file[] = $include_file;
                                        }
                                    }

                                    if (!is_null($context_include->outputs->get_results())) {
                                        foreach ($context_include->outputs->get_results() as $result_include) {
                                            $context->outputs->add_result($result_include);
                                        }
                                    }

                                    $context->set_current_nb_defs($context_include->get_current_nb_defs());

                                    $main_include = $context_include->get_functions()->get_function("{main}");

                                    $defs_output_included_final = [];
                                    if (!is_null($main_include)) {
                                        FuncAnalysis::funccall_after($context_include, $defs->getoutminuskill($myfunc_call->get_block_id()), $main_include, $main_include, $arr_funccall, $instruction, $code[$index + 3]);

                                        if (!is_null($main_include->get_defs())) {
                                            $defs_main_return = $main_include->get_defs()->getdefrefbyname("{main}_return");
                                            foreach ($defs_main_return as $def_main_return) {
                                                $defs_output_included = $main_include->get_defs()->getoutminuskill($def_main_return->get_block_id());
                                                if (!is_null($defs_output_included)) {
                                                    foreach ($defs_output_included as $def_output_included) {
                                                        if (!in_array($def_output_included, $defs_output_included_final, true)) {
                                                            $defs_output_included_final[] = $def_output_included;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    // for all class found, we resolve previous seen objects of this class
                                    $myclasses_include = $context_include->get_classes()->get_list_classes();
                                    foreach ($myclasses_include as $myclass_include) {
                                        $func_callback = "Callbacks::modify_myclass_of_object";
                                        AbstractAnalysis::for_all_objects($context, $func_callback, $myclass_include);
                                    }

                                    $new_defs = false;
                                    if (count($defs_output_included_final) > 0) {
                                        foreach ($defs_output_included_final as $def_output_included_final) {
                                            $ret1 = $defs->adddef($def_output_included_final->get_name(), $def_output_included_final);
                                            $ret2 = $defs->addgen($myfunc_call->get_block_id(), $def_output_included_final);

                                            $new_defs = true;
                                        }
                                    }

                                    if ($new_defs) {
                                        $defs->computekill($context, $myfunc_call->get_block_id());
                                        $defs->reachingDefs($blocks);
                                    }
                                }
                            }
                        }
                    }
                }

                if (!$at_least_one_include_resolved && $context->outputs->get_resolve_includes()) {
                    $myfile_temp = new MyFile(
                            $myfunc_call->get_source_myfile()->get_name(),
                                                  $myfunc_call->getLine(),
                                                  $myfunc_call->getColumn()
                        );

                    $context->outputs->current_includes_file[] = $myfile_temp;
                }
            }
        }
    }
}
