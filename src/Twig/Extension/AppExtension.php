<?php declare(strict_types=1);
/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Extension;

use Symfony\Component\Intl\Intl;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $localeCodes;

    private $locales;

    public function __construct($locales)
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
                'name' => Intl::getLocaleBundle()->getLocaleName($localeCode, $localeCode),
            ];
        }

        return $this->locales;
    }
}
