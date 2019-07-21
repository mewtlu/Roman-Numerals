<?php
namespace App\Interfaces;

interface RomanNumeralGenerator
{
    public static function generate(int $number): String;
}
