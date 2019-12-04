<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\AbstractWordInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WordTypeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('type_as_string', function (int $type): string {
                return $this->convertTypeIdToString($type);
            }),
        ];
    }

    public function convertTypeIdToString(int $type): string
    {
        switch ($type) {
            case AbstractWordInterface::TYPE_NOUN:
                return 'podst. jm.';
            case AbstractWordInterface::TYPE_VERB:
                return 'slov.';
            case AbstractWordInterface::TYPE_ADJECTIVE:
                return 'příd. jm.';
            case AbstractWordInterface::TYPE_PRONOUN:
                return 'zájm.';
            case AbstractWordInterface::TYPE_NUMERAL:
                return 'čísl.';
            case AbstractWordInterface::TYPE_ADVERB:
                return 'přísl.';
            case AbstractWordInterface::TYPE_PREPOSITION:
                return 'předl.';
            case AbstractWordInterface::TYPE_CONJUNCTION:
                return 'spoj.';
            case AbstractWordInterface::TYPE_PARTICLE:
                return 'část.';
            case AbstractWordInterface::TYPE_INTERJECTION:
                return 'cit.';
            case AbstractWordInterface::TYPE_UNKNOWN:
            default:
                return '';
        }
    }
}
