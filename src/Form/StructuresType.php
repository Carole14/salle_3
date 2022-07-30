<?php

namespace App\Form;

use App\Entity\Structures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class StructuresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('email', EmailType::class,[
                'label' => 'Email du partenaire',
                'attr' => ['Merci de saisir le mail du partenaire'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer le mail du partenaire',
                    ]),
                ],
            ])
            ->add('mot_de_passe', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'mot de passe du partenaire',
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
            ->add ('structuresperms', PermsType::class, [
                'data_class' => Perms::class,
                'label' => 'permissions',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structures::class,
        ]);
    }
}
