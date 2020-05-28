<?php declare(strict_types=1);

namespace App\Service;

class MarkdownParser implements MarkdownParserInterface
{
    private const PURIFIER_CONFIG = [
        'Cache.DefinitionImpl' => null, // Disable caching
    ];

    private \Parsedown $parsedown;

    private \HTMLPurifier $purifier;

    public function __construct()
    {
        $this->parsedown = new \Parsedown();

        $purifierConfig = \HTMLPurifier_Config::create(self::PURIFIER_CONFIG);

        $this->purifier = new \HTMLPurifier($purifierConfig);
    }

    public function parseToHtml(string $text): string
    {
        $html = $this->parsedown->text($text);

        return $this->purifier->purify($html);
    }
}
