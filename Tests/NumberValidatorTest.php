<?php

namespace Maba\Component\Math\Tests;

use Maba\Component\Math\NumberValidator;
use Maba\Component\Math\NumberValidatorInterface;

class NumberValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NumberValidatorInterface
     */
    protected $numberValidator;

    public function setUp()
    {
        $this->numberValidator = new NumberValidator();
    }

    /**
     * @param mixed $number
     *
     * @dataProvider validNumberProvider
     */
    public function testValidateNumberWithValidNumber($number)
    {
        $this->numberValidator->validateNumber($number);
        $this->addToAssertionCount(1);  // we assert that exception is not thrown
    }

    /**
     * @param mixed $number
     *
     * @expectedException \Maba\Component\Math\Exception\InvalidNumberException
     * @dataProvider invalidNumberProvider
     */
    public function testValidateNumberWithInvalidNumber($number)
    {
        $this->numberValidator->validateNumber($number);
    }

    public function validNumberProvider()
    {
        return array(
            array('0'),
            array('-0'),
            array('0.123'),
            array('123.123'),
            array('12345678901234567890123456789'),
            array('123456789012345678901234567890.123456789012345678901234567890'),
            array('-123456789012345678901234567890'),
            array('-123456789012345678901234567890.123456789012345678901234567890'),
            array('1.000000'),
            array('-1.000000'),
            array('00001'),
            array('00001.00001'),
            array(123),
            array(0),
            array((float)0),
            array(-123),
            array(0.123),
            array(-0.123),
            array(123.123),
            array(-123.123),
        );
    }

    public function invalidNumberProvider()
    {
        return array(
            array(array()),
            array(array(1)),
            array(new \stdClass()),
            array('a'),
            array('123a'),
            array('123.123a'),
            array('a123.123'),
            array('123a.123'),
            array('123E+2'),
            array('123E-2'),
            array('0.1E+2'),
            array('1,2'),
            array('1,200.00'),
            array('1 100'),
            array('1 100.12'),
            array('1 100,12'),
        );
    }

} 