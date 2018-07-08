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
    private $array_includes;
    private $array_requires;

    private $current_mycode;
    private $current_op;
    private $current_block;
    private $current_line;
    private $current_column;
    private $current_func;
    private $current_myfile;
    private $current_nb_defs;
    private $myfiles;
    private $classes;
    private $objects;
    private $functions;
    private $path;
    private $analyze_hardrules;
    private $analyze_functions;
    private $analyze_includes;
    private $analyze_js;
    private $print_file_under_analysis;
    private $configuration_file;
    private $printWarning;
    private $pretty_print;
    private $limit_time;
    private $limit_defs;
    private $limit_size;
    private $limit_values;

    public $inputs;
    public $outputs;

    public function __construct()
    {
        $this->configuration_file = null;
        $this->analyze_hardrules = false;
        $this->analyze_functions = true;
        $this->analyze_includes = true;
        $this->analyze_js = true;
        $this->print_file_under_analysis = false;
        $this->printWarning = false;
        $this->pretty_print = true;
        $this->limit_time = 10;
        $this->limit_defs = 3000;
        $this->limit_size = 500000;
        $this->current_nb_defs = 0;

        $this->inputs = new \progpilot\Inputs\MyInputs;
        $this->outputs = new \progpilot\Outputs\MyOutputs;

        $this->objects = new \progpilot\Dataflow\Objects;
        $this->classes = new \progpilot\Dataflow\Classes;
        $this->functions = new \progpilot\Dataflow\Functions;

        $this->resetInternalValues();

        $this->current_myfile = null;
        $this->myfiles = [];
        $this->array_includes = [];
        $this->array_requires = [];
    }

    public function getCurrentNbDefs()
    {
        return $this->current_nb_defs;
    }

    public function setCurrentNbDefs($current_nb_defs)
    {
        $this->current_nb_defs = $current_nb_defs;
    }

    public function resetInternalLowvalues()
    {
        $this->current_op = null;
        $this->current_block = null;
        $this->current_line = -1;
        $this->current_column = -1;
        $this->current_func = null;
        $this->current_mycode = null;
        $this->path = null;
    }

    public function resetInternalValues()
    {
        $this->resetInternalLowvalues();
        /*
        unset($this->objects);
        unset($this->classes);
        unset($this->functions);
        */
        unset($this->current_mycode);

        $this->inputs->setCode(null);
        /*
                $this->objects = new \progpilot\Dataflow\Objects;
                $this->classes = new \progpilot\Dataflow\Classes;
                $this->functions = new \progpilot\Dataflow\Functions;
             */
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

    public function setArrayIncludes($array_includes)
    {
        $this->array_includes = $array_includes;
    }

    public function setArrayRequires($array_requires)
    {
        $this->array_requires = $array_requires;
    }

    public function getArrayIncludes()
    {
        return $this->array_includes;
    }

    public function getArrayRequires()
    {
        return $this->array_requires;
    }

    public function setPrettyPrint($bool)
    {
        $this->pretty_print = $bool;
    }

    public function getPrettyPrint()
    {
        return $this->pretty_print;
    }

    public function setPrintWarning($bool)
    {
        $this->printWarning = $bool;
    }

    public function getPrintWarning()
    {
        return $this->printWarning;
    }

    public function setLimitDefs($limit_defs)
    {
        $this->limit_defs = $limit_defs;
    }

    public function getLimitDefs()
    {
        return $this->limit_defs;
    }

    public function setLimitTime($limit_time)
    {
        $this->limit_time = $limit_time;
    }

    public function getLimitTime()
    {
        return $this->limit_time;
    }

    public function setLimitSize($limit_size)
    {
        $this->limit_size = $limit_size;
    }

    public function getLimitSize()
    {
        return $this->limit_size;
    }

    public function getAnalyzeJs()
    {
        return $this->analyze_js;
    }

    public function getAnalyzeHardrules()
    {
        return $this->analyze_hardrules;
    }

    public function getAnalyzeIncludes()
    {
        return $this->analyze_includes;
    }

    public function setAnalyzeHardRules($analyze_hardrules)
    {
        $this->analyze_hardrules = $analyze_hardrules;
    }

    public function setAnalyzeJs($analyze_js)
    {
        $this->analyze_js = $analyze_js;
    }

    public function setAnalyzeIncludes($analyze_includes)
    {
        $this->analyze_includes = $analyze_includes;
    }

    public function setAnalyzeFunctions($analyze_functions)
    {
        $this->analyze_functions = $analyze_functions;
    }

    public function getAnalyzeFunctions()
    {
        return $this->analyze_functions;
    }

    public function getCurrentMycode()
    {
        return $this->current_mycode;
    }

    public function getCurrentOp()
    {
        return $this->current_op;
    }

    public function getCurrentBlock()
    {
        return $this->current_block;
    }

    public function getCurrentLine()
    {
        return $this->current_line;
    }

    public function getCurrentColumn()
    {
        return $this->current_column;
    }

    public function getCurrentFunc()
    {
        return $this->current_func;
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
        return $this->current_myfile;
    }

    public function setCurrentMyfile($myfile)
    {
        $this->current_myfile = $myfile;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function setCurrentMycode($mycode)
    {
        $this->current_mycode = $mycode;
    }

    public function setCurrentOp($current_op)
    {
        $this->current_op = $current_op;
    }

    public function setCurrentBlock($current_block)
    {
        $this->current_block = $current_block;
    }

    public function setCurrentLine($current_line)
    {
        $this->current_line = $current_line;
    }

    public function setCurrentColumn($current_column)
    {
        $this->current_column = $current_column;
    }

    public function setCurrentFunc($current_func)
    {
        $this->current_func = $current_func;
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
        $this->configuration_file = $file;
    }

    public function getConfiguration()
    {
        return $this->configuration_file;
    }

    public function setPrintFile($bool)
    {
        $this->print_file_under_analysis = $bool;
    }

    public function getPrintFile()
    {
        return $this->print_file_under_analysis;
    }

    public function readConfiguration()
    {
        if (!is_null($this->configuration_file)) {
            try {
                if (file_exists($this->configuration_file)) {
                    $yaml = new Parser();
                    $value = $yaml->parse(file_get_contents($this->configuration_file));

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

                            if (isset($value["inputs"]["setIncludeFiles"])) {
                                $this->inputs->setIncludeFiles($value["inputs"]["setIncludeFiles"]);
                            }

                            if (isset($value["inputs"]["setExcludeFiles"])) {
                                $this->inputs->setExcludeFiles($value["inputs"]["setExcludeFiles"]);
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
                        }

                        if (isset($value["options"])) {
                            if (isset($value["options"]["setAnalyzeJs"])) {
                                $this->setAnalyzeJs($value["options"]["setAnalyzeJs"]);
                            }

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
