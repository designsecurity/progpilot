# Resolve Includes

Location of included files could not be resolved due to the fact that are dynamics in most cases.  
For example, Progpilot successfully include *myfile.php* when it finds static include like this one :
```php
include("myfile.php");
```
But it will fail for this kind of includes :
```php
$dir = "/files/";
include($dir."myfile.php");
```

To bypass this limitation you can use these functions :
- $obj_context->outputs->resolve_includes($bool);
- $obj_context->outputs->resolve_includes_file($file);  
When *$bool* set to *true* and *$file* set to *resolve_includes.json* for example

For each include not resolved an entry will be printed into *resolve_includes.json* with the location of the include function (file, line, column) :
```javascript
{"includes_not_resolved":[["./tests/includes/simple5.php",11,11]]}
```
Next you can produce a *resolved_includes.json* file with the good value of each include function for example :
```javascript
{
    "includes":
        [
            {
                "line":11,
                "column":11,
                "source_file":"./tests/includes/simple5.php",
                "value":"simple5_include.php"
            }
        ]
}
```
And pass this file to $context->inputs->set_includes("./tests/includes/resolved_includes.json");
