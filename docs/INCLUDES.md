# Resolve Includes

Locations of included files could not be resolved due to the fact that are dynamics in most cases.  
For example, Progpilot successfully include *myfile.php* when it finds a static include like this one :
```php
include("myfile.php");
```
But it will fail for complex includes like this one :
```php
$dir = "/files/";
$suf = 2+2;
include($dir."myfile$suf.php");
```

To bypass this limitation you can use these functions :
- $obj_context->outputs->resolveIncludes($bool);
- $obj_context->outputs->resolveIncludesFile($file);  
When *$bool* set to *true* and *$file* set to *resolve_includes.json* for example

For each include not resolved an entry will be printed in the *$file* with the location of the include function (file, line, column) :
```javascript
{"includes_not_resolved":[["/home/dev/projects/tests/includes/simple5.php",11,11]]}
```
Next you can produce a *resolved_includes.json* file with the good value of each include function :
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
Run again Progpilot and this time when it finds an *include()* function in *line 11*, *column 11* in the file */home/dev/projects/tests/includes/simple5.php* it will be the file */home/dev/projects/tests/includes/simple5_include.php* that will be analyzed.
