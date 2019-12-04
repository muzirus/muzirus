<?php declare(strict_types=1);

namespace App\Service\Provider;

class RussianAlphabetProvider
{
    private const LETTERS = [
        'а',
        'б',
        'в',
        'г',
        'д',
        'e',
        'ё',
        'ж',
        'з',
        'и',
        'й',
        'к',
        'л',
        'м',
        'н',
        'o',
        'п',
        'р',
        'с',
        'т',
        'y',
        'ф',
        'х',
        'ц',
        'ч',
        'ш',
        'щ',
        'ы',
        'э',
        'ю',
        'я',
    ];

    /** @return string[] */
    public static function getRussianLetters(): array
    {
        return self::LETTERS;
    }

    public static function getFirstRussianLetter(): string
    {
        return self::LETTERS[0];
    }
}
