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
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/designsecurity/progpilot"
        }
    ],
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
If no errors occuring you could try the next example.

## Example
- Use this code for analyze *example1.php*
```php
<?php

require_once './vendor/autoload.php';

$file = "example1.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;
		
$context->inputs->set_sources("./data/sources.json");
$context->inputs->set_sinks("./data/sinks.json");
$context->inputs->set_sanitizers("./data/sanitizers.json");
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
  array(7) {
    ["source"]=>
    array(1) {
      [0]=>
      string(4) "var4"
    }
    ["source_line"]=>
    array(1) {
      [0]=>
      int(4)
    }
    ["source_file"]=>
    array(1) {
      [0]=>
      string(12) "example1.php"
    }
    ["sink"]=>
    string(4) "echo"
    ["sink_line"]=>
    int(5)
    ["sink_file"]=>
    string(12) "example1.php"
    ["vuln_name"]=>
    string(3) "xss"
  }
}
```
All files (composer.json, ./data/*.json) used in this example are in the [projects/example](./projects/example) folder

## Configure sources
You can define a return function as a source when the last chars of your name source are ()  
See more available options in the [corresponding chapter about specify an analyze](./doc/SPECIFY_ANALYZE.md)
```javascript
{
    "sources": [
        {"name": "_GET", "language": "php", "type": "HTTP Parameter"},
        {"name": "_POST", "language": "php", "type": "HTTP Parameter"},
        {"name": "_COOKIES", "language": "php", "type": "HTTP Parameter"},
        {"name": "shell_exec()", "language": "php", "type": "command return"}
		]
}
```
