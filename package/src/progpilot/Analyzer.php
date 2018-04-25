<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace progpilot;

use progpilot\Utils;
use progpilot\Objects\MyFile;

class Analyzer
{

        public function __construct()
        {
        }

        function get_files_ofdir($context, $dir, &$files)
        {
            if (is_dir($dir) && !$context->inputs->is_excluded_folder($dir))
            {
                $filesanddirs = scandir($dir);

                if ($filesanddirs != false)
                {
                    foreach ($filesanddirs as $filedir)
                    {
                        if ($filedir != '.' && $filedir != "..")
                        {
                            $folderorfile = $dir."/".$filedir;
                            if (is_dir($folderorfile))
                            {
                                if (!$context->inputs->is_excluded_folder($folderorfile))
                                    $this->get_files_ofdir($context, $folderorfile, $files);
                            }
                            else
                            {
                                if (!$context->inputs->is_excluded_file($folderorfile))
                                {
                                    if (!in_array($folderorfile, $files, true) && realpath($folderorfile))
                                        $files[] = realpath($folderorfile);
                                }
                            }
                        }
                    }
                }
            }
        }

        public function parse($context)
        {
            $script = null;

            // parser
            if (!is_null($context->inputs->get_file()) || !is_null($context->inputs->get_code()))
            {
                $lexer = new \PhpParser\Lexer(array(
                                                  'usedAttributes' => array(
                                                      'comments', 'startLine', 'endLine', 'startFilePos', 'endFilePos'
                                                  )
                                              ));

                $astparser = (new \PhpParser\ParserFactory)->create(\PhpParser\ParserFactory::PREFER_PHP7, $lexer);

                $parser = new \PHPCfg\Parser($astparser, null);

                if (!file_exists($context->inputs->get_file()) && is_null($context->inputs->get_code()))
                    Utils::print_warning($context, Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($context->inputs->get_file()).")");

                else if (is_null($context->inputs->get_file()) && is_null($context->inputs->get_code()))
                    Utils::print_warning($context, Lang::FILE_AND_CODE_ARE_NULL);

                else
                {
                    try
                    {
                        if (is_null($context->inputs->get_code()))
                        {
                            $context->inputs->set_code(file_get_contents($context->inputs->get_file()));
                            $context->set_path(dirname($context->inputs->get_file()));
                            $script = $parser->parse($context->inputs->get_code(), $context->inputs->get_file());
                        }
                        else
                            $script = $parser->parse($context->inputs->get_code(), "");
                    }
                    catch (\PhpParser\Error $e)
                    {
                    }
                }
            }

            unset($astparser);
            unset($parser);
            unset($lexer);

            return $script;
        }

        public function transform($context, $script)
        {
            // transform
            if (!is_null($script))
            {
                $traverser = new \PHPCfg\Traverser();
                $transformvisitor = new \progpilot\Transformations\Php\Transform();
                $transformvisitor->set_context($context);
                $traverser->addVisitor($transformvisitor);

                $traverser->traverse($script);

                unset($transformvisitor);
                unset($traverser);
            }
        }

        public function run_internal_function($context, $myfunc)
        {
            if (!is_null($myfunc) && !$myfunc->is_analyzed())
            {
                $myfunc->set_is_analyzed(true);

                $myfunc->get_mycode()->set_start(0);
                $myfunc->get_mycode()->set_end(count($myfunc->get_mycode()->get_codes()));

                \progpilot\Analysis\ValueAnalysis::build_storage();

                $visitoranalyzer = new \progpilot\Analysis\VisitorAnalysis;
                $visitoranalyzer->set_context($context);
                $visitoranalyzer->analyze($myfunc->get_mycode());

                unset($visitoranalyzer);
            }
            else
            {
                // throw main function missing
            }
        }

        public function run_internal($context, $defs_included = null)
        {
            $start_time = microtime(true);

            $past_results = &$context->outputs->get_results();
            $context->reset_internal_values();
            $context->outputs->set_results($past_results);

            $script = $this->parse($context);

            if ((microtime(true) - $start_time) > $context->get_limit_time())
            {
                Utils::print_warning($context, Lang::MAX_TIME_EXCEEDED);
                return;
            }

            $this->transform($context, $script);

            if ((microtime(true) - $start_time) > $context->get_limit_time())
            {
                Utils::print_warning($context, Lang::MAX_TIME_EXCEEDED);
                return;
            }

            // analyze
            if (!is_null($context))
            {
                $context_functions = $context->get_functions()->get_functions();
                $visitordataflow = new \progpilot\Dataflow\VisitorDataflow();

                if (!is_null($context_functions))
                {
                    foreach ($context_functions as $functions_name)
                    {
                        if (!is_null($functions_name))
                        {
                            foreach ($functions_name as $myfunc)
                            {
                                if (!is_null($myfunc) && !$myfunc->is_data_analyzed())
                                {
                                    $myfunc->set_is_data_analyzed(true);
                                    $visitordataflow->analyze($context, $myfunc, $defs_included);
                                }
                            }
                        }
                    }
                }

                if ($context->get_current_nb_defs() > $context->get_limit_defs())
                {
                    Utils::print_warning($context, Lang::MAX_DEFS_EXCEEDED);
                    return;
                }

                if ((microtime(true) - $start_time) > $context->get_limit_time())
                {
                    Utils::print_warning($context, Lang::MAX_TIME_EXCEEDED);
                    return;
                }

                if (!$context->get_analyze_functions())
                    $this->run_internal_function($context, $context->get_functions()->get_function("{main}"));
                else
                {
                    $functions = $context->get_functions()->get_functions();

                    if (!is_null($functions))
                    {
                        foreach ($functions as $functions_name)
                        {
                            if (!is_null($functions_name))
                            {
                                foreach ($functions_name as $myfunc)
                                    $this->run_internal_function($context, $myfunc);
                            }
                        }
                    }
                }

                // free memory
                gc_mem_caches();

                $context->outputs->callgraph->compute_callgraph();
                \progpilot\Analysis\CustomAnalysis::must_verify_call_flow($context);

                unset($visitordataflow);
            }

            unset($script);
        }

        public function run($context, $cmd_files = null)
        {
            $files = [];

            $context->read_configuration();
            $context->inputs->read_includes_file();
            $context->inputs->read_excludes_file();

            $context->inputs->read_sanitizers();
            $context->inputs->read_sinks();
            $context->inputs->read_sources();
            $context->inputs->read_resolved_includes();
            $context->inputs->read_validators();
            $context->inputs->read_false_positives();
            $context->inputs->read_custom_file();

            $included_files = $context->inputs->get_included_files();
            $included_folders = $context->inputs->get_included_folders();

            if ($cmd_files !== null)
            {
                foreach ($cmd_files as $cmd_file)
                {
                    if (is_dir($cmd_file))
                        $this->get_files_ofdir($context, $cmd_file, $files);
                    else
                    {
                        if (!in_array($cmd_file, $files, true)
                                && !$context->inputs->is_excluded_file($cmd_file))
                            $files[] = $cmd_file;
                    }
                }
            }

            foreach ($included_files as $included_file)
            {
                if (!in_array($included_file, $files, true)
                        && !$context->inputs->is_excluded_file($included_file))
                    $files[] = $included_file;
            }

            foreach ($included_folders as $included_folder)
                $this->get_files_ofdir($context, $included_folder, $files);

            if (!is_null($context->inputs->get_folder()))
                $this->get_files_ofdir($context, $context->inputs->get_folder(), $files);

            else
            {
                if ($context->inputs->get_file() !== null)
                {
                    if (!in_array($context->inputs->get_file(), $files, true)
                            && !$context->inputs->is_excluded_file($context->inputs->get_file())
                            && realpath($context->inputs->get_file()))
                        $files[] = realpath($context->inputs->get_file());
                }
            }

            foreach ($files as $file)
            {
                $context->set_current_nb_defs(0);

                if ($context->get_print_file())
                    echo "progpilot analyze : ".Utils::encode_characters($file)."\n";

                $myfile = new MyFile($file, 0, 0);
                $context->inputs->set_file($file);
                $context->set_current_myfile($myfile);
                $context->reset_dataflow();
                $this->run_internal($context);
            }

            if (count($files) == 0 && !is_null($context->inputs->get_code()))
                $this->run_internal($context);

            if ($context->outputs->get_resolve_includes())
                $context->outputs->write_includes_file();
        }

}


?>
