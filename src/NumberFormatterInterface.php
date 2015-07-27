<?php


namespace Maba\Component\Math;


interface NumberFormatterInterface
{

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
    public function formatNumber($number, $decimals = 0, $point = null, $thousandsSeparator = null, $padLength = null);
} 