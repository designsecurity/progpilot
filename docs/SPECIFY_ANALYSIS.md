# Specify an analysis

You can specify the way of vulnerabilities are detected by playing with sources, sinks, sanitizers and validators :

- **sources** : the untrusted variables that will be initially tainted during the analysis.
- **sinks** : the sensitives functions that could lead to vulnerabilities.
- **sanitizers** : the functions that transform tainted values into safe values.
- **validators** : the functions that valid tainted values without transforming them into safe value.

## Configure sources
- $obj_context->inputs->setSources($files_sources);
- $obj_context->inputs->getSources();

Where *$file_sources* is a json file (or an array of json files) like below :
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
Mandatory properties :
- [Name](#name-property), language

Optional properties :
- [instanceof](#instanceof-property), [prevent](#prevent-property), [parameters](#parameters-property), [is_object](#is_object-property), [is_array](#is_array-property), [array_index](#array_index-property), [is_function](#is_function-property)

## Configure sanitizers
- $obj_context->inputs->setSanitizers($file_sanitizers);
- $obj_context->inputs->getSanitizers();

Where *$file_sanitizers* is a json file (or an array of json files) like below :
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
Mandatory properties :
- [Name](#name-property), language

Optional properties :
- [instanceof](#instanceof-property), [prevent](#prevent-property), [parameters](#parameters-property)

## Configure sinks
- $obj_context->inputs->setSinks($file_sinks);
- $obj_context->inputs->getSinks();

Where *$file_sinks* is a json file (or an array of json files) like below :
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
Mandatory properties :
- [Name](#name-property), language, attack

Optional properties :
- [instanceof](#instanceof-property), [prevent](#prevent-property), [parameters](#parameters-property)

## Configure validators
- $obj_context->inputs->setValidators($file_validators);
- $obj_context->inputs->getValidators();

Where *$file_validators* is a json file (or an array of json files) like below :
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
Mandatory properties :
- [Name](#name-property), language

Optional properties :
- [instanceof](#instanceof-property), [prevent](#prevent-property), [parameters](#parameters-property)

***
***

### name property
#### sinks, validators and sanitizers
the name property must be a function.

#### sources
the name property must be a function (the source will be the return of this function) or a variable.

### is_array property
#### sources
If you want to define all elements of an array as a source (like for well-known *_GET*, *_POST* and *_COOKIE* variables) use *is_array* property set to true.

### is_object property
#### sources
If you want to define all properties of an object as a source (like for the return of *mysql_fetch_object* function) use *is_object* property set to true.

### array_index property
#### sources
If you want to define only one element of an array as a source add *array_index* property with index name as value.

### is_function property
#### sources
You can define a return function or a method as a source when *is_function* property is set to true.  

### instanceof property
#### sinks, validators, sanitizers and sources
If you know the class name of your object just type it like below :
```javascript
{"name": "prepare", "instanceof": "mysql_connect", "language": "php", "attack": "sql_injection", "cwe": "CWE_89"}
```
Instead of using the class name (or if you don't known it) use the name of the property :
```javascript
{"name": "isValidNumber", "instanceof": "ESAPI->validator", "language": "php"}
```
Here *ESAPI->validator->isValidNumber()* is a validation function but we don't know the object assigned to *validator* property.  

Instanceof property works with object heritage and you can define the parent object as an instance of a sink like below :
```javascript
{"name": "query", "instanceof": "SomeClass1", "language": "php"}
```
```php
<?php
class SomeClass1
{
}

class SomeClass2 extends SomeClass1
{
    public function query($tata)
    {
    }
}

$a = new SomeClass2;
$a->query($_GET["p"]);
```
and instanceof property continue to works when the class is not defined :
```javascript
{"name": "query", "instanceof": "VulnerableClass", "language": "php"}
```
```php
<?php

$a = new VulnerableClass;
$a->query($_GET["p"]);
```


### prevent property
#### sanitizers
The value of *prevent* property should match an *attack* defined in the sinks file.  
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
#### sinks
the sink is vulnerable if : 
- no parameters are specified and at least one argument is tainted.
- parameters are specified and all the arguments must be tainted.

The *parameter* object could take a *conditions* parameter with these values :
- **QUOTES** : the tainted variable must be embedded into quotes if not it's a vulnerability otherwise the variable must be sanitized with a function that encode quotes.  
- **array_tainted** : the parameter is vulnerable if the argument is an array with at least one tainted value.  
- **variable_tainted** : the parameter is vulnerable if the argument is a tainted variable.  
- **object_tainted** : the parameter is vulnerable if the argument is an object with at least one tainted property.  

Global conditions could be applied on all parameters :
- **QUOTES_HTML** : if the tainted variable is inside an html tag it's a vulnerability if the variable is embedded into quotes and quotes are not sanitized or if the variable is not embedded into quotes.

#### sanitizers
The *parameter* object could take a *conditions* parameter with these values :
- **taint** : the corresponding argument will be considered as the expected tainted variable. During the analysis, if this argument is tainted the return of the function will be tainted and sanitized, without specifying  a *taint* property the return of the function will be tainted and sanitized if any of the arguments is tainted.
- **equals** : the argument must be equals to the specified string.

#### sources
If you want to define one parameter of a function as a source use *parameters* property.

#### validators
The *parameter* object could take a *conditions* parameter with these values :
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

