<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\SourceInterface;
use App\Entity\SourceTypeInterface;
use App\Form\Source\SourceFormDataInterface;
use Webmozart\Assert\Assert;

class SourceUpdater implements SourceUpdaterInterface
{
    public function updateSource(SourceInterface $source, SourceFormDataInterface $formData): void
    {
        Assert::isInstanceOf($formData->getType(), SourceTypeInterface::class);

        $source->setTitle($formData->getTitle());
        $source->setType($formData->getType());
        $source->setNameOfAuthor($formData->getNameOfAuthor());
        $source->setNameOfPublisher($formData->getNameOfPublisher());
        $source->setDateOfRelease($formData->getDateOfRelease());
        $source->setPlaceOfRelease($formData->getPlaceOfRelease());
        $source->setPagesCount($formData->getPagesCount());
        $source->setIsbnCode($formData->getIsbnCode());
        $source->setNote($formData->getNote());
    }
}
