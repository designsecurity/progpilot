# progpilot
> A static analyzer for security purposes

At this moment only PHP language is supported
You could looking at the API explaination in the [corresponding chapter about API](./doc/API.md)

## Examples
- A simple example where your source code to be analyzed is example1.php
```php
<?php
$file = "example1.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;
		
$context->inputs->set_sources("./data/sources.json");
$context->inputs->set_sinks("./data/sinks.json");
$context->inputs->set_sanitizers("./data/sanitizers.json");
$context->inputs->set_file($file);

$analyzer->run($context);
$results = $context->outputs->get_results();
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
- The return of method get_results() of context instance is :
```javascript
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
    string(27) "./example1.php"
  }
  ["sink"]=>
  string(4) "echo"
  ["sink_line"]=>
  int(5)
  ["sink_file"]=>
  string(27) "./example1.php"
  ["vuln_name"]=>
  string(3) "xss"
}
```


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
