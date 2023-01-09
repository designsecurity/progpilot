# progpilot
> A static application security testing (SAST) for PHP

[![Build Status](https://github.com/designsecurity/progpilot/actions/workflows/main.yml/badge.svg)](https://github.com/designsecurity/progpilot/actions) [![Packagist](https://img.shields.io/packagist/v/designsecurity/progpilot.svg)](https://packagist.org/packages/designsecurity/progpilot) [![Packagist](https://img.shields.io/packagist/l/designsecurity/progpilot.svg)](LICENSE)
---

## Installation

### Option 1: use standalone phar

- Download the latest phar archive from the [releases](https://github.com/designsecurity/progpilot/releases) page.
- Place the file somewhere in your path and make it executable:

```shell
chmod +x progpilot_vX.Y.Z.phar
sudo mv progpilot_vX.Y.Z.phar /usr/local/bin/progpilot
```

### Option 2: build phar from source code

[phar-composer.phar](https://github.com/clue/phar-composer/releases) should be located in a directory listed in the `$PATH` environment variable before starting the build:

```shell
git clone https://github.com/designsecurity/progpilot
cd progpilot
./build.sh
```

The resulting phar archive will be located in the `builds` folder at the root of this project.

### Option 3: use composer

Use [Composer](https://getcomposer.org/) to install progpilot:

```shell
composer require --dev designsecurity/progpilot
```

## Configuration

Use a yaml configuration file (look at [this example](./projects/example_config/configuration.yml)) to configure and customize the progpilot analysis otherwise the default configuration will be used with, in particular the standard [taint configuration data](./package/src/uptodate_data).

## Usage
### CLI example

The progpilot command takes as arguments the path to the files and folders to be analyzed and optionally a configuration file:

```shell
# without config file
progpilot example1.php example2.php folder1/ folder2/
# with a config file
progpilot --configuration configuration.yml example1.php example2.php folder1/ folder2/
```
If you installed it with `composer`, the program will be located at `vendor/bin/progpilot`.

### Library example

It is also possible to use progpilot inside PHP code. For more information look at the [API documentation](./docs/API.md).

Use this code to analyze *source_code1.php*:

```php
<?php
require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setFile("source_code1.php");

try {
  $analyzer->run($context);
} catch (Exception $e) {
   echo "Exception : ".$e->getMessage()."\n";
}  
  
$results = $context->outputs->getResults();

var_dump($results);
```

When source_code1.php contains this code:

```php
<?php
$var7 = $_GET["p"];
$var4 = $var7;
echo "$var4";
```

The simplified [output](./docs/OUTPUT.md) will be:

```php
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
For more examples look also at this [page](./docs/EXAMPLES.md).

## Specify an analysis
It is strongly recommended to customize the taint analysis configuration (the definitions of sinks, sources, sanitizers and validators) according to the context of the application to be analyzed. In the following specification, superglobals variables *_GET*, *_POST* or *_COOKIE* are defined as untrusted and also the return of the *shell_exec()* function:
```json
{
    "sources": [
        {"name": "_GET", "is_array": true, "language": "php"},
        {"name": "_POST", "is_array": true, "language": "php"},
        {"name": "_COOKIE", "is_array": true, "language": "php"},
        {"name": "shell_exec", "is_function": true, "language": "php"}
    ]
}
```
See available settings in the [corresponding chapter about specifying an analysis](./docs/SPECIFY_ANALYSIS.md).  
Custom rules can be created too, see the [corresponding chapter about custom rules](./docs/CUSTOM_ANALYSIS.md).

## Development
[Learn more](./docs/DEV.md) about the development of Progpilot.

## Faq
[Here](./docs/FAQ.md)
