<?php


namespace Maba\Component\Math;


use Maba\Component\Math\Exception\InvalidNumberException;

interface NumberValidatorInterface
{

    /**
     * @param mixed $number
     * @throws InvalidNumberException
     */
    public function validateNumber($number);
} 