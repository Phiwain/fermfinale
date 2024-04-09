<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use function Webmozart\Assert\Tests\StaticAnalysis\false;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> "Votre adresse Email",
                'attr'=> [
                    'placeholder'=>"Indiquez votre adresse mail"
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'=>PasswordType::class,
                'constraints'=>[
                    new Length([
                        'min'=>6,
                        'max'=>20
                    ])
                ],
                'first_options'=> [
                    'label'=>'Votre mot de passe',
                    'attr'=> [
                        'placeholder'=>"Indiquez votre mot de passe"
                    ],
                    'hash_property_path'=>'password'],
                'second_options'=>[
                    'label'=>'Confirmez votre mot de passe',
                    'attr'=> [
                        'placeholder'=>"Confirmez votre mot de passe"
                    ]

                ],
                'mapped'=> false,
            ])
            ->add('Name', TextType::class, [
                'label'=>"Votre Nom",
                'constraints'=>[
                    new Length([
                        'min'=>3,
                        'max'=>20
                    ])
                ],
                'attr'=> [
                    'placeholder'=>"Indiquez votre nom"
                ]
            ])
            ->add('Prenom', TextType::class, [
                'label'=>"Votre Prénom" ,
                'constraints'=>[
                    new Length([
                        'min'=>2,
                        'max'=>20
                    ])
                ],
                'attr'=> [
                    'placeholder'=>"Indiquez votre prénom"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label'=>"S'inscrire"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints'=>[
                new UniqueEntity([
                    'entityClass'=> User::class,
                    'fields' => 'email'
                ])
            ],
            'data_class' => User::class,
        ]);
    }
}
