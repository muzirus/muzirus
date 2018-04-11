<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SymbolInterface;
use App\Factory\SymbolFactory;
use App\Form\Symbol\SymbolFormData;
use Doctrine\ORM\EntityManagerInterface;

class SymbolFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SymbolFactory
     */
    private $symbolFactory;

    public function __construct(EntityManagerInterface $entityManager, SymbolFactory $symbolFactory)
    {
        $this->entityManager = $entityManager;
        $this->symbolFactory = $symbolFactory;
    }

    public function createSymbol(SymbolFormData $formData): SymbolInterface
    {
        $symbol = $this->symbolFactory->createFromFormData($formData);

        $this->entityManager->persist($symbol);
        $this->entityManager->flush();

        return $symbol;
    }

    public function updateSymbol(SymbolInterface $symbol, SymbolFormData $formData): void
    {
        $symbol->setTitle($formData->getTitle());
        $symbol->setContent($formData->getContent());
        $symbol->setDescription($formData->getDescription());

        $this->entityManager->flush();
    }

    public function deleteSymbol(SymbolInterface $symbol): void
    {
        $this->entityManager->remove($symbol);
        $this->entityManager->flush();
    }
}
