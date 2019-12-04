<?php declare(strict_types=1);

namespace App\Form\Word;

use App\Entity\AbstractWordInterface;
use App\Entity\Category;
use App\Entity\Source;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CzechWordForm extends AbstractType
{
    /**
     * @param mixed[] $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, [
                'label' => 'label.word',
                'empty_data' => '',
            ])
            ->add('languageNotePronunciation', TextType::class, [
                'label' => 'label.language_note.pronunciation',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('languageNoteInflection', TextType::class, [
                'label' => 'label.language_note.inflection',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('languageNoteExceptionToInflection', TextType::class, [
                'label' => 'label.language_note.exception_to_inflection',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('languageNoteType', ChoiceType::class, [
                'label' => 'label.language_note.type',
                'choices' => [
                    'label.type.unknown' => AbstractWordInterface::TYPE_UNKNOWN,
                    'label.type.noun' => AbstractWordInterface::TYPE_NOUN,
                    'label.type.verb' => AbstractWordInterface::TYPE_VERB,
                    'label.type.adjective' => AbstractWordInterface::TYPE_ADJECTIVE,
                    'label.type.pronoun' => AbstractWordInterface::TYPE_PRONOUN,
                    'label.type.numeral' => AbstractWordInterface::TYPE_NUMERAL,
                    'label.type.adverb' => AbstractWordInterface::TYPE_ADVERB,
                    'label.type.preposition' => AbstractWordInterface::TYPE_PREPOSITION,
                    'label.type.conjunction' => AbstractWordInterface::TYPE_CONJUNCTION,
                    'label.type.particle' => AbstractWordInterface::TYPE_PARTICLE,
                    'label.type.interjection' => AbstractWordInterface::TYPE_INTERJECTION,
                ],
                'empty_data' => AbstractWordInterface::TYPE_UNKNOWN,
            ])
            ->add('languageNoteGender', ChoiceType::class, [
                'label' => 'label.language_note.gender',
                'choices' => [
                    'label.gender.unknown' => AbstractWordInterface::GENDER_UNKNOWN,
                    'label.gender.masculine' => AbstractWordInterface::GENDER_MASCULINE,
                    'label.gender.feminine' => AbstractWordInterface::GENDER_FEMININE,
                    'label.gender.neuter' => AbstractWordInterface::GENDER_NEUTER,
                ],
                'empty_data' => AbstractWordInterface::GENDER_UNKNOWN,
            ])
            ->add('languageNoteOther', TextareaType::class, [
                'label' => 'label.language_note.other',
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'style' => 'resize: vertical;',
                ],
            ])
            ->add('explanation', TextareaType::class, [
                'label' => 'label.explanation',
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'style' => 'resize: vertical;',
                ],
            ])
            ->add('explanationSourceInfo', TextType::class, [
                'label' => 'label.explanation_source_info',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('explanationSourceDate', TextType::class, [
                'label' => 'label.explanation_source_date',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('note', TextareaType::class, [
                'label' => 'label.note',
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'style' => 'resize: vertical;',
                ],
            ])
            ->add('categories', EntityType::class, [
                'label' => 'label.categories',
                'class' => Category::class,
                'choice_label' => 'title',
                'query_builder' => static function (EntityRepository $entityRepository): QueryBuilder {
                    return $entityRepository->createQueryBuilder('wc')->orderBy('wc.title', 'ASC');
                },
                'multiple' => true,
                'expanded' => true,
                'empty_data' => [],
            ])
            ->add('sources', EntityType::class, [
                'label' => 'label.sources',
                'class' => Source::class,
                'choice_label' => 'title',
                'query_builder' => static function (EntityRepository $entityRepository): QueryBuilder {
                    return $entityRepository->createQueryBuilder('s')->orderBy('s.title', 'ASC');
                },
                'multiple' => true,
                'expanded' => true,
                'empty_data' => [],
            ])
            ->add('statusLight', ChoiceType::class, [
                'label' => 'label.status',
                'choices' => [
                    'label.status.checked' => AbstractWordInterface::STATUS_LIGHT_CHECKED,
                    'label.status.examples_added' => AbstractWordInterface::STATUS_LIGHT_EXAMPLES_FOUND,
                    'label.status.equivalents_not_found' => AbstractWordInterface::STATUS_LIGHT_EQUIVALENTS_NOT_FOUND,
                    'label.status.not_processed' => AbstractWordInterface::STATUS_LIGHT_NOT_PROCESSED,
                ],
                'expanded' => true,
                'empty_data' => AbstractWordInterface::STATUS_LIGHT_NOT_PROCESSED,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
