<?php

namespace App\Form\Word;

use App\Entity\AbstractWordInterface;
use App\Entity\Source;
use App\Entity\WordCategory;
use Doctrine\ORM\EntityRepository;
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
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('wc')->orderBy('wc.title', 'ASC');
                },
                'multiple' => true,
                'expanded' => true,
                'empty_data' => [],
            ])
            ->add('sources', EntityType::class, [
                'class' => Source::class,
                'choice_label' => 'title',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')->orderBy('s.title', 'ASC');
                },
                'multiple' => true,
                'expanded' => true,
                'empty_data' => [],
            ])
            ->add('statusLight', ChoiceType::class, [
                'choices' => [
                    'Ready' => AbstractWordInterface::STATUS_LIGHT_GREEN,
                    'Need work' => AbstractWordInterface::STATUS_LIGHT_YELLOW,
                    'Not processed' => AbstractWordInterface::STATUS_LIGHT_RED,
                    'Unknown' => AbstractWordInterface::STATUS_LIGHT_UNKNOWN,
                ],
                'expanded' => true,
                'empty_data' => AbstractWordInterface::STATUS_LIGHT_UNKNOWN,
            ]);
    }
}
