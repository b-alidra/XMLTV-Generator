
[![Build Status](https://travis-ci.org/b-alidra/XMLTV-Generator.svg?branch=master)](https://travis-ci.org/b-alidra/XMLTV-Generator)
[![Coverage Status](https://coveralls.io/repos/github/b-alidra/XMLTV-Generator/badge.svg?branch=master)](https://coveralls.io/github/b-alidra/XMLTV-Generator?branch=master)
[![StyleCI](https://styleci.io/repos/77653136/shield?branch=master)](https://styleci.io/repos/77653136)

# XMLTV Generator

[XMLTV Format](http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd) PHP generator.

## Requirements:

- PHP 5.6
- libxml

## Installation:

The library is [PSR-4 compliant](http://www.php-fig.org/psr/psr-4)
and the simplest way to install it is via composer:

     composer require b-alidra/xmltv


## Usage

### Create a new XMLTV document root node

```php
$xmltv = new XMLTV();
```

### Set the document root node ttributes (optional)

```php
$xmltv
    ->setDate('2016-12-26')
    ->setSourceinfourl('https://b-alidra.com/xmltv')
    ->setSourceinfoname('XMLTV')
    ->setSourcedataurl('https://b-alidra.com/xmltv')
    ->setGeneratorinfoname('XMLTV')
    ->setGeneratorinfourl('https://b-alidra.com/xmltv');
```

### Add a channel

```php
$xmltv->addChannel(function (&$channel) {
    $channel
        // Required attribute
        ->setId('test-channel')
        // Optional children
        ->addDisplayname(['lang' => 'en'], 'The One')
        ->addIcon(['width' => '80', 'height' => 120, 'src' => 'https://b-alidra.com/icon.png'])
        ->addUrl('https://b-alidra.com');;
});
```

### Add a programme

```php
$xmltv->addProgramme([
        // Required attributes
        'channel'          => 'test-channel',
        'start'            => '20161223184000',
        // Optional attributes
        'stop'             => '20161223194000',
        'pdc-start'        => '20161223184000',
        'vps-start'        => '20161223184000',
        'showview'         => '???',
        'videoplus'        => '???',
        'clumpidx'         => '1'
    ], function (&$program) {
        $program
            // Required child
            ->addTitle(['lang' => 'en'], 'Test channel')
            // Optional children
            ->addSubtitle(['lang' => 'en'], 'Test channel second title')
            ->addDesc(['lang' => 'en'], 'Test channel description')
            ->addCredits(function (&$credits) {
                $credits
                    ->addActor('Test actor')
                    ->addAdapter('Test adapter')
                    ->addCommentator('Test commentator')
                    ->addComposer('Test composer')
                    ->addDirector('Test director')
                    ->addEditor('Test editor')
                    ->addGuest('Test guest')
                    ->addPresenter('Test presenter')
                    ->addProducer('Test producer')
                    ->addWriter('Test writer');
            })
            ->addDate('20160615')
            ->addCategory(['lang' => 'en'], 'Horror')
            ->addKeyword(['lang' => 'en'], 'Fantastic')
            ->addLanguage('en')
            ->addOriglanguage('en')
            ->addLength(['units' => 'minutes'], 120)
            ->addIcon(['src' => 'https://b-alidra.com/icon.png'])
            ->addUrl('https://b-alidra.com')
            ->addCountry('GB')
            ->addEpisodenum('0.0.0/1')
            ->addVideo(function (&$video) {
                $video
                    ->addAspect('')
                    ->addColour('')
                    ->addPresent('yes')
                    ->addQuality('');
            })
            ->addAudio(function (&$audio) {
                $audio->addPresent('yes');
            })
            ->addPreviouslyshown([])
            ->addPremiere('')
            ->addLastchance('')
            ->addNew()
            ->addSubtitles(function (&$subtitles) {
                $subtitles->addLanguage('English');
            })
            ->addRating(function (&$rating) {
                $rating
                    ->addValue('1/5')
                    ->addIcon(['src' => 'https://b-alidra.com/icon.png']);
            })
            ->addStarrating(function (&$starrating) {
                $starrating
                    ->addValue('1/5')
                    ->addIcon(['src' => 'https://b-alidra.com/icon.png']);
            })
            ->addReview([
                'type'     => 'text',
                'source'   => 'Web',
                'reviewer' => 'Belkacem Alidra',
                'lang'     => 'en'
            ]);
        });
    });
```

### Check validation against the [DTD](http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd)

```
$xmltv->validate();
```

### Get the XML

```php
$output = $xmltv->toXml();
```

Will produce the following XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE tv PUBLIC "SYSTEM" "http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd">
<tv date="2016-12-26" source-info-url="https://b-alidra.com/xmltv" source-info-name="XMLTV" source-data-url="https://b-alidra.com/xmltv" generator-info-name="XMLTV" generator-info-url="https://b-alidra.com/xmltv">
  <channel id="test-channel">
    <display-name lang="en">The One</display-name>
    <icon width="80" height="120" src="https://b-alidra.com/icon.png"/>
    <icon width="80" height="120" src="https://b-alidra.com/icon2.png"/>
    <url>https://b-alidra.com</url>
  </channel>
  <programme channel="test-channel" start="20161223184000" stop="20161223194000" pdc-start="20161223184000" vps-start="20161223184000" showview="???" videoplus="???" clumpidx="1">
    <title lang="en">Test channel</title>
    <sub-title lang="en">Test channel second title</sub-title>
    <desc lang="en">Test channel description</desc>
    <credits>
      <director>Test director</director>
      <actor>Test actor</actor>
      <writer>Test writer</writer>
      <adapter>Test adapter</adapter>
      <producer>Test producer</producer>
      <composer>Test composer</composer>
      <editor>Test editor</editor>
      <presenter>Test presenter</presenter>
      <commentator>Test commentator</commentator>
      <guest>Test guest</guest>
    </credits>
    <date>20160615</date>
    <category lang="en">Horror</category>
    <keyword lang="en">Fantastic</keyword>
    <language>en</language>
    <orig-language>en</orig-language>
    <length units="minutes">120</length>
    <icon src="https://b-alidra.com/icon.png"/>
    <url>https://b-alidra.com</url>
    <country>GB</country>
    <episode-num>0.0.0/1</episode-num>
    <video>
      <present>yes</present>
      <colour/>
      <aspect/>
      <quality/>
    </video>
    <audio>
      <present>yes</present>
    </audio>
    <previously-shown/>
    <premiere/>
    <last-chance/>
    <new/>
    <subtitles>
      <language>English</language>
    </subtitles>
    <rating>
      <value>1/5</value>
      <icon src="https://b-alidra.com/icon.png"/>
    </rating>
    <star-rating>
      <value>1/5</value>
      <icon src="https://b-alidra.com/icon.png"/>
    </star-rating>
    <review type="text" source="Web" reviewer="Belkacem Alidra" lang="en"/>
  </programme>
</tv>
```

## Implementation notes

Magic methods are used to set element attributes and to add an element child.

To set an **id** attribute (for example), use

```php
$element->setId($value)
```

To add a **display-name** child, use

```php
$element->addDisplayname($attributes = [], $value = '', $callback)
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
[![StyleCI](https://styleci.io/repos/77653136/shield?branch=master)](https://styleci.io/repos/77653136)
