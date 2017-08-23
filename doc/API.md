# progpilot API

*$obj_context* is an instance of class *\progpilot\Context*

## Inputs
***
- $obj_context->inputs->set_folder($folder);  
- $obj_context->inputs->set_file($file);  
where *file* is the path to file which exists on the disk, example *./myfile.php*
- $obj_context->inputs->set_code($code);  
where *code* is the contents/code of a file, for example *$code = file_get_contents("./myfile.php");*  
if both options are set when the analyze is launched the priority is given to analyze the $file.  
if all options are set when the analyze is launched the priority is given to analyze the $folder.  
To retrieve the value of $file, $code and $folder use these methods :
- $obj_context->inputs->get_file();
- $obj_context->inputs->get_code();
- $obj_context->inputs->get_folder();
***

***
- $obj_context->inputs->set_sources($file_sources);
- $obj_context->inputs->set_sinks($file_sinks);
- $obj_context->inputs->set_sanitizers($file_sanitizers);
- $obj_context->inputs->set_validators($file_validators);
- $obj_context->inputs->get_sources();
- $obj_context->inputs->get_sinks();
- $obj_context->inputs->get_sanitizers();
- $obj_context->inputs->get_validators();  
These methods are mainly explained in the chapter [**specify an analyze**](./SPECIFY_ANALYZE.md)
***

***
- $obj_context->inputs->set_resolved_includes($file_includes);  
This function is explained in the chapter about [**included files**](./INCLUDES.md)
- $obj_context->inputs->set_false_positives($file_false_positives);  
This function is explained in the chapter about [**handling false positives**](./FALSE_POSITIVES.md)
***

***
- $obj_context->inputs->set_include_files($file);  
- $obj_context->inputs->set_exclude_files($file);  
For include or exclude files and folders to be analyzed, see an [**example here**](./../projects/tests/exclude_files.json).
***

## Outputs
***
- $obj_context->outputs->resolve_includes($bool);
- $obj_context->outputs->resolve_includes_file($file);  
These functions are explained in the chapter about [**included files**](./INCLUDES.md)
- $obj_context->outputs->get_ast();
- $obj_context->outputs->get_cfg();
- $obj_context->outputs->get_callgraph();
- $obj_context->outputs->tainted_flow($bool);  
*true* or *false* if you want to print the complete flow of assignments that taints a variable used by a sink function (default is *false* : only the last tainted variable is printed).
***

## Options
***
- $obj_context->set_analyze_js($bool);  
*true* or *false* if you want to analyze javascript (in development), default is *true*
- $obj_context->set_analyze_includes($bool);  
*true* or *false* if you want to analyze included files, default is *true*
- $obj_context->set_configuration($config);  
you can use an yaml file to specify the configuration of analysis, see an [**example here**](./../projects/example_config/configuration.yml).
***
