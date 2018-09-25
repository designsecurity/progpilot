# Development

## Dependencies

This project would not have been possible without these dependencies :

- [ircmaxell/php-cfg](https://github.com/ircmaxell/php-cfg/)
- [nikic/php-parser](https://github.com/nikic/php-parser/)

## Tests

We are using more than 2400 tests cases from [PHP Vulnerability test suite](https://github.com/stivalet/PHP-Vulnerability-test-suite) for testing our tool.

## License

Progpilot is licensed under the [MIT License](../LICENSE)

## Authors

- Eric Therond | [github](https://github.com/eric-therond/) | [website](https://www.designsecurity.org) | [eric.therond.fr@gmail.com](mailto:eric.therond.fr@gmail.com)

See also the list of [contributors](https://github.com/designsecurity/progpilot/contributors) who participated in this project.

## Contribute

If you want to contribute to this project see [the contributing rules](./CONTRIBUTING.md).

## Roadmap

There is a lot of tasks to do :
- Passing by reference
- Pushing elements into array (like array[] = ele; or push_array())
- Property of an object is an object
- definitions on the same line (def = eee; def = aaa;)
- If property hasn't been declared but used later (class { miss public $property;})
- Chained functions calls : $obj->func1()->func2()
- Chained references  : $var = "eee"; $ref1 = &$var; $ref2 = &$ref1;
- Sprintf strings transformations
- $tainted = $tainted + 0; => cast to int
- Handle all tainted flows when severals definitions taint the same expression
