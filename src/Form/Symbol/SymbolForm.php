<?php

namespace App\Form\Symbol;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SymbolForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'label.title',
                'empty_data' => '',
                'attr' => [
                    'autofocus' => true,
                ],
            ])
            ->add('content', TextType::class, [
                'label' => 'label.value',
                'empty_data' => '',
            ])
            ->add('description', TextType::class, [
                'label' => 'label.description',
                'empty_data' => '',
                'required' => false,
            ]);
    }
}
