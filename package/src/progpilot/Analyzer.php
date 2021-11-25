<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace progpilot;

use PHPCfg\Printer;
use progpilot\Utils;
use progpilot\Code\MyCode;
use progpilot\Objects\MyFile;
use progpilot\Helpers\Analysis as HelpersAnalysis;

use function DeepCopy\deep_copy;

class Analyzer
{
    const PHP = "php";
    const JS = "js";
    
    private $parser;
    
    public function __construct()
    {
        $lexer = new \PhpParser\Lexer(array(
            'usedAttributes' => array(
                'comments', 'startLine', 'endLine', 'startFilePos', 'endFilePos'
            )
        ));

        $astparser = (new \PhpParser\ParserFactory)->create(\PhpParser\ParserFactory::PREFER_PHP7, $lexer);

        $this->parser = new \PHPCfg\Parser($astparser, null);
    }

    public function getFilesOfDir($context, $dir, &$files)
    {
        if (is_dir($dir) && !$context->inputs->isExcludedFile($dir)) {
            $filesanddirs = @scandir($dir);

            if ($filesanddirs !== false) {
                foreach ($filesanddirs as $filedir) {
                    if ($filedir !== '.' && $filedir !== "..") {
                        $folderorfile = $dir.DIRECTORY_SEPARATOR.$filedir;
                        
                        if (is_dir($folderorfile)) {
                            $this->getFilesOfDir($context, $folderorfile, $files);
                        } else {
                            if (!$context->inputs->isExcludedFile($folderorfile)) {
                                if (!in_array($folderorfile, $files, true) && realpath($folderorfile)) {
                                    $fileToAdd = realpath($folderorfile);
                                    $files[] = $fileToAdd;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function parsePhp($context)
    {
        $script = null;

        // parser
        if (!is_null($context->inputs->getFile()) || !is_null($context->inputs->getCode())) {
            try {
                if (is_null($context->inputs->getCode())) {
                    $fileContent = @file_get_contents($context->inputs->getFile());
                    if (Analyzer::getTypeOfLanguage(Analyzer::PHP, $fileContent)) {
                        $context->inputs->setCode($fileContent);
                        $context->setPath(dirname($context->inputs->getFile()));
                        $script = $this->parser->parse($context->inputs->getCode(), $context->inputs->getFile());
                    }
                } else {
                    if (Analyzer::getTypeOfLanguage(Analyzer::PHP, $context->inputs->getCode())) {
                        $script = $this->parser->parse($context->inputs->getCode(), "");
                    }
                }
            } catch (\Exception $e) {
                Utils::printWarning($context, Lang::PARSER_ERROR.$e->getMessage());
            }
        }

        return $script;
    }

    public function transformPhp($context, $script)
    {
        // transform
        if (!is_null($script)) {
            $traverser = new \PHPCfg\Traverser();
            $transformvisitor = new \progpilot\Transformations\Php\Transform();
            $transformvisitor->setContext($context);
            $traverser->addVisitor($transformvisitor);
            $traverser->traverse($script);

            unset($traverser);
            unset($transformvisitor);
        
            /*
            $dumper = new \PHPCfg\Printer\Text();
            echo $dumper->printScript($script);
            */
        }
    }

    public function runFunctionAnalysis($context, $myFunc, $updatemyfile = true)
    {
        if (!is_null($myFunc) && !$myFunc->isVisited()) {
            $myFunc->setIsVisited(true);
            
            $myFunc->getMyCode()->setStart(0);
            $myFunc->getMyCode()->setEnd(count($myFunc->getMyCode()->getCodes()));
            
            $visitoranalyzer = new \progpilot\Analysis\VisitorAnalysis;

            if ($updatemyfile) {
                $file = $myFunc->getSourceMyFile()->getName();
                $myFile = new MyFile($file, 0, 0);
                $context->inputs->setFile($file);
                $context->setCurrentMyfile($myFile);
            }

            $params = $myFunc->getParams();
            foreach ($params as $param) {
                $param->setParamToArg(null);
            }

            $visitoranalyzer->setContext($context);
            $visitoranalyzer->analyzeFunc($myFunc, null, true);

            foreach ($myFunc->getReturnDefs() as $returnDef) {
                $returnDefCopy = deep_copy($returnDef);
                $myFunc->addInitialReturnDef($returnDefCopy);
            }

            $context->resetInternalValues();
            unset($visitoranalyzer);
        } else {
            // throw main function missing
        }
    }
    
    public function visitDataFlow($context)
    {
        // analyze
        if (!is_null($context)) {
            $visitordataflow = new \progpilot\Dataflow\VisitorDataflow();
    
            $fileNameHash = hash("sha256", $context->getCurrentMyfile()->getName());
            foreach ($context->getTmpFunctions() as $myFunc) {
                if (!is_null($myFunc)) {
                    $visitordataflow->analyze($context, $myFunc);

                    $className = "function";
                    if (!is_null($myFunc->getMyclass())) {
                        $className = $myFunc->getMyclass()->getName();
                    }

                    $context->getFunctions()->addFunction($fileNameHash, $className, $myFunc->getName(), $myFunc);
                }
            }

            $context->clearTmpFunctions();
        }
    }
    
    public function computeDataFlowPhp($context)
    {
        // free memory
        if (function_exists('gc_mem_caches')) {
            gc_mem_caches();
        }

        $pastResults = &$context->outputs->getResults();
        $context->resetInternalValues();
        $context->outputs->setResults($pastResults);

        $script = $this->parsePhp($context);

        $this->transformPhp($context, $script);
            
        $this->visitDataFlow($context);
    }
    
    public function computeDataFlowJs($context)
    {
        $startTime = microtime(true);
        
        // free memory
        if (function_exists('gc_mem_caches')) {
            gc_mem_caches();
        }
        
        if (!is_null($context->inputs->getFile())) {
            $content = @file_get_contents($context->inputs->getFile());
            
            if (Analyzer::getTypeOfLanguage(Analyzer::JS, $content)) {
                if (!extension_loaded("v8js")) {
                    Utils::printWarning($context, Lang::V8JS_NOTLOADED);
                    return;
                }

                $pastResults = &$context->outputs->getResults();
                $context->resetInternalValues();
                $context->outputs->setResults($pastResults);
                
                if ((microtime(true) - $startTime) > $context->getMaxFileAnalysisDuration()) {
                    Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
                    return;
                }
                
                $transformvisitor = new \progpilot\Transformations\Js\Transform();
                $transformvisitor->setContext($context);
                $transformvisitor->v8jsExecute();
            
                if ((microtime(true) - $startTime) > $context->getMaxFileAnalysisDuration()) {
                    Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
                    return;
                }
                
                $this->visitDataFlow($context);
            }
        }
    }
    
    public function computeDataFlow($context)
    {
        $filename = $context->inputs->getFile();

        if (!file_exists($filename) && is_null($context->inputs->getCode())) {
            Utils::printWarning(
                $context,
                Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($filename).")"
            );
        } elseif (is_null($filename) && is_null($context->inputs->getCode())) {
            Utils::printWarning($context, Lang::FILE_AND_CODE_ARE_NULL);
        } else {
            if (is_null($context->inputs->getCode())
                && @filesize($filename) > $context->getMaxFileSize()) {
                Utils::printWarning(
                    $context,
                    Lang::MAX_SIZE_EXCEEDED." (".Utils::encodeCharacters($filename).")"
                );
            } else {
                if (!$context->isFileDataAnalyzed($filename)) {
                    if ($context->inputs->isLanguage(Analyzer::PHP)) {
                        $this->computeDataFlowPhp($context);
                    } elseif ($context->inputs->isLanguage(Analyzer::JS)) {
                        $this->computeDataFlowJs($context);
                    }
                }
            }
        }
    }
    
    public static function getTypeOfLanguage($lookfor, $content)
    {
        if ($lookfor === Analyzer::PHP && !empty($content)) {
            if (strpos($content, "<?") !== false
                || strpos($content, "<?php") !== false) {
                return true;
            }
        }

        if ($lookfor === Analyzer::JS && !empty($content)) {
            if (strpos($content, "var") !== false
                || strpos($content, "let") !== false
                    || strpos($content, "export") !== false
                        || strpos($content, "import") !== false) {
                return true;
            }
        }
        
        return false;
    }

    public function getNamespace($context, $file)
    {
        try {
            if (@filesize($file) <= $context->getMaxFileSize()) {
                $contents = @file_get_contents($file);
                preg_match('/namespace (.*);/', $contents, $matches);
                if (isset($matches[1])) {
                    $context->addFileandNamepace($file, $matches[1]);
                }

                $script = $this->parser->parse($contents, $file);

                $traverser = new \PHPCfg\Traverser();
                $callvisitor = new \progpilot\CallVisitor();
                $callvisitor->setContext($context);
                $traverser->addVisitor($callvisitor);
                $traverser->traverse($script);
            }
        } catch (\Exception $e) {
            Utils::printWarning($context, Lang::PARSER_ERROR.$e->getMessage());
        }
    }

    public function computeDataFlowOfNamespaces($context, $file)
    {
        $nsCalls = $context->getCallsToNamespace($file);
        if (!is_null($nsCalls)) {
            foreach ($nsCalls as $nsCall) {
                $fileToInclude = $context->getFileFromNamespace($nsCall);
                if (!is_null($fileToInclude) && !$context->isFileDataAnalyzed($fileToInclude)) {
                    $myFileToInclude = new MyFile($fileToInclude, 0, 0);
                    $context->inputs->setFile($fileToInclude);
                    $context->setCurrentMyfile($myFileToInclude);

                    $this->computeDataFlow($context);

                    // file is now data analyzed
                    $context->addDataAnalyzedFile($fileToInclude);
                    // we look for namespaces of this file
                    $this->computeDataFlowOfNamespaces($context, $fileToInclude);
                }
            }
        }
    }

    public function runAnalysisOfCurrentMyFile($context)
    {
        $functions = $context->getFunctions()->getFunctions();
        $fileNameHash = hash("sha256", $context->getCurrentMyfile()->getName());

        $myFuncsOfFile = [];
        // we take all function except mains
        if (isset($functions["$fileNameHash"])) {
            $myFuncsToAnalyze = $functions["$fileNameHash"];
            // we put the functions at the top (will be analyzed at first)
            // could impact initialreturndef and funccall to be analyzed or not
            foreach ($myFuncsToAnalyze as $myFuncsByClass) {
                foreach ($myFuncsByClass as $myFunc) {
                    // func with global variables except to be analyzed/called from a main
                    if (!$myFunc->hasGlobalVariables() && $myFunc->getName() !== "{main}") {
                        $myFuncsOfFile[] = $myFunc;
                    }
                }
            }

            foreach ($myFuncsToAnalyze as $myFuncsByClass) {
                foreach ($myFuncsByClass as $myFunc) {
                    if ($myFunc->getName() == "{main}") {
                        $myFuncsOfFile[] = $myFunc;
                    }
                }
            }
        }

        foreach ($myFuncsOfFile as $myFunc) {
            $this->runFunctionAnalysis($context, $myFunc);
            $context->resetCallStack();
        }
    }
    
    public function run($context, $cmdFiles = null)
    {
        $currentMemoryLimit = ini_get("memory_limit");
        if (!$currentMemoryLimit) {
            $currentMemoryLimit = 0;
        }

        $bytes = HelpersAnalysis::getBytes($currentMemoryLimit);
        if ($bytes < $context->getMaxMemory()) {
            $ret = ini_set('memory_limit', $context->getMaxMemory());
            if (!$ret) {
                Utils::printWarning($context, Lang::CANNOT_SET_MEMORY.$context->getMaxMemory());
            }
        }

        $files = [];

        $context->readConfiguration();
        // try to resolve incorrect included/excluded file paths
        $context->inputs->resolvePaths();

        // add all configurations inside frameworks folders except if overwritten
        $context->inputs->readFrameworks();

        // add common configuration except if overwritten
        $context->inputs->readDefaultSanitizers();
        $context->inputs->readDefaultSinks();
        $context->inputs->readDefaultSources();
        $context->inputs->readDefaultValidators();
        $context->inputs->readDefaultCustomRules();

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

        $includedFiles = $context->inputs->getInclusions();

        foreach ($includedFiles as $includedFile) {
            if (is_dir($includedFile)) {
                $this->getFilesOfDir($context, $includedFile, $files);
            } else {
                if (!in_array($includedFile, $files, true)
                        && !$context->inputs->isExcludedFile($includedFile)) {
                    $files[] = $includedFile;
                }
            }
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

        // a first pass to identify namespaces and calls
        foreach ($files as $file) {
            if (is_file($file)) {
                $myFile = new MyFile($file, 0, 0);
                $context->inputs->setFile($file);
                $context->setCurrentMyfile($myFile);

                $this->getNamespace($context, $file);
            }
        }

        foreach ($files as $file) {
            if (is_file($file)) {
                if ($context->isDebugMode()) {
                    echo "progpilot analyze : ".Utils::encodeCharacters($file)."\n";
                }
            
                $context->outputs->setCountAnalyzedFiles(
                    $context->outputs->getCountAnalyzedFiles() + 1
                );

                // for each file we look for required namespaces to include
                $this->computeDataFlowOfNamespaces($context, $file);

                $myFile = new MyFile($file, 0, 0);
                $context->inputs->setFile($file);
                $context->setCurrentMyfile($myFile);

                $this->computeDataFlow($context);
                // the file is now data analyzed
                $context->addDataAnalyzedFile($file);
                $this->runAnalysisOfCurrentMyFile($context);

                $context->resetIncludedFiles();

                // needed??
                $context->inputs->setCode(null);
            }
        }

        // if no files try to read code
        if (empty($files) && !is_null($context->inputs->getCode())) {
            $this->computeDataFlow($context);
            $this->runAnalysis($context);
        }

        if ($context->outputs->getWriteIncludeFailures()) {
            $context->outputs->writeIncludesFile();
        }
    }
}
