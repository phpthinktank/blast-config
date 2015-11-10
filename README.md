# Blast config

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]
[![Coverage Status](https://img.shields.io/coveralls/phpthinktank/blast-config/master.svg?style=flat-square)](https://coveralls.io/github/phpthinktank/blast-config?branch=1.0.x-dev)

Framework agnostic configuration package supporting php, json and xml. More file types under development.

## Install

Via Composer

``` bash
$ composer require blast/config
```

## Usage

Only a few lines of code:

```
<?php

$factory = new Factory();

// define your base location for all configurations
$locator = $factory->create(__DIR__ . '/res');

// receive config from json as array
$config = $factory->load('/config/config.json', $locator);

// receive config from xml as array
$config = $factory->load('/config/config.xml', $locator)

// receive config as array
$config = $factory->load('/config/config.php', $locator);
```

### Dependency injection

Configure ServiceProvider and Facade.

```
<?php

$container = new Container();
$container->addServiceProvider(new ConfigServiceProvider());
FacadeFactory::setContainer($container);
```

Load your configuration.

```
<?php

// define your base location for all configurations
Config::create(__DIR__ . '/res');

// receive config from json as array
$config = Config::load('/config/config.json', $locator);

```

## Further development

Please visit our [milestones](https://github.com/phpthinktank/blast-config/milestones)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Marco Bunge][link-author]
- [All contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/blast/config.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/phpthinktank/blast-config/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/blast/config.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/blast/config
[link-travis]: https://travis-ci.org/phpthinktank/blast-config
[link-downloads]: https://packagist.org/packages/blast/config
[link-author]: https://github.com/mbunge
[link-contributors]: ../../contributors
