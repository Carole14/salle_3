<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Rechercher'
                ],
            ])
            ;
    }

    public function setDefaults(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults([
            'data-class' => SearchData::class,
            'method' => 'GET',
            'crsf_protect' => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }

}