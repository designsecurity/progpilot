# Examples

#### How can I use my own security files configuration ?
```php
<?php

require_once './vendor/autoload.php';

$file = "example1.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setSources("../../package/src/uptodate_data/sources.json");
$context->inputs->setSinks("../../package/src/uptodate_data/sinks.json");
$context->inputs->setSanitizers("../../package/src/uptodate_data/sanitizers.json");
$context->inputs->setValidators("../../package/src/uptodate_data/validators.json");
$context->inputs->setCustomRules("../../package/src/uptodate_data/rules.json");
$context->inputs->setFile($file);

$analyzer->run($context);
$results = $context->outputs->getResults();

var_dump($results);

?>
```
You can find the updated security files configuration of Progpilot in [package/src/uptodate_data](../package/src/uptodate_data) folder.

