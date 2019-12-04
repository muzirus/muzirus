<?php declare(strict_types=1);

namespace App\Service\Provider;

class CzechAlphabetProvider
{
    private const LETTERS = [
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'ch',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z',
    ];

    /** @return string[] */
    public static function getCzechLetters(): array
    {
        return self::LETTERS;
    }

    public static function getFirstCzechLetter(): string
    {
        return self::LETTERS[0];
    }
}
