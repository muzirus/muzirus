<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Service\MarkdownParser;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MarkdownExtension extends AbstractExtension
{
    private MarkdownParser $markdownParser;

    public function __construct(MarkdownParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'md2html',
                function (string $text): string {
                    return $this->markdownParser->parseToHtml($text);
                },
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }
}
