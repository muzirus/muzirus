<?php

namespace App\Form\Translation;

use App\Entity\RussianWord;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateRussianTranslationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('russianWord', Entitytype::class, [
                'class' => RussianWord::class,
                'choice_label' => 'content',
                'attr' => [
                    'data-select' => 'select2',
                ],
            ])
            ->add('russianWordNote', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('czechWordNote', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ]);
    }
}
