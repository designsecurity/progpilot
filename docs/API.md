# progpilot API

*$obj_context* is an instance of class *\progpilot\Context*

## Inputs
***
- $obj_context->inputs->setFolder($folder);  
- $obj_context->inputs->setFile($file);  
where *file* is the path to file which exists on the disk, example *./myfile.php*
- $obj_context->inputs->setCode($code);  
where *code* is the contents/code of a file, for example *$code = file_get_contents("./myfile.php");*  
if both options are set when the analyze is launched the priority is given to analyze the $file.  
if all options are set when the analyze is launched the priority is given to analyze the $folder.  
To retrieve the value of $file, $code and $folder use these methods:
- $obj_context->inputs->getFile();
- $obj_context->inputs->getCode();
- $obj_context->inputs->getFolder();
***

***
- $obj_context->inputs->setDev($bool);  
If you want to use security data relative to development of progpilot (default is *false*)
***

***
- $obj_context->inputs->addSources($files_sources);
- $obj_context->inputs->setSources($files_sources);
- $obj_context->inputs->addSinks($files_sinks);
- $obj_context->inputs->setSinks($files_sinks);
- $obj_context->inputs->addSanitizers($files_sanitizers);
- $obj_context->inputs->setSanitizers($files_sanitizers);
- $obj_context->inputs->addValidators($files_validators);
- $obj_context->inputs->setValidators($files_validators);
- $obj_context->inputs->addCustomRules($files_custom);
- $obj_context->inputs->setCustomRules($files_custom);
- $obj_context->inputs->getCustomRules();
- $obj_context->inputs->getSources();
- $obj_context->inputs->getSinks();
- $obj_context->inputs->getSanitizers();
- $obj_context->inputs->getValidators();  
These methods are mainly explained in the chapter [**specify an analyze**](./SPECIFY_ANALYSIS.md) and  [**customize an analyze**](./CUSTOM_ANALYSIS.md)   
If a file (sources, sinks, sanitizers, validators, custom rules) is not specified [the default file](../package/src/uptodate_data) will be used.
***

***
- $obj_context->inputs->setResolvedIncludes($mixed);  
This function is explained in the chapter about [**included files**](./INCLUDES.md)
- $obj_context->inputs->setFalsePositives($mixed);  
These functions are explained in the chapter about [**handling false positives**](./FALSE_POSITIVES.md)
***

***
- $obj_context->inputs->setInclusions($mixed);  
- $obj_context->inputs->setExclusions($mixed);  
For include or exclude files and folders during the analysis, see an [**example here**](./../projects/tests/exclude_files.json) with a json file configuration and an [**example here**](./../projects/tests/run_exclude_files.php) with a php array.
***

## Outputs
***
- $obj_context->outputs->setWriteIncludeFailures($bool);
- $obj_context->outputs->setIncludeFailuresFile($file);  
These functions are explained in the chapter about [**included files**](./INCLUDES.md)
- $obj_context->outputs->getAst();
- $obj_context->outputs->getCfg();
- $obj_context->outputs->getCallGraph();
- $obj_context->outputs->taintedFlow($bool);  
*true* or *false* if you want to print the complete flow of assignments that taints a variable used by a sink function (default is *false*: only the last tainted variable is printed).
- $obj_context->outputs->setOnAddResult($func);  
for each vulnerability found by progpilot the function *func* will be called with the vulnerability as argument.
- $obj_context->outputs->getCountAnalyzedFiles();  
print the number of files analyzed (it does not count the included files (with *include()* for example in PHP)).
***

## Options
***
- $obj_context->setMaxDefinitions($nb);  
to prevent memory exhaustion you could limit the number of definitions by file during the analysis (default is *3000*)
- $obj_context->setMaxFileAnalysisDuration($time_sec);  
max execution time by file for some steps of the analysis (default is *10 seconds*)
- $obj_context->setMaxFileSize($size_bytes);  
do not analyze file that are larger than this defined size (default is 500 000 bytes)
- $obj_context->setDebugMode($bool);  
*true* if you want to output warnings during the analysis, default is *false*
- $obj_context->setPrettyPrint($bool);  
*true* if you want to pretty print the JSON output of standalone progpilot application, default is *true*
- $obj_context->setAnalyzeIncludes($bool);  
*true* or *false* if you want to analyze included files, default is *true*
- $obj_context->setConfiguration($config);  
you can use an yaml file to specify the configuration of analysis, see an [**example here**](./../projects/example_config/configuration.yml).
These rules are explained in the chapter [**customize an analyze**](./CUSTOM_ANALYSIS.md)
***
