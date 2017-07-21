# progpilot API

*$obj_context* is an instance of class *\progpilot\Context*

## Inputs
***
- $obj_context->inputs->set_file($file);  
where *file* is the path to file which exists on the disk, example *./myfile.php*
- $obj_context->inputs->set_code($code);  
where *code* is the contents/code of a file, for example *$code = file_get_contents("./myfile.php");*  
if both options are set when the analyze is launched the priority is given to analyze the $file.  
To retrieve the value of $file and $code use theses methods :
- $obj_context->inputs->get_file();
- $obj_context->inputs->get_code();
***

***
- $obj_context->inputs->set_sources($file_sources);
- $obj_context->inputs->set_sinks($file_sinks);
- $obj_context->inputs->set_sanitizers($file_sanitizers);
- $obj_context->inputs->get_sources();
- $obj_context->inputs->get_sinks();
- $obj_context->inputs->get_sanitizers();  
Theses methods are mainly explained in the chapter [**specify an analyze**](./SPECIFY_ANALYZE.md)
***
