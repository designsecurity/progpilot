<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot;

class Lang
{
    const GLOBAL_ERROR = "Progpilot error\n";
    const GLOBAL_CHECK_CONFIG = "Check your configuration file :\n";
    const GLOBAL_INPUT = "Check files and folders that have to be analyzed :\n";

    const FILE_AND_CODE_ARE_NULL =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_INPUT.
        "Code or file must be specified before running the parser";

    const FILE_DOESNT_EXIST =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "The file doesn't exist";
        
    const FORMAT_SANITIZERS =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Format of sanitizers file is incorrect";
    
    const FORMAT_SINKS =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Format of sinks file is incorrect";
   
    const FORMAT_SOURCES =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Format of sources file is incorrect";
    
    const FORMAT_INCLUDES =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Format of includess file is incorrect";
    
    const FORMAT_VALIDATORS =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Format of validators file is incorrect";
    
    const FORMAT_FALSE_POSITIVES =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Format of false positives file is incorrect";
    
    const FORMAT_INCLUDE_FILES =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Format of include_file file is incorrect";
    
    const FORMAT_EXCLUDE_FILES =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Format of exclude file file is incorrect";

    const UNABLE_TO_PARSER_YAML =
        Lang::GLOBAL_ERROR.
        Lang::GLOBAL_CHECK_CONFIG.
        "Unable to parse the YAML file configuration";

    const UNABLE_TO_CREATE_WORKSPACE =
            Lang::GLOBAL_ERROR.
            "Unable to create the workspace directory, do you have the correct permissions on filesystem?";
        
    const COMMAND_LINE_ARG =
        "Usage of progpilot : php progpilot.phar [--configuration path_to_config_file.yml] ".
        "[files and folders (file1.php file2.php ...)]";
        
    const PARSER_ERROR = "Exception raised during parsing.\nMessage: ";
    const PROGPILOT_ARG_DESC = "Progpilot a static analysis tool for security purposes";
    const FILES_ARG_DESC = "Files to be analyzed";
    const CONFIG_ARG_DESC = "Read configuration from config file";
    const MAX_TIME_EXCEEDED = "Max time execution exceeded (you can increase the value with ".
        "\$context->setMaxFileAnalysisDuration())";
    const MAX_DEFS_EXCEEDED = "Max definitions exceeded (you can increase the value with ".
        "\$context->setMaxDefinitions())";
    const MAX_SIZE_EXCEEDED = "Max size of file exceeded (you can increase the value with ".
        "\$context->setMaxFileSize())";
    const MAX_MEMORY_EXCEEDED = "Memory threshold reached, some references will be released ".
        "(increasing execution time)";
    const CANNOT_SET_MEMORY = "Cannot set php memory_limit to ";
}
