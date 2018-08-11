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
To retrieve the value of $file, $code and $folder use these methods :
- $obj_context->inputs->getFile();
- $obj_context->inputs->getCode();
- $obj_context->inputs->getFolder();
***

***
- $obj_context->inputs->setLanguages($array);  
Languages you want to analyze (["php", "js"] but js is in development), default is *["php"]*
- $obj_context->inputs->setFrameworks($array);  
Frameworks you want to analyze (default is *["suitecrm", "codeigniter"]*)
- $obj_context->inputs->setDev($bool);  
If you want to use security data relative to development of progpilot (default is *false*)
***

***
- $obj_context->inputs->setSources($file_sources);
- $obj_context->inputs->setSinks($file_sinks);
- $obj_context->inputs->setSanitizers($file_sanitizers);
- $obj_context->inputs->setValidators($file_validators);
- $obj_context->inputs->setCustomRules($file_custom);
- $obj_context->inputs->getCustomRules();
- $obj_context->inputs->getSources();
- $obj_context->inputs->getSinks();
- $obj_context->inputs->getSanitizers();
- $obj_context->inputs->getValidators();  
These methods are mainly explained in the chapter [**specify an analyze**](./SPECIFY_ANALYSIS.md) and  [**customize an analyze**](./CUSTOM_ANALYSIS.md)   
If a file (sources, sinks, sanitizers, validators, custom rules) is not specified [the default file](../package/src/uptodate_data) will be used.
***

***
- $obj_context->inputs->setResolvedIncludes($file_includes);  
This function is explained in the chapter about [**included files**](./INCLUDES.md)
- $obj_context->inputs->setFalsePositives($file_false_positives);  
This function is explained in the chapter about [**handling false positives**](./FALSE_POSITIVES.md)
***

***
- $obj_context->inputs->setIncludeFiles($file);  
- $obj_context->inputs->setExcludeFiles($file);  
For include or exclude files and folders during the analysis, see an [**example here**](./../projects/tests/exclude_files.json).
***

## Outputs
***
- $obj_context->outputs->resolveIncludes($bool);
- $obj_context->outputs->resolveIncludesFile($file);  
These functions are explained in the chapter about [**included files**](./INCLUDES.md)
- $obj_context->outputs->getAst();
- $obj_context->outputs->getCfg();
- $obj_context->outputs->getCallGraph();
- $obj_context->outputs->taintedFlow($bool);  
*true* or *false* if you want to print the complete flow of assignments that taints a variable used by a sink function (default is *false* : only the last tainted variable is printed).
***

## Options
***
- $obj_context->setLimitDefs($nb);  
to prevent memory exhaustion you could limit the number of definitions by file during the data flow analysis (default is *3000*)
- $obj_context->setLimitTime($time_sec);  
max execution time by file for the first steps of the analysis, the analysis may take much longer in the last steps, so it's recommanded to specify a low value (default is *10 seconds*)
- $obj_context->setLimitSize($size_bytes);  
do not analyze file that are larger than this defined size (default is 500 000 bytes)
- $obj_context->setPrintFile($bool);  
*true* if you want to print the name of files analyzed by progpilot, default is *false*
- $obj_context->setPrintWarning($bool);  
*true* if you want to print warnings during the analysis, default is *false*
- $obj_context->setPrettyPrint($bool);  
*true* if you want to pretty print the JSON output of standalone progpilot application, default is *true*
- $obj_context->setAnalyzeFunctions($bool);  
*true* if you want to analyze all functions (*false* only *main function* is analyzed), default is *true*
- $obj_context->setAnalyzeIncludes($bool);  
*true* or *false* if you want to analyze included files, default is *true*
- $obj_context->setConfiguration($config);  
you can use an yaml file to specify the configuration of analysis, see an [**example here**](./../projects/example_config/configuration.yml).
- $obj_context->setAnalyzeHardRules($bool);  
If you want to check custom rules that can take a lot a time (default is false)  
These rules are explained in the chapter [**customize an analyze**](./CUSTOM_ANALYSIS.md)
***
