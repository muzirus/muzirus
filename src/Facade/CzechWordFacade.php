<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\CzechWordInterface;
use App\Factory\CzechWordFactoryInterface;
use App\Form\Word\CzechWordFormDataInterface;
use App\Service\CzechWordUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class CzechWordFacade implements CzechWordFacadeInterface
{
    private EntityManagerInterface $entityManager;

    private CzechWordFactoryInterface $czechWordFactory;

    private CzechWordUpdaterInterface $czechWordUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        CzechWordFactoryInterface $czechWordFactory,
        CzechWordUpdaterInterface $czechWordUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->czechWordFactory = $czechWordFactory;
        $this->czechWordUpdater = $czechWordUpdater;
    }

    public function createCzechWord(CzechWordFormDataInterface $formData): CzechWordInterface
    {
        $word = $this->czechWordFactory->createFromFormData($formData);

        $this->entityManager->persist($word);
        $this->entityManager->flush();

        return $word;
    }

    public function updateCzechWord(CzechWordInterface $word, CzechWordFormDataInterface $formData): void
    {
        $this->czechWordUpdater->updateCzechWord($word, $formData);

        $this->entityManager->flush();
    }

    public function deleteCzechWord(CzechWordInterface $word): void
    {
        $this->entityManager->remove($word);
        $this->entityManager->flush();
    }
}
