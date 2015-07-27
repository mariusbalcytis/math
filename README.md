PHP Math library
====

PHP library for arbitrary precision mathematics.

Installation
----

```shell
composer require maba/math
```

Why
----

```php
var_dump(intval(9223372036854775807 + 1));
// int(-9223372036854775808)

var_dump(5.2 * 3 === 15.6);
// bool(false)

var_dump((8 + 92233720368547750) * 1500 / 1500 - 92233720368547750);
// float(16)
```

Usage
----

```php
use Maba\Component\Math\BcMath;
use Maba\Component\Math\Math;
use Maba\Component\Math\NumberFormatter;

$basicMathImplementation = new BcMath();
$math = new Math($basicMathImplementation);

var_dump($math->add('9223372036854775807', '1'));
// string(40) "9223372036854775808.00000000000000000000"
var_dump($math->isEqual($math->mul('5.2', '3'), '15.6'));
// bool(true)
var_dump($math->sub($math->div($math->mul($math->add('8', '92233720368547750'), '1500'), '1500'), '92233720368547750'));
// string(22) "8.00000000000000000000"

$result = $math->pow($math->mul('3.141592653589793', '2.71828182845904523536'), 13);

$formatter = new NumberFormatter($math);
echo $formatter->formatNumber($result, 4, '.', ' '); // prints 1 284 625 710 591.2256
```

`BcMath` class uses `bcmath` functions. If you need to use some other arbitrary precision math implementation,
implement `BasicMathInterface`.

Running tests
----

[![Travis status](https://travis-ci.org/mariusbalcytis/math.svg?branch=master)](https://travis-ci.org/mariusbalcytis/math)
[![Coverage Status](https://coveralls.io/repos/mariusbalcytis/math/badge.svg?branch=master&service=github)](https://coveralls.io/github/mariusbalcytis/math?branch=master)

```shell
composer install
vendor/bin/phpunit
```
