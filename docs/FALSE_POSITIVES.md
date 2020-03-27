# Handling false positives

Each vulnerability has an identifier:
```javascript
    ["vuln_id"]=>
    string(64) "e64d474f7d71f783ca18431b280095644599c6b789005c7748587891a0cd8a94"
```
which consists of the hash of the names of tainted variables and file location and sink name.  
So this hash is independent of code indentation and could be used to handle false positives.  
Create a json file containing all false positives with the hash as the value of the **vuln_id** property:
```javascript
{
    "false_positives":
        [
            {"vuln_id":"e64d474f7d71f783ca18431b280095644599c6b789005c7748587891a0cd8a94"}
        ]
}
```
Or use a PHP array that contains the false positives:
```php
$arr = [
        array("vuln_id" => "f31cec392303e924f666116fd67d897c92e8a59a5e8ca93a65091701ca9db558")
    ];
```

And pass it to this function:
```php
$context->inputs->setFalsePositives($arr_or_file);
```

The analyzer will not consider the vulnerabilities with these hashs.
