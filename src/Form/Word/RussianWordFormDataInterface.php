<?php declare(strict_types=1);

namespace App\Form\Word;

interface RussianWordFormDataInterface extends AbstractWordFormDataInterface
{
    public function getContentWithAccent(): string;

    public function setContentWithAccent(string $contentWithAccent): void;
}
