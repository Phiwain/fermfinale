<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class ,[
                'label'=> "Votre Nom",
                'attr'=>[
                    'placeholder'=>"Indiquez votre nom ..."
                ]
            ])
            ->add('prenom',TextType::class ,[
        'label'=> "Votre Prénom",
        'attr'=>[
            'placeholder'=>"Indiquez votre prénom ..."
        ]
    ])
            ->add('address',TextType::class ,[
                'label'=> "Votre Adresse",
                'attr'=>[
                    'placeholder'=>"Indiquez votre adresse ..."
                ]
            ])
            ->add('postal',TextType::class ,[
                'label'=> "Votre code postal",
                'attr'=>[
                    'placeholder'=>"Indiquez votre code postal ..."
                ]
            ])
            ->add('city',TextType::class ,[
        'label'=> "Votre ville",
        'attr'=>[
            'placeholder'=>"Indiquez votre ville ..."
        ]
    ])
            ->add('phone', TextType::class,[
                'label'=> "Votre numéro de téléphone",
                'attr'=>[
                    'placeholder'=>"Indiquez votre numéro de téléphone ..."
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label'=>"Sauvegarder"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
