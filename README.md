# progpilot
> A static analyzer for security purposes

At this moment only PHP language is supported  
To have an idea of the capabilities of the tool you could looking at the [chapter about API explaination](./doc/API.md)

## Installation
Use [getcomposer](https://getcomposer.org/) to install the progpilot library.  
Your composer.json looks like this one :
```javascript
{
    "name": "Example",
    "description": "Example of use of Progpilot",
    "minimum-stability": "dev",
    "require": {
        "designsecurity/progpilot": "dev-master"
    },
    "extra": {
        "enable-patching": true
    }
} 
```
*enable-patching* set to *true* is mandatory because progpilot will patch *ircmaxell/php-cfg* library.  
Then run composer :
```shell
composer install
```
If no errors occuring you could try the following example.

## Example
- Use this code to analyze *example1.php*
```php
<?php

require_once './vendor/autoload.php';

$file = "example1.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;
		
$context->inputs->set_sources("./data/sources.json");
$context->inputs->set_sinks("./data/sinks.json");
$context->inputs->set_sanitizers("./data/sanitizers.json");
$context->inputs->set_validators("./data/validators.json");
$context->inputs->set_file($file);

$analyzer->run($context);
$results = $context->outputs->get_results();

var_dump($results);

?>	 
```
- When example1.php contains this code :
```php
<?php

$var7 = $_GET["p"];
$var4 = $var7;
echo "$var4";

?>	
```
- The return of method get_results() will be :
```javascript
array(1) {
  [0]=>
  array(11) {
    ["source_name"]=>
    array(1) {
      [0]=>
      string(5) "$var4"
    }
    ["source_line"]=>
    array(1) {
      [0]=>
      int(4)
    }
    ["source_column"]=>
    array(1) {
      [0]=>
      int(4)
    }
    ["source_file"]=>
    array(1) {
      [0]=>
      string(12) "example1.php"
    }
    ["sink_name"]=>
    string(4) "echo"
    ["sink_line"]=>
    int(5)
    ["sink_column"]=>
    int(5)
    ["sink_file"]=>
    string(12) "example1.php"
    ["vuln_name"]=>
    string(3) "xss"
    ["vuln_cwe"]=>
    string(6) "CWE_79"
    ["vuln_id"]=>
    string(64) "868c68ca8f2514561246fb69e6fca9924d1125f6372fa38bdfb88734c8621f40"
  }
}
```
All files (composer.json, ./data/*.json) used in this example are in the [projects/example](./projects/example) folder

## Configure analysis
You can configure an analysis (the definitions of sinks, sources, sanitizers and validators) according to your own context.  
You can define traditional variables like *_GET*, *_POST* or *_COOKIES* as untrusted and for example the return of the function *shell_exec()* too like in the following configuration :
```javascript
{
    "sources": [
        {"name": "_GET", "is_array": true, "language": "php"},
        {"name": "_POST", "is_array": true, "language": "php"},
        {"name": "_COOKIES", "is_array": true, "language": "php"},
        {"name": "shell_exec", "is_function": true, "language": "php"}
		]
}
```
See more available options in the [corresponding chapter about specifying an analyze](./doc/SPECIFY_ANALYZE.md)

## Development
[Learn more](./doc/DEV.md) about the development of Progpilot

## Faq
[Here](./doc/FAQ.md)
