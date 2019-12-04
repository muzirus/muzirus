<?php declare(strict_types=1);

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HighlightExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'highlight_accent',
                function (string $text): string {
                    return $this->highlightAccent($text);
                },
                [
                    'pre_escape' => 'html',
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
            new TwigFilter(
                'highlight_cyrillic',
                function (string $text): string {
                    return $this->highlightCyrillic($text);
                },
                [
                    'pre_escape' => 'html',
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
            new TwigFilter(
                'highlight_latin',
                function (string $text): string {
                    return $this->highlightLatin($text);
                },
                [
                    'pre_escape' => 'html',
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
        ];
    }

    public function highlightAccent(string $text): string
    {
        return (string) preg_replace(
            '/\((.)\)/u',
            '<span class="highlight-accent">$1</span>',
            $text
        );
    }

    private function highlightCyrillic(string $text): string
    {
        return (string) preg_replace(
            '/([\p{Cyrillic}]+)/u',
            '<span class="highlight-cyrillic">$1</span>',
            $text
        );
    }

    private function highlightLatin(string $text): string
    {
        return (string) preg_replace(
            '/([\p{Latin}]+)/u',
            '<span class="highlight-latin">$1</span>',
            $text
        );
    }
}
