<?php
namespace App\Helper;

use \App\Interfaces\RomanNumeralGenerator;

class RomanNumerals implements RomanNumeralGenerator
{
    private static $arrDigits = [
        1 => 'I',
        5 => 'V',
        10 => 'X',
        50 => 'L',
        100 => 'C',
        500 => 'D',
        1000 => 'M',
    ];

    private static $bAllDigitsGenerated = false;

    /**
     * This function dynamically generates Roman numerals that are 1/10/100...
     *  lower than the 'known values', dependent on their magnitutde. For
     *  example we'll generate 9 from 10 - 1, 40 from 50 - 10, and 900 from 1000
     *  - 100.
     * @return Void
     */
    private static function _generateValues(): Void
    {
        self::$bAllDigitsGenerated = true;
        $intLastDigit = 1;
        $intLastTenDigit = 1;
        $arrTempDigits = self::$arrDigits;
        foreach($arrTempDigits as $intDigit => $strDigit) {
            if ($intDigit === 1) {
                continue;
            }

            $strIntDigit = substr(strval($intDigit), 0, 1);
            switch ($strIntDigit) {
                case '1':
                    self::$arrDigits[$intDigit - $intLastTenDigit] = self::$arrDigits[$intLastTenDigit].self::$arrDigits[$intDigit];
                    $intLastTenDigit = $intDigit;
                    break;
                case '5':
                    self::$arrDigits[$intDigit - $intLastDigit] = self::$arrDigits[$intLastDigit].self::$arrDigits[$intDigit];
                    break;
            }
            $intLastDigit = $intDigit;
        }
        ksort(self::$arrDigits, 1); // numeric sort on keys
    }

    /**
     * @param  Integer $number - The value to be converted to Roman numerals
     * @return String
     */
    public static function generate(int $number): String
    {
        if (!self::$bAllDigitsGenerated) {
            self::_generateValues();
        }

        $arrConvertedNumber = [];

        foreach(array_reverse(self::$arrDigits, true) as $intDigit => $strDigit) {
            while ($number >= $intDigit) {
                $number -=  $intDigit;
                $arrConvertedNumber[] = $strDigit;
            }
        }

        return implode($arrConvertedNumber, '');
    }
}