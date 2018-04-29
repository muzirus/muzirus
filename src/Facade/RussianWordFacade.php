<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\RussianWordInterface;
use App\Factory\RussianWordFactory;
use App\Form\Word\RussianWordFormData;
use App\Service\RussianWordUpdater;
use Doctrine\ORM\EntityManagerInterface;

class RussianWordFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var RussianWordFactory */
    private $russianWordFactory;

    /** @var RussianWordUpdater */
    private $russianWordUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        RussianWordFactory $russianWordFactory,
        RussianWordUpdater $russianWordUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->russianWordFactory = $russianWordFactory;
        $this->russianWordUpdater = $russianWordUpdater;
    }

    public function createWord(RussianWordFormData $formData): RussianWordInterface
    {
        $word = $this->russianWordFactory->createFromFormData($formData);

        $this->entityManager->persist($word);
        $this->entityManager->flush();

        return $word;
    }

    public function updateWord(RussianWordInterface $word, RussianWordFormData $formData): void
    {
        $this->russianWordUpdater->updateRussianWord($word, $formData);

        $this->entityManager->flush();
    }

    public function deleteWord(RussianWordInterface $word): void
    {
        $this->entityManager->remove($word);
        $this->entityManager->flush();
    }
}
