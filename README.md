## About

[![Build Status](https://travis-ci.org/martinlindhe/php-debughelper.png?branch=master)](https://travis-ci.org/martinlindhe/php-debughelper)
https://packagist.org/packages/martinlindhe/php-debughelper


## Installation
With Composer


```
composer require martinlindhe/php-debughelper
```

or add manually to composer.json:

```json
{
    "require": {
        "martinlindhe/php-debughelper": "~0.1"
    }
}
```

## HexPrinter
```php
use DebugHelper\HexPrinter;

echo HexPrinter::render("\xF0\xFF\x00");
```

will output something like
```
000000: f0 ff 00                                         ...
```


## BinaryPrinter
```php
use DebugHelper\BinaryPrinter;

echo BinaryPrinter::render("\xF0\xFF\x00");
```

will output something like
```
000000: 11110000 11111111 00000000                 ...
```


## Stopwatch
```php
use DebugHelper\Stopwatch;

$watch = new Stopwatch;
$watch->start();
// do some heavy lifting ...
$watch->stop();

echo $watch->getElapsedTime()." seconds elapsed\n";
```

## Logging

dbg($msg); // write to stdout if DEBUG=1
nfo($msg);
err($msg);

dbgTime($msg);
nfoTime($msg);
errTime($msg);



## Helpers

```
d()       dumps variable, using symfony/var-dumper
dd()      dump and die
bt($ex = null)  prints a backtrace (optionally from exception)
dh()      shorthand for DebugHelper\HexPrinter::render()
dbits()   shorthand for DebugHelper\BinaryPrinter::render()
dm()      prints current memory usage
apcm()    prints memory usage by the apc extension
```
