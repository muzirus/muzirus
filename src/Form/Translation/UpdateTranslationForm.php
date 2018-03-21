<?php

namespace App\Form\Translation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateTranslationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('russianWordNote', TextType::class, [
                'label' => 'label.russian_note',
                'empty_data' => '',
                'required' => false,
            ])
            ->add('czechWordNote', TextType::class, [
                'label' => 'label.czech_note',
                'empty_data' => '',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
