# Specify an analyze

You can specify the way of vulnerabilities are detected by playing with sources, sinks and sanitizers.

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
        {"name": "mysql_fetch_array()", "language": "php", "type": "database return"}
		]
}
```
*Name* and *language* properties are mandatory
The value of *name* property must be a php function (the source will be the return of this function) or a variable
You can define a return function as a source when the last chars of your *name* source are ()

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
        {"name": "str_replace", "language": "js", "type": "character encoding", "prevent": "xss"}
		]
}
```
*Name*, *language*, *type* and *prevent* properties are mandatory
The value of *name* property must be a php function
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
*Name*, *language*, *attack* properties are mandatory
The value of *name* property must be a php function or method
To specify a method add *instanceof* property with the class name value to which the method belongs.
You can also specify which parameters of a function is a sink with *parameters* property
The *attack* will be annihilate if a source is sanitized by a sanitizer where *prevent* property equals *attack* property
