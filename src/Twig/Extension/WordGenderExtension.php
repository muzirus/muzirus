<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\AbstractWordInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WordGenderExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('gender_as_string', function (int $gender): string {
                return $this->convertGenderIdToString($gender);
            }),
        ];
    }

    public function convertGenderIdToString(int $gender): string
    {
        switch ($gender) {
            case AbstractWordInterface::GENDER_MASCULINE:
                return 'm';
            case AbstractWordInterface::GENDER_FEMININE:
                return 'ž';
            case AbstractWordInterface::GENDER_NEUTER:
                return 's';
            case AbstractWordInterface::GENDER_UNKNOWN:
            default:
                return '';
        }
    }
}
