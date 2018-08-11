# Customize an analysis

In addition to [**specify an analysis**](./SPECIFY_ANALYSIS.md) you can customize in depth an analysis.

## Call graph checking

You could check that your program meets a given specification. For example this rule will traverse the call graph (only from the main function) of a program to verify if a user is authenticated and has rights before retrieving a secret.

```javascript
{
    "custom_rules": [
        {"name": "rules_#1", "sequence":
            [
                {"function_name": "dev_iam_authenticated", "language": "php"},
                {"function_name": "dev_iam_rights", "language": "php"},
                {"function_name": "dev_retrieve_secret", "language": "php"}
            ],
            "description": "rule #1 not verified",
            "action": "MUST_VERIFY_CALL_FLOW"
        }]
}
```

In the call graph of the code below :
```php
<?php

function secret()
{
    dev_iam_authenticated();
    
    if(1 == rand())
    {
        dev_iam_rights();
    }
    else
    {
        nada();
    }
    
    var_dump(dev_retrieve_secret());
}

secret();

?>
```

There is one path that does not verify the rule #1 :  
<p align=center>
<img src="customcallgraph1.png" width=30%>
</p>

## Restricted function calls

You could also check the function calls comply the conditions you have defined,  
for example with this rule you want to check that Twig auto escaping strategy is enabled :

```javascript
{"name": "rules_#5", "function_name": "__construct", "instanceof": "Twig_Environment", "parameters": 
    [
        {"id": 2, "values": 
            [ 
                {"value" : "false", "is_array": true, "array_index": "autoescape"} 
            ]}
    ], 
"description": "Twig_Environment autoescaping should be set to true",
"language": "php", "action": "MUST_NOT_VERIFY_DEFINITION",
"attack": "security misconfiguration", "cwe": "CWE_1004"}
```

In the code below the restrictions on the function call are not satistied :
```php
<?php

$a = new Twig_Environment($loader, array("autoescape" => false));

?>
```
