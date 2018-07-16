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

    public function runInternalFunction($context, $myFunc)
    {
        if (!is_null($myFunc) && !$myFunc->isAnalyzed()) {
            $myFunc->setIsAnalyzed(true);

            $myFunc->getMyCode()->setStart(0);
            $myFunc->getMyCode()->setEnd(count($myFunc->getMyCode()->getCodes()));

            \progpilot\Analysis\ValueAnalysis::buildStorage();

            $visitoranalyzer = new \progpilot\Analysis\VisitorAnalysis;
            $visitoranalyzer->setContext($context);
            $visitoranalyzer->analyze($myFunc->getMyCode());

            unset($visitoranalyzer);
        } else {
            // throw main function missing
        }
    }

    public function runInternal($context, $includedDefs = null)
    {
        // free memory
        if (function_exists('gc_mem_caches')) {
            gc_mem_caches();
        }
            
        if ($context->getCurrentNbDefs() > $context->getLimitDefs()) {
            Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
            return;
        }

        $startTime = microtime(true);

        $pastResults = &$context->outputs->getResults();
        $context->resetInternalValues();
        $context->outputs->setResults($pastResults);

        $script = $this->parse($context);

        if ((microtime(true) - $startTime) > $context->getLimitTime()) {
            Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
            return;
        }

        $this->transform($context, $script);

        if ((microtime(true) - $startTime) > $context->getLimitTime()) {
            Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
            return;
        }

        // analyze
        if (!is_null($context)) {
            $contextFunctions = [];
            if (!is_null($context->getFunctions()->getFunctions())) {
                foreach ($context->getFunctions()->getFunctions() as $functionsName) {
                    if (!is_null($functionsName)) {
                        foreach ($functionsName as $myFunc) {
                            $contextFunctions[] = $myFunc;
                        }
                    }
                }
            }
    
            foreach ($context->getClasses()->getListClasses() as $myClass) {
                $contextFunctions = array_merge($contextFunctions, $myClass->getMethods());
            }
                
            $visitordataflow = new \progpilot\Dataflow\VisitorDataflow();

            foreach ($contextFunctions as $myFunc) {
                if (!is_null($myFunc) && !$myFunc->isDataAnalyzed()) {
                    $myFunc->setIsDataAnalyzed(true);
                    $visitordataflow->analyze($context, $myFunc, $includedDefs);
                }
            }

            if ($context->getCurrentNbDefs() > $context->getLimitDefs()) {
                Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
                return;
            }

            if ((microtime(true) - $startTime) > $context->getLimitTime()) {
                Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
                return;
            }

            if (!$context->getAnalyzeFunctions()) {
                $this->runInternalFunction($context, $context->getFunctions()->getFunction("{main}"));
            } else {
                foreach ($contextFunctions as $myFunc) {
                    $this->runInternalFunction($context, $myFunc);
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

    public function run($context, $cmdFiles = null)
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

        $includedFiles = $context->inputs->getIncludedFiles();
        $includedFolders = $context->inputs->getIncludedFolders();

        if ($cmdFiles !== null) {
            foreach ($cmdFiles as $cmdFile) {
                if (is_dir($cmdFile)) {
                    $this->getFilesOfDir($context, $cmdFile, $files);
                } else {
                    if (!in_array($cmdFile, $files, true)
                                && !$context->inputs->isExcludedFile($cmdFile)) {
                        $files[] = $cmdFile;
                    }
                }
            }
        }

        foreach ($includedFiles as $includedFile) {
            if (!in_array($includedFile, $files, true)
                        && !$context->inputs->isExcludedFile($includedFile)) {
                $files[] = $includedFile;
            }
        }

        foreach ($includedFolders as $includedFolder) {
            $this->getFilesOfDir($context, $includedFolder, $files);
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

            $myFile = new MyFile($file, 0, 0);
            $context->inputs->setFile($file);
            $context->setCurrentMyfile($myFile);
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
