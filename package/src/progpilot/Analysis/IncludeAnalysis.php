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

    public static function isCircularInclude($myfile)
    {
        $myfile_included = $myfile->getIncludedFromMyfile();
        while (!is_null($myfile_included)) {
            if ($myfile_included->getName() === $myfile->getName()) {
                return true;
            }

            $myfile_included = $myfile_included->getIncludedFromMyfile();
        }

        return false;
    }

    public static function funccall($context, $defs, $blocks, $instruction, $code, $index)
    {
        $funcname = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arr_funccall = $instruction->getProperty(MyInstruction::ARR);
        $myfunc_call = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        // require, require_once ... already handled in transform Expr/include_
        if ($myfunc_call->getName() === "include" && $context->getAnalyzeIncludes()) {
            $type_include = $instruction->getProperty(MyInstruction::TYPE_INCLUDE);
            $nb_params = $myfunc_call->getNbParams();
            if ($nb_params > 0) {
                $at_least_one_include_resolved = false;

                $mydef_arg = $instruction->getProperty("argdef0");

                if (count($mydef_arg->getLastKnownValues()) !== 0) {
                    foreach ($mydef_arg->getLastKnownValues() as $last_known_value) {
                        $real_file = false;

                        // else it's maybe a relative path
                        $file = $context->getPath()."/".$last_known_value;
                        $real_file = realpath($file);

                        // if $last_known_value is a absolute path to the file :
                        // /home/dev/file.php
                        if (!$real_file) {
                            $real_file = realpath($last_known_value);
                        }

                        if (!$real_file) {
                            $continue_include = false;

                            $myinclude = $context->inputs->getIncludeByLocation(
                                $context->getCurrentLine(),
                                $context->getCurrentColumn(),
                                $myfunc_call->getSourceMyFile()->getName()
                            );

                            if (!is_null($myinclude)) {
                                $name_included_file = realpath($myinclude->getValue());
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

                            $array_includes = $context->getArrayIncludes();
                            $array_requires = $context->getArrayRequires();

                            if ((!in_array($name_included_file, $array_includes, true) && $type_include === 2)
                                || (!in_array($name_included_file, $array_requires, true) && $type_include === 4)
                                    || ($type_include === 1 || $type_include === 3)) {
                                $myfile = new MyFile(
                                    $name_included_file,
                                    $myfunc_call->getLine(),
                                    $myfunc_call->getColumn()
                                );
                                $myfile->setIncludedFromMyfile($myfunc_call->getSourceMyFile());

                                if (!IncludeAnalysis::isCircularInclude($myfile)) {
                                    if ($type_include === 2) {
                                        $array_includes[] = $name_included_file;
                                    }

                                    if ($type_include === 4) {
                                        $array_requires[] = $name_included_file;
                                    }

                                    $context_include = clone $context;

                                    $context_include->resetInternalValues();

                                    // not need to propagate files already included to the current analyzed file
                                    // because of clone context and reset values that don't
                                    // ie : $context_include->set_array_includes($array_includes); ect
                                    $context_include->inputs->setFile($name_included_file);
                                    $context_include->inputs->setCode(null);
                                    $context_include->setCurrentMyfile($myfile);
                                    //$context_include->setOutputs(new \progpilot\Outputs\MyOutputs);
                                    $context_include->outputs->resetRepresentations();

                                    $main_function_save = $context->getFunctions()->getFunction("{main}");
                                    $save_main = $context_include->getFunctions()->delFunction("{main}");

                                    $analyzer_include = new \progpilot\Analyzer;
                                    $analyzer_include->runInternal(
                                        $context_include,
                                        $defs->getOutMinusKill($myfunc_call->getBlockId())
                                    );

                                    if (count($context_include->outputs->current_includes_file) > 0) {
                                        foreach ($context_include->outputs->current_includes_file as $include_file) {
                                            $context->current_includes_file[] = $include_file;
                                        }
                                    }

                                    if (!is_null($context_include->outputs->getResults())) {
                                        foreach ($context_include->outputs->getResults() as $result_include) {
                                            $context->outputs->addResult($result_include);
                                        }
                                    }

                                    $context->setCurrentNbDefs($context_include->getCurrentNbDefs());

                                    $main_include = $context_include->getFunctions()->getFunction("{main}");

                                    $defs_output_included_final = [];
                                    if (!is_null($main_include)) {
                                        FuncAnalysis::funccallAfter(
                                            $context_include,
                                            $defs->getOutMinusKill($myfunc_call->getBlockId()),
                                            $main_include,
                                            $main_include,
                                            $arr_funccall,
                                            $instruction,
                                            $code[$index + 3]
                                        );

                                        if (!is_null($main_include->getDefs())) {
                                            $defs_main_return =
                                                $main_include->getDefs()->getDefRefByName("{main}_return");
                                            foreach ($defs_main_return as $def_main_return) {
                                                $defs_output_included = $main_include->getDefs()->getOutMinusKill(
                                                    $def_main_return->getBlockId()
                                                );
                                                if (!is_null($defs_output_included)) {
                                                    foreach ($defs_output_included as $def_output_included) {
                                                        if (!in_array(
                                                            $def_output_included,
                                                            $defs_output_included_final,
                                                            true
                                                        )) {
                                                            $defs_output_included_final[] = $def_output_included;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    // for all class found, we resolve previous seen objects of this class
                                    $myclasses_include = $context_include->getClasses()->getListClasses();
                                    foreach ($myclasses_include as $myclass_include) {
                                        $func_callback = "Callbacks::modifyMyclassOfObject";
                                        AbstractAnalysis::forAllobjects($context, $func_callback, $myclass_include);
                                    }

                                    $new_defs = false;
                                    if (count($defs_output_included_final) > 0) {
                                        foreach ($defs_output_included_final as $def_output_included_final) {
                                            $ret1 = $defs->addDef(
                                                $def_output_included_final->getName(),
                                                $def_output_included_final
                                            );
                                            $ret2 = $defs->addGen(
                                                $myfunc_call->getBlockId(),
                                                $def_output_included_final
                                            );

                                            $new_defs = true;
                                        }
                                    }

                                    if ($new_defs) {
                                        $defs->computeKill($context, $myfunc_call->getBlockId());
                                        $defs->reachingDefs($blocks);
                                    }
                                }
                            }
                        }
                    }
                }

                if (!$at_least_one_include_resolved && $context->outputs->getResolveIncludes()) {
                    $myfile_temp = new MyFile(
                        $myfunc_call->getSourceMyFile()->getName(),
                        $myfunc_call->getLine(),
                        $myfunc_call->getColumn()
                    );

                    $context->outputs->current_includes_file[] = $myfile_temp;
                }
            }
        }
    }
}
