# Examples

#### How can I use my own security files configuration ?
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

?>
```
You can find the updated security files configuration of Progpilot in [package/src/uptodate_data](../package/src/uptodate_data) folder.

#### How can I display the vulnerabilites when they are detected ?

You can use *setOnAddResult* method :

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

