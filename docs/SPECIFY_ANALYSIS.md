# Specify an analysis

You can specify the way of vulnerabilities are detected by playing with sources, sinks, sanitizers and validators :

- **sources** : the untrusted variables that will be initially tainted during the analysis.
- **sinks** : the sensitives functions that could lead to vulnerabilities.
- **sanitizers** : the functions that transform tainted values into safe values.
- **validators** : the functions that valid tainted values without transforming them into safe value.

## Configure sources
- $obj_context->inputs->setSources($file_sources);
- $obj_context->inputs->getSources();

Where *$file_sources* is a json file like below :
```javascript
{
    "sources": [
        {"name": "_GET", "is_array": true, "language": "php"},
        {"name": "_POST", "is_array": true, "language": "php"},
        {"name": "_COOKIE", "is_array": true, "language": "php"},
        {"name": "shell_exec", "is_function": true, "language": "php"},
        {"name": "vardev", "is_array": true, "array_index": "tainted", "language": "php", "type": "for dev purposes"},
        {"name": "exec", "is_function": true, "parameters": [{"id": 2, "is_array": true, "array_index": 0}], "language": "php"}
        ]
}
```
*Name* and *language* properties are mandatory.  
The value of *name* property must be a function (the source will be the return of this function) or a variable.  
You can define a return function or a method as a source when *is_function* property is set to true.  
To specify a method add *[instanceof](#instanceof-property)* property with the class name value to which the method belongs.  
For defining a property as a source just add *instanceof* like for a method.  
If you want to define all elements of an array as a source (like for well-known *_GET*, *_POST* and *_COOKIE* variables) use *is_array* property set to true.  
If you want to define only one element of an array as a source add *array_index* property with index name as value.  
If you want to define one parameter of a function as a source use *parameters* property.

## Configure sanitizers
- $obj_context->inputs->setSanitizers($file_sanitizers);
- $obj_context->inputs->getSanitizers();

Where *$file_sanitizers* is a json file like below :
```javascript
{
    "sanitizers": [
        {"name": "filter_var",  "language": "php", "parameters": 
            [
                {"id": 2, "conditions": "equals", "values": 
                    [
                        {"value" : "FILTER_SANITIZE_ENCODED", "prevent" : ["xss"]},
                        {"value" : "FILTER_SANITIZE_MAGIC_QUOTES", "prevent" : ["command_injection", "sql_injection"]},
                        {"value" : "FILTER_SANITIZE_SPECIAL_CHARS", "prevent" : ["xss"]},
                        {"value" : "FILTER_SANITIZE_FULL_SPECIAL_CHARS", "prevent" : ["xss"]},
                        {"value" : "FILTER_SANITIZE_STRING", "prevent" : ["xss"]},
                        {"value" : "FILTER_SANITIZE_STRIPPED", "prevent" : ["xss"]}
                    ]}
            ]
        },
        {"name": "addslashes", "language": "php", "prevent": ["sql_injection", "command_injection"]}
        ]
}
```
*Name*, *language* properties are mandatory.  
The value of *name* property must be a function.  
To specify a method add *[instanceof](#instanceof-property)* property with the class name value to which the method belongs.  
The value of *[prevent](#prevent-property)* property should match with an *attack* defined in the sinks file.  
You can add conditions to parameters of your sanitizer function :  
- **taint** : the corresponding argument will be considered as the expected tainted variable. During the analysis, if this argument is tainted the return of the function will be tainted and sanitized, without specifying  a *taint* property the return of the function will be tainted and sanitized if any of the arguments is tainted.
- **equals** : the argument must be equals to the specified string.

## Configure sinks
- $obj_context->inputs->setSinks($file_sinks);
- $obj_context->inputs->getSinks();

Where *$file_sinks* is a json file like below :
```javascript
{
    "sinks": [
        {"name": "echo", "language": "php", "attack": "xss", "cwe": "CWE_79"},
        {"name": "print", "language": "php", "attack": "xss", "cwe": "CWE_79"},
        {"name": "printf", "language": "php", "attack": "xss", "cwe": "CWE_79"},
        {"name": "include", "language": "php", "attack": "file_inclusion", "cwe": "CWE_98"},
        {"name": "eval", "language": "php", "attack": "code_injection", "cwe": "CWE_95"},
        {"name": "system", "language": "php", "attack": "command_injection", "cwe": "CWE_78"},        
        {"name": "ldap_search", "parameters": [{"id": 3}], "language": "php", "attack": "ldap_injection", "cwe": "CWE_90"},
        {"name": "mysql_query", "language": "php", "attack": "sql_injection", "cwe": "CWE_89"},
        {"name": "prepare", "instanceof": "mysql_connect", "language": "php", "attack": "sql_injection", "cwe": "CWE_89"}
        ]
}
```
*Name*, *language*, *attack* properties are mandatory.  
The value of *name* property must be a function or a method.  
To specify a method add *[instanceof](#instanceof-property)* property with the class name value to which the method belongs.  
You can also specify which parameters of a function is a sink with *parameters* property.  
The *attack* will be annihilate if a source is sanitized by a sanitizer where *prevent* property equals *attack* property.  
The *parameter* object could take a *conditions* parameter with these values :
- **QUOTES** : the tainted variable must be embedded into quotes if not it's a vulnerability otherwise the variable must be sanitized with a function that encode quotes.  
Global conditions could be applied :
- **QUOTES_HTML** : if the tainted variable is inside an html tag it's a vulnerability if the variable is embedded into quotes and quotes are not sanitized or if the variable is not embedded into quotes.

## Configure validators
- $obj_context->inputs->setValidators($file_validators);
- $obj_context->inputs->getValidators();

Where *$file_validators* is a json file like below :
```javascript
{
    "validators": [
        {"name": "in_array", "language": "php", "parameters": 
            [
                {"id": 1, "conditions": "valid"},
                {"id": 2, "conditions": "array_not_tainted"}
            ]
        },
        {"name": "isValidNumber", "instanceof": "ESAPI->validator", "language": "php", "parameters": 
            [
                {"id": 2, "conditions": "valid"}
            ]
        },
        {"name": "filter_var",  "language": "php", "parameters": 
            [
                {"id": 1, "conditions": "valid"},
                {"id": 2, "conditions": "equals", "values": 
                    [
                        {"value" : "FILTER_VALIDATE_BOOLEAN"},
                        {"value" : "FILTER_VALIDATE_FLOAT"},
                        {"value" : "FILTER_VALIDATE_INT"},
                        {"value" : "FILTER_VALIDATE_IP"},
                        {"value" : "FILTER_VALIDATE_MAC"},
                        {"value" : "FILTER_VALIDATE_URL"}
                    ]}
            ]
        }
        ]
}
```
*Name*, *language*, properties are mandatory.  
The value of *name* property must be a function or a method.  
To specify a method add *[instanceof](#instanceof-property)* property with the class name value to which the method belongs.  
You can add conditions to parameters of your validator function :  
- **valid** : the corresponding argument will be considered as safe if others conditions are respected.
- **not_tainted** : the argument is not tainted.
- **array_not_tainted** : the argument is an array that not contains any tainted values.
- **equals** : the argument must be equals to the specified string.

For the following *in_array* call : 
```php
$tainted = $_GET["p"];

$legal_table = array("safe1", "safe2");
if (in_array($tainted, $legal_table, true)) 
{
    echo $tainted;
} 
```
*$tainted* (parameter number 1) is the variable we want to validate.  
*$legal_table* (parameter number 2) is an array that not contains any tainted values.  
So the variable *tainted* is safe in the if block.

***
***

### instanceof property

If you known the class name of your object just type it like below :
```javascript
{"name": "prepare", "instanceof": "mysql_connect", "language": "php", "attack": "sql_injection", "cwe": "CWE_89"}
```
For some reasons if you don't known the class name of your object or the analyzer fails to find it, use this syntax :
```javascript
{"name": "isValidNumber", "instanceof": "ESAPI->validator", "language": "php"}
```
Here *ESAPI->validator->isValidNumber()* is a validation function but we don't know the object assigned to *validator* property.

### prevent property

*Prevent* properties could be assigned to the main object or to the value object or the both :
```javascript
{"name": "htmlentities", "language": "php", "prevent": ["xss"], "parameters": 
    [
        {"id": 2, "conditions": "equals", "values": 
            [
                {"value" : "ENT_QUOTES", "prevent" : ["xss", "command_injection"]}
            ]}
    ]
}
```
If the analyzer finds a *$safe = htmlentites($tainted)* function with no second parameter defined, the *safe* variable will not lead to xss vulnerabilities.
Otherwise if it finds *$safe = htmlentites($tainted, ENT_QUOTES)*, the *prevent* property of the correct value object condition overwrite the main *prevent* property, so *safe* variable will not lead to xss and command_injection vulnerabilites.
*Prevent* properties could take also these predefined values :
- *ALL* which prevent all vulnerabilities
- *QUOTES* which indicates that quotes are encoded

### parameters property

the sink is vulnerable if : 
- no parameters are specified and at least one argument is tainted.
- parameters are specified and all the arguments must be tainted.
