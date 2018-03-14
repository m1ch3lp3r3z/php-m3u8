PHP-M3U8
========

An M3U8 parser / dumper framework.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f04296f1-1621-4af0-8346-fd3379f34a5a/big.png)](https://insight.sensiolabs.com/projects/f04296f1-1621-4af0-8346-fd3379f34a5a)

[![Latest Stable Version](https://poser.pugx.org/chrisyue/php-m3u8/v/stable)](https://packagist.org/packages/chrisyue/php-m3u8)
[![License](https://poser.pugx.org/chrisyue/php-m3u8/license)](https://packagist.org/packages/chrisyue/php-m3u8)
[![Total Downloads](https://poser.pugx.org/chrisyue/php-m3u8/downloads)](https://packagist.org/packages/chrisyue/php-m3u8)
[![Build Status](https://travis-ci.org/chrisyue/php-m3u8.svg?branch=develop)](https://travis-ci.org/chrisyue/php-m3u8)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/chrisyue/php-m3u8/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/chrisyue/php-m3u8/?branch=develop)
[![Code Coverage](https://scrutinizer-ci.com/g/chrisyue/php-m3u8/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/chrisyue/php-m3u8/?branch=develop)
[![StyleCI](https://styleci.io/repos/52257600/shield)](https://styleci.io/repos/52257600)

Installation
------------

```
composer require 'chrisyue/php-m3u8:dev-feature/3.0'
```

That was it.

Usage
-----

For the quick use:

```php
<?php

use Chrisyue\PhpM3u8\M3u8\PlaylistFacade;
use Chrisyue\PhpM3u8\Document\Rfc8216\MediaPlaylist;

$text = <<<M3U8
#EXTM3U
#EXT-X-VERSION:3
#EXT-X-TARGETDURATION:10
#EXTINF:10.0,Hello World
/path/to/first/segment
#EXT-X-ENDLIST
M3U8;

// As you could guess, one can change the `MediaPlaylist` to `MasterPlaylist` to parse/dump a master playlist
$m3u8 = new PlaylistFacade(MediaPlaylist::class);
$playlist = $m3u8->parse($text);

// you can now get the parsed information from `$playlist`
$playlist->version;
$playlist->targetduration;
$playlist->mediaSegments[0]->inf->duration;
$playlist->mediaSegments[0]->inf->title;
$playlist->endlist;

// or dump the `$playlist` back
$text = $m3u8->dump($playlist);
```

That was it

However, a "facade" hides a lot of details. PHP-M3u8 not only parse / dump M3U8,
but also let one support more tags easily. That's why it's a "framework".
