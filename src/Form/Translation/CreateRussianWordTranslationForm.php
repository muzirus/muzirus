<?php declare(strict_types=1);

namespace App\Form\Translation;

use Symfony\Component\Form\FormBuilderInterface;

class CreateRussianWordTranslationForm extends UpdateTranslationForm
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder->remove(self::FIELD_RUSSIAN_WORD);
    }
}
