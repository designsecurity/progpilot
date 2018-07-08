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
use progpilot\Objects\MyFunction;

class MyInputs
{
    private $custom_rules;
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

    private $custom_file;
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
        $this->custom_rules = [];
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

        $this->custom_file = null;
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

    public function getSinksFile()
    {
        return $this->sinks_file;
    }

    public function getSourcesFile()
    {
        return $this->sources_file;
    }

    public function getValidatorsFile()
    {
        return $this->validators_file;
    }

    public function getSanitizersFile()
    {
        return $this->sanitizers_file;
    }

    public function getIncludedFiles()
    {
        return $this->includes_files_analysis;
    }

    public function getIncludedFolders()
    {
        return $this->includes_folders_analysis;
    }

    public function getFolder()
    {
        return $this->folder;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function isExcludedFolder($name)
    {
        $name = realpath($name);
        foreach ($this->excludes_folders_analysis as $exclude_name) {
            if (strpos($name, realpath($exclude_name)) === 0) {
                return true;
            }
        }

        return false;
    }

    public function isIncludedFolder($name)
    {
        $name = realpath($name);
        foreach ($this->includes_folders_analysis as $include_name) {
            if (strpos($name, realpath($include_name)) === 0) {
                return true;
            }
        }

        return false;
    }

    public function isExcludedFile($name)
    {
        $name = realpath($name);
        foreach ($this->excludes_files_analysis as $exclude_name) {
            if (realpath($exclude_name) === $name) {
                return true;
            }
        }

        return false;
    }

    public function isIncludedFile($name)
    {
        $name = realpath($name);
        foreach ($this->includes_files_analysis as $include_name) {
            if (realpath($include_name) === $name) {
                return true;
            }
        }

        return false;
    }

    public function getIncludeByLocation($line, $column, $source_file)
    {
        foreach ($this->resolved_includes as $myinclude) {
            if ($myinclude->getLine() === $line
                                                && $myinclude->getColumn() === $column
                                                        && $myinclude->getSourceFile() === $source_file) {
                return $myinclude;
            }
        }

        return null;
    }

    public function getValidatorByName($stack_class, $myfunc, $myclass)
    {
        foreach ($this->validators as $myvalidator) {
            if ($myvalidator->getName() === $myfunc->getName()) {
                if (!$myvalidator->isInstance() && !$myfunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    return $myvalidator;
                }

                if ($myvalidator->isInstance() && $myfunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    if (!is_null($myclass) && $myvalidator->getInstanceOfName() === $myclass->getName()) {
                        return $myvalidator;
                    }

                    $properties_validator = explode("->", $myvalidator->getInstanceOfName());

                    if (is_array($properties_validator)) {
                        $myvalidator_instance_name = $properties_validator[0];

                        $myvalidator_number_ofproperties = count($properties_validator);
                        $stack_number_ofproperties = count($stack_class);

                        if ($stack_number_ofproperties >= $myvalidator_number_ofproperties) {
                            $known_properties =
                                $stack_class[$stack_number_ofproperties - $myvalidator_number_ofproperties];

                            foreach ($known_properties as $prop_class) {
                                if ($prop_class->getName() === $myvalidator_instance_name) {
                                    return $myvalidator;
                                }
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function getSanitizerByName($stack_class, $myfunc, $myclass)
    {
        foreach ($this->sanitizers as $mysanitizer) {
            if ($mysanitizer->getName() === $myfunc->getName()) {
                if (!$mysanitizer->isInstance() && !$myfunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    return $mysanitizer;
                }

                if ($mysanitizer->isInstance() && $myfunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    if (!is_null($myclass) && $mysanitizer->getInstanceOfName() === $myclass->getName()) {
                        return $mysanitizer;
                    }

                    $properties_sanitizer = explode("->", $mysanitizer->getInstanceOfName());

                    if (is_array($properties_sanitizer)) {
                        $mysanitizer_instance_name = $properties_sanitizer[0];

                        $mysanitizer_number_ofproperties = count($properties_sanitizer);
                        $stack_number_ofproperties = count($stack_class);

                        if ($stack_number_ofproperties >= $mysanitizer_number_ofproperties) {
                            $known_properties =
                            $stack_class[$stack_number_ofproperties - $mysanitizer_number_ofproperties];

                            foreach ($known_properties as $prop_class) {
                                if ($prop_class->getName() === $mysanitizer_instance_name) {
                                    return $mysanitizer;
                                }
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function getSinkByName($context, $stack_class, $myfunc, $myclass)
    {
        foreach ($this->sinks as $mysink) {
            if ($mysink->getName() === $myfunc->getName()) {
                if (!$mysink->isInstance() && !$myfunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    return $mysink;
                }

                if ($mysink->isInstance() && $myfunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    if (!is_null($myclass) && $mysink->getInstanceOfName() === $myclass->getName()) {
                        return $mysink;
                    }

                    $properties_sink = explode("->", $mysink->getInstanceOfName());

                    if (is_array($properties_sink)) {
                        $mysink_instance_name = $properties_sink[0];

                        $mysink_number_ofproperties = count($properties_sink);
                        $stack_number_ofproperties = count($stack_class);

                        if ($stack_number_ofproperties >= $mysink_number_ofproperties) {
                            $known_properties =
                            $stack_class[$stack_number_ofproperties - $mysink_number_ofproperties];

                            foreach ($known_properties as $prop_class) {
                                $object_id = $prop_class->getObjectId();
                                $myclass = $context->getObjects()->getMyClassFromObject($object_id);
                                
                                if (!is_null($myclass) && $myclass->getName() === $mysink_instance_name) {
                                    return $mysink;
                                }
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function getSourceByName(
        $stack_class,
        $myfunc_or_def,
        $isFunction = false,
        $instance_name = false,
        $arr_value = false
    ) {
        foreach ($this->sources as $mysource) {
            if ($mysource->getName() === $myfunc_or_def->getName()) {
                $check_function = false;
                $check_array = false;
                $check_instance = false;

                if (!$instance_name) {
                    $check_instance = true;
                }


                if ($instance_name && $mysource->isInstance()) {
                    if ($mysource->getInstanceOfName() === $instance_name) {
                        $check_instance = true;
                    }

                    $properties_source = explode("->", $mysource->getInstanceOfName());

                    if (is_array($properties_source)) {
                        $mysource_instance_name = $properties_source[0];

                        $mysource_number_ofproperties = count($properties_source);
                        $stack_number_ofproperties = count($stack_class);

                        if ($stack_number_ofproperties >= $mysource_number_ofproperties) {
                            $known_properties =
                                $stack_class[$stack_number_ofproperties - $mysource_number_ofproperties];

                            foreach ($known_properties as $prop_class) {
                                if ($prop_class->getName() === $mysource_instance_name) {
                                    $check_instance = true;
                                }
                            }
                        }
                    }
                }

                if ($mysource->isFunction() === $isFunction) {
                    $check_function = true;
                }

                // if we request an array the source must be an array
                // and array nots equals (like $_GET["p"])
                if (($arr_value !== false
                                         && $mysource->getIsArray()
                                         && is_null($mysource->getArrayValue()))
                            // or we don't request an array
                            // and the source is not an array (echo $hardcoded_tainted)
                            || (!$arr_value && !$mysource->getIsArray())
                            // or we don't request an array
                            // if mysource is a function and a array like that :
                            // $row = mysqli_fetch_assoc()
                            // echo $row[0]
                            // we don't want an array ie : $row = mysqli_fetch_assoc()[0]
                            || (!$arr_value && $mysource->isFunction() && $mysource->getIsArray())) {
                    $check_array = true;
                }

                // if we request an array the source must be an array and array value equals
                if (($arr_value !== false
                                         && $mysource->getIsArray()
                                         && !is_null($mysource->getArrayValue())
                                         && $mysource->getArrayValue() === $arr_value)) {
                    $check_array = true;
                }

                if ($check_array && $check_instance && $check_function) {
                    return $mysource;
                }
            }
        }

        return null;
    }

    public function getFalsePositiveById($id)
    {
        foreach ($this->false_positives as $false_positive) {
            if ($false_positive->getId() === $id) {
                return $false_positive;
            }
        }

        return null;
    }

    public function getSanitizers()
    {
        return $this->sanitizers;
    }

    public function getSinks()
    {
        return $this->sinks;
    }

    public function getSources()
    {
        return $this->sources;
    }

    public function getValidators()
    {
        return $this->validators;
    }

    public function getResolvedIncludes()
    {
        return $this->resolved_includes;
    }

    public function getFalsePositives()
    {
        return $this->false_positives_file;
    }

    public function getExcludeFiles()
    {
        return $this->excludes_files;
    }

    public function getIncludeFiles()
    {
        return $this->includes_files;
    }

    public function getCustomRules()
    {
        return $this->custom_rules;
    }

    public function setCustomRules($file)
    {
        $this->custom_file = $file;
    }

    public function setIncludeFiles($file)
    {
        $this->includes_file = $file;
    }

    public function setExcludeFiles($file)
    {
        $this->excludes_file = $file;
    }

    public function setFalsePositives($file)
    {
        $this->false_positives_file = $file;
    }

    public function setResolvedIncludes($file)
    {
        $this->resolved_includes_file = $file;
    }

    public function setSources($file)
    {
        $this->sources_file = $file;
    }

    public function setSinks($file)
    {
        $this->sinks_file = $file;
    }

    public function setSanitizers($file)
    {
        $this->sanitizers_file = $file;
    }

    public function setValidators($file)
    {
        $this->validators_file = $file;
    }

    public function readSanitizers()
    {
        if (is_null($this->sanitizers_file)) {
            $this->sanitizers_file = __DIR__."/../../uptodate_data/sanitizers.json";
        }

        if (!is_null($this->sanitizers_file)) {
            if (!file_exists($this->sanitizers_file)) {
                Utils::printError(Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->sanitizers_file).")");
            }

            $output_json = file_get_contents($this->sanitizers_file);

            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'sanitizers'})) {
                $sanitizers = $parsed_json-> {'sanitizers'};
                foreach ($sanitizers as $sanitizer) {
                    if (!isset($sanitizer-> {'name'})
                                || !isset($sanitizer-> {'language'})) {
                        Utils::printError(Lang::FORMAT_SANITIZERS);
                    }

                    $name = $sanitizer-> {'name'};
                    $language = $sanitizer-> {'language'};

                    $prevent = [];
                    if (isset($sanitizer-> {'prevent'})) {
                        $prevent = $sanitizer-> {'prevent'};
                    }

                    $mysanitizer = new MySanitizer($name, $language, $prevent);

                    if (isset($sanitizer-> {'instanceof'})) {
                        $mysanitizer->setIsInstance(true);
                        $mysanitizer->setInstanceOfName($sanitizer-> {'instanceof'});
                    }

                    if (isset($sanitizer-> {'parameters'})) {
                        $parameters = $sanitizer-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && isset($parameter-> {'condition'})) {
                                if (is_int($parameter-> {'id'})
                                            && ($parameter-> {'condition'} === "equals"
                                                    || $parameter-> {'condition'} === "taint"
                                                            || $parameter-> {'condition'} === "sanitize")) {
                                    if ($parameter-> {'condition'} === "equals") {
                                        if (isset($parameter-> {'values'})) {
                                            $mysanitizer->addParameter(
                                                $parameter-> {'id'},
                                                $parameter-> {'condition'},
                                                $parameter-> {'values'}
                                            );
                                        }
                                    } else {
                                        $mysanitizer->addParameter(
                                            $parameter-> {'id'},
                                            $parameter-> {'condition'}
                                        );
                                    }
                                }
                            }
                        }

                        $mysanitizer->setHasParameters(true);
                    }

                    $this->sanitizers[] = $mysanitizer;
                }
            } else {
                Utils::printError(Lang::FORMAT_SANITIZERS);
            }
        }
    }

    public function readSinks()
    {
        if (is_null($this->sinks_file)) {
            $this->sinks_file = __DIR__."/../../uptodate_data/sinks.json";
        }

        if (!is_null($this->sinks_file)) {
            if (!file_exists($this->sinks_file)) {
                Utils::printError(Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->sinks_file).")");
            }

            $output_json = file_get_contents($this->sinks_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'sinks'})) {
                $sinks = $parsed_json-> {'sinks'};
                foreach ($sinks as $sink) {
                    if (!isset($sink-> {'name'})
                                || !isset($sink-> {'language'})
                                || !isset($sink-> {'attack'})
                                || !isset($sink-> {'cwe'})) {
                        Utils::printError(Lang::FORMAT_SINKS);
                    }

                    $name = $sink-> {'name'};
                    $language = $sink-> {'language'};
                    $attack = $sink-> {'attack'};
                    $cwe = $sink-> {'cwe'};

                    $mysink = new MySink($name, $language, $attack, $cwe);

                    if (isset($sink-> {'instanceof'})) {
                        $mysink->setIsInstance(true);
                        $mysink->setInstanceOfName($sink-> {'instanceof'});
                    }

                    if (isset($sink-> {'condition'})) {
                        $mysink->addGlobalCondition($sink-> {'condition'});
                    }

                    if (isset($sink-> {'parameters'})) {
                        $parameters = $sink-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && is_int($parameter-> {'id'})) {
                                if (isset($parameter-> {'condition'})) {
                                    $mysink->addParameter($parameter-> {'id'}, $parameter-> {'condition'});
                                } else {
                                    $mysink->addParameter($parameter-> {'id'});
                                }
                            }
                        }

                        $mysink->setHasParameters(true);
                    }

                    $this->sinks[] = $mysink;
                }
            } else {
                Utils::printError(Lang::FORMAT_SINKS);
            }
        }
    }

    public function readSources()
    {
        if (is_null($this->sources_file)) {
            $this->sources_file = __DIR__."/../../uptodate_data/sources.json";
        }

        if (!is_null($this->sources_file)) {
            if (!file_exists($this->sources_file)) {
                Utils::printError(Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->sources_file).")");
            }

            $output_json = file_get_contents($this->sources_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'sources'})) {
                $sources = $parsed_json-> {'sources'};
                foreach ($sources as $source) {
                    if (!isset($source-> {'name'})
                                || !isset($source-> {'language'})) {
                        Utils::printError(Lang::FORMAT_SOURCES);
                    }

                    $name = $source-> {'name'};
                    $language = $source-> {'language'};

                    $mysource = new MySource($name, $language);

                    if (isset($source-> {'is_function'}) && $source-> {'is_function'}) {
                        $mysource->setIsFunction(true);
                    }

                    if (isset($source-> {'is_array'}) && $source-> {'is_array'}) {
                        $mysource->setIsArray(true);
                    }

                    if (isset($source-> {'array_index'})) {
                        $arr = array($source-> {'array_index'} => false);
                        $mysource->setArrayValue($arr);
                    }

                    if (isset($source-> {'instanceof'})) {
                        $mysource->setIsInstance(true);
                        $mysource->setInstanceOfName($source-> {'instanceof'});
                    }

                    if (isset($source-> {'return_array_index'})) {
                        $mysource->setReturnArray(true);
                        $mysource->setReturnArrayValue($source-> {'return_array_index'});
                    }

                    if (isset($source-> {'parameters'})) {
                        $parameters = $source-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (is_int($parameter-> {'id'})) {
                                $mysource->addParameter($parameter-> {'id'});

                                if (isset($parameter-> {'is_array'})
                                            && $parameter-> {'is_array'}
                                            && isset($parameter-> {'array_index'})) {
                                    $mysource->addConditionParameter(
                                        $parameter-> {'id'},
                                        MySource::CONDITION_ARRAY,
                                        $parameter-> {'array_index'}
                                    );
                                }
                            }
                        }

                        $mysource->setHasParameters(true);
                    }

                    $this->sources[] = $mysource;
                }
            } else {
                Utils::printError(Lang::FORMAT_SOURCES);
            }
        }
    }

    public function readValidators()
    {
        if (is_null($this->validators_file)) {
            $this->validators_file = __DIR__."/../../uptodate_data/validators.json";
        }

        if (!is_null($this->validators_file)) {
            if (!file_exists($this->validators_file)) {
                Utils::printError(Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->validators_file).")");
            }

            $output_json = file_get_contents($this->validators_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'validators'})) {
                $validators = $parsed_json-> {'validators'};
                foreach ($validators as $validator) {
                    if (!isset($validator-> {'name'})
                                || !isset($validator-> {'language'})) {
                        Utils::printError(Lang::FORMAT_VALIDATORS);
                    }

                    $name = $validator-> {'name'};
                    $language = $validator-> {'language'};

                    $myvalidator = new MyValidator($name, $language);

                    if (isset($validator-> {'parameters'})) {
                        $parameters = $validator-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && isset($parameter-> {'condition'})) {
                                if (is_int($parameter-> {'id'})
                                            && ($parameter-> {'condition'} === "not_tainted"
                                                    || $parameter-> {'condition'} === "array_not_tainted"
                                                            || $parameter-> {'condition'} === "valid"
                                                                    || $parameter-> {'condition'} === "equals")) {
                                    if ($parameter-> {'condition'} === "equals") {
                                        if (isset($parameter-> {'values'})) {
                                            $myvalidator->addParameter(
                                                $parameter-> {'id'},
                                                $parameter-> {'condition'},
                                                $parameter-> {'values'}
                                            );
                                        }
                                    } else {
                                        $myvalidator->addParameter(
                                            $parameter-> {'id'},
                                            $parameter-> {'condition'}
                                        );
                                    }
                                }
                            }
                        }

                        $myvalidator->setHasParameters(true);
                    }

                    if (isset($validator-> {'instanceof'})) {
                        $myvalidator->setIsInstance(true);
                        $myvalidator->setInstanceOfName($validator-> {'instanceof'});
                    }

                    $this->validators[] = $myvalidator;
                }
            } else {
                Utils::printError(Lang::FORMAT_VALIDATORS);
            }
        }
    }

    public function readResolvedIncludes()
    {
        if (!is_null($this->resolved_includes_file)) {
            if (!file_exists($this->resolved_includes_file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->resolved_includes_file).")"
                );
            }

            $output_json = file_get_contents($this->resolved_includes_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'includes'})) {
                $includes = $parsed_json-> {'includes'};
                foreach ($includes as $include) {
                    if (!isset($include-> {'line'})
                                || !isset($include-> {'column'})
                                || !isset($include-> {'source_file'})
                                || !isset($include-> {'value'})) {
                        Utils::printError(Lang::FORMAT_INCLUDES);
                    }

                    if (realpath($include-> {'source_file'})) {
                        $line = $include-> {'line'};
                        $column = $include-> {'column'};
                        $source_file = realpath($include-> {'source_file'});
                        $value = $include-> {'value'};

                        $myinclude = new MyInclude($line, $column, $source_file, $value);
                        $this->resolved_includes[] = $myinclude;
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_INCLUDES);
            }
        }
    }

    public function readFalsePositives()
    {
        if (!is_null($this->false_positives_file)) {
            if (!file_exists($this->false_positives_file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->false_positives_file).")"
                );
            }

            $output_json = file_get_contents($this->false_positives_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'false_positives'})) {
                $false_positives = $parsed_json-> {'false_positives'};
                foreach ($false_positives as $false_positive) {
                    if (!isset($false_positive-> {'vuln_id'})) {
                        Utils::printError(Lang::FORMAT_FALSE_POSITIVES);
                    }

                    $vuln_id = $false_positive-> {'vuln_id'};

                    $myvuln = new MyVuln($vuln_id);
                    $this->false_positives[] = $myvuln;
                }
            } else {
                Utils::printError(Lang::FORMAT_FALSE_POSITIVES);
            }
        }
    }

    public function readExcludesFile()
    {
        if (!is_null($this->excludes_file)) {
            if (!file_exists($this->excludes_file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->excludes_file).")"
                );
            }

            $output_json = file_get_contents($this->excludes_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'exclude_files'})) {
                $exclude_files = $parsed_json-> {'exclude_files'};
                foreach ($exclude_files as $exclude_file) {
                    if (realpath($exclude_file)) {
                        $this->excludes_files_analysis[] = realpath($exclude_file);
                    }
                }
            }

            if (isset($parsed_json-> {'exclude_folders'})) {
                $exclude_folders = $parsed_json-> {'exclude_folders'};
                foreach ($exclude_folders as $exclude_folder) {
                    if (realpath($exclude_folder)) {
                        $this->excludes_folders_analysis[] = realpath($exclude_folder);
                    }
                }
            }
        }
    }

    public function readIncludesFile()
    {
        if (!is_null($this->includes_file)) {
            if (!file_exists($this->includes_file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->includes_file).")"
                );
            }

            $output_json = file_get_contents($this->includes_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'include_files'})) {
                $include_files = $parsed_json-> {'include_files'};
                foreach ($include_files as $include_file) {
                    if (realpath($include_file)) {
                        $this->includes_files_analysis[] = realpath($include_file);
                    }
                }
            }

            if (isset($parsed_json-> {'include_folders'})) {
                $include_folders = $parsed_json-> {'include_folders'};
                foreach ($include_folders as $include_folder) {
                    if (realpath($include_folder)) {
                        $this->includes_folders_analysis[] = realpath($include_folder);
                    }
                }
            }
        }
    }

    public function readCustomFile()
    {
        if (is_null($this->custom_file)) {
            $this->custom_file = __DIR__."/../../uptodate_data/rules.json";
        }

        if (!is_null($this->custom_file)) {
            if (!file_exists($this->custom_file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->custom_file).")"
                );
            }

            $output_json = file_get_contents($this->custom_file);
            $parsed_json = json_decode($output_json);

            if (isset($parsed_json-> {'custom_rules'})) {
                $custom_rules = $parsed_json-> {'custom_rules'};
                foreach ($custom_rules as $custom_rule) {
                    if (isset($custom_rule-> {'name'})
                                && isset($custom_rule-> {'description'})
                                && isset($custom_rule-> {'cwe'})
                                && isset($custom_rule-> {'attack'})) {
                        $mycustom = new MyCustomRule($custom_rule-> {'name'}, $custom_rule-> {'description'});
                        $mycustom->setCwe($custom_rule-> {'cwe'});
                        $mycustom->setAttack($custom_rule-> {'attack'});

                        if (isset($custom_rule-> {'sequence'}) && isset($custom_rule-> {'action'})) {
                            $mycustom->setType(MyCustomRule::TYPE_SEQUENCE);
                            $mycustom->setAction($custom_rule-> {'action'});

                            foreach ($custom_rule-> {'sequence'} as $seq) {
                                if (isset($seq-> {'function_name'}) && isset($seq-> {'language'})) {
                                    $mycustomfunction = null;

                                    if (!isset($seq-> {'action'})) {
                                        $mycustomfunction = $mycustom->addToSequence(
                                            $seq-> {'function_name'},
                                            $seq-> {'language'}
                                        );
                                    } else {
                                        switch ($seq-> {'action'}) {
                                            case 'MUST_VERIFY_DEFINITION':
                                                $mycustomfunction = $mycustom->addToSequenceWithAction(
                                                    $seq-> {'function_name'},
                                                    $seq-> {'language'},
                                                    $seq-> {'action'}
                                                );
                                                break;
                                            default:
                                                $mycustomfunction = $mycustom->addToSequence(
                                                    $seq-> {'function_name'},
                                                    $seq-> {'language'}
                                                );
                                                break;
                                        }
                                    }

                                    if (isset($seq-> {'parameters'}) && !is_null($mycustomfunction)) {
                                        $parameters = $seq-> {'parameters'};
                                        foreach ($parameters as $parameter) {
                                            if (isset($parameter-> {'id'}) && isset($parameter-> {'values'})) {
                                                if (is_int($parameter-> {'id'})) {
                                                    $mycustomfunction->addParameter(
                                                        $parameter-> {'id'},
                                                        $parameter-> {'values'}
                                                    );
                                                }
                                            }
                                        }

                                        $mycustomfunction->setHasParameters(true);
                                    }

                                    if (isset($seq-> {'instanceof'})) {
                                        $mycustomfunction->setIsInstance(true);
                                        $mycustomfunction->setInstanceOfName($seq-> {'instanceof'});
                                    }
                                }
                            }
                        } elseif (isset($custom_rule-> {'function_name'})
                                     && isset($custom_rule-> {'language'})
                                     && isset($custom_rule-> {'action'})) {
                            $mycustom->setType(MyCustomRule::TYPE_FUNCTION);
                            $mycustom->setAction($custom_rule-> {'action'});
                            $mycustomfunction = $mycustom->addFunctionDefinition(
                                $custom_rule-> {'function_name'},
                                $custom_rule-> {'language'}
                            );

                            if (isset($custom_rule-> {'parameters'})) {
                                $parameters = $custom_rule-> {'parameters'};
                                foreach ($parameters as $parameter) {
                                    if (isset($parameter-> {'id'}) && isset($parameter-> {'values'})) {
                                        if (is_int($parameter-> {'id'})) {
                                            $mycustomfunction->addParameter(
                                                $parameter-> {'id'},
                                                $parameter-> {'values'}
                                            );
                                        }
                                    }
                                }

                                $mycustomfunction->setHasParameters(true);
                            }

                            if (isset($custom_rule-> {'instanceof'})) {
                                $mycustomfunction->setIsInstance(true);
                                $mycustomfunction->setInstanceOfName($custom_rule-> {'instanceof'});
                            }
                        }

                        $this->custom_rules[] = $mycustom;
                    }
                }
            }
        }
    }
}
