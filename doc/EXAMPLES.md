# Examples

#### How can I use my own security data files ?
```php
<?php

require_once './vendor/autoload.php';

$file = "example1.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->set_sources("../../package/src/uptodate_data/sources.json");
$context->inputs->set_sinks("../../package/src/uptodate_data/sinks.json");
$context->inputs->set_sanitizers("../../package/src/uptodate_data/sanitizers.json");
$context->inputs->set_validators("../../package/src/uptodate_data/validators.json");
$context->inputs->set_file($file);

$analyzer->run($context);
$results = $context->outputs->get_results();

var_dump($results);

?>
```
You can find the updated configuration of Progpilot in [package/src/uptodate_data](../package/src/uptodate_data) folder.__

