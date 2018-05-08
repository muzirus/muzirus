<?php declare(strict_types=1);

namespace App\Tests\Service\Provider;

use App\Service\Provider\CzechAlphabetProvider;
use PHPUnit\Framework\TestCase;

class CzechAlphabetProviderTest extends TestCase
{
    public function testShouldReturnCzechLetters(): void
    {
        $this->assertEquals(
            [
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
            ],
            CzechAlphabetProvider::getCzechLetters()
        );
    }

    public function testShouldReturnFirstCzechLetter(): void
    {
        $this->assertSame('a', CzechAlphabetProvider::getFirstCzechLetter());
    }
}
