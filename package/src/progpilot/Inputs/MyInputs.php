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
use progpilot\Objects\MyDefinition;

class MyInputs
{
    private $dev;
    private $languages;
    
    private $customRules;
    private $sanitizers;
    private $sinks;
    private $sources;
    private $validators;

    private $overwrittenCustomRules;
    private $overwrittenSanitizers;
    private $overwrittenSinks;
    private $overwrittenSources;
    private $overwrittenValidators;

    private $falsePositivesAnalysis;
    private $excludesFilesAnalysis;
    private $includesFilesAnalysis;
    private $resolvedIncludesAnalysis;

    private $file;
    private $code;
    private $folder;

    private $falsePositives;

    public function __construct()
    {
        $this->dev = false;
        $this->languages = ["php"];
        
        $this->customRules = [];
        $this->sanitizers = [];
        $this->sinks = [];
        $this->sources = [];
        $this->validators = [];

        $this->overwrittenCustomRules = false;
        $this->overwrittenSanitizers = false;
        $this->overwrittenSinks = false;
        $this->overwrittenSources = false;
        $this->overwrittenValidators = false;

        $this->falsePositivesAnalysis = [];
        $this->excludesFilesAnalysis = ["vendor", "node_modules"];
        $this->includesFilesAnalysis = [];
        $this->resolvedIncludesAnalysis = [];

        $this->file = null;
        $this->code = null;
        $this->folder = null;

        $this->falsePositives= null;
    }

    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    public function isLanguage($lang)
    {
        return in_array($lang, $this->languages, true);
    }
    
    public function getLanguages()
    {
        return $this->languages;
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

    public function resolvePaths()
    {
        $tmpFiles = $this->excludesFilesAnalysis;
        $this->excludesFilesAnalysis = [];

        foreach ($tmpFiles as $excludedFile) {
            if (strpos($excludedFile, "/") !== false
                || strpos($excludedFile, "\\") !== false) {
                // there is a slash, the dev likely wants a path
                if (str_starts_with("./", $excludedFile) === 0
                    && str_starts_with(".\\", $excludedFile) === 0
                        && str_starts_with("/", $excludedFile) === 0
                            && preg_match("/^[a-bA-B]*:/", $excludedFile) === 0) {
                    // it's not a relative or absolute path
                    $excludedFile = ".".DIRECTORY_SEPARATOR.$excludedFile;
                }

                $excludedFile = realpath($excludedFile);
            }

            if (!in_array($excludedFile, $this->excludesFilesAnalysis, true)) {
                $this->excludesFilesAnalysis[] = $excludedFile;
            }
        }


        $tmpFiles = $this->includesFilesAnalysis;
        $this->includesFilesAnalysis = [];

        foreach ($tmpFiles as $includedFile) {
            if (strpos($includedFile, "/") !== false
                || strpos($includedFile, "\\") !== false) {
                // there is a slash, the dev likely wants a path
                if (str_starts_with("./", $includedFile) === 0
                    && str_starts_with(".\\", $includedFile) === 0
                        && str_starts_with("/", $includedFile) === 0
                            && preg_match("/^[a-bA-B]*:/", $includedFile) === 0) {
                    // it's not a relative or absolute path
                    $includedFile = ".".DIRECTORY_SEPARATOR.$includedFile;
                }

                $includedFile = realpath($includedFile);
            }

            if (!in_array($includedFile, $this->includesFilesAnalysis, true)) {
                $this->includesFilesAnalysis[] = $includedFile;
            }
        }
    }

    public function isExcludedFile($name)
    {
        $name = realpath($name);
        $basename = basename($name);
        $folders = explode(DIRECTORY_SEPARATOR, $name);

        foreach ($this->excludesFilesAnalysis as $excludeFileName) {
            if (strpos($excludeFileName, "/") === false
                && strpos($excludeFileName, "\\") === false) {
                // it's not a path
                // test if it's a file name
                if (basename($excludeFileName) === $basename) {
                    return true;
                }

                // test if it's a folder name
                if (!empty($folders)) {
                    foreach ($folders as $folder) {
                        if ($folder === $excludeFileName) {
                            return true;
                        }
                    }
                }
            } else {
                // we found if
                if (strpos($name, $excludeFileName) === 0) {
                    return true;
                }
            }
        }

        return false;
    }

    public function isIncludedFile($name)
    {
        $name = realpath($name);
        $basename = basename($name);
        $folders = explode(DIRECTORY_SEPARATOR, $name);

        foreach ($this->includesFilesAnalysis as $includedFileName) {
            if (strpos($includedFileName, "/") === false
                && strpos($includedFileName, "\\") === false) {
                // it's not a path
                // test if it's a file name
                if (basename($includedFileName) === $basename) {
                    return true;
                }

                // test if it's a folder name
                if (!empty($folders)) {
                    foreach ($folders as $folder) {
                        if ($folder === $includedFileName) {
                            return true;
                        }
                    }
                }
            } else {
                // we found if
                if (strpos($name, $includedFileName) === 0) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getIncludeByLocation($line, $column, $sourceFile)
    {
        foreach ($this->resolvedIncludesAnalysis as $myInclude) {
            if ($myInclude->getLine() === $line
                && $myInclude->getColumn() === $column
                    && $myInclude->getSourceFile() === $sourceFile) {
                return $myInclude;
            }
        }

        return null;
    }

    public function getValidatorByName($context, $stackClass, $myFunc, $myClass)
    {
        foreach ($this->validators as $myValidator) {
            if ($myValidator->getName() === $myFunc->getName()) {
                if (!$myValidator->isInstance() && !$myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    return $myValidator;
                }

                if ($myValidator->isInstance() && $myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    if (!is_null($myClass) &&
                        ($myValidator->getInstanceOfName() === $myClass->getName()
                            || $myValidator->getInstanceOfName() === $myClass->getExtendsOf())) {
                        return $myValidator;
                    }

                    if ($myValidator->getLanguage() === "php") {
                        $propertiesValidator = explode("->", $myValidator->getInstanceOfName());
                    } elseif ($myValidator->getLanguage() === "js") {
                        $propertiesValidator = explode(".", $myValidator->getInstanceOfName());
                    }

                    if (is_array($propertiesValidator)) {
                        $myValidatorInstanceName = $propertiesValidator[0];

                        $myValidatorNumberOfProperties = count($propertiesValidator);
                        $stackNumberOfProperties = count($stackClass);

                        if ($stackNumberOfProperties >= $myValidatorNumberOfProperties) {
                            $knownProperties =
                                $stackClass[$stackNumberOfProperties - $myValidatorNumberOfProperties];

                            foreach ($knownProperties as $propClass) {
                                $objectId = $propClass->getObjectId();
                                $myClass = $context->getObjects()->getMyClassFromObject($objectId);
                                
                                if (($myClass->getName() === $myValidatorInstanceName
                                    || $myClass->getExtendsOf() === $myValidatorInstanceName)) {
                                    return $myValidator;
                                }
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function getSanitizerByName($context, $stackClass, $myFunc, $myClass)
    {
        foreach ($this->sanitizers as $mySanitizer) {
            if ($mySanitizer->getName() === $myFunc->getName()) {
                if (!$mySanitizer->isInstance() && !$myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    return $mySanitizer;
                }

                if ($mySanitizer->isInstance() && $myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    if (!is_null($myClass) &&
                        ($mySanitizer->getInstanceOfName() === $myClass->getName()
                            || $mySanitizer->getInstanceOfName() === $myClass->getExtendsOf())) {
                        return $mySanitizer;
                    }

                    if ($mySanitizer->getLanguage() === "php") {
                        $propertiesSanitizer = explode("->", $mySanitizer->getInstanceOfName());
                    } elseif ($mySanitizer->getLanguage() === "js") {
                        $propertiesSanitizer = explode(".", $mySanitizer->getInstanceOfName());
                    }

                    if (is_array($propertiesSanitizer)) {
                        $mySanitizerInstanceName = $propertiesSanitizer[0];

                        $mySanitizerNumberOfProperties = count($propertiesSanitizer);
                        $stackNumberOfProperties = count($stackClass);

                        if ($stackNumberOfProperties >= $mySanitizerNumberOfProperties) {
                            $knownProperties =
                            $stackClass[$stackNumberOfProperties - $mySanitizerNumberOfProperties];

                            foreach ($knownProperties as $propClass) {
                                $objectId = $propClass->getObjectId();
                                $myClass = $context->getObjects()->getMyClassFromObject($objectId);
                                
                                if (!is_null($myClass) && ($myClass->getName() === $mySanitizerInstanceName
                                    || $myClass->getExtendsOf() === $mySanitizerInstanceName)) {
                                    return $mySanitizer;
                                }
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function getSinkByName($context, $stackClass, $myFunc, $myClass)
    {
        foreach ($this->sinks as $mySink) {
            if ($mySink->getName() === $myFunc->getName()) {
                if (!$mySink->isInstance() && !$myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    return $mySink;
                }

                if ($mySink->isInstance() && $myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    if (!is_null($myClass)
                        && ($mySink->getInstanceOfName() === $myClass->getName()
                            || $mySink->getInstanceOfName() === $myClass->getExtendsOf())) {
                        return $mySink;
                    }

                    if ($mySink->getLanguage() === "php") {
                        $propertiesSink = explode("->", $mySink->getInstanceOfName());
                    } elseif ($mySink->getLanguage() === "js") {
                        $propertiesSink = explode(".", $mySink->getInstanceOfName());
                    }

                    if (is_array($propertiesSink)) {
                        $mySinkInstanceName = $propertiesSink[0];

                        $mySinkNumberOfProperties = count($propertiesSink);
                        $stackNumberOfProperties = count($stackClass);

                        if ($stackNumberOfProperties >= $mySinkNumberOfProperties) {
                            $knownProperties =
                            $stackClass[$stackNumberOfProperties - $mySinkNumberOfProperties];

                            foreach ($knownProperties as $propClass) {
                                $objectId = $propClass->getObjectId();
                                $myClass = $context->getObjects()->getMyClassFromObject($objectId);
                                
                                if ((is_null($myClass) && $mySinkInstanceName === $propClass->getName())
                                    || (!is_null($myClass)
                                        && ($myClass->getName() === $mySinkInstanceName
                                            || $myClass->getExtendsOf() === $mySinkInstanceName))) {
                                    return $mySink;
                                }
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    public function getSourceArrayByName(
        $myFuncOrDef,
        $arrValue = false
    ) {
        foreach ($this->sources as $mySource) {
            if ($mySource->getName() === $myFuncOrDef->getName()
                && $mySource->getIsArray()
                    && $arrValue === false) {
                return $mySource;
            }
        }

        return null;
    }
    
    public function getSourceByName(
        $context,
        $stackClass,
        $myFuncOrDef,
        $isFunction = false,
        $instanceName = false,
        $arrValue = false
    ) {
        foreach ($this->sources as $mySource) {
            $checkName = false;
            if (!$isFunction && $myFuncOrDef->isType(MyDefinition::TYPE_PROPERTY)) {
                $properties = $myFuncOrDef->property->getProperties();
                if (is_array($properties) && count($properties) > 0) {
                    $lastproperty = $properties[count($properties) - 1];
                    if ($lastproperty === $mySource->getName()) {
                        $checkName = true;
                    }
                }
            }

            if (($mySource->getName() === $myFuncOrDef->getName()) || $checkName) {
                $checkFunction = false;
                $checkArray = false;
                $checkInstance = false;
                
                if (!$instanceName && !$mySource->isInstance()) {
                    $checkInstance = true;
                }

                if ($instanceName && $mySource->isInstance()) {
                    if ($mySource->getInstanceOfName() === $instanceName) {
                        $checkInstance = true;
                    }

                    if ($mySource->getLanguage() === "php") {
                        $propertiesSource = explode("->", $mySource->getInstanceOfName());
                    } elseif ($mySource->getLanguage() === "js") {
                        $propertiesSource = explode(".", $mySource->getInstanceOfName());
                    }

                    if (is_array($propertiesSource)) {
                        $mySourceInstanceName = $propertiesSource[0];

                        $mySourceNumberOfProperties = count($propertiesSource);
                        $stackNumberOfProperties = count($stackClass);

                        if ($stackNumberOfProperties >= $mySourceNumberOfProperties) {
                            $knownProperties =
                                $stackClass[$stackNumberOfProperties - $mySourceNumberOfProperties];

                            foreach ($knownProperties as $propClass) {
                                if ($propClass->getName() === $mySourceInstanceName) {
                                    $checkInstance = true;
                                }
                            }
                        }
                    }
                }

                if ($mySource->isFunction() === $isFunction) {
                    $checkFunction = true;
                }

                // if we request an array the source must be an array
                // and array nots equals (like $_GET["p"])
                if (($arrValue !== false && $arrValue !== "PROGPILOT_ALL_INDEX_TAINTED"
                    && $mySource->getIsArray()
                        && empty($mySource->getArrayValue()))
                            // or we don't request an array
                            // and the source is not an array (echo $hardcoded_tainted)
                            || (!$arrValue && !$mySource->getIsArray())
                            // or we don't request an array
                            // if mysource is a function and a array like that :
                            // $row = mysqli_fetch_assoc()
                            // echo $row[0]
                            // we don't want an array ie : $row = mysqli_fetch_assoc()[0]
                            || (!$arrValue && $mySource->isFunction() && $mySource->getIsArray())) {
                    $checkArray = true;
                }

                // if we request an array the source must be an array and array value equals
                if (($arrValue !== false && $arrValue !== "PROGPILOT_ALL_INDEX_TAINTED"
                    && $mySource->getIsArray()
                        && !empty($mySource->getArrayValue())
                            && $mySource->isAnArrayValue($arrValue))) {
                    $checkArray = true;
                }

                if ($checkArray && $checkInstance && $checkFunction) {
                    return $mySource;
                }
            }
        }

        return null;
    }

    public function getFalsePositiveById($id)
    {
        foreach ($this->falsePositivesAnalysis as $falsePositive) {
            if ($falsePositive->getId() === $id) {
                return $falsePositive;
            }
        }

        return null;
    }

    public function getDev()
    {
        return $this->dev;
    }

    public function setDev($dev)
    {
        $this->dev = $dev;

        if ($this->dev) {
            $sanitizersfile = __DIR__."/../../uptodate_data/php/dev/sanitizers.json";
            $this->readSanitizersFile($sanitizersfile);
            
            $sinksfile = __DIR__."/../../uptodate_data/php/dev/sinks.json";
            $this->readSinksFile($sinksfile);
            
            $sourcesfile = __DIR__."/../../uptodate_data/php/dev/sources.json";
            $this->readSourcesFile($sourcesfile);
            
            $validatorsfile = __DIR__."/../../uptodate_data/php/dev/validators.json";
            $this->readValidatorsFile($validatorsfile);
            
            $customsfile = __DIR__."/../../uptodate_data/php/dev/rules.json";
            $this->readCustomFile($customsfile);
        }
    }

    public function readDir($dir, &$files)
    {
        if (is_dir($dir)) {
            $filesanddirs = @scandir($dir);

            if ($filesanddirs !== false) {
                foreach ($filesanddirs as $filedir) {
                    if ($filedir !== '.' && $filedir !== "..") {
                        $folderorfile = $dir.DIRECTORY_SEPARATOR.$filedir;
                        
                        if (is_dir($folderorfile)) {
                            $this->readDir($folderorfile, $files);
                        } else {
                            $files[] = $folderorfile;
                        }
                    }
                }
            }
        }
    }

    public function readFrameworks()
    {
        $frameworksConfigurationFiles = [];
        $frameworksDir = __DIR__."/../../uptodate_data/php/frameworks/";

        $this->readDir($frameworksDir, $frameworksConfigurationFiles);

        foreach ($frameworksConfigurationFiles as $configFile) {
            $basenameConfigFile = basename($configFile);
            switch ($basenameConfigFile) {
                case "sanitizers.json":
                    if (!$this->overwrittenSanitizers) {
                        $this->readSanitizersFile($configFile);
                    }
                    break;
                case "validators.json":
                    if (!$this->overwrittenValidators) {
                        $this->readValidatorsFile($configFile);
                    }
                    break;
                case "sinks.json":
                    if (!$this->overwrittenSinks) {
                        $this->readSinksFile($configFile);
                    }
                    break;
                case "sources.json":
                    if (!$this->overwrittenSources) {
                        $this->readSourcesFile($configFile);
                    }
                    break;
                case "rules.json":
                    if (!$this->overwrittenCustomRules) {
                        $this->readCustomFile($configFile);
                    }
                    break;
                default:
                    break;
            }
        }
    }

    public function addSources($files)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $this->readSourcesFile($file);
            }
        } else {
            $this->readSourcesFile($files);
        }
    }

    public function setSources($files)
    {
        $this->overwrittenSources = true;
        $this->sources = [];
        $this->addSources($files);
    }

    public function getSources()
    {
        return $this->sources;
    }

    public function addSinks($files)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $this->readSinksFile($file);
            }
        } else {
            $this->readSinksFile($files);
        }
    }

    public function getSinks()
    {
        return $this->sinks;
    }

    public function setSinks($files)
    {
        $this->overwrittenSinks = true;
        $this->sinks = [];
        $this->addSinks($files);
    }

    public function addValidators($files)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $this->readValidatorsFile($file);
            }
        } else {
            $this->readValidatorsFile($files);
        }
    }

    public function setValidators($files)
    {
        $this->overwrittenValidators = true;
        $this->validators = [];
        $this->addValidators($files);
    }

    public function getValidators()
    {
        return $this->validators;
    }

    public function addSanitizers($files)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $this->readSanitizersFile($file);
            }
        } else {
            $this->readSanitizersFile($files);
        }
    }

    public function setSanitizers($files)
    {
        $this->overwrittenSanitizers = true;
        $this->sanitizers = [];
        $this->addSanitizers($files);
    }

    public function getSanitizers()
    {
        return $this->sanitizers;
    }

    public function addCustomRules($files)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $this->readCustomFile($file);
            }
        } else {
            $this->readCustomFile($files);
        }
    }

    public function setCustomRules($files)
    {
        $this->overwrittenCustomRules = true;
        $this->customRules = [];
        $this->addCustomRules($files);
    }

    public function getCustomRules()
    {
        return $this->customRules;
    }

    public function readDefaultSanitizers()
    {
        if (!$this->overwrittenSanitizers) {
            $this->readSanitizersFile(__DIR__."/../../uptodate_data/php/sanitizers.json");
            $this->readSanitizersFile(__DIR__."/../../uptodate_data/js/sanitizers.json");
        }
    }

    public function readSanitizersFile($file)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                Utils::printError(Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($file).")");
            }

            $outputJson = file_get_contents($file);

            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson-> {'sanitizers'})) {
                $sanitizers = $parsedJson-> {'sanitizers'};
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

                    $mySanitizer = new MySanitizer($name, $language, $prevent);

                    if (isset($sanitizer-> {'instanceof'})) {
                        $mySanitizer->setIsInstance(true);
                        $mySanitizer->setInstanceOfName($sanitizer-> {'instanceof'});
                    }

                    if (isset($sanitizer-> {'parameters'})) {
                        $parameters = $sanitizer-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && isset($parameter-> {'conditions'})) {
                                if (is_int($parameter-> {'id'})
                                            && ($parameter-> {'conditions'} === "equals"
                                                    || $parameter-> {'conditions'} === "notequals"
                                                        || $parameter-> {'conditions'} === "taint"
                                                            || $parameter-> {'conditions'} === "sanitize")) {
                                    if ($parameter-> {'conditions'} === "equals"
                                        || $parameter-> {'conditions'} === "notequals") {
                                        if (isset($parameter-> {'values'})) {
                                            $mySanitizer->addParameter(
                                                $parameter-> {'id'},
                                                $parameter-> {'conditions'},
                                                $parameter-> {'values'}
                                            );
                                        }
                                    } else {
                                        $mySanitizer->addParameter(
                                            $parameter-> {'id'},
                                            $parameter-> {'conditions'}
                                        );
                                    }
                                }
                            }
                        }

                        $mySanitizer->setHasParameters(true);
                    }

                    if (!in_array($mySanitizer, $this->sanitizers, true)) {
                        $this->sanitizers[] = $mySanitizer;
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_SANITIZERS);
            }
        }
    }

    public function readDefaultSinks()
    {
        if (!$this->overwrittenSinks) {
            $this->readSinksFile(__DIR__."/../../uptodate_data/php/sinks.json");
            $this->readSinksFile(__DIR__."/../../uptodate_data/js/sinks.json");
        }
    }

    public function readSinksFile($file)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                Utils::printError(Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($file).")");
            }

            $outputJson = file_get_contents($file);
            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson-> {'sinks'})) {
                $sinks = $parsedJson-> {'sinks'};
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

                    $mySink = new MySink($name, $language, $attack, $cwe);

                    if (isset($sink-> {'instanceof'})) {
                        $mySink->setIsInstance(true);
                        $mySink->setInstanceOfName($sink-> {'instanceof'});
                    }

                    if (isset($sink-> {'conditions'})) {
                        $mySink->addGlobalconditions($sink-> {'conditions'});
                    }

                    if (isset($sink-> {'parameters'})) {
                        $parameters = $sink-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && is_int($parameter-> {'id'})) {
                                if (isset($parameter-> {'conditions'})) {
                                    $mySink->addParameter($parameter-> {'id'}, $parameter-> {'conditions'});
                                } else {
                                    $mySink->addParameter($parameter-> {'id'});
                                }
                            }
                        }

                        $mySink->setHasParameters(true);
                    }

                    if (!in_array($mySink, $this->sinks, true)) {
                        $this->sinks[] = $mySink;
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_SINKS);
            }
        }
    }

    public function readDefaultSources()
    {
        if (!$this->overwrittenSources) {
            $this->readSourcesFile(__DIR__."/../../uptodate_data/php/sources.json");
            $this->readSourcesFile(__DIR__."/../../uptodate_data/js/sources.json");
        }
    }

    public function readSourcesFile($file)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                Utils::printError(Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($file).")");
            }

            $outputJson = file_get_contents($file);
            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson-> {'sources'})) {
                $sources = $parsedJson-> {'sources'};
                foreach ($sources as $source) {
                    if (!isset($source-> {'name'})
                                || !isset($source-> {'language'})) {
                        Utils::printError(Lang::FORMAT_SOURCES);
                    }

                    $name = $source-> {'name'};
                    $language = $source-> {'language'};

                    $mySource = new MySource($name, $language);

                    if (isset($source-> {'is_function'}) && $source-> {'is_function'}) {
                        $mySource->setIsFunction(true);
                    }

                    if (isset($source-> {'is_array'}) && $source-> {'is_array'}) {
                        $mySource->setIsArray(true);
                    }

                    if (isset($source-> {'is_object'}) && $source-> {'is_object'}) {
                        $mySource->setIsObject(true);
                    }

                    if (isset($source-> {'array_index'}) && is_array($source-> {'array_index'})) {
                        $arr = [];
                        foreach ($source-> {'array_index'} as $array_index) {
                            $arr[$array_index] = false;
                        }

                        $mySource->setArrayValue($arr);
                    }

                    if (isset($source-> {'instanceof'})) {
                        $mySource->setIsInstance(true);
                        $mySource->setInstanceOfName($source-> {'instanceof'});
                    }

                    if (isset($source-> {'return_array_index'})) {
                        $mySource->setReturnArray(true);
                        $mySource->setReturnArrayValue($source-> {'return_array_index'});
                    }

                    if (isset($source-> {'label'})) {
                        $label = MyDefinition::SECURITY_LOW;
                        if ($source-> {'label'} === "high") {
                            $label = MyDefinition::SECURITY_HIGH;
                        }
                            
                        $mySource->setLabel($label);
                    }

                    if (isset($source-> {'parameters'})) {
                        $parameters = $source-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (is_int($parameter-> {'id'})) {
                                $mySource->addParameter($parameter-> {'id'});

                                if (isset($parameter-> {'is_array'})
                                            && $parameter-> {'is_array'}
                                            && isset($parameter-> {'array_index'})) {
                                    $mySource->addconditionsParameter(
                                        $parameter-> {'id'},
                                        MySource::CONDITION_ARRAY,
                                        $parameter-> {'array_index'}
                                    );
                                }
                            }
                        }

                        $mySource->setHasParameters(true);
                    }

                    if (!in_array($mySource, $this->sources, true)) {
                        $this->sources[] = $mySource;
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_SOURCES);
            }
        }
    }

    public function readDefaultValidators()
    {
        if (!$this->overwrittenValidators) {
            $this->readValidatorsFile(__DIR__."/../../uptodate_data/php/validators.json");
            $this->readValidatorsFile(__DIR__."/../../uptodate_data/js/validators.json");
        }
    }

    public function readValidatorsFile($file)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                Utils::printError(Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($file).")");
            }

            $outputJson = file_get_contents($file);
            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson-> {'validators'})) {
                $validators = $parsedJson-> {'validators'};
                foreach ($validators as $validator) {
                    if (!isset($validator-> {'name'})
                                || !isset($validator-> {'language'})) {
                        Utils::printError(Lang::FORMAT_VALIDATORS);
                    }

                    $name = $validator-> {'name'};
                    $language = $validator-> {'language'};

                    $validWhenReturning = true;
                    if (isset($validator-> {'valid_when_returning'})) {
                        $validWhenReturning = $validator-> {'valid_when_returning'};
                    }

                    $myValidator = new MyValidator($name, $language, $validWhenReturning);

                    if (isset($validator-> {'parameters'})) {
                        $parameters = $validator-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && isset($parameter-> {'conditions'})) {
                                if (is_int($parameter-> {'id'})
                                            && ($parameter-> {'conditions'} === "not_tainted"
                                                    || $parameter-> {'conditions'} === "array_not_tainted"
                                                            || $parameter-> {'conditions'} === "valid"
                                                                    || $parameter-> {'conditions'} === "equals"
                                                                    || $parameter-> {'conditions'} === "notequals")) {
                                    if ($parameter-> {'conditions'} === "equals"
                                        || $parameter-> {'conditions'} === "notequals") {
                                        if (isset($parameter-> {'values'})) {
                                            $myValidator->addParameter(
                                                $parameter-> {'id'},
                                                $parameter-> {'conditions'},
                                                $parameter-> {'values'}
                                            );
                                        }
                                    } else {
                                        $myValidator->addParameter(
                                            $parameter-> {'id'},
                                            $parameter-> {'conditions'}
                                        );
                                    }
                                }
                            }
                        }

                        $myValidator->setHasParameters(true);
                    }

                    if (isset($validator-> {'instanceof'})) {
                        $myValidator->setIsInstance(true);
                        $myValidator->setInstanceOfName($validator-> {'instanceof'});
                    }

                    if (!in_array($myValidator, $this->validators, true)) {
                        $this->validators[] = $myValidator;
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_VALIDATORS);
            }
        }
    }
        
    public function readDefaultCustomRules()
    {
        if (!$this->overwrittenCustomRules) {
            $this->readCustomFile(__DIR__."/../../uptodate_data/php/rules.json");
            $this->readCustomFile(__DIR__."/../../uptodate_data/js/rules.json");
        }
    }

    public function readCustomFile($file)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($file).")"
                );
            }

            $outputJson = file_get_contents($file);
            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson-> {'custom_rules'})) {
                $customRules = $parsedJson-> {'custom_rules'};
                foreach ($customRules as $customRule) {
                    if (isset($customRule-> {'description'})) {
                        $myCustom = new MyCustomRule($customRule-> {'description'});
                        
                        if (!isset($customRule-> {'cwe'})) {
                            $customRule-> {'cwe'} = "";
                        }
                            
                        if (!isset($customRule-> {'attack'})) {
                            $customRule-> {'attack'} = "";
                        }
                            
                        $myCustom->setCwe($customRule-> {'cwe'});
                        $myCustom->setAttack($customRule-> {'attack'});
                        if (isset($customRule-> {'extra'})) {
                            $myCustom->setExtra($customRule-> {'extra'});
                        }

                        if (isset($customRule-> {'sequence'}) && isset($customRule-> {'action'})) {
                            $myCustom->setType(MyCustomRule::TYPE_SEQUENCE);
                            $myCustom->setAction($customRule-> {'action'});

                            foreach ($customRule-> {'sequence'} as $seq) {
                                if (isset($seq-> {'function_name'}) && isset($seq-> {'language'})) {
                                    $myCustomFunction = null;
                                    $myCustomFunction = $myCustom->addToSequence(
                                        $seq-> {'function_name'},
                                        $seq-> {'language'}
                                    );

                                    if (isset($seq-> {'parameters'}) && !is_null($myCustomFunction)) {
                                        $parameters = $seq-> {'parameters'};
                                        foreach ($parameters as $parameter) {
                                            if (isset($parameter-> {'id'}) && isset($parameter-> {'values'})) {
                                                $validbydefault = false;
                                                if (isset($parameter-> {'valid_by_default'})
                                                    && $parameter-> {'valid_by_default'}) {
                                                    $validbydefault = true;
                                                }
                                                    
                                                $fixed = false;
                                                if (isset($parameter-> {'fixed'})
                                                    && $parameter-> {'fixed'}) {
                                                    $fixed = true;
                                                }
                                                    
                                                $sufficient = false;
                                                if (isset($parameter-> {'sufficient'})
                                                    && $parameter-> {'sufficient'}) {
                                                    $sufficient = true;
                                                }

                                                $fail_if_not_verified = true;
                                                if (isset($parameter-> {'fail_if_not_verified'})
                                                    && !$parameter-> {'fail_if_not_verified'}) {
                                                    $fail_if_not_verified = false;
                                                }

                                                $notequals = false;
                                                if (isset($parameter-> {'notequals'})
                                                    && $parameter-> {'notequals'}) {
                                                    $notequals = true;
                                                }

                                                if (is_int($parameter-> {'id'})) {
                                                    $myCustomFunction->addParameter(
                                                        $parameter-> {'id'},
                                                        $validbydefault,
                                                        $fixed,
                                                        $sufficient,
                                                        $fail_if_not_verified,
                                                        $notequals,
                                                        $parameter-> {'values'}
                                                    );
                                                }
                                            }
                                        }

                                        $myCustomFunction->setHasParameters(true);
                                    }

                                    if (isset($seq-> {'instanceof'})) {
                                        $myCustomFunction->setIsInstance(true);
                                        $myCustomFunction->setInstanceOfName($seq-> {'instanceof'});
                                    }
                                }
                            }
                        } elseif (isset($customRule-> {'name'})
                                     && isset($customRule-> {'language'})
                                     && isset($customRule-> {'action'})
                                     && isset($customRule-> {'is_function'})
                                     && $customRule-> {'is_function'} === true) {
                            $myCustom->setType(MyCustomRule::TYPE_FUNCTION);
                            $myCustom->setAction($customRule-> {'action'});
                            $myCustomFunction = $myCustom->addFunctionDefinition(
                                $customRule-> {'name'},
                                $customRule-> {'language'}
                            );

                            if (isset($customRule-> {'parameters'})) {
                                $parameters = $customRule-> {'parameters'};
                                foreach ($parameters as $parameter) {
                                    if (isset($parameter-> {'id'}) && isset($parameter-> {'values'})) {
                                        if (is_int($parameter-> {'id'})) {
                                            $fixed = false;
                                            if (isset($parameter-> {'fixed'})
                                                && $parameter-> {'fixed'}) {
                                                $fixed = true;
                                            }
                                        
                                            $validbydefault = false;
                                            if (isset($parameter-> {'valid_by_default'})
                                                && $parameter-> {'valid_by_default'}) {
                                                $validbydefault = true;
                                            }

                                            $sufficient = false;
                                            if (isset($parameter-> {'sufficient'})
                                                && $parameter-> {'sufficient'}) {
                                                $sufficient = true;
                                            }

                                            $fail_if_not_verified = true;
                                            if (isset($parameter-> {'fail_if_not_verified'})
                                                && !$parameter-> {'fail_if_not_verified'}) {
                                                $fail_if_not_verified = false;
                                            }

                                            $notequals = false;
                                            if (isset($parameter-> {'notequals'})
                                                && $parameter-> {'notequals'}) {
                                                $notequals = true;
                                            }
                                                    
                                            $myCustomFunction->addParameter(
                                                $parameter-> {'id'},
                                                $validbydefault,
                                                $fixed,
                                                $sufficient,
                                                $fail_if_not_verified,
                                                $notequals,
                                                $parameter-> {'values'}
                                            );
                                        }
                                    }
                                }

                                $myCustomFunction->setHasParameters(true);
                            }

                            if (isset($customRule-> {'instanceof'})) {
                                $myCustomFunction->setIsInstance(true);
                                $myCustomFunction->setInstanceOfName($customRule-> {'instanceof'});
                            }

                            if (isset($customRule-> {'min_nb_args'})) {
                                $myCustomFunction->setMinNbArgs($customRule-> {'min_nb_args'});
                            }

                            if (isset($customRule-> {'max_nb_args'})) {
                                $myCustomFunction->setMaxNbArgs($customRule-> {'max_nb_args'});
                            }
                        } elseif (isset($customRule-> {'name'})
                                     && isset($customRule-> {'language'})
                                     && isset($customRule-> {'action'})
                                     && (!isset($customRule-> {'is_function'})
                                     || $customRule-> {'is_function'} !== true)) {
                            $myCustom->setType(MyCustomRule::TYPE_VARIABLE);
                            $myCustom->setAction($customRule-> {'action'});
                            $myCustomVariable = $myCustom->addVariableDefinition(
                                $customRule-> {'name'},
                                $customRule-> {'language'}
                            );

                            if (isset($customRule-> {'instanceof'})) {
                                $myCustomVariable->setIsInstance(true);
                                $myCustomVariable->setInstanceOfName($customRule-> {'instanceof'});
                            }
                        }

                        if (!in_array($myCustom, $this->customRules, true)) {
                            $this->customRules[] = $myCustom;
                        }
                    }
                }
            }
        }
    }

    public function setResolvedIncludes($resolvedIncludes)
    {
        if (!is_null($resolvedIncludes)) {
            if (!file_exists($resolvedIncludes)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($resolvedIncludes).")"
                );
            }

            $outputJson = file_get_contents($resolvedIncludes);
            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson-> {'includes'})) {
                $includes = $parsedJson-> {'includes'};
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
                        $sourceFile = realpath($include-> {'source_file'});
                        $value = $include-> {'value'};

                        $myInclude = new MyInclude($line, $column, $sourceFile, $value);
                        if (!in_array($myInclude, $this->resolvedIncludesAnalysis, true)) {
                            $this->resolvedIncludesAnalysis[] = $myInclude;
                        }
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_INCLUDES);
            }
        }
    }
    
    public function getFalsePositives()
    {
        return $this->falsePositivesAnalysis;
    }

    public function setFalsePositives($falsePositives)
    {
        $this->readFalsePositives($falsePositives);
    }

    public function readFalsePositives($falsePositives)
    {
        if (!is_null($falsePositives)) {
            if (is_string($falsePositives)) {
                $this->readFalsePositivesFile($falsePositives);
            } elseif (is_array($falsePositives)) {
                foreach ($falsePositives as $falsePositive) {
                    if (!isset($falsePositive["vuln_id"])) {
                        Utils::printError(Lang::FORMAT_FALSE_POSITIVES);
                    }

                    $vulnId = $falsePositive["vuln_id"];

                    $myVuln = new MyVuln($vulnId);

                    if (!in_array($myVuln, $this->falsePositivesAnalysis, true)) {
                        $this->falsePositivesAnalysis[] = $myVuln;
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_FALSE_POSITIVES);
            }
        }
    }

    public function readFalsePositivesFile($file)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($file).")"
                );
            }

            $outputJson = file_get_contents($file);
            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson-> {'false_positives'})) {
                $falsePositives = $parsedJson-> {'false_positives'};
                foreach ($falsePositives as $falsePositive) {
                    if (!isset($falsePositive-> {'vuln_id'})) {
                        Utils::printError(Lang::FORMAT_FALSE_POSITIVES);
                    }

                    $vulnId = $falsePositive-> {'vuln_id'};

                    $myVuln = new MyVuln($vulnId);
                    if (!in_array($myVuln, $this->falsePositivesAnalysis, true)) {
                        $this->falsePositivesAnalysis[] = $myVuln;
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_FALSE_POSITIVES);
            }
        }
    }

    public function getInclusions()
    {
        return $this->includesFilesAnalysis;
    }

    public function getExclusions()
    {
        return $this->excludesFilesAnalysis;
    }

    public function setExclusions($exclusions)
    {
        $this->excludesFilesAnalysis = [];
        $this->addExclusions($exclusions);
    }

    public function setInclusions($inclusions)
    {
        $this->includesFilesAnalysis = [];
        $this->addInclusions($inclusions);
    }

    public function addExclusions($exclusions)
    {
        if (!is_null($exclusions)) {
            if (is_string($exclusions)) {
                $this->readExcludesFile($exclusions);
            } elseif (is_array($exclusions)) {
                foreach ($exclusions as $excludeFile) {
                    if (is_string($excludeFile) && !in_array($excludeFile, $this->excludesFilesAnalysis, true)) {
                        $this->excludesFilesAnalysis[] = $excludeFile;
                    }
                }
            }
        }
    }

    public function addInclusions($inclusions)
    {
        if (!is_null($inclusions)) {
            if (is_string($inclusions)) {
                $this->readIncludesFile($inclusions);
            } elseif (is_array($inclusions)) {
                foreach ($inclusions as $includeFile) {
                    if (is_string($includeFile) && !in_array($includeFile, $this->includesFilesAnalysis, true)) {
                        $this->includesFilesAnalysis[] = $includeFile;
                    }
                }
            }
        }
    }

    public function readExcludesFile($file)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($file).")"
                );
            }

            $outputJson = file_get_contents($file);
            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson->{'exclusions'}) && is_array($parsedJson->{'exclusions'})) {
                foreach ($parsedJson->{'exclusions'} as $excludeFile) {
                    if (is_string($excludeFile) && !in_array($excludeFile, $this->excludesFilesAnalysis, true)) {
                        $this->excludesFilesAnalysis[] = $excludeFile;
                    }
                }
            }
        }
    }

    public function readIncludesFile($file)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($file).")"
                );
            }

            $outputJson = file_get_contents($file);
            $parsedJson = json_decode($outputJson);

            if (isset($parsedJson->{'inclusions'}) && is_array($parsedJson->{'inclusions'})) {
                foreach ($parsedJson->{'inclusions'} as $includeFile) {
                    if (is_string($includeFile) && !in_array($includeFile, $this->includesFilesAnalysis, true)) {
                            $this->includesFilesAnalysis[] = $includeFile;
                    }
                }
            }
        }
    }
}
