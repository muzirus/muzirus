<?php declare(strict_types=1);

namespace App\Subscriber;

use App\Entity\LogEntry;
use App\Event\CategoryEvent;
use App\Event\CzechWordEvent;
use App\Event\RussianWordEvent;
use App\Event\SourceEvent;
use App\Event\SourceTypeEvent;
use App\Event\TranslationEvent;
use App\Event\TranslationExampleEvent;
use App\Events;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LogEntrySubscriber implements EventSubscriberInterface
{
    /** @var ObjectManager */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::CATEGORY_CREATED => 'onCategoryCreated',
            Events::CATEGORY_UPDATED => 'onCategoryUpdated',
            Events::CZECH_WORD_CREATED => 'onCzechWordCreated',
            Events::CZECH_WORD_UPDATED => 'onCzechWordUpdated',
            Events::RUSSIAN_WORD_CREATED => 'onRussianWordCreated',
            Events::RUSSIAN_WORD_UPDATED => 'onRussianWordUpdated',
            Events::SOURCE_CREATED => 'onSourceCreated',
            Events::SOURCE_UPDATED => 'onSourceUpdated',
            Events::SOURCE_TYPE_CREATED => 'onSourceTypeCreated',
            Events::SOURCE_TYPE_UPDATED => 'onSourceTypeUpdated',
            Events::TRANSLATION_CREATED => 'onTranslationCreated',
            Events::TRANSLATION_UPDATED => 'onTranslationUpdated',
            Events::TRANSLATION_EXAMPLE_CREATED => 'onTranslationExampleCreated',
            Events::TRANSLATION_EXAMPLE_UPDATED => 'onTranslationExampleUpdated',
        ];
    }

    public function onCategoryCreated(CategoryEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_CATEGORY_CREATED, $event->getUser());
        $logEntry->setCategory($event->getCategory());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCategoryUpdated(CategoryEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_CATEGORY_UPDATED, $event->getUser());
        $logEntry->setCategory($event->getCategory());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCzechWordCreated(CzechWordEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_CZECH_WORD_CREATED, $event->getUser());
        $logEntry->setCzechWord($event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCzechWordUpdated(CzechWordEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_CZECH_WORD_UPDATED, $event->getUser());
        $logEntry->setCzechWord($event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onRussianWordCreated(RussianWordEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_RUSSIAN_WORD_CREATED, $event->getUser());
        $logEntry->setRussianWord($event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onRussianWordUpdated(RussianWordEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_RUSSIAN_WORD_UPDATED, $event->getUser());
        $logEntry->setRussianWord($event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceCreated(SourceEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_SOURCE_CREATED, $event->getUser());
        $logEntry->setSource($event->getSource());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceUpdated(SourceEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_SOURCE_UPDATED, $event->getUser());
        $logEntry->setSource($event->getSource());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceTypeCreated(SourceTypeEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_SOURCE_TYPE_CREATED, $event->getUser());
        $logEntry->setSourceType($event->getSourceType());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceTypeUpdated(SourceTypeEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_SOURCE_TYPE_UPDATED, $event->getUser());
        $logEntry->setSourceType($event->getSourceType());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationCreated(TranslationEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_TRANSLATION_CREATED, $event->getUser());
        $logEntry->setTranslation($event->getTranslation());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationUpdated(TranslationEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_TRANSLATION_UPDATED, $event->getUser());
        $logEntry->setTranslation($event->getTranslation());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationExampleCreated(TranslationExampleEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_TRANSLATION_EXAMPLE_CREATED, $event->getUser());
        $logEntry->setTranslationExample($event->getTranslationExample());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationExampleUpdated(TranslationExampleEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_TRANSLATION_EXAMPLE_UPDATED, $event->getUser());
        $logEntry->setTranslationExample($event->getTranslationExample());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }
}
