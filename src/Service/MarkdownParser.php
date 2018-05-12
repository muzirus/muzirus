<?php declare(strict_types=1);

namespace App\Service;

class MarkdownParser implements MarkdownParserInterface
{
    private const PURIFIER_CONFIG = [
        'Cache.DefinitionImpl' => null, // Disable caching
    ];

    /** @var \Parsedown */
    private $parsedown;

    /** @var \HTMLPurifier_Config */
    private $purifierConfig;

    /** @var \HTMLPurifier */
    private $purifier;

    public function __construct()
    {
        $this->parsedown = new \Parsedown();

        $this->purifierConfig = \HTMLPurifier_Config::create(self::PURIFIER_CONFIG);

        $this->purifier = new \HTMLPurifier($this->purifierConfig);
    }

    public function parseToHtml(string $text): string
    {
        $html = $this->parsedown->text($text);

        $safeHtml = $this->purifier->purify($html);

        return $safeHtml;
    }
}
