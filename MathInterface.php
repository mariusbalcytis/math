<?php


namespace Maba\Component\Math;


interface MathInterface extends BasicMathInterface
{

    public function negate($operand);
    public function abs($operand);
    public function isEqual($first, $second);
    public function isGt($first, $second);
    public function isLt($first, $second);
    public function isGte($first, $second);
    public function isLte($first, $second);
    public function isPositive($operand);
    public function isNegative($operand);
    public function isZero($operand);
    public function round($operand, $precision = 0, $mode = PHP_ROUND_HALF_UP);
    public function floor($operand, $precision = 0);
    public function ceil($operand, $precision = 0);
}