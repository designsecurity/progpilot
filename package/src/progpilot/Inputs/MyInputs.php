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
    private $languages;
    private $frameworks;
    
    private $customRules;

    private $sanitizers;
    private $sinks;
    private $sources;
    private $validators;
    private $falsePositivesAnalysis;
    private $excludesFilesAnalysis;
    private $includesFilesAnalysis;
    private $excludesFoldersAnalysis;
    private $includesFoldersAnalysis;

    private $customFile;
    private $resolvedIncludes;
    private $falsePositives;
    private $sourcesFile;
    private $sinksFile;
    private $sanitizersFile;
    private $validatorsFile;
    private $includes;
    private $excludes;

    private $file;
    private $code;
    private $folder;

    public function __construct()
    {
        $this->dev = false;
        $this->languages = ["php"];
        $this->frameworks = ["suitecrm", "codeigniter", "wordpress", "prestashop", "symfony"];
        
        $this->customRules = [];
        $this->resolvedIncludesAnalysis = [];
        $this->sanitizers = [];
        $this->sinks = [];
        $this->sources = [];
        $this->validators = [];
        $this->falsePositivesAnalysis = [];
        $this->excludesFilesAnalysis = [];
        $this->includesFilesAnalysis = [];
        $this->excludesFoldersAnalysis = [];
        $this->includesFoldersAnalysis = [];

        $this->customFile = null;
        $this->falsePositives= null;
        $this->resolvedIncludes = null;
        $this->sanitizersFile = null;
        $this->sinksFile = null;
        $this->sourcesFile = null;
        $this->validatorsFile = null;
        $this->excludes = null;
        $this->includes = null;

        $this->file = null;
        $this->code = null;
        $this->folder = null;
    }


    public function setFrameworks($frameworks)
    {
        $this->frameworks = $frameworks;
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

    public function getFrameworks()
    {
        return $this->frameworks;
    }
    
    public function getSinksFile()
    {
        return $this->sinksFile;
    }

    public function getSourcesFile()
    {
        return $this->sourcesFile;
    }

    public function getValidatorsFile()
    {
        return $this->validatorsFile;
    }

    public function getSanitizersFile()
    {
        return $this->sanitizersFile;
    }

    public function getIncludedFiles()
    {
        return $this->includesFilesAnalysis;
    }

    public function getIncludedFolders()
    {
        return $this->includesFoldersAnalysis;
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
        foreach ($this->excludesFoldersAnalysis as $excludeName) {
            if (strpos($name, realpath($excludeName)) === 0) {
                return true;
            }
        }

        return false;
    }

    public function isIncludedFolder($name)
    {
        $name = realpath($name);
        foreach ($this->includesFoldersAnalysis as $includeName) {
            if (strpos($name, realpath($includeName)) === 0) {
                return true;
            }
        }

        return false;
    }

    public function isExcludedFile($name)
    {
        $name = realpath($name);
        foreach ($this->excludesFilesAnalysis as $excludeName) {
            if (realpath($excludeName) === $name) {
                return true;
            }
        }
        
        foreach ($this->excludesFoldersAnalysis as $excludeName) {
            $realExcludeName = realpath($excludeName);
            $folderfirst = substr($name, 0, strlen($realExcludeName));
            if ($realExcludeName === $folderfirst) {
                return true;
            }
        }

        return false;
    }

    public function isIncludedFile($name)
    {
        $name = realpath($name);
        foreach ($this->includesFilesAnalysis as $includeName) {
            if (realpath($includeName) === $name) {
                return true;
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
                                
                                if (!is_null($myClass)
                                    && ($myClass->getName() === $mySinkInstanceName
                                        || $myClass->getExtendsOf() === $mySinkInstanceName)) {
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
                        && is_null($mySource->getArrayValue()))
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
                        && !is_null($mySource->getArrayValue())
                            && $mySource->getArrayValue() === $arrValue)) {
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
        return $this->resolvedIncludes;
    }

    public function getFalsePositives()
    {
        return $this->falsePositives;
    }

    public function getIncludes()
    {
        return $this->includes;
    }

    public function getExcludes()
    {
        return $this->excludes;
    }

    public function getDev()
    {
        return $this->dev;
    }

    public function setDev($dev)
    {
        $this->dev = $dev;
    }

    public function getCustomRules()
    {
        return $this->customRules;
    }

    public function setCustomRules($file)
    {
        $this->customFile = $file;
    }

    public function setIncludeFiles($file)
    {
        $this->includesFile = $file;
    }

    public function setExcludes($arr)
    {
        $this->excludes = $arr;
    }

    public function setIncludes($arr)
    {
        $this->includes = $arr;
    }

    public function setFalsePositives($arr)
    {
        $this->falsePositives = $arr;
    }

    public function setResolvedIncludes($arr)
    {
        $this->resolvedIncludes = $arr;
    }

    public function setSources($file)
    {
        $this->sourcesFile = $file;
    }

    public function setSinks($file)
    {
        $this->sinksFile = $file;
    }

    public function setSanitizers($file)
    {
        $this->sanitizersFile = $file;
    }

    public function setValidators($file)
    {
        $this->validatorsFile = $file;
    }

    public function readDev()
    {
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

    public function readFrameworks()
    {
        if (is_array($this->frameworks) && in_array("suitecrm", $this->frameworks, true)) {
            $sanitizersfile = __DIR__."/../../uptodate_data/php/frameworks/suitecrm/sanitizers.json";

            if (is_array($this->sanitizersFile)) {
                if (!in_array($sanitizersfile, $this->sanitizersFile, true)) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            } else {
                if ($this->sanitizersFile !== $sanitizersfile) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            }
            
            $sinksfile = __DIR__."/../../uptodate_data/php/frameworks/suitecrm/sinks.json";
            
            if (is_array($this->sinksFile)) {
                if (!in_array($sinksfile, $this->sinksFile, true)) {
                    $this->readSinksFile($sinksfile);
                }
            } else {
                if ($this->sinksFile !== $sinksfile) {
                    $this->readSinksFile($sinksfile);
                }
            }
            
            $sourcesfile = __DIR__."/../../uptodate_data/php/frameworks/suitecrm/sources.json";
            
            if (is_array($this->sourcesFile)) {
                if (!in_array($sourcesfile, $this->sourcesFile, true)) {
                    $this->readSourcesFile($sourcesfile);
                }
            } else {
                if ($this->sourcesFile !== $sourcesfile) {
                    $this->readSourcesFile($sourcesfile);
                }
            }
            
            $validatorsfile = __DIR__."/../../uptodate_data/php/frameworks/suitecrm/validators.json";
            
            if (is_array($this->validatorsFile)) {
                if (!in_array($validatorsfile, $this->validatorsFile, true)) {
                    $this->readValidatorsFile($validatorsfile);
                }
            } else {
                if ($this->validatorsFile !== $validatorsfile) {
                    $this->readValidatorsFile($validatorsfile);
                }
            }
            
            $rulesfile = __DIR__."/../../uptodate_data/php/frameworks/suitecrm/rules.json";
            
            if (is_array($this->customFile)) {
                if (!in_array($rulesfile, $this->customFile, true)) {
                    $this->readCustomFile($rulesfile);
                }
            } else {
                if ($this->customFile !== $rulesfile) {
                    $this->readCustomFile($rulesfile);
                }
            }
        }
        
        if (is_array($this->frameworks) && in_array("codeigniter", $this->frameworks, true)) {
            $sanitizersfile = __DIR__."/../../uptodate_data/php/frameworks/codeigniter/sanitizers.json";
            
            if (is_array($this->sanitizersFile)) {
                if (!in_array($sanitizersfile, $this->sanitizersFile, true)) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            } else {
                if ($this->sanitizersFile !== $sanitizersfile) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            }
            
            $sinksfile = __DIR__."/../../uptodate_data/php/frameworks/codeigniter/sinks.json";
            
            if (is_array($this->sinksFile)) {
                if (!in_array($sinksfile, $this->sinksFile, true)) {
                    $this->readSinksFile($sinksfile);
                }
            } else {
                if ($this->sinksFile !== $sinksfile) {
                    $this->readSinksFile($sinksfile);
                }
            }
            
            $sourcesfile = __DIR__."/../../uptodate_data/php/frameworks/codeigniter/sources.json";
            
            if (is_array($this->sourcesFile)) {
                if (!in_array($sourcesfile, $this->sourcesFile, true)) {
                    $this->readSourcesFile($sourcesfile);
                }
            } else {
                if ($this->sourcesFile !== $sourcesfile) {
                    $this->readSourcesFile($sourcesfile);
                }
            }
            
            $validatorsfile = __DIR__."/../../uptodate_data/php/frameworks/codeigniter/validators.json";
            
            if (is_array($this->validatorsFile)) {
                if (!in_array($validatorsfile, $this->validatorsFile, true)) {
                    $this->readValidatorsFile($validatorsfile);
                }
            } else {
                if ($this->validatorsFile !== $validatorsfile) {
                    $this->readValidatorsFile($validatorsfile);
                }
            }
            
            $rulesfile = __DIR__."/../../uptodate_data/php/frameworks/codeigniter/rules.json";
            
            if (is_array($this->customFile)) {
                if (!in_array($rulesfile, $this->customFile, true)) {
                    $this->readCustomFile($rulesfile);
                }
            } else {
                if ($this->customFile !== $rulesfile) {
                    $this->readCustomFile($rulesfile);
                }
            }
        }
        
        
        if (is_array($this->frameworks) && in_array("wordpress", $this->frameworks, true)) {
            $sanitizersfile = __DIR__."/../../uptodate_data/php/frameworks/wordpress/sanitizers.json";
            
            if (is_array($this->sanitizersFile)) {
                if (!in_array($sanitizersfile, $this->sanitizersFile, true)) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            } else {
                if ($this->sanitizersFile !== $sanitizersfile) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            }
            
            $sinksfile = __DIR__."/../../uptodate_data/php/frameworks/wordpress/sinks.json";
            
            if (is_array($this->sinksFile)) {
                if (!in_array($sinksfile, $this->sinksFile, true)) {
                    $this->readSinksFile($sinksfile);
                }
            } else {
                if ($this->sinksFile !== $sinksfile) {
                    $this->readSinksFile($sinksfile);
                }
            }
            
            $sourcesfile = __DIR__."/../../uptodate_data/php/frameworks/wordpress/sources.json";
            
            if (is_array($this->sourcesFile)) {
                if (!in_array($sourcesfile, $this->sourcesFile, true)) {
                    $this->readSourcesFile($sourcesfile);
                }
            } else {
                if ($this->sourcesFile !== $sourcesfile) {
                    $this->readSourcesFile($sourcesfile);
                }
            }
            
            $validatorsfile = __DIR__."/../../uptodate_data/php/frameworks/wordpress/validators.json";
            
            if (is_array($this->validatorsFile)) {
                if (!in_array($validatorsfile, $this->validatorsFile, true)) {
                    $this->readValidatorsFile($validatorsfile);
                }
            } else {
                if ($this->validatorsFile !== $validatorsfile) {
                    $this->readValidatorsFile($validatorsfile);
                }
            }
            
            $rulesfile = __DIR__."/../../uptodate_data/php/frameworks/wordpress/rules.json";
            
            if (is_array($this->customFile)) {
                if (!in_array($rulesfile, $this->customFile, true)) {
                    $this->readCustomFile($rulesfile);
                }
            } else {
                if ($this->customFile !== $rulesfile) {
                    $this->readCustomFile($rulesfile);
                }
            }
        }
        
        
        if (is_array($this->frameworks) && in_array("symfony", $this->frameworks, true)) {
            $sanitizersfile = __DIR__."/../../uptodate_data/php/frameworks/symfony/sanitizers.json";
            
            if (is_array($this->sanitizersFile)) {
                if (!in_array($sanitizersfile, $this->sanitizersFile, true)) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            } else {
                if ($this->sanitizersFile !== $sanitizersfile) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            }
            
            $sinksfile = __DIR__."/../../uptodate_data/php/frameworks/symfony/sinks.json";
            
            if (is_array($this->sinksFile)) {
                if (!in_array($sinksfile, $this->sinksFile, true)) {
                    $this->readSinksFile($sinksfile);
                }
            } else {
                if ($this->sinksFile !== $sinksfile) {
                    $this->readSinksFile($sinksfile);
                }
            }
            
            $sourcesfile = __DIR__."/../../uptodate_data/php/frameworks/symfony/sources.json";
            
            if (is_array($this->sourcesFile)) {
                if (!in_array($sourcesfile, $this->sourcesFile, true)) {
                    $this->readSourcesFile($sourcesfile);
                }
            } else {
                if ($this->sourcesFile !== $sourcesfile) {
                    $this->readSourcesFile($sourcesfile);
                }
            }
            
            $validatorsfile = __DIR__."/../../uptodate_data/php/frameworks/symfony/validators.json";
            
            if (is_array($this->validatorsFile)) {
                if (!in_array($validatorsfile, $this->validatorsFile, true)) {
                    $this->readValidatorsFile($validatorsfile);
                }
            } else {
                if ($this->validatorsFile !== $validatorsfile) {
                    $this->readValidatorsFile($validatorsfile);
                }
            }
            
            $rulesfile = __DIR__."/../../uptodate_data/php/frameworks/symfony/rules.json";
            
            if (is_array($this->customFile)) {
                if (!in_array($rulesfile, $this->customFile, true)) {
                    $this->readCustomFile($rulesfile);
                }
            } else {
                if ($this->customFile !== $rulesfile) {
                    $this->readCustomFile($rulesfile);
                }
            }
        }
        
        
        if (is_array($this->frameworks) && in_array("prestashop", $this->frameworks, true)) {
            $sanitizersfile = __DIR__."/../../uptodate_data/php/frameworks/prestashop/sanitizers.json";
            
            if (is_array($this->sanitizersFile)) {
                if (!in_array($sanitizersfile, $this->sanitizersFile, true)) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            } else {
                if ($this->sanitizersFile !== $sanitizersfile) {
                    $this->readSanitizersFile($sanitizersfile);
                }
            }
            
            $sinksfile = __DIR__."/../../uptodate_data/php/frameworks/prestashop/sinks.json";
            
            if (is_array($this->sinksFile)) {
                if (!in_array($sinksfile, $this->sinksFile, true)) {
                    $this->readSinksFile($sinksfile);
                }
            } else {
                if ($this->sinksFile !== $sinksfile) {
                    $this->readSinksFile($sinksfile);
                }
            }
            
            $sourcesfile = __DIR__."/../../uptodate_data/php/frameworks/prestashop/sources.json";
            
            if (is_array($this->sourcesFile)) {
                if (!in_array($sourcesfile, $this->sourcesFile, true)) {
                    $this->readSourcesFile($sourcesfile);
                }
            } else {
                if ($this->sourcesFile !== $sourcesfile) {
                    $this->readSourcesFile($sourcesfile);
                }
            }
            
            $validatorsfile = __DIR__."/../../uptodate_data/php/frameworks/prestashop/validators.json";
            
            if (is_array($this->validatorsFile)) {
                if (!in_array($validatorsfile, $this->validatorsFile, true)) {
                    $this->readValidatorsFile($validatorsfile);
                }
            } else {
                if ($this->validatorsFile !== $validatorsfile) {
                    $this->readValidatorsFile($validatorsfile);
                }
            }
            
            $rulesfile = __DIR__."/../../uptodate_data/php/frameworks/prestashop/rules.json";
            
            if (is_array($this->customFile)) {
                if (!in_array($rulesfile, $this->customFile, true)) {
                    $this->readCustomFile($rulesfile);
                }
            } else {
                if ($this->customFile !== $rulesfile) {
                    $this->readCustomFile($rulesfile);
                }
            }
        }
    }

    public function readSanitizers()
    {
        if (is_null($this->sanitizersFile)) {
            $this->readSanitizersFile(__DIR__."/../../uptodate_data/php/sanitizers.json");
            $this->readSanitizersFile(__DIR__."/../../uptodate_data/js/sanitizers.json");
        } else {
            if (is_array($this->sanitizersFile)) {
                foreach ($this->sanitizersFile as $file) {
                    $this->readSanitizersFile($file);
                }
            } else {
                $this->readSanitizersFile($this->sanitizersFile);
            }
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
                                                    || $parameter-> {'conditions'} === "taint"
                                                            || $parameter-> {'conditions'} === "sanitize")) {
                                    if ($parameter-> {'conditions'} === "equals") {
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

                    $this->sanitizers[] = $mySanitizer;
                }
            } else {
                Utils::printError(Lang::FORMAT_SANITIZERS);
            }
        }
    }

    public function readSinks()
    {
        if (is_null($this->sinksFile)) {
            $this->readSinksFile(__DIR__."/../../uptodate_data/php/sinks.json");
            $this->readSinksFile(__DIR__."/../../uptodate_data/js/sinks.json");
        } else {
            if (is_array($this->sinksFile)) {
                foreach ($this->sinksFile as $file) {
                    $this->readSinksFile($file);
                }
            } else {
                $this->readSinksFile($this->sinksFile);
            }
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

                    $this->sinks[] = $mySink;
                }
            } else {
                Utils::printError(Lang::FORMAT_SINKS);
            }
        }
    }

    public function readSources()
    {
        if (is_null($this->sourcesFile)) {
            $this->readSourcesFile(__DIR__."/../../uptodate_data/php/sources.json");
            $this->readSourcesFile(__DIR__."/../../uptodate_data/js/sources.json");
        } else {
            if (is_array($this->sourcesFile)) {
                foreach ($this->sourcesFile as $file) {
                    $this->readSourcesFile($file);
                }
            } else {
                $this->readSourcesFile($this->sourcesFile);
            }
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

                    if (isset($source-> {'array_index'})) {
                        $arr = array($source-> {'array_index'} => false);
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

                    $this->sources[] = $mySource;
                }
            } else {
                Utils::printError(Lang::FORMAT_SOURCES);
            }
        }
    }

    public function readValidators()
    {
        if (is_null($this->validatorsFile)) {
            $this->readValidatorsFile(__DIR__."/../../uptodate_data/php/validators.json");
            $this->readValidatorsFile(__DIR__."/../../uptodate_data/js/validators.json");
        } else {
            if (is_array($this->validatorsFile)) {
                foreach ($this->validatorsFile as $file) {
                    $this->readValidatorsFile($file);
                }
            } else {
                $this->readValidatorsFile($this->validatorsFile);
            }
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

                    $myValidator = new MyValidator($name, $language);

                    if (isset($validator-> {'parameters'})) {
                        $parameters = $validator-> {'parameters'};
                        foreach ($parameters as $parameter) {
                            if (isset($parameter-> {'id'}) && isset($parameter-> {'conditions'})) {
                                if (is_int($parameter-> {'id'})
                                            && ($parameter-> {'conditions'} === "not_tainted"
                                                    || $parameter-> {'conditions'} === "array_not_tainted"
                                                            || $parameter-> {'conditions'} === "valid"
                                                                    || $parameter-> {'conditions'} === "equals")) {
                                    if ($parameter-> {'conditions'} === "equals") {
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

                    $this->validators[] = $myValidator;
                }
            } else {
                Utils::printError(Lang::FORMAT_VALIDATORS);
            }
        }
    }

    public function readResolvedIncludes()
    {
        if (!is_null($this->resolvedIncludes)) {
            if (!file_exists($this->resolvedIncludes)) {
                Utils::printError(
                    Lang::FILE_DOESNT_EXIST." (".Utils::encodeCharacters($this->resolvedIncludes).")"
                );
            }

            $outputJson = file_get_contents($this->resolvedIncludes);
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
                        $this->resolvedIncludesAnalysis[] = $myInclude;
                    }
                }
            } else {
                Utils::printError(Lang::FORMAT_INCLUDES);
            }
        }
    }
    
    public function readFalsePositives()
    {
        if (!is_null($this->falsePositives)) {
            if (is_string($this->falsePositives)) {
                $this->readFalsePositivesFile($this->falsePositives);
            } elseif (is_array($this->falsePositives)) {
                foreach ($this->falsePositives as $falsePositive) {
                    if (!isset($falsePositive["vuln_id"])) {
                        Utils::printError(Lang::FORMAT_FALSE_POSITIVES);
                    }

                    $vulnId = $falsePositive["vuln_id"];

                    $myVuln = new MyVuln($vulnId);
                    $this->falsePositivesAnalysis[] = $myVuln;
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
                    $this->falsePositivesAnalysis[] = $myVuln;
                }
            } else {
                Utils::printError(Lang::FORMAT_FALSE_POSITIVES);
            }
        }
    }

    public function readExcludes()
    {
        if (!is_null($this->excludes)) {
            if (is_string($this->excludes)) {
                $this->readExcludesFile($this->excludes);
            } elseif (is_array($this->excludes)) {
                if (isset($this->excludes["exclude_files"])) {
                    $excludeFiles = $this->excludes["exclude_files"];
                    foreach ($excludeFiles as $excludeFile) {
                        if (realpath($excludeFile)) {
                            $this->excludesFilesAnalysis[] = realpath($excludeFile);
                        }
                    }
                }

                if (isset($this->excludes["exclude_folders"])) {
                    $excludeFolders = $this->excludes["exclude_folders"];
                    foreach ($excludeFolders as $excludeFolder) {
                        if (realpath($excludeFolder)) {
                            $this->excludesFoldersAnalysis[] = realpath($excludeFolder);
                        }
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

            if (isset($parsedJson-> {'exclude_files'})) {
                $excludeFiles = $parsedJson-> {'exclude_files'};
                foreach ($excludeFiles as $excludeFile) {
                    if (realpath($excludeFile)) {
                        $this->excludesFilesAnalysis[] = realpath($excludeFile);
                    }
                }
            }

            if (isset($parsedJson-> {'exclude_folders'})) {
                $excludeFolders = $parsedJson-> {'exclude_folders'};
                foreach ($excludeFolders as $excludeFolder) {
                    if (realpath($excludeFolder)) {
                        $this->excludesFoldersAnalysis[] = realpath($excludeFolder);
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

            if (isset($parsedJson-> {'include_files'})) {
                $includeFiles = $parsedJson-> {'include_files'};
                foreach ($includeFiles as $includeFile) {
                    if (realpath($includeFile)) {
                        $this->includesFilesAnalysis[] = realpath($includeFile);
                    }
                }
            }

            if (isset($parsedJson-> {'include_folders'})) {
                $includeFolders = $parsedJson-> {'include_folders'};
                foreach ($includeFolders as $includeFolder) {
                    if (realpath($includeFolder)) {
                        $this->includesFoldersAnalysis[] = realpath($includeFolder);
                    }
                }
            }
        }
    }

    public function readIncludes()
    {
        if (!is_null($this->includes)) {
            if (is_string($this->includes)) {
                $this->readIncludesFile($this->includes);
            } elseif (is_array($this->includes)) {
                if (isset($this->includes["include_files"])) {
                    $includeFiles = $this->includes["include_files"];
                    foreach ($includeFiles as $includeFile) {
                        if (realpath($includeFile)) {
                            $this->includesFilesAnalysis[] = realpath($includeFile);
                        }
                    }
                }

                if (isset($this->includes["include_folders"])) {
                    $includeFolders = $this->includes["include_folders"];
                    foreach ($includeFolders as $includeFolder) {
                        if (realpath($includeFolder)) {
                            $this->includesFoldersAnalysis[] = realpath($includeFolder);
                        }
                    }
                }
            }
        }
    }
    
    public function readCustomRules()
    {
        if (is_null($this->customFile)) {
            $this->readCustomFile(__DIR__."/../../uptodate_data/php/rules.json");
            $this->readCustomFile(__DIR__."/../../uptodate_data/js/rules.json");
        } else {
            if (is_array($this->customFile)) {
                foreach ($this->customFile as $file) {
                    $this->readCustomFile($file);
                }
            } else {
                $this->readCustomFile($this->customFile);
            }
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
                                                    
                                                if (is_int($parameter-> {'id'})) {
                                                    $myCustomFunction->addParameter(
                                                        $parameter-> {'id'},
                                                        $validbydefault,
                                                        $fixed,
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
                                                    
                                            $myCustomFunction->addParameter(
                                                $parameter-> {'id'},
                                                $validbydefault,
                                                $fixed,
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

                        $this->customRules[] = $myCustom;
                    }
                }
            }
        }
    }
}
