<?php


namespace Maba\Component\Math;


class Math implements MathInterface
{
    protected $math;

    public function __construct(BasicMathInterface $math)
    {
        $this->math = $math;
    }

    public function add($first, $second)
    {
        return $this->math->add($first, $second);
    }

    public function sub($first, $second)
    {
        return $this->math->sub($first, $second);
    }

    public function div($first, $second)
    {
        return $this->math->div($first, $second);
    }

    public function mul($first, $second)
    {
        return $this->math->mul($first, $second);
    }

    public function pow($first, $second)
    {
        return $this->math->pow($first, $second);
    }

    public function mod($first, $second)
    {
        return $this->math->mod($first, $second);
    }

    public function comp($first, $second)
    {
        return $this->math->comp($first, $second);
    }

    public function negate($operand)
    {
        return $this->mul($operand, '-1');
    }

    public function abs($operand)
    {
        return $this->isGte($operand, '0') ? $operand : $this->negate($operand);
    }

    public function isEqual($first, $second)
    {
        return $this->comp($first, $second) === 0;
    }

    public function isGt($first, $second)
    {
        return $this->comp($first, $second) > 0;
    }

    public function isLt($first, $second)
    {
        return $this->comp($first, $second) < 0;
    }

    public function isGte($first, $second)
    {
        return $this->comp($first, $second) >= 0;
    }

    public function isLte($first, $second)
    {
        return $this->comp($first, $second) <= 0;
    }

    public function isPositive($operand)
    {
        return $this->isGt($operand, '0');
    }

    public function isNegative($operand)
    {
        return $this->isLt($operand, '0');
    }

    public function isZero($operand)
    {
        return $this->isEqual($operand, '0');
    }

    public function round($operand, $precision = 0, $mode = PHP_ROUND_HALF_UP)
    {
        $multiplier = $this->pow('10', $precision);
        $operand = $this->mul($operand, $multiplier);
        if (($fraction = strstr($operand, '.')) !== false) {
            $fraction = '0' . $fraction;
            $positive = $this->isPositive($operand);
            $operand = $positive ? $this->sub($operand, $fraction) : $this->add($operand, $fraction);

            if (
                $mode === PHP_ROUND_HALF_UP && $this->isGte($fraction, '0.5')
                || $this->isGt($fraction, '0.5')
                || (
                    $mode === PHP_ROUND_HALF_EVEN
                    && $this->isEqual($fraction, '0.5')
                    && !$this->isZero($this->mod($operand, 2))
                )
                || (
                    $mode === PHP_ROUND_HALF_ODD
                    && $this->isEqual($fraction, '0.5')
                    && $this->isZero($this->mod($operand, 2))
                )
            ) {
                $operand = $positive ? $this->add($operand, '1') : $this->sub($operand, '1');
            }
        }
        return $this->div($operand, $multiplier);
    }

    public function floor($operand, $precision = 0)
    {
        $multiplier = $this->pow('10', $precision);
        $operand = $this->mul($operand, $multiplier);
        if (($fraction = strstr($operand, '.')) !== false) {
            $fraction = '0' . $fraction;
            if ($this->isPositive($fraction)) {
                $operand = $this->isPositive($operand)
                    ? $this->sub($operand, $fraction)
                    : $this->sub($this->add($operand, $fraction), '1');
            }
        }
        return $this->div($operand, $multiplier);
    }

    public function ceil($operand, $precision = 0)
    {
        $multiplier = $this->pow('10', $precision);
        $operand = $this->mul($operand, $multiplier);
        if (($fraction = strstr($operand, '.')) !== false) {
            $fraction = '0' . $fraction;
            if ($this->isPositive($fraction)) {
                $operand = $this->isPositive($operand)
                    ? $this->add($this->sub($operand, $fraction), '1')
                    : $this->add($operand, $fraction);
            }
        }
        return $this->div($operand, $multiplier);
    }

} 