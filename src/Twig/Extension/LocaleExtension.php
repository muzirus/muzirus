<?php declare(strict_types=1);

namespace App\Twig\Extension;

use Symfony\Component\Intl\Locales;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LocaleExtension extends AbstractExtension
{
    /** @var string[] */
    private $localeCodes;

    /** @var string[]|null */
    private $locales;

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

    public function getLocales(): array
    {
        if ($this->locales !== null) {
            return $this->locales;
        }

        $this->locales = [];
        foreach ($this->localeCodes as $localeCode) {
            $this->locales[] = [
                'code' => $localeCode,
                'name' => Locales::getName($localeCode, $localeCode),
            ];
        }

        return $this->locales;
    }
}
