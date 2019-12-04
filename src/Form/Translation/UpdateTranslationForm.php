<?php declare(strict_types=1);

namespace App\Form\Translation;

use App\Entity\CzechWord;
use App\Entity\RussianWord;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateTranslationForm extends AbstractType
{
    public const FIELD_RUSSIAN_WORD = 'russianWord';
    public const FIELD_RUSSIAN_WORD_NOTE = 'russianWordNote';
    public const FIELD_CZECH_WORD = 'czechWord';
    public const FIELD_CZECH_WORD_NOTE = 'czechWordNote';
    public const FIELD_LINK = 'link';

    /**
     * @param mixed[] $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            self::FIELD_RUSSIAN_WORD,
            EntityType::class,
            [
                'label' => 'label.russian_word',
                'class' => RussianWord::class,
                'choice_label' => 'content',
                'query_builder' => static function (EntityRepository $entityRepository): QueryBuilder {
                    return $entityRepository->createQueryBuilder('w')->orderBy('w.content', 'ASC');
                },
                'attr' => [
                    'data-select' => 'select2',
                ],
            ]
        );
        $builder->add(
            self::FIELD_RUSSIAN_WORD_NOTE,
            TextType::class,
            [
                'label' => 'label.russian_note',
                'empty_data' => '',
                'required' => false,
            ]
        );
        $builder->add(
            self::FIELD_CZECH_WORD,
            EntityType::class,
            [
                'label' => 'label.czech_word',
                'class' => CzechWord::class,
                'choice_label' => 'content',
                'query_builder' => static function (EntityRepository $entityRepository): QueryBuilder {
                    return $entityRepository->createQueryBuilder('w')->orderBy('w.content', 'ASC');
                },
                'attr' => [
                    'data-select' => 'select2',
                ],
            ]
        );
        $builder->add(
            self::FIELD_CZECH_WORD_NOTE,
            TextType::class,
            [
                'label' => 'label.czech_note',
                'empty_data' => '',
                'required' => false,
            ]
        );
        $builder->add(
            self::FIELD_LINK,
            TextType::class,
            [
                'label' => 'label.link',
                'empty_data' => '',
                'required' => false,
                'attr' => [
                    'placeholder' => 'view?...',
                ],
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
