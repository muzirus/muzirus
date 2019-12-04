<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\AbstractWordInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WordInfoExtension extends AbstractExtension
{
    /** @var Environment */
    private $environment;

    /** @var HighlightExtension */
    private $highlightExtension;

    /** @var WordTypeExtension */
    private $wordTypeExtension;

    /** @var WordGenderExtension */
    private $wordGenderExtension;

    public function __construct(
        Environment $environment,
        HighlightExtension $highlightExtension,
        WordTypeExtension $wordTypeExtension,
        WordGenderExtension $wordGenderExtension
    ) {
        $this->environment = $environment;
        $this->highlightExtension = $highlightExtension;
        $this->wordTypeExtension = $wordTypeExtension;
        $this->wordGenderExtension = $wordGenderExtension;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'word_info_under',
                function (AbstractWordInterface $word): string {
                    return $this->getInfoUnder($word);
                },
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFilter(
                'word_info_after',
                function (AbstractWordInterface $word): string {
                    return $this->getInfoAfter($word);
                },
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }

    private function getInfoUnder(AbstractWordInterface $word): string
    {
        $properties = [];

        if ($word->hasLanguageNoteInflection()) {
            $properties[] = $this->highlightExtension->highlightAccent(
                $this->escapeHtml(
                    $word->getLanguageNoteInflection()
                )
            );
        }

        if ($word->hasLanguageNoteExceptionToInflection()) {
            $properties[] = $this->highlightExtension->highlightAccent(
                $this->escapeHtml(
                    $word->getLanguageNoteExceptionToInflection()
                )
            );
        }

        if ($word->getLanguageNoteType() === AbstractWordInterface::TYPE_NOUN) {
            if ($word->getLanguageNoteGender() !== AbstractWordInterface::GENDER_UNKNOWN) {
                $properties[] = sprintf(
                    '<em class="text-muted">%s</em>',
                    $this->wordGenderExtension->convertGenderIdToString($word->getLanguageNoteGender())
                );
            }
        } else {
            $properties[] = sprintf(
                '<em class="text-muted">%s</em>',
                $this->wordTypeExtension->convertTypeIdToString($word->getLanguageNoteType())
            );
        }

        if ($word->hasLanguageNoteOther()) {
            $properties[] = sprintf('<em>%s</em>', $this->escapeHtml($word->getLanguageNoteOther()));
        }

        return implode(', ', $properties);
    }

    private function getInfoAfter(AbstractWordInterface $word): string
    {
        $properties = [];

        if ($word->hasLanguageNotePronunciation()) {
            $properties[] = sprintf(
                '<em>%s</em>',
                $this->highlightExtension->highlightAccent(
                    $this->escapeHtml(
                        $word->getLanguageNotePronunciation()
                    )
                )
            );
        }

        if ($word->getLanguageNoteType() === AbstractWordInterface::TYPE_NOUN) {
            if ($word->getLanguageNoteGender() !== AbstractWordInterface::GENDER_UNKNOWN) {
                $properties[] = sprintf(
                    '<em class="text-muted">%s</em>',
                    $this->wordGenderExtension->convertGenderIdToString($word->getLanguageNoteGender())
                );
            }
        } else {
            $properties[] = sprintf(
                '<em class="text-muted">%s</em>',
                $this->wordTypeExtension->convertTypeIdToString($word->getLanguageNoteType())
            );
        }

        return sprintf('<small>%s</small>', implode(', ', $properties));
    }

    private function escapeHtml(string $string): string
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return twig_escape_filter($this->environment, $string);
    }
}
