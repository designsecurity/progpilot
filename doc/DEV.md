# Development

## Dependencies

This project would not have been possible without these dependencies :

- ircmaxell/php-cfg
- nikic/php-parser

## Tests

We are using more than 2400 tests cases from [PHP Vulnerability test suite](https://github.com/stivalet/PHP-Vulnerability-test-suite) for testing our tool.

## License

Progpilot is licensed under the [MIT License](../LICENSE)

## Authors

- Eric Therond | [github](https://github.com/eric-therond/) | [website](https://www.designsecurity.org) | [eric.therond.fr@gmail.com](mailto:eric.therond.fr@gmail.com)

See also the list of [contributors](https://github.com/designsecurity/progpilot/contributors) who participated in this project.

## Roadmap

There is a lot of tasks to do :
- Global variables
- Object heritage
- Htmlentities ENT_QUOTES
- Better analysis of conditions
- Circular includes
- Passing by reference
- Pushing elements into array (like array[] = ele; or push_array())
- Property of an object is an object
- Sanitizers : prevent property must be an array
- Objects identifiers and assignments to variables
- Static methods
- Cast expression : ((int) ($taint)).$taint
- If property hasn't been declared but used later (class { miss public $property;})
- Chained functions calls : $obj->func1()->func2()
- Safe command : system("ls ' ".htmlentities($tainted, ENT_QUOTES)." '"); ie : understanding of context : command or only command argument
- Sprintf strings transformations
- settype as a sanitizer
