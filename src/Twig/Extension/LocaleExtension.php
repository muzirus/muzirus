<?php declare(strict_types=1);

namespace App\Twig\Extension;

use Symfony\Component\Intl\Locales;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LocaleExtension extends AbstractExtension
{
    /** @var string[] */
    private $localeCodes;

    public function __construct(string $locales)
    {
        $this->localeCodes = explode('|', $locales);
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_locales', [$this, 'getLocales']),
        ];
    }

    /** @return string[][] */
    public function getLocales(): array
    {
        return array_map(
            static function (string $localeCode): array {
                return [
                    'code' => $localeCode,
                    'name' => Locales::getName($localeCode, $localeCode),
                ];
            },
            $this->localeCodes
        );
    }
}
