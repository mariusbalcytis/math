<?php


namespace Maba\Component\Math\Tests;

use Maba\Component\Math\BcMath;
use Maba\Component\Math\Math;
use Maba\Component\Math\MathInterface;
use Maba\Component\Math\NumberValidatorInterface;

/**
 * Tests Math together with BcMath to test use-cases without mocking
 */
class MathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MathInterface
     */
    protected $math;

    public function setUp()
    {
        /** @var NumberValidatorInterface $validator */
        $validator = $this->getMock('Maba\Component\Math\NumberValidatorInterface');
        $this->math = new Math(new BcMath(6, $validator));
    }

    /**
     * @param string $operand
     * @param string $result
     *
     * @dataProvider negateProvider
     */
    public function testNegate($result, $operand)
    {
        $this->assertSameNumber($result, $this->math->negate($operand));
    }

    /**
     * @param string $operand
     * @param string $result
     *
     * @dataProvider absProvider
     */
    public function testAbs($result, $operand)
    {
        $this->assertSameNumber($result, $this->math->abs($operand));
    }

    /**
     * @param string $result
     * @param string $operand
     * @param int $precision
     * @param int $mode
     *
     * @dataProvider roundProvider
     */
    public function testRound($result, $operand, $precision = 0, $mode = PHP_ROUND_HALF_UP)
    {
        $this->assertSameNumber($result, $this->math->round($operand, $precision, $mode));
    }

    /**
     * @param string $result
     * @param string $operand
     * @param int $precision
     *
     * @dataProvider floorProvider
     */
    public function testFloor($result, $operand, $precision = 0)
    {
        $this->assertSameNumber($result, $this->math->floor($operand, $precision));
    }

    /**
     * @param string $result
     * @param string $operand
     * @param int $precision
     *
     * @dataProvider ceilProvider
     */
    public function testCeil($result, $operand, $precision = 0)
    {
        $this->assertSameNumber($result, $this->math->ceil($operand, $precision));
    }

    public function negateProvider()
    {
        return array(
            array('1', '-1'),
            array('-21234.111254', '21234.111254'),
        );
    }

    public function absProvider()
    {
        return array(
            array('1', '-1'),
            array('1', '1'),
            array('21234.111254', '-21234.111254'),
            array('21234.111254', '21234.111254'),
        );
    }

    public function roundProvider()
    {
        return array(
            array('2', '2'),
            array('2', '2.1'),
            array('2', '2.499999'),
            array('3', '2.5'),
            array('3', '2.7'),
            array('0', '0'),
            array('-2', '-2'),
            array('-2', '-2.1'),
            array('-2', '-2.499999'),
            array('-3', '-2.5'),
            array('-3', '-2.7'),
            array('2', '2', 1),
            array('2.1', '2.1', 1),
            array('2.1', '2.12', 1),
            array('2.1', '2.149999', 1),
            array('2.2', '2.15', 1),
            array('2.2', '2.15000', 1),
            array('2.2', '2.17', 1),
            array('-2', '-2', 1),
            array('-2.1', '-2.1', 1),
            array('-2.1', '-2.12', 1),
            array('-2.1', '-2.149999', 1),
            array('-2.2', '-2.15', 1),
            array('-2.2', '-2.15000', 1),
            array('-2.2', '-2.17', 1),
            array('0', '-2.17', -2),
            array('0', '2.17', -2),
            array('100', '100', -2),
            array('100', '130', -2),
            array('100', '149.999999', -2),
            array('200', '150', -2),
            array('200', '186', -2),
            array('-100', '-100', -2),
            array('-100', '-130', -2),
            array('-100', '-149.999999', -2),
            array('-200', '-150', -2),
            array('-200', '-186', -2),

            array('2', '2', 0, PHP_ROUND_HALF_DOWN),
            array('2', '2.1', 0, PHP_ROUND_HALF_DOWN),
            array('2', '2.5', 0, PHP_ROUND_HALF_DOWN),
            array('3', '2.6', 0, PHP_ROUND_HALF_DOWN),
            array('-2', '-2', 0, PHP_ROUND_HALF_DOWN),
            array('-2', '-2.1', 0, PHP_ROUND_HALF_DOWN),
            array('-2', '-2.5', 0, PHP_ROUND_HALF_DOWN),
            array('-3', '-2.6', 0, PHP_ROUND_HALF_DOWN),

            array('1.2', '1.25', 1, PHP_ROUND_HALF_DOWN),
            array('20', '25', -1, PHP_ROUND_HALF_DOWN),
            array('-1.2', '-1.25', 1, PHP_ROUND_HALF_DOWN),
            array('-20', '-25', -1, PHP_ROUND_HALF_DOWN),

            array('10', '9.5', 0, PHP_ROUND_HALF_EVEN),
            array('9', '9.5', 0, PHP_ROUND_HALF_ODD),
            array('8', '8.5', 0, PHP_ROUND_HALF_EVEN),
            array('9', '8.5', 0, PHP_ROUND_HALF_ODD),

            array('1.6', '1.55', 1, PHP_ROUND_HALF_EVEN),
            array('1.5', '1.54', 1, PHP_ROUND_HALF_EVEN),
            array('-1.6', '-1.55', 1, PHP_ROUND_HALF_EVEN),
            array('-1.5', '-1.54', 1, PHP_ROUND_HALF_EVEN),

            array('1.5', '1.55', 1, PHP_ROUND_HALF_ODD),
            array('1.5', '1.54', 1, PHP_ROUND_HALF_ODD),
            array('-1.5', '-1.55', 1, PHP_ROUND_HALF_ODD),
            array('-1.5', '-1.54', 1, PHP_ROUND_HALF_ODD),
        );
    }

    public function floorProvider()
    {
        return array(
            array('0', '0'),
            array('2', '2'),

            array('4', '4.3'),
            array('9', '9.999'),
            array('-4', '-3.14'),

            array('4.3', '4.3', 1),
            array('9.9', '9.999', 1),
            array('-3.2', '-3.14', 1),
            array('-3.2', '-3.174', 1),
            array('-3.2', '-3.15', 1),
            array('-3.2', '-3.2', 1),

            array('-40', '-31.5', -1),
            array('990', '999.12', -1),
            array('720', '721.12', -1),
            array('720', '720', -1),
            array('-720', '-720', -1),
        );
    }

    public function ceilProvider()
    {
        return array(
            array('0', '0'),
            array('2', '2'),

            array('5', '4.3'),
            array('10', '9.999'),
            array('-3', '-3.14'),

            array('4.3', '4.3', 1),
            array('10', '9.999', 1),
            array('-3.1', '-3.14', 1),
            array('-3.1', '-3.174', 1),
            array('-3.1', '-3.15', 1),
            array('-3.2', '-3.2', 1),

            array('-30', '-31.5', -1),
            array('1000', '999.12', -1),
            array('730', '721.12', -1),
            array('720', '720', -1),
            array('-720', '-720', -1),
        );
    }

    protected function assertSameNumber($expected, $actual, $message = '')
    {
        if (is_string($actual) && strpos($actual, '.') !== false) {
            $actual = rtrim(rtrim($actual, '0'), '.');
        }
        $this->assertSame($expected, $actual, $message);
    }

} 