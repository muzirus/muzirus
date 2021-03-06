<?php declare(strict_types=1);

namespace App\Form\Announcement;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementForm extends AbstractType
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
            ->add('content', TextareaType::class, [
                'label' => 'label.content',
                'empty_data' => '',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
