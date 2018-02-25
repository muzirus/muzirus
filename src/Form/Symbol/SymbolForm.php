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
                'attr' => [
                    'autofocus' => true,
                ],
                'label' => 'label.title',
            ])
            ->add('content', TextType::class, [
                'label' => 'label.content',
            ])
            ->add('description', TextType::class, [
                'label' => 'label.description',
            ]);
    }
}
