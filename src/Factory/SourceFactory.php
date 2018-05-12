<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\Source;
use App\Entity\SourceInterface;
use App\Form\Source\SourceFormDataInterface;

class SourceFactory implements SourceFactoryInterface
{
    public function createFromFormData(SourceFormDataInterface $formData): SourceInterface
    {
        $source = new Source($formData->getTitle(), $formData->getType());

        $source->setNameOfAuthor($formData->getNameOfAuthor());
        $source->setNameOfPublisher($formData->getNameOfPublisher());
        $source->setDateOfRelease($formData->getDateOfRelease());
        $source->setPlaceOfRelease($formData->getPlaceOfRelease());
        $source->setPagesCount($formData->getPagesCount());
        $source->setIsbnCode($formData->getIsbnCode());
        $source->setNote($formData->getNote());

        return $source;
    }
}
