<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SymbolInterface;
use App\Factory\SymbolFactoryInterface;
use App\Form\Symbol\SymbolFormDataInterface;
use App\Service\SymbolUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class SymbolFacade implements SymbolFacadeInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var SymbolFactoryInterface */
    private $symbolFactory;

    /** @var SymbolUpdaterInterface */
    private $symbolUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        SymbolFactoryInterface $symbolFactory,
        SymbolUpdaterInterface $symbolUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->symbolFactory = $symbolFactory;
        $this->symbolUpdater = $symbolUpdater;
    }

    public function createSymbol(SymbolFormDataInterface $formData): SymbolInterface
    {
        $symbol = $this->symbolFactory->createFromFormData($formData);

        $this->entityManager->persist($symbol);
        $this->entityManager->flush();

        return $symbol;
    }

    public function updateSymbol(SymbolInterface $symbol, SymbolFormDataInterface $formData): void
    {
        $this->symbolUpdater->updateSymbol($symbol, $formData);

        $this->entityManager->flush();
    }

    public function deleteSymbol(SymbolInterface $symbol): void
    {
        $this->entityManager->remove($symbol);
        $this->entityManager->flush();
    }
}
