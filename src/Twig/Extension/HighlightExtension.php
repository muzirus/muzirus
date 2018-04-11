<?php declare(strict_types=1);

namespace App\Twig\Extension;

class HighlightExtension extends \Twig_Extension
{
    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter(
                'highlight_accent',
                function (string $text) {
                    return $this->highlightAccent($text);
                },
                [
                    'pre_escape' => 'html',
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
            new \Twig_SimpleFilter(
                'highlight_cyrillic',
                function (string $text) {
                    return $this->highlightCyrillic($text);
                },
                [
                    'pre_escape' => 'html',
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
            new \Twig_SimpleFilter(
                'highlight_latin',
                function (string $text) {
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

    private function highlightAccent(string $text): string
    {
        return preg_replace(
            '/\((.)\)/u',
            '<span class="highlight-accent">$1</span>',
            $text
        );
    }

    private function highlightCyrillic(string $text): string
    {
        return preg_replace(
            '/([\p{Cyrillic}]+)/u',
            '<span class="highlight-cyrillic">$1</span>',
            $text
        );
    }

    private function highlightLatin(string $text): string
    {
        return preg_replace(
            '/([\p{Latin}]+)/u',
            '<span class="highlight-latin">$1</span>',
            $text
        );
    }
}
