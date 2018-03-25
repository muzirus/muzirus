<?php

namespace App\Form\Translation;

use Symfony\Component\Form\FormBuilderInterface;

class CreateCzechWordTranslationForm extends UpdateTranslationForm
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder->remove(self::FIELD_CZECH_WORD);
    }
}
