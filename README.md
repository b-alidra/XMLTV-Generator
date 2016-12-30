
[![Build Status](https://travis-ci.org/b-alidra/XMLTV-Generator.svg?branch=master)](https://travis-ci.org/b-alidra/XMLTV-Generator)
[![Coverage Status](https://coveralls.io/repos/github/b-alidra/XMLTV-Generator/badge.svg?branch=master)](https://coveralls.io/github/b-alidra/XMLTV-Generator?branch=master)

# XMLTV Generator

PHP generator of XMLTV files, respecting the [XMLTV Format](http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd).

## Requirements:

- PHP 5.6

## Installation:
-------------
The library is [PSR-4 compliant](http://www.php-fig.org/psr/psr-4)
 and the simplest way to install it is via composer:

     composer require b-alidra/xmltv


## Usage


```php
$this->xmltv = new Xmltv();
$this->xmltv
    ->setDate('2016-12-26')
    ->setSourceinfourl('https://b-alidra.com/xmltv')
    ->addChannel(function (&$channel) {
        $channel
            ->setId('test-channel')
            ->addDisplayname(['lang' => 'en'], 'The One')
            ->addIcon(['width' => '80', 'height' => 120, 'src' => 'https://b-alidra.com/icon.png']);
    })
    ->addProgramme([
        'channel'          => 'test-channel',
        'start'            => '20161223184000',
    ], function (&$program) {
        $program
            ->addTitle(['lang' => 'en'], 'Test channel')
            ->addSubtitle(['lang' => 'en'], 'Test channel second title')
            ->addDesc(['lang' => 'en'], 'Test channel description');
    });

$output = $xmltv->toXml();
```

Will produce the following XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE tv PUBLIC "SYSTEM" "http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd">
<tv date="2016-12-26" source-info-url="https://b-alidra.com/xmltv">
  <channel id="test-channel">
    <display-name lang="en">The One</display-name>
    <icon width="80" height="120" src="https://b-alidra.com/icon.png"/>
  </channel>
  <programme channel="test-channel" start="20161223184000">
    <title lang="en">Test channel</title>
    <sub-title lang="en">Test channel second title</sub-title>
    <desc lang="en">Test channel description</desc>
  </programme>
</tv>

```

## Tests

To run the test suite, first install the dependencies, then run `phpunit`:

```sh
$ composer install
$ phpunit
```

For a test coverage report, look at`build/report`

## License

[MIT](LICENSE)

[![Build Status](https://travis-ci.org/b-alidra/XMLTV-Generator.svg?branch=master)](https://travis-ci.org/b-alidra/XMLTV-Generator)
[![Coverage Status](https://coveralls.io/repos/github/b-alidra/XMLTV-Generator/badge.svg?branch=master)](https://coveralls.io/github/b-alidra/XMLTV-Generator?branch=master)

