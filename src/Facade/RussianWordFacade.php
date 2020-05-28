<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\RussianWordInterface;
use App\Factory\RussianWordFactoryInterface;
use App\Form\Word\RussianWordFormDataInterface;
use App\Service\RussianWordUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class RussianWordFacade implements RussianWordFacadeInterface
{
    private EntityManagerInterface $entityManager;

    private RussianWordFactoryInterface $russianWordFactory;

    private RussianWordUpdaterInterface $russianWordUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        RussianWordFactoryInterface $russianWordFactory,
        RussianWordUpdaterInterface $russianWordUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->russianWordFactory = $russianWordFactory;
        $this->russianWordUpdater = $russianWordUpdater;
    }

    public function createRussianWord(RussianWordFormDataInterface $formData): RussianWordInterface
    {
        $word = $this->russianWordFactory->createFromFormData($formData);

        $this->entityManager->persist($word);
        $this->entityManager->flush();

        return $word;
    }

    public function updateRussianWord(RussianWordInterface $word, RussianWordFormDataInterface $formData): void
    {
        $this->russianWordUpdater->updateRussianWord($word, $formData);

        $this->entityManager->flush();
    }

    public function deleteRussianWord(RussianWordInterface $word): void
    {
        $this->entityManager->remove($word);
        $this->entityManager->flush();
    }
}
