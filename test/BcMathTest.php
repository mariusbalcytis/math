<?php


namespace Maba\Component\Math\Tests;

use Maba\Component\Math\BcMath;
use Maba\Component\Math\NumberValidatorInterface;

class BcMathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BcMath
     */
    protected $math;

    public function setUp()
    {
        /** @var NumberValidatorInterface $validator */
        $validator = $this->getMock('Maba\Component\Math\NumberValidatorInterface');
        $this->math = new BcMath(6, $validator);
    }

    /**
     * @param string $first
     * @param string $second
     * @param string $result
     *
     * @dataProvider addProvider
     */
    public function testAdd($result, $first, $second)
    {
        $this->assertSameNumber($result, $this->math->add($first, $second));
    }

    /**
     * @param string $first
     * @param string $second
     * @param string $result
     *
     * @dataProvider subProvider
     */
    public function testSub($result, $first, $second)
    {
        $this->assertSameNumber($result, $this->math->sub($first, $second));
    }

    /**
     * @param string $first
     * @param string $second
     * @param string $result
     *
     * @dataProvider divProvider
     */
    public function testDiv($result, $first, $second)
    {
        $this->assertSameNumber($result, $this->math->div($first, $second));
    }

    /**
     * @param string $first
     * @param string $second
     * @param string $result
     *
     * @dataProvider mulProvider
     */
    public function testMul($result, $first, $second)
    {
        $this->assertSameNumber($result, $this->math->mul($first, $second));
    }

    /**
     * @param string $first
     * @param string $second
     * @param string $result
     *
     * @dataProvider compProvider
     */
    public function testComp($result, $first, $second)
    {
        $this->assertSameNumber($result, $this->math->comp($first, $second));
    }

    /**
     * @param string $first
     * @param string $second
     * @param string $result
     *
     * @dataProvider powProvider
     */
    public function testPow($result, $first, $second)
    {
        $this->assertSameNumber($result, $this->math->pow($first, $second));
    }

    /**
     * @param string $first
     * @param string $second
     * @param string $result
     *
     * @dataProvider modProvider
     */
    public function testMod($result, $first, $second)
    {
        $this->assertSameNumber($result, $this->math->mod($first, $second));
    }

    public function addProvider()
    {
        return array(
            array('3', '1', '2'),
            array('-24654.120559', '-2212.999329', '-22441.12123'),
            array('20228.121901', '-2212.999329', '22441.12123'),
            array('9223372036854775808', '9223372036854775807', '1'),
            array('-9223372036854775808', '-9223372036854775807', '-1'),
            array('1.200002', '-9223372036854775808.021', '9223372036854775809.221002'),
            array('3.123456', '1.1234567', '2'),
        );
    }

    public function subProvider()
    {
        return array(
            array('3', '1', '-2'),
        );
    }

    public function divProvider()
    {
        return array(
            array('3', '6', '2'),
            array('29.98001', '12355.1221', '412.112'),
        );
    }

    public function mulProvider()
    {
        return array(
            array('6', '3', '2'),
            array('6389376070676.240175', '29.98001', '213121212123.553'),
        );
    }

    public function compProvider()
    {
        return array(
            array(1, '3', '2'),
            array(1, '-1', '-2'),
            array(-1, '-12.222222', '-12.222221'),
            array(0, '-12.222222', '-12.2222224'),
        );
    }

    public function powProvider()
    {
        return array(
            array('9', '3', '2'),
            array('1073741824', '2', '30'),
        );
    }

    public function modProvider()
    {
        return array(
            array('2', '17', '3'),
            array('0', '44', '2'),
            array('3', '4422', '9'),
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