<?php

namespace App\Form\Source;

use App\Entity\SourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SourceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'autofocus' => true,
                ],
            ])
            ->add('type', Entitytype::class, [
                'class' => SourceType::class,
                'choice_label' => 'title',
            ])
            ->add('nameOfAuthor', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('nameOfPublisher', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('dateOfRelease', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('placeOfRelease', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('pagesCount', NumberType::class, [
                'empty_data' => 0,
                'required' => false,
            ])
            ->add('isbnCode', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('note', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ]);
    }
}
