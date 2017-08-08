# Handling false positives

Each vulnerability has an identifier :
```javascript
    ["vuln_id"]=>
    string(64) "e64d474f7d71f783ca18431b280095644599c6b789005c7748587891a0cd8a94"
```
which consists of a hash of the name of tainted variables and sink.  
So this hash is independent of code indentation and you could use it for handle false positives.  
Produce a json file which contains all your false positives with **vuln_id** for each :
```javascript
{
    "false_positives":
        [
            {"vuln_id":"e64d474f7d71f783ca18431b280095644599c6b789005c7748587891a0cd8a94"}
        ]
}
```

And pass it to this function :
- $context->inputs->set_false_positives("./false_positives.json");

The analyzer will not considerer the vulnerabilities with these hashs.
