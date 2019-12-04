<?php declare(strict_types=1);

namespace App\Subscriber;

use App\Entity\LogEntry;
use App\Event\CategoryCreatedEvent;
use App\Event\CategoryUpdatedEvent;
use App\Event\CzechWordCreatedEvent;
use App\Event\CzechWordUpdatedEvent;
use App\Event\RussianWordCreatedEvent;
use App\Event\RussianWordUpdatedEvent;
use App\Event\SourceCreatedEvent;
use App\Event\SourceTypeCreatedEvent;
use App\Event\SourceTypeUpdatedEvent;
use App\Event\SourceUpdatedEvent;
use App\Event\TranslationCreatedEvent;
use App\Event\TranslationExampleCreatedEvent;
use App\Event\TranslationExampleUpdatedEvent;
use App\Event\TranslationUpdatedEvent;
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

    /** @return string[] */
    public static function getSubscribedEvents(): array
    {
        return [
            CategoryCreatedEvent::class => 'onCategoryCreated',
            CategoryUpdatedEvent::class => 'onCategoryUpdated',
            CzechWordCreatedEvent::class => 'onCzechWordCreated',
            CzechWordUpdatedEvent::class => 'onCzechWordUpdated',
            RussianWordCreatedEvent::class => 'onRussianWordCreated',
            RussianWordUpdatedEvent::class => 'onRussianWordUpdated',
            SourceCreatedEvent::class => 'onSourceCreated',
            SourceUpdatedEvent::class => 'onSourceUpdated',
            SourceTypeCreatedEvent::class => 'onSourceTypeCreated',
            SourceTypeUpdatedEvent::class => 'onSourceTypeUpdated',
            TranslationCreatedEvent::class => 'onTranslationCreated',
            TranslationUpdatedEvent::class => 'onTranslationUpdated',
            TranslationExampleCreatedEvent::class => 'onTranslationExampleCreated',
            TranslationExampleUpdatedEvent::class => 'onTranslationExampleUpdated',
        ];
    }

    public function onCategoryCreated(CategoryCreatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_CATEGORY_CREATED, $event->getUser());
        $logEntry->setCategory($event->getCategory());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCategoryUpdated(CategoryUpdatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_CATEGORY_UPDATED, $event->getUser());
        $logEntry->setCategory($event->getCategory());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCzechWordCreated(CzechWordCreatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_CZECH_WORD_CREATED, $event->getUser());
        $logEntry->setCzechWord($event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCzechWordUpdated(CzechWordUpdatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_CZECH_WORD_UPDATED, $event->getUser());
        $logEntry->setCzechWord($event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onRussianWordCreated(RussianWordCreatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_RUSSIAN_WORD_CREATED, $event->getUser());
        $logEntry->setRussianWord($event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onRussianWordUpdated(RussianWordUpdatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_RUSSIAN_WORD_UPDATED, $event->getUser());
        $logEntry->setRussianWord($event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceCreated(SourceCreatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_SOURCE_CREATED, $event->getUser());
        $logEntry->setSource($event->getSource());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceUpdated(SourceUpdatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_SOURCE_UPDATED, $event->getUser());
        $logEntry->setSource($event->getSource());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceTypeCreated(SourceTypeCreatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_SOURCE_TYPE_CREATED, $event->getUser());
        $logEntry->setSourceType($event->getSourceType());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceTypeUpdated(SourceTypeUpdatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_SOURCE_TYPE_UPDATED, $event->getUser());
        $logEntry->setSourceType($event->getSourceType());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationCreated(TranslationCreatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_TRANSLATION_CREATED, $event->getUser());
        $logEntry->setTranslation($event->getTranslation());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationUpdated(TranslationUpdatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_TRANSLATION_UPDATED, $event->getUser());
        $logEntry->setTranslation($event->getTranslation());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationExampleCreated(TranslationExampleCreatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_TRANSLATION_EXAMPLE_CREATED, $event->getUser());
        $logEntry->setTranslationExample($event->getTranslationExample());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationExampleUpdated(TranslationExampleUpdatedEvent $event): void
    {
        $logEntry = new LogEntry(LogEntry::NAME_TRANSLATION_EXAMPLE_UPDATED, $event->getUser());
        $logEntry->setTranslationExample($event->getTranslationExample());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }
}
