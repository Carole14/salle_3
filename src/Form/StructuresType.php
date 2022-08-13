<?php

namespace App\Form;

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
            ->add('email', EmailType::class,[
                'label' => 'Email de la structure',
                'attr' => ['Merci de saisir le mail de la structure'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer le mail de la structure',
                    ]),
                ],
            ])
            ->add('mot_de_passe', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'mot de passe de la structure',
                'mapped' => false,
                'attr' => ['autocomplete' => 'nouveau mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'entrer le mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('active', ChoiceType::class, [
                'choices' => [
                    'active' => 'true',
                    'inactive' => 'false',
                ]
            ])
            ->add ('struturesperms', EntityType::class, [
                'class' => Perms::class,
                'multiple' => true,
                'expanded' => true,
            ]);
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structures::class,
        ]);
    }
}
