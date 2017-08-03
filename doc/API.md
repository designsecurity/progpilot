# progpilot API

*$obj_context* is an instance of class *\progpilot\Context*

## Inputs
***
- $obj_context->inputs->set_file($file);  
where *file* is the path to file which exists on the disk, example *./myfile.php*
- $obj_context->inputs->set_code($code);  
where *code* is the contents/code of a file, for example *$code = file_get_contents("./myfile.php");*  
if both options are set when the analyze is launched the priority is given to analyze the $file.  
To retrieve the value of $file and $code use these methods :
- $obj_context->inputs->get_file();
- $obj_context->inputs->get_code();
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
- $obj_context->inputs->set_includes($file_includes);  
If you want to specify the location of files to be included during the analysis 
***

## Outputs
***
- $obj_context->outputs->resolve_includes($bool);
- $obj_context->outputs->resolve_includes_file($file);  
If you define *$bool* to *true* and a *$file*, all the arguments of includes functions (like include()) when the analysis couldn't resolved them as existing files on the disk will be written into the *$file*. Next you can specify locations of files and pass the corrected *$file* as an argument of *$obj_context->inputs->set_includes($file);*
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
***
