<?php

namespace App\Twig\Extension;

use App\Entity\AbstractWordInterface;

class StatusLightExtension extends \Twig_Extension
{
    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter('convert_status_code_to_icon', [$this, 'getStatusLightCode']),
        ];
    }

    public function getStatusLightCode(int $status): string
    {
        switch ($status) {
            case AbstractWordInterface::STATUS_LIGHT_RED:
                return '<i class="fa fa-times-circle text-red"></i>';
            case AbstractWordInterface::STATUS_LIGHT_YELLOW:
                return '<i class="fa fa-circle text-yellow"></i>';
            case AbstractWordInterface::STATUS_LIGHT_GREEN:
                return '<i class="fa fa-check-circle text-green"></i>';
            case AbstractWordInterface::STATUS_LIGHT_UNKNOWN:
            default:
                return '<i class="fa fa-question-circle text-gray"></i>';
        }
    }
}