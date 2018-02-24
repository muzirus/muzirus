<?php

namespace App\Form\Abbreviation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AbbreviationForm extends AbstractType
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
            ->add('description', TextType::class, [
                'label' => 'label.description',
            ])
            ->add('content', TextType::class, [
                'label' => 'label.content',
            ]);
    }
}
