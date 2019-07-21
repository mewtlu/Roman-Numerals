<?php
namespace App\Helper;

use PHPUnit\Framework\TestCase;

/**
 * Test case for RomanNumerals class
 */
final class RomanNumeralsTest extends TestCase
{
    const TESTVALUES = [
        [
            'conversionInteger' => 1,
            'expectedString' => 'I',
        ],
        [
            'conversionInteger' => 2,
            'expectedString' => 'II',
        ],
        [
            'conversionInteger' => 3,
            'expectedString' => 'III',
        ],
        [
            'conversionInteger' => 4,
            'expectedString' => 'IV',
        ],
        [
            'conversionInteger' => 5,
            'expectedString' => 'V',
        ],
        [
            'conversionInteger' => 6,
            'expectedString' => 'VI',
        ],
        [
            'conversionInteger' => 9,
            'expectedString' => 'IX',
        ],
        [
            'conversionInteger' => 20,
            'expectedString' => 'XX',
        ],
        [
            'conversionInteger' => 123,
            'expectedString' => 'CXXIII',
        ],
        [
            'conversionInteger' => 2174,
            'expectedString' => 'MMCLXXIV',
        ],
        [
            'conversionInteger' => 3999,
            'expectedString' => 'MMMCMXCIX',
        ]
    ];

    public function testGenerate(): void
    {
        foreach ($this::TESTVALUES as $arrValueSet) {
            $strActualConvertedValue = RomanNumerals::generate($arrValueSet['conversionInteger']);
            $this->assertEquals($arrValueSet['expectedString'], $strActualConvertedValue);
        }
    }
}
