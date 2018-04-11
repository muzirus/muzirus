<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\LogEntry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LogEntryExtension extends \Twig_Extension
{
    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction(
                'getLogEntryIcon',
                function (LogEntry $logEntry) {
                    return $this->getLogEntryIcon($logEntry);
                },
                [
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
            new \Twig_SimpleFunction(
                'getLogEntryTitle',
                function (LogEntry $logEntry) {
                    return $this->getLogEntryTitle($logEntry);
                }
            ),
            new \Twig_SimpleFunction(
                'getLogEntryBody',
                function (LogEntry $logEntry) {
                    return $this->getLogEntryBody($logEntry);
                },
                [
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
        ];
    }

    private function getLogEntryIcon(LogEntry $logEntry): string
    {
        switch ($logEntry->getName()) {
            case LogEntry::NAME_CATEGORY_CREATED:
            case LogEntry::NAME_CZECH_WORD_CREATED:
            case LogEntry::NAME_RUSSIAN_WORD_CREATED:
            case LogEntry::NAME_SOURCE_CREATED:
            case LogEntry::NAME_SOURCE_TYPE_CREATED:
            case LogEntry::NAME_TRANSLATION_CREATED:
            case LogEntry::NAME_TRANSLATION_EXAMPLE_CREATED:
                return '<i class="fa fa-plus bg-green"></i>';
            case LogEntry::NAME_CATEGORY_UPDATED:
            case LogEntry::NAME_CZECH_WORD_UPDATED:
            case LogEntry::NAME_RUSSIAN_WORD_UPDATED:
            case LogEntry::NAME_SOURCE_UPDATED:
            case LogEntry::NAME_SOURCE_TYPE_UPDATED:
            case LogEntry::NAME_TRANSLATION_UPDATED:
            case LogEntry::NAME_TRANSLATION_EXAMPLE_UPDATED:
                return '<i class="fa fa-pencil bg-blue"></i>';
            default:
                return '<i class="fa fa-question bg-black"></i>';
        }
    }

    private function getLogEntryTitle(LogEntry $logEntry): string
    {
        switch ($logEntry->getName()) {
            case LogEntry::NAME_CATEGORY_CREATED:
                return 'Category has been created';
            case LogEntry::NAME_CZECH_WORD_CREATED:
                return 'Czech word has been created';
            case LogEntry::NAME_RUSSIAN_WORD_CREATED:
                return 'Russian word has been created';
            case LogEntry::NAME_SOURCE_CREATED:
                return 'Source has been created';
            case LogEntry::NAME_SOURCE_TYPE_CREATED:
                return 'Source type has been created';
            case LogEntry::NAME_TRANSLATION_CREATED:
                return 'Translation has been created';
            case LogEntry::NAME_TRANSLATION_EXAMPLE_CREATED:
                return 'Translation example has been created';
            case LogEntry::NAME_CATEGORY_UPDATED:
                return 'Category has been updated';
            case LogEntry::NAME_CZECH_WORD_UPDATED:
                return 'Czech word has been updated';
            case LogEntry::NAME_RUSSIAN_WORD_UPDATED:
                return 'Russian word has been updated';
            case LogEntry::NAME_SOURCE_UPDATED:
                return 'Source has been updated';
            case LogEntry::NAME_SOURCE_TYPE_UPDATED:
                return 'Source type has been updated';
            case LogEntry::NAME_TRANSLATION_UPDATED:
                return 'Translation  has been updated';
            case LogEntry::NAME_TRANSLATION_EXAMPLE_UPDATED:
                return 'Translation example has been updated';
            default:
                return 'Nobody knows what happened';
        }
    }

    private function getLogEntryBody(LogEntry $logEntry): string
    {
        $userName = $logEntry->hasUser() ? $logEntry->getUser()->getName() : 'Nobody';

        switch ($logEntry->getName()) {
            case LogEntry::NAME_CATEGORY_CREATED:
                $category = $logEntry->getCategory();

                return $this->getTextCreated(
                    $userName,
                    $category,
                    $this->urlGenerator->generate(
                        'admin.category.edit',
                        [
                            'id' => $category->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_CZECH_WORD_CREATED:
                $czechWord = $logEntry->getCzechWord();

                return $this->getTextCreated(
                    $userName,
                    $czechWord,
                    $this->urlGenerator->generate(
                        'admin.czech-word.edit',
                        [
                            'id' => $czechWord->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_RUSSIAN_WORD_CREATED:
                $russianWord = $logEntry->getRussianWord();

                return $this->getTextCreated(
                    $userName,
                    $russianWord,
                    $this->urlGenerator->generate(
                        'admin.russian-word.edit',
                        [
                            'id' => $russianWord->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_SOURCE_CREATED:
                $source = $logEntry->getSource();

                return $this->getTextCreated(
                    $userName,
                    $source,
                    $this->urlGenerator->generate(
                        'admin.source.edit',
                        [
                            'id' => $source->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_SOURCE_TYPE_CREATED:
                $sourceType = $logEntry->getSourceType();

                return $this->getTextCreated(
                    $userName,
                    $sourceType,
                    $this->urlGenerator->generate(
                        'admin.source-type.edit',
                        [
                            'id' => $sourceType->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_TRANSLATION_CREATED:
                $translation = $logEntry->getTranslation();

                return $this->getTextCreated(
                    $userName,
                    $translation,
                    $this->urlGenerator->generate(
                        'admin.translation.edit',
                        [
                            'id' => $translation->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_TRANSLATION_EXAMPLE_CREATED:
                $translationExample = $logEntry->getTranslationExample();

                return $this->getTextCreated(
                    $userName,
                    $translationExample,
                    $this->urlGenerator->generate(
                        'admin.translation-example.edit',
                        [
                            'id' => $translationExample->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_CATEGORY_UPDATED:
                $category = $logEntry->getCategory();

                return $this->getTextUpdated(
                    $userName,
                    $category,
                    $this->urlGenerator->generate(
                        'admin.category.edit',
                        [
                            'id' => $category->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_CZECH_WORD_UPDATED:
                $czechWord = $logEntry->getCzechWord();

                return $this->getTextUpdated(
                    $userName,
                    $czechWord,
                    $this->urlGenerator->generate(
                        'admin.czech-word.edit',
                        [
                            'id' => $czechWord->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_RUSSIAN_WORD_UPDATED:
                $russianWord = $logEntry->getRussianWord();

                return $this->getTextUpdated(
                    $userName,
                    $russianWord,
                    $this->urlGenerator->generate(
                        'admin.russian-word.edit',
                        [
                            'id' => $russianWord->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_SOURCE_UPDATED:
                $source = $logEntry->getSource();

                return $this->getTextUpdated(
                    $userName,
                    $source,
                    $this->urlGenerator->generate(
                        'admin.source.edit',
                        [
                            'id' => $source->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_SOURCE_TYPE_UPDATED:
                $sourceType = $logEntry->getSourceType();

                return $this->getTextUpdated(
                    $userName,
                    $sourceType,
                    $this->urlGenerator->generate(
                        'admin.source-type.edit',
                        [
                            'id' => $sourceType->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_TRANSLATION_UPDATED:
                $translation = $logEntry->getTranslation();

                return $this->getTextUpdated(
                    $userName,
                    $translation,
                    $this->urlGenerator->generate(
                        'admin.translation.edit',
                        [
                            'id' => $translation->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_TRANSLATION_EXAMPLE_UPDATED:
                $translationExample = $logEntry->getTranslationExample();

                return $this->getTextUpdated(
                    $userName,
                    $translationExample,
                    $this->urlGenerator->generate(
                        'admin.translation-example.edit',
                        [
                            'id' => $translationExample->getId(),
                        ]
                    )
                );
            default:
                return 'Nobody knows what happened';
        }
    }

    private function getTextCreated(string $who, string $what, string $whatUrl): string
    {
        return '<strong>' . $who . '</strong> created <strong><a href="' . $whatUrl . '">' . $what . '</a></strong>.';
    }

    private function getTextUpdated(string $who, string $what, string $whatUrl): string
    {
        return '<strong>' . $who . '</strong> updated <strong><a href="' . $whatUrl . '">' . $what . '</a></strong>.';
    }
}
