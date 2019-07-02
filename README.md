# progpilot
> A static analyzer for security purposes  
> Only PHP language is currently supported

[![Build Status](https://travis-ci.org/designsecurity/progpilot.svg?branch=master)](https://travis-ci.org/designsecurity/progpilot) [![Packagist](https://img.shields.io/packagist/v/designsecurity/progpilot.svg)](https://packagist.org/packages/designsecurity/progpilot) [![Packagist](https://img.shields.io/packagist/l/designsecurity/progpilot.svg)](LICENSE)
---
## Standalone example
- Download the latest phar archive in [releases](https://github.com/designsecurity/progpilot/releases) folder (or [builds](./builds/) folder for dev versions).
- Optional : configure your analysis with [a yaml file](./projects/example_config/configuration.yml).
- Optional : use the up-to-date security files configuration in [package/src/uptodate_data](./package/src/uptodate_data) folder.
- Progpilot takes two optional arguments :
  - your YAML configuration file (if not the default configuration will be used)
  - your files and folders that have to be analysed

```shell
php progpilot.phar --configuration ./configuration.yml example1.php example2.php ./folder1/ ./folder2/
```

## Library installation
Use [getcomposer](https://getcomposer.org/) to install progpilot.  
Your composer.json looks like this one :
```javascript
{
    "name": "Example",
    "description": "Example of use of Progpilot",
    "require": {
        "designsecurity/progpilot": "^0.6"
    }
} 
```
Then run composer :
```shell
composer install
```
Then you could try the following example.

## Library example
- For more informations : look at the [chapter about API explaination](./docs/API.md)
- Use this code to analyze *source_code1.php* :
```php
<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setFile("source_code1.php");

$analyzer->run($context);
$results = $context->outputs->getResults();

var_dump($results);

?>
```
- When source_code1.php contains this code :
```php
<?php

$var7 = $_GET["p"];
$var4 = $var7;
echo "$var4";

?>	
```
- The simplified [output](./docs/OUTPUT.md) will be :
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
    ["sink_name"]=>
    string(4) "echo"
    ["sink_line"]=>
    int(5)
    ["vuln_name"]=>
    string(3) "xss"
  }
}
```
All files (composer.json, example1.php, source_code1.php) used in this example are in the [projects/example](./projects/example) folder.  
For more examples look at this [page](./docs/EXAMPLES.md).

## Specify an analysis
You can configure an analysis (the definitions of sinks, sources, sanitizers and validators) according to your own context.  
You can define traditional variables like *_GET*, *_POST* or *_COOKIE* as untrusted and for example the return of the function *shell_exec()* too like in the following configuration :
```javascript
{
    "sources": [
        {"name": "_GET", "is_array": true, "language": "php"},
        {"name": "_POST", "is_array": true, "language": "php"},
        {"name": "_COOKIE", "is_array": true, "language": "php"},
        {"name": "shell_exec", "is_function": true, "language": "php"}
		]
}
```
See more available options in the [corresponding chapter about specifying an analysis](./docs/SPECIFY_ANALYSIS.md)

## Development
[Learn more](./docs/DEV.md) about the development of Progpilot

## Faq
[Here](./docs/FAQ.md)
