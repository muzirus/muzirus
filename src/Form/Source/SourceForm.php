<?php declare(strict_types=1);

namespace App\Form\Source;

use App\Entity\SourceType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'label.title',
                'empty_data' => '',
                'attr' => [
                    'autofocus' => true,
                ],
            ])
            ->add('type', EntityType::class, [
                'label' => 'label.source_type',
                'class' => SourceType::class,
                'choice_label' => 'title',
                'query_builder' => static function (EntityRepository $entityRepository): QueryBuilder {
                    return $entityRepository->createQueryBuilder('st')->orderBy('st.title', 'ASC');
                },
            ])
            ->add('nameOfAuthor', TextType::class, [
                'label' => 'label.name_of_author',
                'empty_data' => '',
                'required' => false,
            ])
            ->add('nameOfPublisher', TextType::class, [
                'label' => 'label.name_of_publisher',
                'empty_data' => '',
                'required' => false,
            ])
            ->add('dateOfRelease', TextType::class, [
                'label' => 'label.date_of_release',
                'empty_data' => '',
                'required' => false,
            ])
            ->add('placeOfRelease', TextType::class, [
                'label' => 'label.place_of_release',
                'empty_data' => '',
                'required' => false,
            ])
            ->add('pagesCount', NumberType::class, [
                'label' => 'label.pages_count',
                'empty_data' => 0,
                'required' => false,
            ])
            ->add('isbnCode', TextType::class, [
                'label' => 'label.code_of_publication',
                'empty_data' => '',
                'required' => false,
            ])
            ->add('note', TextType::class, [
                'label' => 'label.note',
                'empty_data' => '',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
