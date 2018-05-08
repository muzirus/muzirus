<?php declare(strict_types=1);

namespace App\Tests\Service\Provider;

use App\Service\Provider\RussianAlphabetProvider;
use PHPUnit\Framework\TestCase;

class RussianAlphabetProviderTest extends TestCase
{
    public function testShouldReturnRussianLetters(): void
    {
        $this->assertEquals(
            [
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
            ],
            RussianAlphabetProvider::getRussianLetters()
        );
    }

    public function testShouldReturnFirstRussianLetter(): void
    {
        $this->assertSame('а', RussianAlphabetProvider::getFirstRussianLetter());
    }
}
