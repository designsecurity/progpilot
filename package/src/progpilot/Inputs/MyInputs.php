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

class MyInputs extends MyInputsInternalApi
{
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
}
