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
    private $myfile;
    private $classes;
    private $objects;
    private $functions;
    private $path;
    private $analyze_functions;
    private $analyze_includes;
    private $analyze_js;
    private $print_file_under_analysis;
    private $configuration_file;
    private $print_warning;
    private $limit_time;
    private $limit_defs;

    public $inputs;
    public $outputs;

    public function __construct()
    {
        $this->configuration_file = null;
        $this->analyze_functions = true;
        $this->analyze_includes = true;
        $this->analyze_js = true;
        $this->print_file_under_analysis = false;
        $this->print_warning = false;
        $this->limit_time = 10;
        $this->limit_defs = 10000;

        $this->inputs = new \progpilot\Inputs\MyInputs;
        $this->outputs = new \progpilot\Outputs\MyOutputs;

        $this->reset_internal_values();

        $this->myfile = null;
        $this->array_includes = [];
        $this->array_requires = [];
    }

    public function reset_internal_lowvalues()
    {
        $this->current_op = null;
        $this->current_block = null;
        $this->current_line = -1;
        $this->current_column = -1;
        $this->current_func = null;
        $this->current_mycode = null;
        $this->path = null;
    }

    public function reset_internal_values()
    {
        $this->reset_internal_lowvalues();

        unset($this->objects);
        unset($this->classes);
        unset($this->functions);
        unset($this->mycode);

        $this->inputs->set_code(null);

        $this->objects = new \progpilot\Dataflow\Objects;
        $this->classes = new \progpilot\Dataflow\Classes;
        $this->functions = new \progpilot\Dataflow\Functions;
    }

    public function get_array_includes()
    {
        return $this->array_includes;
    }

    public function get_array_requires()
    {
        return $this->array_requires;
    }

    public function set_print_warning($bool)
    {
        $this->print_warning = $bool;
    }

    public function get_print_warning()
    {
        return $this->print_warning;
    }

    public function set_limit_defs($limit_defs)
    {
        $this->limit_defs = $limit_defs;
    }

    public function get_limit_defs()
    {
        return $this->limit_defs;
    }

    public function set_limit_time($limit_time)
    {
        $this->limit_time = $limit_time;
    }

    public function get_limit_time()
    {
        return $this->limit_time;
    }

    public function get_analyze_js()
    {
        return $this->analyze_js;
    }

    public function get_analyze_includes()
    {
        return $this->analyze_includes;
    }

    public function set_analyze_js($analyze_js)
    {
        $this->analyze_js = $analyze_js;
    }

    public function set_analyze_includes($analyze_includes)
    {
        $this->analyze_includes = $analyze_includes;
    }

    public function set_analyze_functions($analyze_functions)
    {
        $this->analyze_functions = $analyze_functions;
    }

    public function get_analyze_functions()
    {
        return $this->analyze_functions;
    }

    public function get_current_mycode()
    {
        return $this->current_mycode;
    }

    public function get_current_op()
    {
        return $this->current_op;
    }

    public function get_current_block()
    {
        return $this->current_block;
    }

    public function get_current_line()
    {
        return $this->current_line;
    }

    public function get_current_column()
    {
        return $this->current_column;
    }

    public function get_current_func()
    {
        return $this->current_func;
    }

    public function get_objects()
    {
        return $this->objects;
    }

    public function get_classes()
    {
        return $this->classes;
    }

    public function get_functions()
    {
        return $this->functions;
    }

    public function get_inputs()
    {
        return $this->inputs;
    }

    public function get_outputs()
    {
        return $this->outputs;
    }

    public function get_path()
    {
        return $this->path;
    }

    public function get_myfile()
    {
        return $this->myfile;
    }

    public function set_myfile($myfile)
    {
        $this->myfile = $myfile;
    }

    public function set_path($path)
    {
        $this->path = $path;
    }

    public function set_current_mycode($mycode)
    {
        $this->current_mycode = $mycode;
    }

    public function set_current_op($current_op)
    {
        $this->current_op = $current_op;
    }

    public function set_current_block($current_block)
    {
        $this->current_block = $current_block;
    }

    public function set_current_line($current_line)
    {
        $this->current_line = $current_line;
    }

    public function set_current_column($current_column)
    {
        $this->current_column = $current_column;
    }

    public function set_current_func($current_func)
    {
        $this->current_func = $current_func;
    }

    public function set_objects($objects)
    {
        $this->objects = $objects;
    }

    public function set_classes($classes)
    {
        $this->classes = $classes;
    }

    public function set_functions($functions)
    {
        $this->functions = $functions;
    }

    public function set_inputs($inputs)
    {
        $this->inputs = $inputs;
    }

    public function set_outputs($outputs)
    {
        $this->outputs = $outputs;
    }


    public function set_configuration($file)
    {
        $this->configuration_file = $file;
    }

    public function get_configuration()
    {
        return $this->configuration_file;
    }


    public function set_print_file($bool)
    {
        $this->print_file_under_analysis = $bool;
    }

    public function get_print_file()
    {
        return $this->print_file_under_analysis;
    }

    public function read_configuration()
    {
        if (!is_null($this->configuration_file))
        {
            try
            {
                if (file_exists($this->configuration_file))
                {
                    $yaml = new Parser();
                    $value = $yaml->parse(file_get_contents($this->configuration_file));

                    if (is_array($value))
                    {
                        if (isset($value["inputs"]))
                        {
                            if (isset($value["inputs"]["set_sources"]))
                                $this->inputs->set_sources($value["inputs"]["set_sources"]);

                            if (isset($value["inputs"]["set_sinks"]))
                                $this->inputs->set_sinks($value["inputs"]["set_sinks"]);

                            if (isset($value["inputs"]["set_validators"]))
                                $this->inputs->set_validators($value["inputs"]["set_validators"]);

                            if (isset($value["inputs"]["set_sanitizers"]))
                                $this->inputs->set_sanitizers($value["inputs"]["set_sanitizers"]);

                            if (isset($value["inputs"]["set_include_files"]))
                                $this->inputs->set_include_files($value["inputs"]["set_include_files"]);

                            if (isset($value["inputs"]["set_exclude_files"]))
                                $this->inputs->set_exclude_files($value["inputs"]["set_exclude_files"]);

                            if (isset($value["inputs"]["set_folder"]))
                                $this->inputs->set_folder($value["inputs"]["set_folder"]);

                            if (isset($value["inputs"]["set_file"]))
                                $this->inputs->set_file($value["inputs"]["set_file"]);

                            if (isset($value["inputs"]["set_code"]))
                                $this->inputs->set_code($value["inputs"]["set_code"]);

                            if (isset($value["inputs"]["set_resolved_includes"]))
                                $this->inputs->set_resolved_includes($value["inputs"]["set_resolved_includes"]);

                            if (isset($value["inputs"]["set_false_positives"]))
                                $this->inputs->set_false_positives($value["inputs"]["set_false_positives"]);
                        }

                        if (isset($value["outputs"]))
                        {
                            if (isset($value["outputs"]["tainted_flow"]))
                                $this->outputs->tainted_flow($value["outputs"]["tainted_flow"]);

                            if (isset($value["outputs"]["resolve_includes"]))
                                $this->outputs->resolve_includes($value["outputs"]["resolve_includes"]);

                            if (isset($value["outputs"]["resolve_includes_file"]))
                                $this->outputs->resolve_includes_file($value["outputs"]["resolve_includes_file"]);
                        }

                        if (isset($value["options"]))
                        {
                            if (isset($value["options"]["set_analyze_js"]))
                                $this->set_analyze_js($value["options"]["set_analyze_js"]);

                            if (isset($value["options"]["set_analyze_includes"]))
                                $this->set_analyze_includes($value["options"]["set_analyze_includes"]);

                            if (isset($value["options"]["set_analyze_functions"]))
                                $this->set_analyze_functions($value["options"]["set_analyze_functions"]);

                            if (isset($value["options"]["set_print_file"]))
                                $this->set_print_file($value["options"]["set_print_file"]);

                            if (isset($value["options"]["set_limit_time"]))
                                $this->set_limit_time($value["options"]["set_limit_time"]);

                            if (isset($value["options"]["set_limit_defs"]))
                                $this->set_limit_defs($value["options"]["set_limit_defs"]);

                            if (isset($value["options"]["set_print_warning"]))
                                $this->set_print_warning($value["options"]["set_print_warning"]);
                        }
                    }
                }
            }
            catch (ParseException $e)
            {
                Utils::print_error($context, Lang::UNABLE_TO_PARSER_YAML);
            }
        }
    }
}

?>
