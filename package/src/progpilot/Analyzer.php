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

    public function getFilesOfDir($context, $dir, &$files)
    {
        if (is_dir($dir) && !$context->inputs->isExcludedFolder($dir)) {
            $filesanddirs = scandir($dir);

            if ($filesanddirs !== false) {
                foreach ($filesanddirs as $filedir) {
                    if ($filedir !== '.' && $filedir !== "..") {
                        $folderorfile = $dir."/".$filedir;
                        if (is_dir($folderorfile)) {
                            if (!$context->inputs->isExcludedFolder($folderorfile)) {
                                $this->getFilesOfDir($context, $folderorfile, $files);
                            }
                        } else {
                            if (!$context->inputs->isExcludedFile($folderorfile)) {
                                if (!in_array($folderorfile, $files, true) && realpath($folderorfile)) {
                                    $files[] = realpath($folderorfile);
                                }
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
        if (!is_null($context->inputs->getFile()) || !is_null($context->inputs->getCode())) {
            $lexer = new \PhpParser\Lexer(array(
                                                  'usedAttributes' => array(
                                                      'comments', 'startLine', 'endLine', 'startFilePos', 'endFilePos'
                                                  )
                                              ));

            $astparser = (new \PhpParser\ParserFactory)->create(\PhpParser\ParserFactory::PREFER_PHP7, $lexer);

            $parser = new \PHPCfg\Parser($astparser, null);

            if (!file_exists($context->inputs->getFile()) && is_null($context->inputs->getCode())) {
                Utils::printWarning(
                    $context,
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($context->inputs->getFile()).")"
                );
            } elseif (is_null($context->inputs->getFile()) && is_null($context->inputs->getCode())) {
                Utils::printWarning($context, Lang::FILE_AND_CODE_ARE_NULL);
            } else {
                try {
                    if (is_null($context->inputs->getCode())) {
                        if (filesize($context->inputs->getFile()) > $context->getLimitSize()) {
                            Utils::printWarning(
                                $context,
                                Lang::MAX_SIZE_EXCEEDED." (".Utils::encodeCharacters($context->inputs->getFile()).")"
                            );
                        } else {
                            $context->inputs->setCode(file_get_contents($context->inputs->getFile()));
                            $context->setPath(dirname($context->inputs->getFile()));
                            $script = $parser->parse($context->inputs->getCode(), $context->inputs->getFile());
                        }
                    } else {
                        $script = $parser->parse($context->inputs->getCode(), "");
                    }
                } catch (\PhpParser\Error $e) {
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
        if (!is_null($script)) {
            $traverser = new \PHPCfg\Traverser();
            $transformvisitor = new \progpilot\Transformations\Php\Transform();
            $transformvisitor->setContext($context);
            $traverser->addVisitor($transformvisitor);

            $traverser->traverse($script);

            unset($transformvisitor);
            unset($traverser);
        }
    }

    public function runInternalFunction($context, $myfunc)
    {
        if (!is_null($myfunc) && !$myfunc->isAnalyzed()) {
            $myfunc->setIsAnalyzed(true);

            $myfunc->getMyCode()->setStart(0);
            $myfunc->getMyCode()->setEnd(count($myfunc->getMyCode()->getCodes()));

            \progpilot\Analysis\ValueAnalysis::buildStorage();

            $visitoranalyzer = new \progpilot\Analysis\VisitorAnalysis;
            $visitoranalyzer->setContext($context);
            $visitoranalyzer->analyze($myfunc->getMyCode());

            unset($visitoranalyzer);
        } else {
            // throw main function missing
        }
    }

    public function runInternal($context, $defs_included = null)
    {
        // free memory
        if (function_exists('gc_mem_caches')) {
            gc_mem_caches();
        }
            
        if ($context->getCurrentNbDefs() > $context->getLimitDefs()) {
            Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
            return;
        }

        $start_time = microtime(true);

        $past_results = &$context->outputs->getResults();
        $context->resetInternalValues();
        $context->outputs->setResults($past_results);

        $script = $this->parse($context);

        if ((microtime(true) - $start_time) > $context->getLimitTime()) {
            Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
            return;
        }

        $this->transform($context, $script);

        if ((microtime(true) - $start_time) > $context->getLimitTime()) {
            Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
            return;
        }

        // analyze
        if (!is_null($context)) {
            $context_functions = [];
            if (!is_null($context->getFunctions()->getFunctions())) {
                foreach ($context->getFunctions()->getFunctions() as $functions_name) {
                    if (!is_null($functions_name)) {
                        foreach ($functions_name as $myfunc) {
                            $context_functions[] = $myfunc;
                        }
                    }
                }
            }
    
            foreach ($context->getClasses()->getListClasses() as $myclass) {
                $context_functions = array_merge($context_functions, $myclass->getMethods());
            }
                
            $visitordataflow = new \progpilot\Dataflow\VisitorDataflow();

            foreach ($context_functions as $myfunc) {
                if (!is_null($myfunc) && !$myfunc->isDataAnalyzed()) {
                    $myfunc->setIsDataAnalyzed(true);
                    $visitordataflow->analyze($context, $myfunc, $defs_included);
                }
            }

            if ($context->getCurrentNbDefs() > $context->getLimitDefs()) {
                Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
                return;
            }

            if ((microtime(true) - $start_time) > $context->getLimitTime()) {
                Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
                return;
            }

            if (!$context->getAnalyzeFunctions()) {
                $this->runInternalFunction($context, $context->getFunctions()->getFunction("{main}"));
            } else {
                foreach ($context_functions as $myfunc) {
                    $this->runInternalFunction($context, $myfunc);
                }
            }
            
            if ($context->getCurrentNbDefs() > $context->getLimitDefs()) {
                Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
                return;
            }
            
            $context->outputs->callgraph->computeCallGraph();
            \progpilot\Analysis\CustomAnalysis::mustVerifyCallFlow($context);

            unset($visitordataflow);
        }

        unset($script);
    }

    public function run($context, $cmd_files = null)
    {
        $files = [];

        $context->readConfiguration();
        $context->inputs->readIncludesFile();
        $context->inputs->readExcludesFile();

        $context->inputs->readSanitizers();
        $context->inputs->readSinks();
        $context->inputs->readSources();
        $context->inputs->readResolvedIncludes();
        $context->inputs->readValidators();
        $context->inputs->readFalsePositives();
        $context->inputs->readCustomFile();

        $included_files = $context->inputs->getIncludedFiles();
        $included_folders = $context->inputs->getIncludedFolders();

        if ($cmd_files !== null) {
            foreach ($cmd_files as $cmd_file) {
                if (is_dir($cmd_file)) {
                    $this->getFilesOfDir($context, $cmd_file, $files);
                } else {
                    if (!in_array($cmd_file, $files, true)
                                && !$context->inputs->isExcludedFile($cmd_file)) {
                        $files[] = $cmd_file;
                    }
                }
            }
        }

        foreach ($included_files as $included_file) {
            if (!in_array($included_file, $files, true)
                        && !$context->inputs->isExcludedFile($included_file)) {
                $files[] = $included_file;
            }
        }

        foreach ($included_folders as $included_folder) {
            $this->getFilesOfDir($context, $included_folder, $files);
        }

        if (!is_null($context->inputs->getFolder())) {
            $this->getFilesOfDir($context, $context->inputs->getFolder(), $files);
        } else {
            if ($context->inputs->getFile() !== null) {
                if (!in_array($context->inputs->getFile(), $files, true)
                            && !$context->inputs->isExcludedFile($context->inputs->getFile())
                            && realpath($context->inputs->getFile())) {
                    $files[] = realpath($context->inputs->getFile());
                }
            }
        }

        foreach ($files as $file) {
            $context->setCurrentNbDefs(0);

            if ($context->getPrintFile()) {
                echo "progpilot analyze : ".Utils::encodeCharacters($file)."\n";
            }

            $myfile = new MyFile($file, 0, 0);
            $context->inputs->setFile($file);
            $context->setCurrentMyfile($myfile);
            $context->resetDataflow();
            $this->runInternal($context);
        }

        if (count($files) === 0 && !is_null($context->inputs->getCode())) {
            $this->runInternal($context);
        }

        if ($context->outputs->getResolveIncludes()) {
            $context->outputs->writeIncludesFile();
        }
    }
}
