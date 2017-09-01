# progpilot
> A static analyzer for security purposes  
> Only PHP language is currently supported

[![https://travis-ci.org/designsecurity/progpilot.svg?branch=master](https://travis-ci.org/designsecurity/progpilot)]

## Standalone example
- Download the latest phar archive in [builds](./builds) folder.
- Use the up-to-date data in [projects/uptodate_data](./projects/uptodate_data) folder.
- Configure your analysis with [a yaml file](./projects/example_config/configuration.yml).
- Then run progpilot with php and your JSON configuration file in command line argument :

```shell
php progpilot_dev20170828-161722.phar ./configuration.yml
```

## Library installation
Use [getcomposer](https://getcomposer.org/) to install progpilot.  
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

## Library example
- For more informations : look at the [chapter about API explaination](./doc/API.md)
- Use this code to analyze *example1.php* :
```php
<?php

require_once './vendor/autoload.php';

$file = "example1.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->set_sources("../uptodate_data/sources.json");
$context->inputs->set_sinks("../uptodate_data/sinks.json");
$context->inputs->set_sanitizers("../uptodate_data/sanitizers.json");
$context->inputs->set_validators("../uptodate_data/validators.json");
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
- The simplified output will be :
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
All files (composer.json, ./data/*.json) used in this example are in the [projects/example](./projects/example) and [projects/uptodate_data](./projects/uptodate_data) folders.

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
See more available options in the [corresponding chapter about specifying an analyze](./doc/SPECIFY_ANALYZE.md)

## Development
[Learn more](./doc/DEV.md) about the development of Progpilot

## Faq
[Here](./doc/FAQ.md)
