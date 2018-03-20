<?php

namespace App\Form\TranslationExample;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TranslationExampleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('czechWordSentence', TextType::class, [
                'label' => 'label.czech_sentence',
                'empty_data' => '',
            ])
            ->add('russianWordSentence', TextType::class, [
                'label' => 'label.russian_sentence',
                'empty_data' => '',
            ]);
    }
}
