<?php

namespace App\Form\Word;

use App\Entity\AbstractWordInterface;
use App\Entity\Source;
use App\Entity\WordCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CzechWordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, [
                'empty_data' => '',
            ])
            ->add('languageNotePronunciation', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('languageNoteInflection', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('languageNoteExceptionToInflection', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('languageNoteGender', ChoiceType::class, [
                'choices' => [
                    'masculine' => AbstractWordInterface::GENDER_MASCULINE,
                    'feminine' => AbstractWordInterface::GENDER_FEMININE,
                    'neuter' => AbstractWordInterface::GENDER_NEUTER,
                    'unknown' => AbstractWordInterface::GENDER_UNKNOWN,
                ],
                'expanded' => true,
                'empty_data' => AbstractWordInterface::GENDER_UNKNOWN,
            ])
            ->add('languageNoteOther', TextareaType::class, [
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'style' => 'resize: vertical;',
                ],
            ])
            ->add('explanation', TextareaType::class, [
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'style' => 'resize: vertical;',
                ],
            ])
            ->add('explanationSourceInfo', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('explanationSourceDate', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('note', TextareaType::class, [
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'style' => 'resize: vertical;',
                ],
            ])
            ->add('categories', EntityType::class, [
                'class' => WordCategory::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'empty_data' => [],
            ])
            ->add('sources', EntityType::class, [
                'class' => Source::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'empty_data' => [],
            ])
            ->add('statusLight', ChoiceType::class, [
                'choices' => [
                    'green' => AbstractWordInterface::STATUS_LIGHT_GREEN,
                    'yellow' => AbstractWordInterface::STATUS_LIGHT_YELLOW,
                    'red' => AbstractWordInterface::STATUS_LIGHT_RED,
                    'unknown' => AbstractWordInterface::STATUS_LIGHT_UNKNOWN,
                ],
                'expanded' => true,
                'empty_data' => AbstractWordInterface::STATUS_LIGHT_UNKNOWN,
            ]);
    }
}
