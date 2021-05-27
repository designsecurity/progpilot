<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;
use progpilot\Utils;
use progpilot\Dataflow;
use progpilot\Objects\MyFunction;

class Context
{
    private $arrayIncludes;
    private $arrayRequires;

    private $currentMyCode;
    private $currentOp;
    private $currentBlock;
    private $currentLine;
    private $currentColumn;
    private $currentFunc;
    private $currentMyFile;
    private $currentNbDefs;
    private $classes;
    private $objects;
    private $functions;
    private $path;
    private $analyzeIncludes;
    private $configurationFile;
    private $debugMode;
    private $prettyPrint;
    private $maxFileAnalysisDuration;
    private $maxDefinitions;
    private $maxFileSize;
    private $defsMain;
    private $symbols;
    private $callStack;

    private $analyzedDataFiles;

    public $inputs;
    public $outputs;

    public function __construct()
    {
        $this->configurationFile = null;
        $this->analyzeIncludes = true;
        $this->debugMode = false;
        $this->prettyPrint = true;
        $this->maxFileAnalysisDuration = 30;
        $this->maxDefinitions = 500;
        $this->maxFileSize = 1000000;

        $this->inputs = new \progpilot\Inputs\MyInputs;
        $this->outputs = new \progpilot\Outputs\MyOutputs;

        $this->objects = new \progpilot\Dataflow\Objects;
        $this->classes = new \progpilot\Dataflow\Classes;
        $this->functions = new \progpilot\Dataflow\Functions;

        $this->resetInternalValues();

        $this->currentFunc = null;
        $this->currentMyFile = null;
        $this->arrayIncludes = [];
        $this->arrayRequires = [];
        $this->analyzedDataFiles = [];

        $this->defsMain = [];
        $this->tmpfunctions = [];
        $this->symbols = new Dataflow\Symbols;
        $this->callStack = [];
    }
    

    public function pushToCallStack($val)
    {
        array_push($this->callStack, $val);
    }

    public function popFromCallStack()
    {
        return array_pop($this->callStack);
    }

    public function setCallStack($callStack)
    {
        $this->callStack = $callStack;
    }

    public function getCallStack()
    {
        return $this->callStack;
    }

    public function inCallStack($curFunc)
    {
        foreach ($this->callStack as $call) {
            $callFunc = $call[0];

            if ($callFunc->getName() === $curFunc->getName()
                && !$callFunc->isType(MyFunction::TYPE_FUNC_METHOD)
                    && !$curFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                return true;
            }

            if ($callFunc->getName() === $curFunc->getName()
                && $callFunc->isType(MyFunction::TYPE_FUNC_METHOD)
                    && $curFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                $curClass = $curFunc->getMyClass();
                $callClass = $callFunc->getMyClass();

                if ($curClass->getName() === $callClass->getName()) {
                    return true;
                }
                
                $curClassExtends = $curClass->getExtendsOf();
                $callClassExtends = $callClass->getExtendsOf();

                if (isset($curClassExtends) && isset($callClassExtends)
                    && $curClassExtends === $callClassExtends) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getSymbols()
    {
        return $this->symbols;
    }
    
    public function addTmpFunctions($myfunc)
    {
        $this->tmpfunctions[] = $myfunc;
    }
    
    public function clearTmpFunctions()
    {
        $this->tmpfunctions = [];
    }
    
    public function getTmpFunctions()
    {
        return $this->tmpfunctions;
    }

    public function addDataAnalyzedFile($file)
    {
        if (!in_array($file, $this->analyzedDataFiles)) {
            $this->analyzedDataFiles[] = $file;
        }
    }

    public function isFileDataAnalyzed($file)
    {
        return in_array($file, $this->analyzedDataFiles);
    }

    public function getDefsMain()
    {
        return $this->defsMain;
    }

    public function setDefsMain($defsMain)
    {
        $this->defsMain = $defsMain;
    }

    public function addFileandNamepace($file, $namespace)
    {
        $this->namespaces["$namespace"] = $file;
    }

    public function getFileFromNamespace($namespace)
    {
        if (isset($this->namespaces["$namespace"])) {
            return $this->namespaces["$namespace"];
        }

        return null;
    }

    public function addCallToNamespace($namespace)
    {
        if (!isset($this->calltonamespaces["".$this->currentMyFile->getName().""])) {
            $this->calltonamespaces["".$this->currentMyFile->getName().""] = [];
        }

        if (!in_array($namespace, $this->calltonamespaces["".$this->currentMyFile->getName().""], true)) {
            $this->calltonamespaces["".$this->currentMyFile->getName().""][] = $namespace;
        }
    }
    
    public function getCallsToNamespace($file)
    {
        if (isset($this->calltonamespaces["$file"])) {
            return $this->calltonamespaces["$file"];
        }

        return null;
    }

    public function resetInternalLowvalues()
    {
        $this->currentOp = null;
        $this->currentBlock = null;
        $this->currentLine = -1;
        $this->currentColumn = -1;
        $this->currentFunc = null;
        $this->currentMyCode = null;
    }

    public function resetInternalValues()
    {
        $this->resetInternalLowvalues();

        $this->inputs->setCode(null);
    }

    public function resetCallStack()
    {
        $this->callStack = [];
    }

    public function resetIncludedFiles()
    {
        $this->arrayIncludes = [];
        $this->arrayRequires = [];
    }

    public function resetDataflow()
    {
        $this->analyzedDataFiles = [];
        $this->objects = new \progpilot\Dataflow\Objects;
        $this->classes = new \progpilot\Dataflow\Classes;
        $this->functions = new \progpilot\Dataflow\Functions;
    }

    public function setArrayIncludes($arrayIncludes)
    {
        $this->arrayIncludes = $arrayIncludes;
    }

    public function setArrayRequires($arrayRequires)
    {
        $this->arrayRequires = $arrayRequires;
    }

    public function &getArrayIncludes()
    {
        return $this->arrayIncludes;
    }

    public function &getArrayRequires()
    {
        return $this->arrayRequires;
    }

    public function setPrettyPrint($bool)
    {
        $this->prettyPrint = $bool;
    }

    public function getPrettyPrint()
    {
        return $this->prettyPrint;
    }

    public function setDebugMode($bool)
    {
        $this->debugMode = $bool;
    }

    public function isDebugMode()
    {
        return $this->debugMode;
    }

    public function setMaxDefinitions($maxDefinitions)
    {
        $this->maxDefinitions = $maxDefinitions;
    }

    public function getMaxDefinitions()
    {
        return $this->maxDefinitions;
    }

    public function setMaxFileAnalysisDuration($maxFileAnalysisDuration)
    {
        $this->maxFileAnalysisDuration = $maxFileAnalysisDuration;
    }

    public function getMaxFileAnalysisDuration()
    {
        return $this->maxFileAnalysisDuration;
    }

    public function setMaxFileSize($maxFileSize)
    {
        $this->maxFileSize = $maxFileSize;
    }

    public function getMaxFileSize()
    {
        return $this->maxFileSize;
    }

    public function getAnalyzeIncludes()
    {
        return $this->analyzeIncludes;
    }

    public function setAnalyzeIncludes($analyzeIncludes)
    {
        $this->analyzeIncludes = $analyzeIncludes;
    }

    public function getCurrentMycode()
    {
        return $this->currentMyCode;
    }

    public function getCurrentOp()
    {
        return $this->currentOp;
    }

    public function getCurrentBlock()
    {
        return $this->currentBlock;
    }

    public function getCurrentLine()
    {
        return $this->currentLine;
    }

    public function getCurrentColumn()
    {
        return $this->currentColumn;
    }

    public function getCurrentFunc()
    {
        return $this->currentFunc;
    }

    public function getObjects()
    {
        return $this->objects;
    }

    public function getClasses()
    {
        return $this->classes;
    }

    public function getFunctions()
    {
        return $this->functions;
    }

    public function getInputs()
    {
        return $this->inputs;
    }

    public function getOutputs()
    {
        return $this->outputs;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getCurrentMyfile()
    {
        return $this->currentMyFile;
    }

    public function setCurrentMyfile($myFile)
    {
        $this->currentMyFile = $myFile;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function setCurrentMycode($myCode)
    {
        $this->currentMyCode = $myCode;
    }

    public function setCurrentOp($currentOp)
    {
        $this->currentOp = $currentOp;
    }

    public function setCurrentBlock($currentBlock)
    {
        $this->currentBlock = $currentBlock;
    }

    public function setCurrentLine($currentLine)
    {
        $this->currentLine = $currentLine;
    }

    public function setCurrentColumn($currentColumn)
    {
        $this->currentColumn = $currentColumn;
    }

    public function setCurrentFunc($currentFunc)
    {
        $this->currentFunc = $currentFunc;
    }

    public function setObjects($objects)
    {
        $this->objects = $objects;
    }

    public function setClasses($classes)
    {
        $this->classes = $classes;
    }

    public function setFunctions($functions)
    {
        $this->functions = $functions;
    }

    public function setInputs($inputs)
    {
        $this->inputs = $inputs;
    }

    public function setOutputs($outputs)
    {
        $this->outputs = $outputs;
    }

    public function setConfiguration($file)
    {
        $this->configurationFile = $file;
    }

    public function getConfiguration()
    {
        return $this->configurationFile;
    }

    public function readConfiguration()
    {
        if (!is_null($this->configurationFile)) {
            try {
                if (file_exists($this->configurationFile)) {
                    $yaml = new Parser();
                    $value = $yaml->parse(file_get_contents($this->configurationFile));

                    if (is_array($value)) {
                        if (isset($value["inputs"])) {
                            if (isset($value["inputs"]["customrules"])) {
                                $keep_defaults = true;
                                if (isset($value["inputs"]["customrules"]["keep_defaults"])) {
                                    $keep_defaults = $value["inputs"]["customrules"]["keep_defaults"];
                                }

                                if ($keep_defaults) {
                                    $this->inputs->addCustomRules($value["inputs"]["customrules"]["config_files"]);
                                } else {
                                    $this->inputs->setCustomRules($value["inputs"]["customrules"]["config_files"]);
                                }
                            }

                            if (isset($value["inputs"]["sources"])) {
                                $keep_defaults = true;
                                if (isset($value["inputs"]["sources"]["keep_defaults"])) {
                                    $keep_defaults = $value["inputs"]["sources"]["keep_defaults"];
                                }

                                if ($keep_defaults) {
                                    $this->inputs->addSources($value["inputs"]["sources"]["config_files"]);
                                } else {
                                    $this->inputs->setSources($value["inputs"]["sources"]["config_files"]);
                                }
                            }

                            if (isset($value["inputs"]["sinks"])) {
                                $keep_defaults = true;
                                if (isset($value["inputs"]["sinks"]["keep_defaults"])) {
                                    $keep_defaults = $value["inputs"]["sinks"]["keep_defaults"];
                                }

                                if ($keep_defaults) {
                                    $this->inputs->addSinks($value["inputs"]["sinks"]["config_files"]);
                                } else {
                                    $this->inputs->setSinks($value["inputs"]["sinks"]["config_files"]);
                                }
                            }

                            if (isset($value["inputs"]["validators"])) {
                                $keep_defaults = true;
                                if (isset($value["inputs"]["validators"]["keep_defaults"])) {
                                    $keep_defaults = $value["inputs"]["validators"]["keep_defaults"];
                                }

                                if ($keep_defaults) {
                                    $this->inputs->addValidators($value["inputs"]["validators"]["config_files"]);
                                } else {
                                    $this->inputs->setValidators($value["inputs"]["validators"]["config_files"]);
                                }
                            }

                            if (isset($value["inputs"]["sanitizers"])) {
                                $keep_defaults = true;
                                if (isset($value["inputs"]["sanitizers"]["keep_defaults"])) {
                                    $keep_defaults = $value["inputs"]["sanitizers"]["keep_defaults"];
                                }

                                if ($keep_defaults) {
                                    $this->inputs->addSanitizers($value["inputs"]["sanitizers"]["config_files"]);
                                } else {
                                    $this->inputs->setSanitizers($value["inputs"]["sanitizers"]["config_files"]);
                                }
                            }

                            if (isset($value["inputs"]["inclusions"])) {
                                $this->inputs->setInclusions($value["inputs"]["inclusions"]);
                            }

                            if (isset($value["inputs"]["exclusions"])) {
                                $this->inputs->setExclusions($value["inputs"]["exclusions"]);
                            }

                            if (isset($value["inputs"]["resolved_includes_file"])) {
                                $this->inputs->setResolvedIncludes($value["inputs"]["resolved_includes_file"]);
                            }

                            if (isset($value["inputs"]["false_positives"])) {
                                $this->inputs->setFalsePositives($value["inputs"]["false_positives"]);
                            }
                            
                            if (isset($value["inputs"]["languages"])) {
                                $this->inputs->setLanguages($value["inputs"]["languages"]);
                            }
                            
                            if (isset($value["inputs"]["dev_mode"])) {
                                $this->inputs->setDev($value["inputs"]["dev_mode"]);
                            }
                        }

                        if (isset($value["outputs"])) {
                            if (isset($value["outputs"]["tainted_flow"])) {
                                $this->outputs->taintedFlow($value["outputs"]["tainted_flow"]);
                            }

                            if (isset($value["outputs"]["include_failures_file"])) {
                                $this->outputs->setIncludeFailuresFile($value["outputs"]["include_failures_file"]);
                            }
                        }

                        if (isset($value["options"])) {
                            if (isset($value["options"]["analyze_includes"])) {
                                $this->setAnalyzeIncludes($value["options"]["analyze_includes"]);
                            }

                            if (isset($value["options"]["max_file_analysis_duration"])) {
                                $this->setMaxFileAnalysisDuration($value["options"]["max_file_analysis_duration"]);
                            }

                            if (isset($value["options"]["max_definitions"])) {
                                $this->setMaxDefinitions($value["options"]["max_definitions"]);
                            }

                            if (isset($value["options"]["max_file_size"])) {
                                $this->setMaxFileSize($value["options"]["max_file_size"]);
                            }

                            if (isset($value["options"]["debug_mode"])) {
                                $this->setDebugMode($value["options"]["debug_mode"]);
                            }

                            if (isset($value["options"]["pretty_print"])) {
                                $this->setPrettyPrint($value["options"]["pretty_print"]);
                            }
                        }
                    }
                } else {
                    Utils::printError(
                        Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->configurationFile).")"
                    );
                }
            } catch (ParseException $e) {
                Utils::printError(Lang::UNABLE_TO_PARSER_YAML);
            }
        }
    }
}
