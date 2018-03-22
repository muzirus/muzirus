<?php

namespace App\Form\TranslationExample;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationExampleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('czechWordSentence', TextareaType::class, [
                'label' => 'label.czech_sentence',
                'empty_data' => '',
                'attr' => [
                    'style' => 'resize: vertical;',
                    'rows' => 4,
                ],
            ])
            ->add('russianWordSentence', TextareaType::class, [
                'label' => 'label.russian_sentence',
                'empty_data' => '',
                'attr' => [
                    'style' => 'resize: vertical;',
                    'rows' => 4,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
