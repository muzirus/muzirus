<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\AbstractWordInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class StatusLightExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'convert_status_code_to_icon',
                function (int $status) {
                    return $this->getStatusLightCode($status);
                },
                [
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
            new TwigFilter(
                'convert_status_code_to_class',
                function (int $status) {
                    return $this->getStatusLightClass($status);
                }
            ),
        ];
    }

    private function getStatusLightCode(int $status): string
    {
        switch ($status) {
            case AbstractWordInterface::STATUS_LIGHT_EQUIVALENTS_NOT_FOUND:
                return '<i class="fa fa-times-circle text-red"></i>';
            case AbstractWordInterface::STATUS_LIGHT_EXAMPLES_FOUND:
                return '<i class="fa fa-circle text-yellow"></i>';
            case AbstractWordInterface::STATUS_LIGHT_CHECKED:
                return '<i class="fa fa-check-circle text-green"></i>';
            case AbstractWordInterface::STATUS_LIGHT_NOT_PROCESSED:
            default:
                return '<i class="fa fa-question-circle text-gray"></i>';
        }
    }

    private function getStatusLightClass(int $status): string
    {
        switch ($status) {
            case AbstractWordInterface::STATUS_LIGHT_EQUIVALENTS_NOT_FOUND:
                //return 'danger';
                return '';
            case AbstractWordInterface::STATUS_LIGHT_EXAMPLES_FOUND:
                return 'warning';
            case AbstractWordInterface::STATUS_LIGHT_CHECKED:
                return 'success';
            case AbstractWordInterface::STATUS_LIGHT_NOT_PROCESSED:
            default:
                return '';
        }
    }
}
