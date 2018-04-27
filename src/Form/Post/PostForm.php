<?php declare(strict_types=1);

namespace App\Form\Post;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostForm extends AbstractType
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
            ->add('title_in_russian', TextType::class, [
                'label' => 'label.title_in_russian',
                'empty_data' => '',
            ])
            ->add('slug', TextType::class, [
                'label' => 'label.slug',
                'empty_data' => '',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'label.content',
                'empty_data' => '',
                'attr' => [
                    'rows' => 10,
                ],
            ])
            ->add('content_in_russian', TextareaType::class, [
                'label' => 'label.content_in_russian',
                'empty_data' => '',
                'attr' => [
                    'rows' => 10,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
