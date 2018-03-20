<?php

namespace App\Form\SourceType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SourceTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title', TextType::class, [
            'label' => 'label.title',
            'empty_data' => '',
            'attr' => [
                'autofocus' => true,
            ],
        ]);
    }
}
