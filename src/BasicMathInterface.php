<?php


namespace Maba\Component\Math;


interface BasicMathInterface
{

    public function add($first, $second);
    public function sub($first, $second);
    public function div($first, $second);
    public function mul($first, $second);
    public function comp($first, $second);
    public function pow($first, $second);
    public function mod($first, $second);
}