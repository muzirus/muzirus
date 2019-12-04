<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\CategoryInterface;
use App\Entity\CzechWordInterface;
use App\Entity\LogEntry;
use App\Entity\RussianWordInterface;
use App\Entity\SourceInterface;
use App\Entity\SourceTypeInterface;
use App\Entity\TranslationExampleInterface;
use App\Entity\TranslationInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LogEntryExtension extends AbstractExtension
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
            new TwigFunction(
                'getLogEntryIcon',
                function (LogEntry $logEntry): string {
                    return $this->getLogEntryIcon($logEntry);
                },
                [
                    'is_safe' => [
                        'html',
                    ],
                ]
            ),
            new TwigFunction(
                'getLogEntryTitle',
                function (LogEntry $logEntry): string {
                    return $this->getLogEntryTitle($logEntry);
                }
            ),
            new TwigFunction(
                'getLogEntryBody',
                function (LogEntry $logEntry): string {
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
        $user = $logEntry->getUser();
        $userName = $user !== null ? $user->getName() : 'Nobody';

        switch ($logEntry->getName()) {
            case LogEntry::NAME_CATEGORY_CREATED:
                $category = $logEntry->getCategory();

                if ($category === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        CategoryInterface::class
                    ));
                }

                return $this->getTextCreated(
                    $userName,
                    $category->getTitle(),
                    $this->urlGenerator->generate(
                        'admin.category.edit',
                        [
                            'id' => $category->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_CZECH_WORD_CREATED:
                $czechWord = $logEntry->getCzechWord();

                if ($czechWord === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        CzechWordInterface::class
                    ));
                }

                return $this->getTextCreated(
                    $userName,
                    $czechWord->getContent(),
                    $this->urlGenerator->generate(
                        'admin.czech-word.edit',
                        [
                            'id' => $czechWord->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_RUSSIAN_WORD_CREATED:
                $russianWord = $logEntry->getRussianWord();

                if ($russianWord === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        RussianWordInterface::class
                    ));
                }

                return $this->getTextCreated(
                    $userName,
                    $russianWord->getContent(),
                    $this->urlGenerator->generate(
                        'admin.russian-word.edit',
                        [
                            'id' => $russianWord->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_SOURCE_CREATED:
                $source = $logEntry->getSource();

                if ($source === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        SourceInterface::class
                    ));
                }

                return $this->getTextCreated(
                    $userName,
                    $source->getTitle(),
                    $this->urlGenerator->generate(
                        'admin.source.edit',
                        [
                            'id' => $source->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_SOURCE_TYPE_CREATED:
                $sourceType = $logEntry->getSourceType();

                if ($sourceType === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        SourceTypeInterface::class
                    ));
                }

                return $this->getTextCreated(
                    $userName,
                    $sourceType->getTitle(),
                    $this->urlGenerator->generate(
                        'admin.source-type.edit',
                        [
                            'id' => $sourceType->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_TRANSLATION_CREATED:
                $translation = $logEntry->getTranslation();

                if ($translation === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        TranslationInterface::class
                    ));
                }

                return $this->getTextCreated(
                    $userName,
                    $translation->__toString(),
                    $this->urlGenerator->generate(
                        'admin.translation.edit',
                        [
                            'id' => $translation->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_TRANSLATION_EXAMPLE_CREATED:
                $translationExample = $logEntry->getTranslationExample();

                if ($translationExample === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        TranslationExampleInterface::class
                    ));
                }

                return $this->getTextCreated(
                    $userName,
                    $translationExample->__toString(),
                    $this->urlGenerator->generate(
                        'admin.translation-example.edit',
                        [
                            'id' => $translationExample->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_CATEGORY_UPDATED:
                $category = $logEntry->getCategory();

                if ($category === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        CategoryInterface::class
                    ));
                }

                return $this->getTextUpdated(
                    $userName,
                    $category->getTitle(),
                    $this->urlGenerator->generate(
                        'admin.category.edit',
                        [
                            'id' => $category->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_CZECH_WORD_UPDATED:
                $czechWord = $logEntry->getCzechWord();

                if ($czechWord === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        CzechWordInterface::class
                    ));
                }

                return $this->getTextUpdated(
                    $userName,
                    $czechWord->getContent(),
                    $this->urlGenerator->generate(
                        'admin.czech-word.edit',
                        [
                            'id' => $czechWord->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_RUSSIAN_WORD_UPDATED:
                $russianWord = $logEntry->getRussianWord();

                if ($russianWord === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        RussianWordInterface::class
                    ));
                }

                return $this->getTextUpdated(
                    $userName,
                    $russianWord->getContent(),
                    $this->urlGenerator->generate(
                        'admin.russian-word.edit',
                        [
                            'id' => $russianWord->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_SOURCE_UPDATED:
                $source = $logEntry->getSource();

                if ($source === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        SourceInterface::class
                    ));
                }

                return $this->getTextUpdated(
                    $userName,
                    $source->getTitle(),
                    $this->urlGenerator->generate(
                        'admin.source.edit',
                        [
                            'id' => $source->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_SOURCE_TYPE_UPDATED:
                $sourceType = $logEntry->getSourceType();

                if ($sourceType === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        SourceTypeInterface::class
                    ));
                }

                return $this->getTextUpdated(
                    $userName,
                    $sourceType->getTitle(),
                    $this->urlGenerator->generate(
                        'admin.source-type.edit',
                        [
                            'id' => $sourceType->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_TRANSLATION_UPDATED:
                $translation = $logEntry->getTranslation();

                if ($translation === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        TranslationInterface::class
                    ));
                }

                return $this->getTextUpdated(
                    $userName,
                    $translation->__toString(),
                    $this->urlGenerator->generate(
                        'admin.translation.edit',
                        [
                            'id' => $translation->getId(),
                        ]
                    )
                );
            case LogEntry::NAME_TRANSLATION_EXAMPLE_UPDATED:
                $translationExample = $logEntry->getTranslationExample();

                if ($translationExample === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        TranslationExampleInterface::class
                    ));
                }

                return $this->getTextUpdated(
                    $userName,
                    $translationExample->__toString(),
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
