# Resolve Includes

Locations of included files may not be resolved due to the fact they are dynamics in most cases.  
For example, Progpilot successfully include *myfile.php* when it finds a static include like this one:
```php
include("myfile.php");
```
But it will fail for complex includes like this one:
```php
$dir = "/files/";
$suf = 2+2;
include($dir."myfile$suf.php");
```

To bypass this limitation use these functions:
- $obj_context->outputs->setWriteIncludeFailures($bool);
- $obj_context->outputs->setIncludeFailuresFile($file);  
When *$bool* set to *true* and *$file* set to *resolve_includes.json* for example

For each include not resolved an entry will be printed in the *$file* with the location of the include function (file, line, column):
```javascript
{"include_failures":[["/home/dev/projects/tests/includes/simple5.php",11,11]]}
```
Next create a *resolved_includes.json* file with the good value for each include function call:
```javascript
{
    "includes":
        [
            {
                "line":11,
                "column":11,
                "source_file":"/home/dev/projects/tests/includes/simple5.php",
                "value":"/home/dev/projects/tests/includes/simple5_include.php"
            }
        ]
}
```
And pass this file to **$context->inputs->setResolvedIncludes("resolved_includes.json");**  
Run again Progpilot and this time when it finds an *include()* function in *line 11*, *column 11* in the file */home/dev/projects/tests/includes/simple5.php*, the file */home/dev/projects/tests/includes/simple5_include.php* will be analyzed.
