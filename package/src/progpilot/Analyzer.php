<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace progpilot;

use progpilot\Utils;
use progpilot\Code\MyCode;
use progpilot\Objects\MyFile;

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
        if (is_dir($dir) && !$context->inputs->isExcludedFolder($dir)) {
            $filesanddirs = @scandir($dir);

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

    public function parsePhp($context)
    {
        $script = null;

        // parser
        if (!is_null($context->inputs->getFile()) || !is_null($context->inputs->getCode())) {
            try {
                if (is_null($context->inputs->getCode())) {
                    $fileContent = file_get_contents($context->inputs->getFile());
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
            } catch (\PhpParser\Error $e) {
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
        }
    }

    public function runFunctionAnalysis($context, $myFunc, $updatemyfile = true)
    {
        echo "runFunctionAnalysis 1\n";
        if (!is_null($myFunc) && !$myFunc->isVisited()) {
            echo "runFunctionAnalysis 2\n";
            $myFunc->setIsVisited(true);
            $myFunc->setInitialAnalysis(true);
            
            $myFunc->getMyCode()->setStart(0);
            $myFunc->getMyCode()->setEnd(count($myFunc->getMyCode()->getCodes()));
            
            \progpilot\Analysis\ValueAnalysis::buildStorage();
            
            $visitoranalyzer = new \progpilot\Analysis\VisitorAnalysis;

            if ($updatemyfile) {
                $file = $myFunc->getSourceMyFile()->getName();
                $myFile = new MyFile($file, 0, 0);
                $context->inputs->setFile($file);
                $context->setCurrentMyfile($myFile);
            }

            $visitoranalyzer->setContext($context);
            $visitoranalyzer->analyze($myFunc->getMyCode());

            foreach ($myFunc->getReturnDefs() as $returnDef) {
                $returnDefCopy = deep_copy($returnDef);
                $myFunc->addInitialReturnDef($returnDefCopy);
            }
                
            $myFunc->setInitialAnalysis(false);

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
            $functionsTmp = $context->getFunctions()->getFunctions();
            if (isset($functionsTmp[$fileNameHash])) {
                $functionsFile = $functionsTmp[$fileNameHash];
                foreach ($functionsFile as $classname => $functionsmethod) {
                    foreach ($functionsmethod as $funcname => $signFunc) {
                        $myFunc = Utils::unserializeFunc($signFunc);

                        if (!is_null($myFunc) && !$myFunc->isDataAnalyzed()) {
                            $myFunc->setIsDataAnalyzed(true);
                            $visitordataflow->analyze($context, $myFunc);

                            // we explicitely update the func (ie we serialize again and store it on the disk)
                            $context->getFunctions()->updateFunction($fileNameHash, $classname, $funcname, $myFunc);
                            var_dump($myFunc->getBlocks());
                        }
                    }
                }
            }

            // we merge all defs of "main" functions into one
            $defsMain = [];
            foreach ($context->getFunctions()->getAllFunctions("{main}") as $signFunc) {
                $myFunc = Utils::unserializeFunc($signFunc);
                foreach ($myFunc->getDefs()->getDefs() as $defs) {
                    $defsMain = array_merge($defsMain, $defs);
                }
            }

            $context->setDefsMain($defsMain);
        }
    }
    
    public function computeDataFlowPhp($context)
    {
        // check if it is PHP language ????? LIKE myJavascriptFile
        $startTime = microtime(true);
        
        // free memory
        if (function_exists('gc_mem_caches')) {
            gc_mem_caches();
        }
            
        if ($context->getCurrentNbDefs() > $context->getLimitDefs()) {
            Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
            return;
        }

        $pastResults = &$context->outputs->getResults();
        $context->resetInternalValues();
        $context->outputs->setResults($pastResults);

        $script = $this->parsePhp($context);

        if ((microtime(true) - $startTime) > $context->getLimitTime()) {
            Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
            return;
        }

        $this->transformPhp($context, $script);

        unset($script);
            
        if ((microtime(true) - $startTime) > $context->getLimitTime()) {
            Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
            return;
        }
        
        $this->visitDataFlow($context);
    }
    
    public function computeDataFlowJs($context)
    {
        $startTime = microtime(true);
        
        // free memory
        if (function_exists('gc_mem_caches')) {
            gc_mem_caches();
        }
            
        if (!extension_loaded("v8js")) {
            Utils::printWarning($context, Lang::V8JS_NOTLOADED);
            return;
        }
            
        if ($context->getCurrentNbDefs() > $context->getLimitDefs()) {
            Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
            return;
        }
        
        if (!is_null($context->inputs->getFile())) {
            $content = file_get_contents($context->inputs->getFile());
            
            if (Analyzer::getTypeOfLanguage(Analyzer::JS, $content)) {
                $pastResults = &$context->outputs->getResults();
                $context->resetInternalValues();
                $context->outputs->setResults($pastResults);
                
                if ((microtime(true) - $startTime) > $context->getLimitTime()) {
                    Utils::printWarning($context, Lang::MAX_TIME_EXCEEDED);
                    return;
                }
                
                $transformvisitor = new \progpilot\Transformations\Js\Transform();
                $transformvisitor->setContext($context);
                $transformvisitor->v8jsExecute();
            
                if ((microtime(true) - $startTime) > $context->getLimitTime()) {
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
                && filesize($filename) > $context->getLimitSize()) {
                Utils::printWarning(
                    $context,
                    Lang::MAX_SIZE_EXCEEDED." (".Utils::encodeCharacters($filename).")"
                );
            } else {
                if (!$context->isFileAnalyzed($filename)) {
                    $context->addAnalyzedFile($filename);

                    if ($context->inputs->isLanguage(Analyzer::PHP)) {
                        $this->computeDataFlowPhp($context);
                    }
                    
                    if ($context->inputs->isLanguage(Analyzer::JS)) {
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
                || strpos($content, "int") !== false
                    || strpos($content, "this") !== false
                        || strpos($content, "let") !== false
                            || strpos($content, "export") !== false
                                || strpos($content, "import") !== false) {
                return true;
            }
        }
        
        return false;
    }

    public function runAnalysis($context)
    {
        $contextFunctions = [];
        // we take all function except mains
        foreach ($context->getFunctions()->getFunctions() as $functionsFile) {
            foreach ($functionsFile as $functionsmethod) {
                foreach ($functionsmethod as $signFunc) {
                    $myFunc = Utils::unserializeFunc($signFunc);
                    if ($myFunc->isDataAnalyzed()
                        // func with global variables except to be analyzed/called from a main
                        && !$myFunc->hasGlobalVariables()
                            && $myFunc->getName() !== "{main}") {
                        $contextFunctions[] = $myFunc;
                    }
                }
            }
        }

        echo "runanalysis1\n";
        foreach ($context->getFunctions()->getAllFunctions("{main}") as $signFunc) {
            echo "runanalysis2\n";
            // we put the main functions at the end (we be analyzed at the end)
            $contextFunctions[] = Utils::unserializeFunc($signFunc);
        }

        foreach ($contextFunctions as $myFunc) {
            echo "runanalysis3\n";
            // cfg, ast, callgraph initialization
            $context->outputs->createRepresentationsForFunction($myFunc);
            // include once/require once reset each time
            $context->setArrayIncludes([]);
            $context->setArrayRequires([]);

            $this->runFunctionAnalysis($context, $myFunc);
        
            $tmpCallgraph = $context->outputs->callgraph[$myFunc->getId()];
            $tmpCallgraph->computeCallGraph();

            \progpilot\Analysis\CustomAnalysis::mustVerifyCallFlow($context, $tmpCallgraph);
        }
    }
    
    public function run($context, $cmdFiles = null)
    {
        Utils::createWorkSpace();

        $files = [];

        $context->readConfiguration();
        $context->inputs->readExcludes();
        $context->inputs->readIncludes();

        $context->inputs->readDev();
        $context->inputs->readFrameworks();
        $context->inputs->readSanitizers();
        $context->inputs->readSinks();
        $context->inputs->readSources();
        $context->inputs->readResolvedIncludes();
        $context->inputs->readValidators();
        $context->inputs->readFalsePositives();
        $context->inputs->readCustomRules();

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
            
            $context->outputs->setCountAnalyzedFiles(
                $context->outputs->getCountAnalyzedFiles() + 1
            );

            $myFile = new MyFile($file, 0, 0);
            $context->inputs->setFile($file);
            $context->setCurrentMyfile($myFile);
            $this->computeDataFlow($context);
            $context->inputs->setCode(null);
        }

        // if no files try to read code
        if (empty($files) && !is_null($context->inputs->getCode())) {
            $this->computeDataFlow($context);
        }

        $this->runAnalysis($context);

        if ($context->outputs->getResolveIncludes()) {
            $context->outputs->writeIncludesFile();
        }

        //Utils::deleteWorkSpace();
    }
}
