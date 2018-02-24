<?php

namespace App\Twig\Extension;

use App\Entity\AbstractWordInterface;

class WordGenderExtension extends \Twig_Extension
{
    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter('gender_as_string', [$this, 'convertGenderIdToString']),
        ];
    }

    public function convertGenderIdToString(int $id): string
    {
        switch ($id) {
            case AbstractWordInterface::GENDER_MASCULINE:
                return 'mužský rod';
            case AbstractWordInterface::GENDER_FEMININE:
                return 'ženský rod';
            case AbstractWordInterface::GENDER_NEUTER:
                return 'střední rod';
            case AbstractWordInterface::GENDER_UNKNOWN:
            default:
                return '???';
        }
    }
}
