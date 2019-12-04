<?php declare(strict_types=1);

namespace App\Form\Category;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryForm extends AbstractType
{
    /**
     * @param mixed[] $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'title',
            TextType::class,
            [
                'label' => 'label.title',
                'empty_data' => '',
                'attr' => [
                    'autofocus' => true,
                ],
            ]
        );

        $builder->add(
            'titleInRussian',
            TextType::class,
            [
                'label' => 'label.title_in_russian',
                'empty_data' => '',
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
