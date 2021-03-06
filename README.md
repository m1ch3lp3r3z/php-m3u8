PHP M3u8
========

An M3u8 parser / dumper framework.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f04296f1-1621-4af0-8346-fd3379f34a5a/big.png)](https://insight.sensiolabs.com/projects/f04296f1-1621-4af0-8346-fd3379f34a5a)

[![Latest Stable Version](https://poser.pugx.org/chrisyue/php-m3u8/v/stable)](https://packagist.org/packages/chrisyue/php-m3u8)
[![License](https://poser.pugx.org/chrisyue/php-m3u8/license)](https://packagist.org/packages/chrisyue/php-m3u8)
[![Total Downloads](https://poser.pugx.org/chrisyue/php-m3u8/downloads)](https://packagist.org/packages/chrisyue/php-m3u8)
[![Build Status](https://travis-ci.org/chrisyue/php-m3u8.svg?branch=develop)](https://travis-ci.org/chrisyue/php-m3u8)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/chrisyue/php-m3u8/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/chrisyue/php-m3u8/?branch=develop)
[![Code Coverage](https://scrutinizer-ci.com/g/chrisyue/php-m3u8/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/chrisyue/php-m3u8/?branch=develop)
[![StyleCI](https://styleci.io/repos/52257600/shield)](https://styleci.io/repos/52257600)

**Warning: you are visiting the very experimental branch, this branch is for the contributors only!**

To get the ready-to-use code, please visit [master](../../../tree/master) branch.

### Why would I like to make a new version?

I'd like to separate the parse/dump ability from the model classes(to meet the Single Responsibility Principle), 
and also I'd like the parser/dumper could read some configuration from the model class to know how to parse/dump a 
specific tag to/from model. I think it could be cool because the configurations could also be treated as a M3u8 documentation.
Thanks for the doctrine annotation reader, these thoughts could become true.

### How to Use

Please visit the [docs](docs).
