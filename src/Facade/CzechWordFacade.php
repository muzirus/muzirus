<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\CzechWordInterface;
use App\Factory\CzechWordFactory;
use App\Form\Word\CzechWordFormData;
use App\Service\CzechWordUpdater;
use Doctrine\ORM\EntityManagerInterface;

class CzechWordFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var CzechWordFactory */
    private $czechWordFactory;

    /** @var CzechWordUpdater */
    private $czechWordUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        CzechWordFactory $czechWordFactory,
        CzechWordUpdater $czechWordUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->czechWordFactory = $czechWordFactory;
        $this->czechWordUpdater = $czechWordUpdater;
    }

    public function createWord(CzechWordFormData $formData): CzechWordInterface
    {
        $word = $this->czechWordFactory->createFromFormData($formData);

        $this->entityManager->persist($word);
        $this->entityManager->flush();

        return $word;
    }

    public function updateWord(CzechWordInterface $word, CzechWordFormData $formData): void
    {
        $this->czechWordUpdater->updateCzechWord($word, $formData);

        $this->entityManager->flush();
    }

    public function deleteWord(CzechWordInterface $word): void
    {
        $this->entityManager->remove($word);
        $this->entityManager->flush();
    }
}
