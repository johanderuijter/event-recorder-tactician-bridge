# event-recorder-tactician-bridge

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Middleware for `league/tactician` to dispatch events stored by `jdr/event-recorder`.

## Install

Via Composer

``` bash
$ composer require jdr/event-recorder-tactician-bridge
```

## Usage

Add as a tactician middleware.

``` php
<?php

use JDR\EventRecorder\EventDispatcher;
use JDR\EventRecorder\RecordsEvents;
use JDR\EventRecorderTacticianBridge\ReleaseRecordedEvents;
use League\Tactician\CommandBus;

$commandBus = new CommandBus([
    new ReleaseRecordedEvents(new EventDispatcher(), new RecordsEvents()),
    // ...
]);

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ bin/phpspec run
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email dev@johanderuijter.nl instead of using the issue tracker.

## Credits

- [Johan de Ruijter][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jdr/event-recorder-tactician-bridge.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jdr/event-recorder-tactician-bridge.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jdr/event-recorder-tactician-bridge
[link-downloads]: https://packagist.org/packages/jdr/event-recorder-tactician-bridge
[link-author]: https://github.com/johanderuijter
[link-contributors]: ../../contributors
