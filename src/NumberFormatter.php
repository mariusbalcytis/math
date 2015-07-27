<?php


namespace Maba\Component\Math;


class NumberFormatter implements NumberFormatterInterface
{
    protected $math;
    protected $defaultDecimalPoint;
    protected $defaultThousandsSeparator;

    public function __construct(MathInterface $math, $defaultDecimalPoint = '.', $defaultThousandsSeparator = '')
    {
        $this->math = $math;
        $this->defaultDecimalPoint = $defaultDecimalPoint;
        $this->defaultThousandsSeparator = $defaultThousandsSeparator;
    }

    /**
     * Formats number
     *
     * @param string      $number
     * @param int         $decimals
     * @param string|null $point Separator as decimal point
     * @param string|null $thousandsSeparator Separator for thousands
     * @param int|null    $padLength if provided, zeros are padded to the left. Provides needed integer part length
     *
     * @return string
     */
    public function formatNumber($number, $decimals = 0, $point = null, $thousandsSeparator = null, $padLength = null)
    {
        if ($point === null) {
            $point = $this->defaultDecimalPoint;
        }
        if ($thousandsSeparator === null) {
            $thousandsSeparator = $this->defaultThousandsSeparator;
        }

        $number = $this->math->round($number, $decimals);
        $negative = $this->math->isNegative($number);
        $number = $this->math->abs($number);

        $parts = explode('.', $number, 2);
        $integer = $parts[0];
        $fraction = isset($parts[1]) ? $parts[1] : '0';

        $integer = str_pad(
            ltrim($integer, '0'),
            $padLength !== null && $padLength > 1 ? $padLength : 1,
            '0',
            STR_PAD_LEFT
        );
        $result = ltrim(implode($thousandsSeparator, str_split(
            str_repeat(' ', (3 - strlen($integer) % 3) % 3) . $integer,
            3
        )), ' ');
        if ($result === '') {
            $result = '0';
        }

        if ($decimals > 0) {
            $result .= $point . str_pad(substr($fraction, 0, $decimals), $decimals, '0', STR_PAD_RIGHT);
        }

        if ($negative) {
            $result = '-' . $result;
        }

        return $result;
    }

} 