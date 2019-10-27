<?php declare(strict_types=1);

namespace App\Subscriber;

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
        $logEntry = new CategoryCreated($event->getUser(), $event->getCategory());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCategoryUpdated(CategoryUpdatedEvent $event): void
    {
        $logEntry = new CategoryUpdated($event->getUser(), $event->getCategory());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCzechWordCreated(CzechWordCreatedEvent $event): void
    {
        $logEntry = new CzechWordCreated($event->getUser(), $event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onCzechWordUpdated(CzechWordUpdatedEvent $event): void
    {
        $logEntry = new CzechWordUpdated($event->getUser(), $event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onRussianWordCreated(RussianWordCreatedEvent $event): void
    {
        $logEntry = new RussianWordCreated($event->getUser(), $event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onRussianWordUpdated(RussianWordUpdatedEvent $event): void
    {
        $logEntry = new RussianWordUpdated($event->getUser(), $event->getWord());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceCreated(SourceCreatedEvent $event): void
    {
        $logEntry = new SourceCreated($event->getUser(), $event->getSource());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceUpdated(SourceUpdatedEvent $event): void
    {
        $logEntry = new SourceUpdated($event->getUser(), $event->getSource());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceTypeCreated(SourceTypeCreatedEvent $event): void
    {
        $logEntry = new SourceTypeCreated($event->getUser(), $event->getSourceType());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onSourceTypeUpdated(SourceTypeUpdatedEvent $event): void
    {
        $logEntry = new SourceTypeUpdated($event->getUser(), $event->getSourceType());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationCreated(TranslationCreatedEvent $event): void
    {
        $logEntry = new TranslationCreated($event->getUser(), $event->getTranslation());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationUpdated(TranslationUpdatedEvent $event): void
    {
        $logEntry = new TranslationUpdated($event->getUser(), $event->getTranslation());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationExampleCreated(TranslationExampleCreatedEvent $event): void
    {
        $logEntry = new TranslationExampleCreated($event->getUser(), $event->getTranslationExample());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }

    public function onTranslationExampleUpdated(TranslationExampleUpdatedEvent $event): void
    {
        $logEntry = new TranslationExampleUpdated($event->getUser(), $event->getTranslationExample());

        $this->objectManager->persist($logEntry);
        $this->objectManager->flush();
    }
}
