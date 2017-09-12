<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

use progpilot\Lang;
use progpilot\Utils;

class MyInputs
{

    private $resolved_includes;

    private $sanitizers;
    private $sinks;
    private $sources;
    private $validators;
    private $false_positives;
    private $excludes_files_analysis;
    private $includes_files_analysis;
    private $excludes_folders_analysis;
    private $includes_folders_analysis;

    private $resolved_includes_file;
    private $false_positives_file;
    private $sources_file;
    private $sinks_file;
    private $sanitizers_file;
    private $validators_file;
    private $excludes_file;
    private $includes_file;

    private $file;
    private $code;
    private $folder;

    public function __construct()
    {

        $this->resolved_includes = [];
        $this->sanitizers = [];
        $this->sinks = [];
        $this->sources = [];
        $this->validators = [];
        $this->false_positives = [];
        $this->excludes_files_analysis = [];
        $this->includes_files_analysis = [];
        $this->excludes_folders_analysis = [];
        $this->includes_folders_analysis = [];

        $this->false_positives_file = null;
        $this->resolved_includes_file = null;
        $this->sanitizers_file = null;
        $this->sinks_file = null;
        $this->sources_file = null;
        $this->validators_file = null;
        $this->excludes_file = null;
        $this->includes_file = null;

        $this->file = null;
        $this->code = null;
        $this->folder = null;
    }

    public function get_included_files()
    {
        return $this->includes_files_analysis;
    }

    public function get_included_folders()
    {
        return $this->includes_folders_analysis;
    }

    public function get_folder()
    {
        return $this->folder;
    }

    public function get_file()
    {
        return $this->file;
    }

    public function get_code()
    {
        return $this->code;
    }

    public function set_folder($folder)
    {
        $this->folder = $folder;
    }

    public function set_file($file)
    {
        $this->file = $file;
    }

    public function set_code($code)
    {
        $this->code = $code;
    }

    public function is_excluded_folder($name)
    {
        $name = realpath($name);
        foreach ($this->excludes_folders_analysis as $exclude_name) {
            if (strpos($name, realpath($exclude_name)) === 0)
                return true;
        }

        return false;
    }

    public function is_included_folder($name)
    {
        $name = realpath($name);
        foreach ($this->includes_folders_analysis as $include_name) {
            if (strpos($name, realpath($include_name)) === 0)
                return true;
        }

        return false;
    }

    public function is_excluded_file($name)
    {
        $name = realpath($name);
        foreach ($this->excludes_files_analysis as $exclude_name) {
            if (realpath($exclude_name) == $name)
                return true;
        }

        return false;
    }

    public function is_included_file($name)
    {
        $name = realpath($name);
        foreach ($this->includes_files_analysis as $include_name) {
            if (realpath($include_name) == $name)
                return true;
        }

        return false;
    }

    public function get_include_bylocation($line, $column, $source_file)
    {
        foreach ($this->resolved_includes as $myinclude) {
            if ($myinclude->get_line() == $line
                    && $myinclude->get_column() == $column
                    && $myinclude->get_source_file() == $source_file)
                return $myinclude;
        }

        return null;
    }

    public function get_validator_byname($stack_class, $myfunc, $myclass)
    {
        foreach ($this->validators as $myvalidator) {
            if ($myvalidator->get_name() === $myfunc->get_name()) {
                if (!$myvalidator->is_instance() && !$myfunc->get_is_method())
                    return $myvalidator;

                if ($myvalidator->is_instance() && $myfunc->get_is_method()) {
                    if (!is_null($myclass) && $myvalidator->get_instanceof_name() === $myclass->get_name())
                        return $myvalidator;

                    $properties_validator = explode("->", $myvalidator->get_instanceof_name());

                    if (is_array($properties_validator)) {
                        $myvalidator_instance_name = $properties_validator[0];

                        $myvalidator_number_ofproperties = count($properties_validator);
                        $stack_number_ofproperties = count($stack_class);

                        if ($stack_number_ofproperties >= $myvalidator_number_ofproperties) {
                            $known_properties = $stack_class[$stack_number_ofproperties - $myvalidator_number_ofproperties];

                            foreach ($known_properties as $prop_class) {
                                if ($prop_class->get_name() == $myvalidator_instance_name)
                                    return $myvalidator;
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function get_sanitizer_byname($stack_class, $myfunc, $myclass)
    {
        foreach ($this->sanitizers as $mysanitizer) {
            if ($mysanitizer->get_name() === $myfunc->get_name()) {
                if (!$mysanitizer->is_instance() && !$myfunc->get_is_method())
                    return $mysanitizer;

                if ($mysanitizer->is_instance() && $myfunc->get_is_method()) {
                    if (!is_null($myclass) && $mysanitizer->get_instanceof_name() === $myclass->get_name())
                        return $mysanitizer;

                    $properties_sanitizer = explode("->", $mysanitizer->get_instanceof_name());

                    if (is_array($properties_sanitizer)) {
                        $mysanitizer_instance_name = $properties_sanitizer[0];

                        $mysanitizer_number_ofproperties = count($properties_sanitizer);
                        $stack_number_ofproperties = count($stack_class);

                        if ($stack_number_ofproperties >= $mysanitizer_number_ofproperties) {
                            $known_properties = $stack_class[$stack_number_ofproperties - $mysanitizer_number_ofproperties];

                            foreach ($known_properties as $prop_class) {
                                if ($prop_class->get_name() == $mysanitizer_instance_name)
                                    return $mysanitizer;
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function get_sink_byname($stack_class, $myfunc, $myclass)
    {
        foreach ($this->sinks as $mysink) {
            if ($mysink->get_name() === $myfunc->get_name()) {
                if (!$mysink->is_instance() && !$myfunc->get_is_method())
                    return $mysink;

                if ($mysink->is_instance() && $myfunc->get_is_method()) {
                    if (!is_null($myclass) && $mysink->get_instanceof_name() === $myclass->get_name())
                        return $mysink;

                    $properties_sink = explode("->", $mysink->get_instanceof_name());

                    if (is_array($properties_sink)) {
                        $mysink_instance_name = $properties_sink[0];

                        $mysink_number_ofproperties = count($properties_sink);
                        $stack_number_ofproperties = count($stack_class);

                        if ($stack_number_ofproperties >= $mysink_number_ofproperties) {
                            $known_properties = $stack_class[$stack_number_ofproperties - $mysink_number_ofproperties];

                            foreach ($known_properties as $prop_class) {
                                if ($prop_class->get_name() == $mysink_instance_name)
                                    return $mysink;
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function get_source_byname($stack_class, $myfunc_or_def, $is_function = false, $instance_name = false, $arr_value = false)
    {
        foreach ($this->sources as $mysource) {
            if ($mysource->get_name() === $myfunc_or_def->get_name()) {
                $check_function = false;
                $check_array = false;
                $check_instance = false;

                if (!$instance_name)
                    $check_instance = true;


                if ($instance_name && $mysource->is_instance()) {
                    if ($mysource->get_instanceof_name() === $instance_name)
                        $check_instance = true;

                    $properties_source = explode("->", $mysource->get_instanceof_name());

                    if (is_array($properties_source)) {
                        $mysource_instance_name = $properties_source[0];

                        $mysource_number_ofproperties = count($properties_source);
                        $stack_number_ofproperties = count($stack_class);

                        if ($stack_number_ofproperties >= $mysource_number_ofproperties) {
                            $known_properties = $stack_class[$stack_number_ofproperties - $mysource_number_ofproperties];

                            foreach ($known_properties as $prop_class) {
                                if ($prop_class->get_name() == $mysource_instance_name)
                                    $check_instance = true;
                            }
                        }
                    }
                }

                if ($mysource->is_function() == $is_function)
                    $check_function = true;

                if (($arr_value != false
                        && $mysource->get_is_array()
                        && is_null($mysource->get_array_value()))
                        || (!$arr_value && !$mysource->get_is_array()))
                    $check_array = true;

                if (($arr_value != false
                        && $mysource->get_is_array()
                        && !is_null($mysource->get_array_value())
                        && $mysource->get_array_value() == $arr_value))
                    $check_array = true;

                if ($check_array && $check_instance && $check_function)
                    return $mysource;
            }
        }

        return null;
    }

    public function get_false_positive_byid($id)
    {
        foreach ($this->false_positives as $false_positive) {
            if ($false_positive->get_id() == $id)
                return $false_positive;
        }

        return null;
    }

    public function get_sanitizers()
    {
        return $this->sanitizers;
    }

    public function get_sinks()
    {
        return $this->sinks;
    }

    public function get_sources()
    {
        return $this->sources;
    }

    public function get_validators()
    {
        return $this->validators;
    }

    public function get_resolved_includes()
    {
        return $this->resolved_includes;
    }

    public function get_false_positives()
    {
        return $this->false_positives_file;
    }

    public function get_exclude_files()
    {
        return $this->excludes_files;
    }

    public function get_include_files()
    {
        return $this->includes_files;
    }

    public function set_include_files($file)
    {
        $this->includes_file = $file;
    }

    public function set_exclude_files($file)
    {
        $this->excludes_file = $file;
    }

    public function set_false_positives($file)
    {
        $this->false_positives_file = $file;
    }

    public function set_resolved_includes($file)
    {
        $this->resolved_includes_file = $file;
    }

    public function set_sources($file)
    {
        $this->sources_file = $file;
    }

    public function set_sinks($file)
    {
        $this->sinks_file = $file;
    }

    public function set_sanitizers($file)
    {
        $this->sanitizers_file = $file;
    }

    public function set_validators($file)
    {
        $this->validators_file = $file;
    }

    public function read_sanitizers()
    {
        if (!is_null($this->sanitizers_file)) {
            if (!file_exists($this->sanitizers_file))
                Utils::print_error(Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($this->sanitizers_file).")");

            $output_json = file_get_contents($this->sanitizers_file);

            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'sanitizers'})) {
                $sanitizers = $parsed_json-> {'sanitizers'};
                foreach ($sanitizers as $sanitizer) {
                    if (!isset($sanitizer-> {'name'})
                            || !isset($sanitizer-> {'language'}))
                        Utils::print_error(Lang::FORMAT_SANITIZERS);

                    $name = $sanitizer-> {'name'};
                    $language = $sanitizer-> {'language'};

                    $prevent = [];
                    if (isset($sanitizer-> {'prevent'}))
                        $prevent = $sanitizer-> {'prevent'};

                    $mysanitizer = new MySanitizer($name, $language, $prevent);

                    if (isset($sanitizer-> {'instanceof'})) {
                        $mysanitizer->set_is_instance(true);
                        $mysanitizer->set_instanceof_name($sanitizer-> {'instanceof'});
                    }

                    if (isset($sanitizer-> {'parameters'})) {
                        $parameters = $sanitizer-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && isset($parameter-> {'condition'})) {
                                if (is_int($parameter-> {'id'})
                                        && ($parameter-> {'condition'} == "equals"
                                            || $parameter-> {'condition'} == "taint"
                                            || $parameter-> {'condition'} == "sanitize")) {
                                    if ($parameter-> {'condition'} == "equals") {
                                        if (isset($parameter-> {'values'})) {
                                            $mysanitizer->add_parameter($parameter-> {'id'}, $parameter-> {'condition'}, $parameter-> {'values'});
                                        }
                                    } else
                                        $mysanitizer->add_parameter($parameter-> {'id'}, $parameter-> {'condition'});
                                }
                            }
                        }

                        $mysanitizer->set_has_parameters(true);
                    }

                    $this->sanitizers[] = $mysanitizer;
                }
            } else
                Utils::print_error(Lang::FORMAT_SANITIZERS);
        }
    }

    public function read_sinks()
    {
        if (!is_null($this->sinks_file)) {
            if (!file_exists($this->sinks_file))
                Utils::print_error(Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($this->sinks_file).")");

            $output_json = file_get_contents($this->sinks_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'sinks'})) {
                $sinks = $parsed_json-> {'sinks'};
                foreach ($sinks as $sink) {
                    if (!isset($sink-> {'name'})
                            || !isset($sink-> {'language'})
                            || !isset($sink-> {'attack'})
                            || !isset($sink-> {'cwe'}))
                        Utils::print_error(Lang::FORMAT_SINKS);

                    $name = $sink-> {'name'};
                    $language = $sink-> {'language'};
                    $attack = $sink-> {'attack'};
                    $cwe = $sink-> {'cwe'};

                    $mysink = new MySink($name, $language, $attack, $cwe);

                    if (isset($sink-> {'instanceof'})) {
                        $mysink->set_is_instance(true);
                        $mysink->set_instanceof_name($sink-> {'instanceof'});
                    }

                    if (isset($sink-> {'condition'}))
                        $mysink->add_global_condition($sink-> {'condition'});

                    if (isset($sink-> {'parameters'})) {
                        $parameters = $sink-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && is_int($parameter-> {'id'})) {
                                if (isset($parameter-> {'condition'}))
                                    $mysink->add_parameter($parameter-> {'id'}, $parameter-> {'condition'});
                                else
                                    $mysink->add_parameter($parameter-> {'id'});
                            }
                        }

                        $mysink->set_has_parameters(true);
                    }

                    $this->sinks[] = $mysink;
                }
            } else
                Utils::print_error(Lang::FORMAT_SINKS);
        }
    }

    public function read_sources()
    {
        if (!is_null($this->sources_file)) {
            if (!file_exists($this->sources_file))
                Utils::print_error(Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($this->sources_file).")");

            $output_json = file_get_contents($this->sources_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'sources'})) {
                $sources = $parsed_json-> {'sources'};
                foreach ($sources as $source) {
                    if (!isset($source-> {'name'})
                            || !isset($source-> {'language'}))
                        Utils::print_error(Lang::FORMAT_SOURCES);

                    $name = $source-> {'name'};
                    $language = $source-> {'language'};

                    $mysource = new MySource($name, $language);

                    if (isset($source-> {'is_function'}) && $source-> {'is_function'}) {
                        $mysource->set_is_function(true);
                    }

                    if (isset($source-> {'is_array'}) && $source-> {'is_array'}) {
                        $mysource->set_is_array(true);
                    }

                    if (isset($source-> {'array_index'})) {
                        $arr = array($source-> {'array_index'} => false);
                        $mysource->set_array_value($arr);
                    }

                    if (isset($source-> {'instanceof'})) {
                        $mysource->set_is_instance(true);
                        $mysource->set_instanceof_name($source-> {'instanceof'});
                    }

                    if (isset($source-> {'return_array_index'})) {
                        $mysource->set_return_array(true);
                        $mysource->set_return_array_value($source-> {'return_array_index'});
                    }

                    if (isset($source-> {'parameters'})) {
                        $parameters = $source-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (is_int($parameter-> {'id'})) {
                                $mysource->add_parameter($parameter-> {'id'});

                                if (isset($parameter-> {'is_array'})
                                        && $parameter-> {'is_array'}
                                        && isset($parameter-> {'array_index'})) {
                                    $mysource->add_condition_parameter($parameter-> {'id'}, MySource::CONDITION_ARRAY, $parameter-> {'array_index'});
                                }
                            }
                        }

                        $mysource->set_has_parameters(true);
                    }

                    $this->sources[] = $mysource;
                }
            } else
                Utils::print_error(Lang::FORMAT_SOURCES);
        }
    }

    public function read_validators()
    {
        if (!is_null($this->validators_file)) {
            if (!file_exists($this->validators_file))
                Utils::print_error(Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($this->validators_file).")");

            $output_json = file_get_contents($this->validators_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'validators'})) {
                $validators = $parsed_json-> {'validators'};
                foreach ($validators as $validator) {
                    if (!isset($validator-> {'name'})
                            || !isset($validator-> {'language'}))
                        Utils::print_error(Lang::FORMAT_VALIDATORS);

                    $name = $validator-> {'name'};
                    $language = $validator-> {'language'};

                    $myvalidator = new MyValidator($name, $language);

                    if (isset($validator-> {'parameters'})) {
                        $parameters = $validator-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && isset($parameter-> {'condition'})) {
                                if (is_int($parameter-> {'id'})
                                        && ($parameter-> {'condition'} == "not_tainted"
                                            || $parameter-> {'condition'} == "array_not_tainted"
                                            || $parameter-> {'condition'} == "valid"
                                            || $parameter-> {'condition'} == "equals")) {
                                    if ($parameter-> {'condition'} == "equals") {
                                        if (isset($parameter-> {'values'})) {
                                            $myvalidator->add_parameter($parameter-> {'id'}, $parameter-> {'condition'}, $parameter-> {'values'});
                                        }
                                    } else
                                        $myvalidator->add_parameter($parameter-> {'id'}, $parameter-> {'condition'});
                                }
                            }
                        }

                        $myvalidator->set_has_parameters(true);
                    }

                    if (isset($validator-> {'instanceof'})) {
                        $myvalidator->set_is_instance(true);
                        $myvalidator->set_instanceof_name($validator-> {'instanceof'});
                    }

                    $this->validators[] = $myvalidator;
                }
            } else
                Utils::print_error(Lang::FORMAT_VALIDATORS);
        }
    }

    public function read_resolved_includes()
    {
        if (!is_null($this->resolved_includes_file)) {
            if (!file_exists($this->resolved_includes_file))
                Utils::print_error(Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($this->resolved_includes_file).")");

            $output_json = file_get_contents($this->resolved_includes_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'includes'})) {
                $includes = $parsed_json-> {'includes'};
                foreach ($includes as $include) {
                    if (!isset($include-> {'line'})
                            || !isset($include-> {'column'})
                            || !isset($include-> {'source_file'})
                            || !isset($include-> {'value'}))
                        Utils::print_error(Lang::FORMAT_INCLUDES);

                    if (realpath($include-> {'source_file'})) {
                        $line = $include-> {'line'};
                        $column = $include-> {'column'};
                        $source_file = realpath($include-> {'source_file'});
                        $value = $include-> {'value'};

                        $myinclude = new MyInclude($line, $column, $source_file, $value);
                        $this->resolved_includes[] = $myinclude;
                    }
                }
            } else
                Utils::print_error(Lang::FORMAT_INCLUDES);
        }
    }

    public function read_false_positives()
    {
        if (!is_null($this->false_positives_file)) {
            if (!file_exists($this->false_positives_file))
                Utils::print_error(Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($this->false_positives_file).")");

            $output_json = file_get_contents($this->false_positives_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'false_positives'})) {
                $false_positives = $parsed_json-> {'false_positives'};
                foreach ($false_positives as $false_positive) {
                    if (!isset($false_positive-> {'vuln_id'}))
                        Utils::print_error(Lang::FORMAT_FALSE_POSITIVES);

                    $vuln_id = $false_positive-> {'vuln_id'};

                    $myvuln = new MyVuln($vuln_id);
                    $this->false_positives[] = $myvuln;
                }
            } else
                Utils::print_error(Lang::FORMAT_FALSE_POSITIVES);
        }
    }

    public function read_excludes_file()
    {
        if (!is_null($this->excludes_file)) {
            if (!file_exists($this->excludes_file))
                Utils::print_error(Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($this->excludes_file).")");

            $output_json = file_get_contents($this->excludes_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'exclude_files'})) {
                $exclude_files = $parsed_json-> {'exclude_files'};
                foreach ($exclude_files as $exclude_file) {
                    if (realpath($exclude_file))
                        $this->excludes_files_analysis[] = realpath($exclude_file);
                }
            }

            if (isset($parsed_json-> {'exclude_folders'})) {
                $exclude_folders = $parsed_json-> {'exclude_folders'};
                foreach ($exclude_folders as $exclude_folder) {
                    if (realpath($exclude_folder))
                        $this->excludes_folders_analysis[] = realpath($exclude_folder);
                }
            }
        }
    }

    public function read_includes_file()
    {
        if (!is_null($this->includes_file)) {
            if (!file_exists($this->includes_file))
                Utils::print_error(Lang::FILE_DOESNT_EXIST." (".Utils::encode_characters($this->includes_file).")");

            $output_json = file_get_contents($this->includes_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'include_files'})) {
                $include_files = $parsed_json-> {'include_files'};
                foreach ($include_files as $include_file) {
                    if (realpath($include_file))
                        $this->includes_files_analysis[] = realpath($include_file);
                }
            }

            if (isset($parsed_json-> {'include_folders'})) {
                $include_folders = $parsed_json-> {'include_folders'};
                foreach ($include_folders as $include_folder) {
                    if (realpath($include_folder))
                        $this->includes_folders_analysis[] = realpath($include_folder);
                }
            }
        }
    }
}

?>
