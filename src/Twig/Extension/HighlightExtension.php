<?php

namespace App\Twig\Extension;

class HighlightExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('highlight_accent', [$this, 'highlightAccent']),
            new \Twig_SimpleFilter('highlight_cyrillic', [$this, 'highlightCyrillic']),
            new \Twig_SimpleFilter('highlight_latin', [$this, 'highlightLatin']),
        ];
    }

    public function highlightAccent(string $text): string
    {
        return preg_replace(
            '/\((.)\)/u',
            '<span class="highlight-accent">$1</span>',
            $text
        );
    }

    public function highlightCyrillic(string $text): string
    {
        return preg_replace(
            '/([\p{Cyrillic}]+)/u',
            '<span class="highlight-cyrillic">$1</span>',
            $text
        );
    }

    public function highlightLatin(string $text): string
    {
        return preg_replace(
            '/([\p{Latin}]+)/u',
            '<span class="highlight-latin">$1</span>',
            $text
        );
    }
}
