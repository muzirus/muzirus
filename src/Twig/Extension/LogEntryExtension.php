<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\CategoryInterface;
use App\Entity\CzechWordInterface;
use App\Entity\LogEntry\AbstractLogEntry;
use App\Entity\LogEntry\CategoryCreated;
use App\Entity\LogEntry\CategoryUpdated;
use App\Entity\LogEntry\CzechWordCreated;
use App\Entity\LogEntry\CzechWordUpdated;
use App\Entity\LogEntry\RussianWordCreated;
use App\Entity\LogEntry\RussianWordUpdated;
use App\Entity\LogEntry\SourceCreated;
use App\Entity\LogEntry\SourceTypeCreated;
use App\Entity\LogEntry\SourceTypeUpdated;
use App\Entity\LogEntry\SourceUpdated;
use App\Entity\LogEntry\TranslationCreated;
use App\Entity\LogEntry\TranslationExampleCreated;
use App\Entity\LogEntry\TranslationExampleUpdated;
use App\Entity\LogEntry\TranslationUpdated;
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
                function (AbstractLogEntry $logEntry): string {
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
                function (AbstractLogEntry $logEntry): string {
                    return $this->getLogEntryTitle($logEntry);
                }
            ),
            new TwigFunction(
                'getLogEntryBody',
                function (AbstractLogEntry $logEntry): string {
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

    private function getLogEntryIcon(AbstractLogEntry $logEntry): string
    {
        switch ($logEntry->getClass()) {
            case CategoryCreated::class:
            case CzechWordCreated::class:
            case RussianWordCreated::class:
            case SourceCreated::class:
            case SourceTypeCreated::class:
            case TranslationCreated::class:
            case TranslationExampleCreated::class:
                return '<i class="fa fa-plus bg-green"></i>';
            case CategoryUpdated::class:
            case CzechWordUpdated::class:
            case RussianWordUpdated::class:
            case SourceUpdated::class:
            case SourceTypeUpdated::class:
            case TranslationUpdated::class:
            case TranslationExampleUpdated::class:
                return '<i class="fa fa-pencil bg-blue"></i>';
            default:
                return '<i class="fa fa-question bg-black"></i>';
        }
    }

    private function getLogEntryTitle(AbstractLogEntry $logEntry): string
    {
        return $logEntry->toString();
    }

    private function getLogEntryBody(AbstractLogEntry $logEntry): string
    {
        $user = $logEntry->getUser();
        $userName = $user !== null ? $user->getName() : 'Nobody';

        switch ($logEntry->getClass()) {
            case CategoryCreated::class:
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
            case CzechWordCreated::class:
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
            case RussianWordCreated::class:
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
            case SourceCreated::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
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
            case AbstractLogEntry::class:
                $translationExample = $logEntry->getTranslationExample();

                if ($translationExample === null) {
                    throw new \LogicException(sprintf(
                        'Log entry is missing "%s" entity',
                        TranslationExampleInterface::class
                    ));
                }

                return $this->getTextUpdated(
                    $userName,
                    $translationExample->toString(),
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
