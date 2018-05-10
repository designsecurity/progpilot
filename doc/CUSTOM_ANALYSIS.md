# Customize an analysis

In addition to [**specify an analysis**](./SPECIFY_ANALYSIS.md) you can customize in depth an analysis.

## Model checking

You could check that your program meets a given specification. For example this rule will traverse the call graph (only from the main function) of a program to verify if a user is authenticated and has rights before retrieving a secret.

```javascript
{
    "custom_rules": [
        {"name": "rules_#1", "sequence":
            [
                {"function_name": "dev_iam_authenticated", "language": "php"},
                {"function_name": "dev_iam_rights", "language": "php"},
                {"function_name": "dev_retrieve_secret", "language": "php", "action": "MUST_VERIFY_CALL_FLOW"}
            ]
        }
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

