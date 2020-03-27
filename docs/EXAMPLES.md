# Examples

#### How can I customize the analysis?
```php
<?php

require_once './vendor/autoload.php';

$file = "example1.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setSources("../../package/src/uptodate_data/php/sources.json");
$context->inputs->setSinks("../../package/src/uptodate_data/php/sinks.json");
$context->inputs->setSanitizers("../../package/src/uptodate_data/php/sanitizers.json");
$context->inputs->setValidators("../../package/src/uptodate_data/php/validators.json");
$context->inputs->setCustomRules("../../package/src/uptodate_data/php/rules.json");
$context->inputs->setFile($file);

$analyzer->run($context);
$results = $context->outputs->getResults();

var_dump($results);


```
The up-to-date taint analysis specification and custom rules files are located in [package/src/uptodate_data](../package/src/uptodate_data) folder.

#### How can I display the vulnerabilities when they are detected?

Use *setOnAddResult* method:

```php
<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setFile("./tests/oop/simple1.php");
//$context->outputs->setOnAddResult("var_dump");
$var = function($result) {
    var_dump($result);
};
$context->outputs->setOnAddResult($var);
$analyzer->run($context);
```

