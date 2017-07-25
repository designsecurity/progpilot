# Specify an analyze

You can specify the way of vulnerabilities are detected by playing with sources, sinks, sanitizers and validators :

- **sources** : the untrusted variables that will be initially tainted during the analysis.
- **sinks** : the sensitives functions that could lead to vulnerabilities.
- **sanitizers** : the functions that transform tainted values as safe values.
- **validators** : the functions that valid tainted values without transforming them as safe value.

## Configure sources
- $obj_context->inputs->set_sources($file_sources);
- $obj_context->inputs->get_sources();

Where *$file_sources* is a json file like below :
```javascript
{
    "sources": [
        {"name": "_GET", "language": "php", "type": "HTTP Parameter"},
        {"name": "_POST", "language": "php", "type": "HTTP Parameter"},
        {"name": "_COOKIES", "language": "php", "type": "HTTP Parameter"},
        {"name": "shell_exec()", "language": "php", "type": "command return"},
        {"name": "mysql_fetch_array()", "language": "php", "type": "database return"},
        {"name": "member1", "instanceof": "testc1", "language": "php", "type": "for dev purposes"},
        {"name": "vardev", "array_index": "tainted", "language": "php", "type": "for dev purposes"}
		]
}
```
*Name* and *language* properties are mandatory.  
The value of *name* property must be a php function (the source will be the return of this function) or a variable.  
To specify a method add *instanceof* property with the class name value to which the method belongs.  
You can define a return function or method as a source when the last chars of your *name* source are ().  
For defining a property as a source just add *instanceof* like for a method.  
If you want to define only one element of an array as a source use *array_index* property with index name as value.  
By default if you define a variable as a source and in your code this variable is an array all the elements of this array will be tainted, it is the case for well-known *_GET*, *_POST* and *_COOKIES* variables.

## Configure sanitizers
- $obj_context->inputs->set_sanitizers($file_sanitizers);
- $obj_context->inputs->get_sanitizers();

Where *$file_sanitizers* is a json file like below :
```javascript
{
    "sanitizers": [
        {"name": "htmlentities", "language": "php", "type": "character encoding", "prevent": "xss"},
        {"name": "addslashes", "language": "php", "type": "character escaping", "prevent": "sql_injection"},
        {"name": "mysql_real_escape_string", "language": "php", "type": "character escaping", "prevent": "sql_injection"},
        {"name": "str_replace", "language": "js", "type": "character encoding", "prevent": "xss"},
        {"name": "mysanitizer", "instanceof": "testc1", "language": "php", "type": "character encoding", "prevent": "xss", "comment": "for dev purposes"}
		]
}
```
*Name*, *language*, *type* and *prevent* properties are mandatory.  
The value of *name* property must be a php function.  
To specify a method add *instanceof* property with the class name value to which the method belongs.  
The value of *prevent* property should match which an *attack* defined in the sinks file.

## Configure sinks
- $obj_context->inputs->set_sinks($file_sinks);
- $obj_context->inputs->get_sinks();

Where *$file_sinks* is a json file like below :
```javascript
{
    "sinks": [
        {"name": "echo", "language": "php", "attack": "xss"},
        {"name": "print", "language": "php", "attack": "xss"},
        {"name": "printf", "language": "php", "attack": "xss"},
        {"name": "write", "instanceof": "document", "language": "js", "attack": "xss"},
        {"name": "include", "language": "php", "attack": "file_inclusion"},
        {"name": "eval", "language": "php", "attack": "code_injection"},
        {"name": "system", "language": "php", "attack": "command_injection"},
        {"name": "ldap_search", "parameters": [{"id": 3}], "language": "php", "attack": "ldap_injection"},
        {"name": "mysql_query", "language": "php", "attack": "sql_injection"},
        {"name": "xpath", "instanceof": "simplexml_load_file", "language": "php", "attack": "xpath_injection"}
		]
}
```
*Name*, *language*, *attack* properties are mandatory.  
The value of *name* property must be a php function or method.  
To specify a method add *instanceof* property with the class name value to which the method belongs.  
You can also specify which parameters of a function is a sink with *parameters* property.  
The *attack* will be annihilate if a source is sanitized by a sanitizer where *prevent* property equals *attack* property

## Configure validators
- $obj_context->inputs->set_validators($file_validators);
- $obj_context->inputs->get_validators();

Where *$file_validators* is a json file like below :
```javascript
{
    "validators": [
        {"name": "in_array", "language": "php", "parameters": 
            [
                {"id": 1, "condition": "valid"},
                {"id": 2, "condition": "array_not_tainted"}
            ]
        }
		]
}
```
*Name*, *language*, properties are mandatory.  
The value of *name* property must be a php function or method.  
To specify a method add *instanceof* property with the class name value to which the method belongs.  
You can add conditions to parameters of your validator function :  
- **valid** : the corresponding argument will be considered as safe if others conditions are respected.
- **not_tainted** : the argument is not tainted.
- **array_not_tainted** : the argument is an array that not contains any tainted values.

For the following in_array call : 
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

