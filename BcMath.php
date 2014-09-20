<?php


namespace Maba\Component\Math;

use Maba\Component\Math\Exception\DivisionByZeroException;

class BcMath implements BasicMathInterface
{
    protected $scale;
    protected $validator;

    public function __construct($scale = 20, NumberValidatorInterface $validator = null)
    {
        $this->scale = $scale;
        $this->validator = $validator !== null ? $validator : new NumberValidator();
    }

    public function add($first, $second)
    {
        $this->validator->validateNumber($first);
        $this->validator->validateNumber($second);
        return bcadd($first, $second, $this->scale);
    }

    public function sub($first, $second)
    {
        $this->validator->validateNumber($first);
        $this->validator->validateNumber($second);
        return bcsub($first, $second, $this->scale);
    }

    public function div($first, $second)
    {
        $this->validator->validateNumber($first);
        $this->validator->validateNumber($second);
        $result = bcdiv($first, $second, $this->scale);
        if ($result === null) {
            throw new DivisionByZeroException(sprintf('Division by zero (%s / %s)', $first, $second));
        }
        return $result;
    }

    public function mul($first, $second)
    {
        $this->validator->validateNumber($first);
        $this->validator->validateNumber($second);
        return bcmul($first, $second, $this->scale);
    }

    public function comp($first, $second)
    {
        $this->validator->validateNumber($first);
        $this->validator->validateNumber($second);
        return bccomp($first, $second, $this->scale);
    }

    public function pow($first, $second)
    {
        $this->validator->validateNumber($first);
        $this->validator->validateNumber($second);
        return bcpow($first, $second, $this->scale);
    }

    public function mod($first, $second)
    {
        $this->validator->validateNumber($first);
        $this->validator->validateNumber($second);
        return bcmod($first, $second);
    }

} 