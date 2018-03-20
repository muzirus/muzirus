<?php

namespace App\Form\Word;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RussianWordForm extends CzechWordForm
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder->add('contentWithAccent', TextType::class, [
            'label' => 'label.word_with_accent',
            'required' => false,
            'empty_data' => '',
        ]);
    }
}
