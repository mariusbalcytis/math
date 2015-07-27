<?php


namespace Maba\Component\Math\Tests;

use Maba\Component\Math\BcMath;
use Maba\Component\Math\Math;
use Maba\Component\Math\NumberFormatter;
use Maba\Component\Math\NumberFormatterInterface;
use Maba\Component\Math\NumberValidatorInterface;

class NumberFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NumberFormatterInterface
     */
    protected $numberFormatter;

    public function setUp()
    {
        /** @var NumberValidatorInterface $validator */
        $validator = $this->getMock('Maba\Component\Math\NumberValidatorInterface');
        $math = new Math(new BcMath(6, $validator));
        $this->numberFormatter = new NumberFormatter($math, '.', '');
    }

    /**
     * @param string      $expected
     * @param string      $number
     * @param int         $decimals
     * @param null|string $decimalPoint
     * @param null|string $thousandsSeparator
     * @param null|int    $padLength
     *
     * @dataProvider formatProvider
     */
    public function testFormat(
        $expected,
        $number,
        $decimals = 0,
        $decimalPoint = null,
        $thousandsSeparator = null,
        $padLength = null
    ) {
        $this->assertSame(
            $expected,
            $this->numberFormatter->formatNumber($number, $decimals, $decimalPoint, $thousandsSeparator, $padLength)
        );
    }

    public function formatProvider()
    {
        return array(
            array('0', '0'),
            array('1', '1'),
            array('2', '2.11'),
            array('2', '2.11000'),
            array('2.11', '2.11000', 2),
            array('2.00', '2', 2),
            array('2.00', '2.000000', 2),
            array('2.10', '2.1', 2),
            array('2.99', '2.991', 2),
            array('2.990', '2.99', 3),
            array('20', '20.22', -1),

            array('0', '0', 0, ','),
            array('1', '1', 0, ','),
            array('2', '2.11', 0, ','),
            array('2', '2.11000', 0, ','),
            array('2,11', '2.11000', 2, ','),
            array('2,00', '2', 2, ','),
            array('2,00', '2.000000', 2, ','),
            array('2,10', '2.1', 2, ','),
            array('2,99', '2.991', 2, ','),
            array('2,990', '2.99', 3, ','),
            array('20', '20.22', -1, ','),

            array('0', '0', 0, ',', ' '),
            array('0,12', '00000.120000', 2, ',', ' '),
            array('00 000,12', '0.120000', 2, ',', ' ', 5),
            array('012345.00', '12345', 2, '.', '', 6),
            array('123456.12', '123456.12', 2, '.', '', 6),
            array('2', '2.1', 0, ',', ' '),
            array('200', '200', 0, ',', ' '),
            array('200,22', '200.22', 2, ',', ' '),
            array('2 000,22', '2000.22', 2, ',', ' '),
            array('2 000 22', '2000.22', 2, ' ', ' '),
            array('2 00022', '2000.22', 2, '', ' '),
            array('12 345,22', '12345.221', 2, ',', ' '),
            array('123 456,22', '123456.221', 2, ',', ' '),
            array('1 234 567,22', '1234567.221', 2, ',', ' '),
            array('2cd000ab22', '2000.22', 2, 'ab', 'cd'),
            array('12cd345ab22', '12345.221', 2, 'ab', 'cd'),
            array('123cd456ab22', '123456.221', 2, 'ab', 'cd'),
            array('1cd234cd567ab22', '1234567.221', 2, 'ab', 'cd'),

            array('1234567.22', '1234567.221', 2),
            
            array('0', '-0'),
            array('-1', '-1'),
            array('-2', '-2.11'),
            array('-2', '-2.11000'),
            array('-2.11', '-2.11000', 2),
            array('-2.00', '-2', 2),
            array('-2.00', '-2.000000', 2),
            array('-2.10', '-2.1', 2),
            array('-2.99', '-2.991', 2),
            array('-2.990', '-2.99', 3),
            array('-20', '-20.22', -1),

            array('0', '-0', 0, ','),
            array('-1', '-1', 0, ','),
            array('-2', '-2.11', 0, ','),
            array('-2', '-2.11000', 0, ','),
            array('-2,11', '-2.11000', 2, ','),
            array('-2,00', '-2', 2, ','),
            array('-2,00', '-2.000000', 2, ','),
            array('-2,10', '-2.1', 2, ','),
            array('-2,99', '-2.991', 2, ','),
            array('-2,990', '-2.99', 3, ','),
            array('-20', '-20.22', -1, ','),

            array('0', '-0', 0, ',', ' '),
            array('-0,12', '-00000.120000', 2, ',', ' '),
            array('-00 000,12', '-0.120000', 2, ',', ' ', 5),
            array('-012345.00', '-12345', 2, '.', '', 6),
            array('-123456.12', '-123456.12', 2, '.', '', 6),
            array('-2', '-2.1', 0, ',', ' '),
            array('-200', '-200', 0, ',', ' '),
            array('-200,22', '-200.22', 2, ',', ' '),
            array('-2 000,22', '-2000.22', 2, ',', ' '),
            array('-2 000 22', '-2000.22', 2, ' ', ' '),
            array('-2 00022', '-2000.22', 2, '', ' '),
            array('-12 345,22', '-12345.221', 2, ',', ' '),
            array('-123 456,22', '-123456.221', 2, ',', ' '),
            array('-1 234 567,22', '-1234567.221', 2, ',', ' '),
            array('-2cd000ab22', '-2000.22', 2, 'ab', 'cd'),
            array('-12cd345ab22', '-12345.221', 2, 'ab', 'cd'),
            array('-123cd456ab22', '-123456.221', 2, 'ab', 'cd'),
            array('-1cd234cd567ab22', '-1234567.221', 2, 'ab', 'cd'),

            array('-1234567.22', '-1234567.221', 2),
        );
    }

} 