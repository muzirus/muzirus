<?php

namespace App\Form\Abbreviation;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbbreviationType extends FormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'attr' => ['autofocus' => true],
            'label' => 'label.title',
        ]);

        $builder->add('description', TextType::class, [
            'label' => 'label.description',
        ]);

        $builder->add('content', TextType::class, [
            'label' => 'label.content',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AbbreviationTypeData::class,
        ]);
    }
}
