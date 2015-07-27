<?php


namespace Maba\Component\Math;

use Maba\Component\Math\Exception\InvalidNumberException;

class NumberValidator implements NumberValidatorInterface
{

    public function validateNumber($number)
    {
        if (!is_scalar($number)) {
            throw new InvalidNumberException(
                sprintf('Given number is not scalar %s', is_object($number) ? get_class($number) : gettype($number))
            );
        }
        if (!preg_match('/^-?\d+(\.\d+)?$/', $number)) {
            throw new InvalidNumberException(sprintf('Invalid number %s', $number));
        }
    }

} 