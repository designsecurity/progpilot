# Customize an analysis

In addition to [**specify an analysis**](./SPECIFY_ANALYSIS.md) you can customize in depth an analysis.

## Model checking

You could check that your code verify some logic or specifications of your program.  
For example this rule will traverse the call graph of a program to verify if a user is authenticated and has rights before retrieving secret.

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

If the call graph of a program is like that, you could see there is one path that does not verify the rule #1 :  
![ScreenShot](customcallgraph1.png)

