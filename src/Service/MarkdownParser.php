<?php declare(strict_types=1);

namespace App\Service;

class MarkdownParser
{
    /** @var \Parsedown */
    private $parsedown;

    /** @var \HTMLPurifier */
    private $purifier;

    public function __construct()
    {
        $this->parsedown = new \Parsedown();

        $purifierConfig = \HTMLPurifier_Config::create([
            'Cache.DefinitionImpl' => null, // Disable caching
        ]);
        $this->purifier = new \HTMLPurifier($purifierConfig);
    }

    public function parseToHtml(string $text): string
    {
        $html = $this->parsedown->text($text);
        $safeHtml = $this->purifier->purify($html);

        return $safeHtml;
    }
}
