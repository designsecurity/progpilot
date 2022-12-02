# Contributing to progpilot
> First off, thanks for taking time to contribute ! :tada::+1:

## How can I contribute?

### Reporting bugs
Provide at each time your inputs:
- PHP version
- Progpilot version
- Configuration of progpilot
- Files or code you are trying to analyze  

That will allow the ability of contributors to reproduce the bug.

### Style
All php code must adhere to [PSR-2 standard](https://www.php-fig.org/psr/psr-2/) (except for tests).

### GrumPHP
Developers can use [GrumPHP](https://github.com/phpro/grumphp/) to ensure each progpilot commit reaches code style (phpcs) requirements.  

### Frameworks support
Most of the time the analysis of progpilot can be extended simply with adding the corresponding [sources, sinks, validators and sanitizers](./SPECIFY_ANALYSIS.md): look at how it was done for [current frameworks](https://github.com/designsecurity/progpilot/tree/master/package/src/uptodate_data/php/frameworks).

### Implement a test
A new functionality must be testable, to do that:
1. Select the category of your functionality in the dataProvider function in *projects/tests/run_all.php*
2. For example ooptest.php if your functionality extends oop analysis
3. Add your test in *projects/tests/tests/oop* folder 
4. Edit *projects/tests/ooptest.php* and add the expected output of your test:
```php
    [
        "./tests/oop/simple27.php",
        [["\$_GET[\"p\"]", "8", "xss"],
        ["\$_GET[\"t\"]", "17", "xss"]]
    ]
```

- the first element of the array is the name of your file created in step 3
- the second element is an array:
    - it is the list of detected vulnerabilities in the correct order, each vulnerability has an array:
        - the source name, the source line number, and the type of vulnerability (attack)
        - if several sources participate to the vulnerability add them like this: [array("\$var5", "\$var6"), array("3", "4") , "xss"]
