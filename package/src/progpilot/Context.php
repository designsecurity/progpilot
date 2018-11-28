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
    private $myFiles;
    private $classes;
    private $objects;
    private $functions;
    private $path;
    private $analyzeHardRules;
    private $analyzeFunctions;
    private $analyzeIncludes;
    private $printFileUnderAnalysis;
    private $configurationFile;
    private $printWarning;
    private $prettyPrint;
    private $limitTime;
    private $limitDefs;
    private $limitSize;
    private $limitValues;

    public $inputs;
    public $outputs;

    public function __construct()
    {
        $this->configurationFile = null;
        $this->analyzeHardRules = false;
        $this->analyzeFunctions = true;
        $this->analyzeIncludes = true;
        $this->printFileUnderAnalysis = false;
        $this->printWarning = false;
        $this->prettyPrint = true;
        $this->limitTime = 10;
        $this->limitDefs = 3000;
        $this->limitSize = 500000;
        $this->currentNbDefs = 0;

        $this->inputs = new \progpilot\Inputs\MyInputs;
        $this->outputs = new \progpilot\Outputs\MyOutputs;

        $this->objects = new \progpilot\Dataflow\Objects;
        $this->classes = new \progpilot\Dataflow\Classes;
        $this->functions = new \progpilot\Dataflow\Functions;

        $this->resetInternalValues();

        $this->currentMyFile = null;
        $this->myfiles = [];
        $this->arrayIncludes = [];
        $this->arrayRequires = [];
    }

    public function getCurrentNbDefs()
    {
        return $this->currentNbDefs;
    }

    public function setCurrentNbDefs($currentNbDefs)
    {
        $this->currentNbDefs = $currentNbDefs;
    }

    public function resetInternalLowvalues()
    {
        $this->currentOp = null;
        $this->currentBlock = null;
        $this->currentLine = -1;
        $this->currentColumn = -1;
        $this->currentFunc = null;
        $this->currentMyCode = null;
        $this->path = null;
    }

    public function resetInternalValues()
    {
        $this->resetInternalLowvalues();
        
        unset($this->currentMyCode);

        $this->inputs->setCode(null);
        // representations (cfg, ast ...) are deleted to avoid memory grown
        //$this->outputs = new \progpilot\Outputs\MyOutputs;
        $this->outputs->resetRepresentations();
    }

    public function resetDataflow()
    {
        unset($this->objects);
        unset($this->classes);
        unset($this->functions);

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

    public function getArrayIncludes()
    {
        return $this->arrayIncludes;
    }

    public function getArrayRequires()
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

    public function setPrintWarning($bool)
    {
        $this->printWarning = $bool;
    }

    public function getPrintWarning()
    {
        return $this->printWarning;
    }

    public function setLimitDefs($limitDefs)
    {
        $this->limitDefs = $limitDefs;
    }

    public function getLimitDefs()
    {
        return $this->limitDefs;
    }

    public function setLimitTime($limitTime)
    {
        $this->limitTime = $limitTime;
    }

    public function getLimitTime()
    {
        return $this->limitTime;
    }

    public function setLimitSize($limitSize)
    {
        $this->limitSize = $limitSize;
    }

    public function getLimitSize()
    {
        return $this->limitSize;
    }

    public function getAnalyzeHardrules()
    {
        return $this->analyzeHardRules;
    }

    public function getAnalyzeIncludes()
    {
        return $this->analyzeIncludes;
    }

    public function setAnalyzeHardRules($analyzeHardRules)
    {
        $this->analyzeHardRules = $analyzeHardRules;
    }

    public function setAnalyzeIncludes($analyzeIncludes)
    {
        $this->analyzeIncludes = $analyzeIncludes;
    }

    public function setAnalyzeFunctions($analyzeFunctions)
    {
        $this->analyzeFunctions = $analyzeFunctions;
    }

    public function getAnalyzeFunctions()
    {
        return $this->analyzeFunctions;
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

    public function setPrintFile($bool)
    {
        $this->printFileUnderAnalysis = $bool;
    }

    public function getPrintFile()
    {
        return $this->printFileUnderAnalysis;
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
                            if (isset($value["inputs"]["setCustomRules"])) {
                                $this->inputs->setCustomRules($value["inputs"]["setCustomRules"]);
                            }

                            if (isset($value["inputs"]["setSources"])) {
                                $this->inputs->setSources($value["inputs"]["setSources"]);
                            }

                            if (isset($value["inputs"]["setSinks"])) {
                                $this->inputs->setSinks($value["inputs"]["setSinks"]);
                            }

                            if (isset($value["inputs"]["setValidators"])) {
                                $this->inputs->setValidators($value["inputs"]["setValidators"]);
                            }

                            if (isset($value["inputs"]["setSanitizers"])) {
                                $this->inputs->setSanitizers($value["inputs"]["setSanitizers"]);
                            }

                            if (isset($value["inputs"]["setIncludes"])) {
                                $this->inputs->setIncludes($value["inputs"]["setIncludes"]);
                            }

                            if (isset($value["inputs"]["setExcludes"])) {
                                $this->inputs->setExcludes($value["inputs"]["setExcludes"]);
                            }

                            if (isset($value["inputs"]["setFolder"])) {
                                $this->inputs->setFolder($value["inputs"]["setFolder"]);
                            }

                            if (isset($value["inputs"]["setFile"])) {
                                $this->inputs->setFile($value["inputs"]["setFile"]);
                            }

                            if (isset($value["inputs"]["setCode"])) {
                                $this->inputs->setCode($value["inputs"]["setCode"]);
                            }

                            if (isset($value["inputs"]["setResolvedIncludes"])) {
                                $this->inputs->setResolvedIncludes($value["inputs"]["setResolvedIncludes"]);
                            }

                            if (isset($value["inputs"]["setFalsePositives"])) {
                                $this->inputs->setFalsePositives($value["inputs"]["setFalsePositives"]);
                            }
                            
                            if (isset($value["inputs"]["setLanguages"])) {
                                $this->inputs->setLanguages($value["inputs"]["setLanguages"]);
                            }
                            
                            if (isset($value["inputs"]["setFrameworks"])) {
                                $this->inputs->setFrameworks($value["inputs"]["setFrameworks"]);
                            }
                            
                            if (isset($value["inputs"]["setDev"])) {
                                $this->inputs->setDev($value["inputs"]["setDev"]);
                            }
                        }

                        if (isset($value["outputs"])) {
                            if (isset($value["outputs"]["taintedFlow"])) {
                                $this->outputs->taintedFlow($value["outputs"]["taintedFlow"]);
                            }

                            if (isset($value["outputs"]["resolveIncludes"])) {
                                $this->outputs->resolveIncludes($value["outputs"]["resolveIncludes"]);
                            }

                            if (isset($value["outputs"]["resolveIncludesFile"])) {
                                $this->outputs->resolveIncludesFile($value["outputs"]["resolveIncludesFile"]);
                            }
                            
                            if (isset($value["outputs"]["onAddResult"])) {
                                $this->outputs->setOnAddResult($value["outputs"]["onAddResult"]);
                            }
                        }

                        if (isset($value["options"])) {
                            if (isset($value["options"]["setAnalyzeHardRules"])) {
                                $this->setAnalyzeHardRules($value["options"]["setAnalyzeHardRules"]);
                            }

                            if (isset($value["options"]["setAnalyzeIncludes"])) {
                                $this->setAnalyzeIncludes($value["options"]["setAnalyzeIncludes"]);
                            }

                            if (isset($value["options"]["setAnalyzeFunctions"])) {
                                $this->setAnalyzeFunctions($value["options"]["setAnalyzeFunctions"]);
                            }

                            if (isset($value["options"]["setPrintFile"])) {
                                $this->setPrintFile($value["options"]["setPrintFile"]);
                            }

                            if (isset($value["options"]["setLimitTime"])) {
                                $this->setLimitTime($value["options"]["setLimitTime"]);
                            }

                            if (isset($value["options"]["setLimitDefs"])) {
                                $this->setLimitDefs($value["options"]["setLimitDefs"]);
                            }

                            if (isset($value["options"]["setLimitSize"])) {
                                $this->setLimitSize($value["options"]["setLimitSize"]);
                            }

                            if (isset($value["options"]["setPrintWarning"])) {
                                $this->setPrintWarning($value["options"]["setPrintWarning"]);
                            }

                            if (isset($value["options"]["setPrettyPrint"])) {
                                $this->setPrettyPrint($value["options"]["setPrettyPrint"]);
                            }
                        }
                    }
                }
            } catch (ParseException $e) {
                Utils::printError($context, Lang::UNABLE_TO_PARSER_YAML);
            }
        }
    }
}
