# Handling false positives

Each vulnerability has an identifier :
```javascript
    ["vuln_id"]=>
    string(64) "e64d474f7d71f783ca18431b280095644599c6b789005c7748587891a0cd8a94"
```
which consists of the hash of the names of tainted variables and file location and sink name.  
So this hash is independent of code indentation and you could use it to handle false positives.  
Produce a json file that contains all your false positives with **vuln_id** for each :
```javascript
{
    "false_positives":
        [
            {"vuln_id":"e64d474f7d71f783ca18431b280095644599c6b789005c7748587891a0cd8a94"}
        ]
}
```
Or use an array that contains all your false positives with **vuln_id** for each element :
```php
$arr = [
        array("vuln_id" => "f31cec392303e924f666116fd67d897c92e8a59a5e8ca93a65091701ca9db558")
    ];
```

And pass it to this function :
```php
$context->inputs->setFalsePositives($arr_or_file);
```

The analyzer will not consider the vulnerabilities with these hashs.
