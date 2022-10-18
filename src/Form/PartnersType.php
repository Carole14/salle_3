<?php

namespace App\Form;

use App\Entity\Partners;
use App\Entity\Partenaires;
use App\Entity\Perms;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PartnersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class,[
            'label' => 'nom',
        ])
        
        ->add('active', ChoiceType::class, [
            'label' => 'Actif/inactif',
            'choices' => [
                'actif' => 'true',
                'inactif' => 'false',
            ]
        ])
        ->add ('permission', EntityType::class, [
            'label' => 'liste des permissions possible',
            'class' => Perms::class,
            'multiple' => true,
            'expanded' => true,
        ])
        ;
    }

 
}
