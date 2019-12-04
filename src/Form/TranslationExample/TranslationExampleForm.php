<?php declare(strict_types=1);

namespace App\Form\TranslationExample;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationExampleForm extends AbstractType
{
    /**
     * @param mixed[] $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('czechWordSentence', TextareaType::class, [
                'label' => 'label.czech_sentence',
                'empty_data' => '',
                'required' => false,
                'attr' => [
                    'style' => 'resize: vertical;',
                    'rows' => 4,
                ],
            ])
            ->add('russianWordSentence', TextareaType::class, [
                'label' => 'label.russian_sentence',
                'empty_data' => '',
                'required' => false,
                'attr' => [
                    'style' => 'resize: vertical;',
                    'rows' => 4,
                ],
            ])
            ->add('hidden', ChoiceType::class, [
                'label' => 'label.hidden',
                'choices' => [
                    'label.yes' => true,
                    'label.no' => false,
                ],
                'expanded' => true,
                'empty_data' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'forms');
    }
}
