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
                'empty_data' => '',
            ])
            ->add('russianWordSentence', TextType::class, [
                'empty_data' => '',
            ]);
    }
}
