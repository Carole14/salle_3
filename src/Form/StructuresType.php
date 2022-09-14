<?php

namespace App\Form;

use App\Entity\Partenaires;
use App\Entity\Perms;
use App\Entity\Structures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class StructuresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la structure',
            ])
            ->add('Description', TextType::class, [
                'label' => 'description',
            ])
            ->add('adresse', TextType::class, [
                'label' => 'adresse',
            ])
            ->add('active', ChoiceType::class, [
                'label' => 'active/inactive',
                'choices' => [
                    'active' => 'true',
                    'inactive' => 'false',
                ]
            ])
            ->add ('struturesperms', EntityType::class, [
                'label' => 'liste des permissions possibles',
                'class' => Perms::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add ('partenaire', EntityType::class, [
                'label' => 'liste des partenaires possibles',
                'class' => Partenaires::class,   
            ]) ;
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structures::class,
        ]);
    }
}
