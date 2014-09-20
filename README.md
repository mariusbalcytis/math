PHP Math library
====

PHP library for arbitrary precision mathematics.

![Travis status](https://travis-ci.org/mariusbalcytis/math.svg?branch=master)


Usage
----

```php
use Maba\Component\Math\BcMath;
use Maba\Component\Math\Math;
use Maba\Component\Math\NumberFormatter;

$basicMathImplementation = new BcMath();
$math = new Math($basicMathImplementation);

$result = $math->pow($math->mul('3.141592653589793', '2.71828182845904523536'), 13);

$formatter = new NumberFormatter($math);
echo $formatter->formatNumber($result, 4, '.', ' '); // prints 1 284 625 710 591.2256
```

`BcMath` class uses `bcmath` functions. If you need to use some other arbitrary precision math implementation,
implement `BasicMathInterface`.