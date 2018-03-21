<?php

namespace App\Form\Translation;

use App\Entity\CzechWord;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCzechTranslationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('czechWord', Entitytype::class, [
                'label' => 'label.czech_word',
                'class' => CzechWord::class,
                'choice_label' => 'content',
                'attr' => [
                    'data-select' => 'select2',
                ],
            ])
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
